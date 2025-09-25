<?php

class Mailer {
    private $mailer;
    
    public function __construct() {
        // Load PHPMailer
        require_once __DIR__ . '/../vendor/autoload.php';
        
        $this->mailer = new PHPMailer\PHPMailer\PHPMailer(true);
        
        // Server settings
        $this->mailer->isSMTP();
        $this->mailer->Host = getenv('MAIL_HOST') ?: 'smtp.mailtrap.io';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = getenv('MAIL_USERNAME') ?: 'your_mailtrap_username';
        $this->mailer->Password = getenv('MAIL_PASSWORD') ?: 'your_mailtrap_password';
        $this->mailer->SMTPSecure = getenv('MAIL_ENCRYPTION') ?: 'tls';
        $this->mailer->Port = getenv('MAIL_PORT') ?: 2525;
        
        // From email address and name
        $this->mailer->setFrom(
            getenv('MAIL_FROM_ADDRESS') ?: 'noreply@example.com',
            getenv('MAIL_FROM_NAME') ?: 'Your App Name'
        );
    }
    
    /**
     * Send verification email
     * 
     * @param string $toEmail
     * @param string $username
     * @param string $verificationToken
     * @return bool
     */
    public function sendVerificationEmail($toEmail, $username, $verificationToken) {
        try {
            // Recipients
            $this->mailer->addAddress($toEmail, $username);
            
            // Content
            $this->mailer->isHTML(true);
            $this->mailer->Subject = 'Verify your email address';
            
            $verificationUrl = getenv('APP_URL') . '/verify-email.php?token=' . urlencode($verificationToken);
            
            $this->mailer->Body = "
                <h2>Welcome to " . htmlspecialchars(getenv('APP_NAME') ?: 'Our App') . "!</h2>
                <p>Hello " . htmlspecialchars($username) . ",</p>
                <p>Thank you for registering. Please click the button below to verify your email address:</p>
                <p>
                    <a href=\"$verificationUrl\" style=\"display: inline-block; padding: 10px 20px; background-color: #007bff; color: #ffffff; text-decoration: none; border-radius: 5px;\">
                        Verify Email Address
                    </a>
                </p>
                <p>Or copy and paste this URL into your browser:</p>
                <p><small>" . htmlspecialchars($verificationUrl) . "</small></p>
                <p>If you did not create an account, no further action is required.</p>
                <p>Thanks,<br>" . htmlspecialchars(getenv('MAIL_FROM_NAME') ?: 'Your App Team') . "</p>
            ";
            
            $this->mailer->AltBody = "
                Welcome to " . getenv('APP_NAME') . "!\n\n" .
                "Hello $username,\n\n" .
                "Thank you for registering. Please visit the following link to verify your email address:\n\n" .
                "$verificationUrl\n\n" .
                "If you did not create an account, no further action is required.\n\n" .
                "Thanks,\n" . getenv('MAIL_FROM_NAME') . "
            ";
            
            $this->mailer->send();
            return true;
            
        } catch (Exception $e) {
            error_log("Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}");
            return false;
        }
    }
}
