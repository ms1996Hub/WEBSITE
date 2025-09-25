# PHP Website with User Authentication

A complete PHP website with user authentication system, built with modern PHP practices and Bootstrap 5.

## Features

- User registration and login system
- Secure password hashing
- Session management
- Responsive design
- Flash messages
- Clean URL routing
- Database integration with PDO
- CSRF protection (recommended to implement)

## Requirements

- PHP 8.0 or higher
- MySQL 5.7 or higher (or MariaDB 10.3+)
- Web server (Apache/Nginx) with mod_rewrite enabled
- Composer (for dependency management, if needed)

## Installation

1. **Clone the repository**
   ```bash
   git clone [your-repository-url]
   cd your-project-name
   ```

2. **Set up the database**
   - Create a new MySQL database
   - Import the `database.sql` file to create the necessary tables
   - Update the database credentials in `includes/db.php`

3. **Configure the web server**
   - Point your web server's document root to the public directory
   - Make sure mod_rewrite is enabled for clean URLs

4. **Set proper permissions**
   ```bash
   chmod 755 ./
   chmod -R 755 assets/
   chmod -R 755 uploads/  # If you have file uploads
   ```

## Database Schema

Run the following SQL to create the required tables:

```sql
CREATE DATABASE your_database_name;
USE your_database_name;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## Security Considerations

1. **Before going live**:
   - Change all default passwords
   - Update the database credentials in `includes/db.php`
   - Consider implementing CSRF protection
   - Set up HTTPS with a valid SSL certificate
   - Configure proper file permissions

2. **Recommended PHP settings** (in php.ini):
   ```
   display_errors = Off
   log_errors = On
   error_log = /path/to/php-error.log
   ```

## License

This project is open-source and available under the MIT License.

## Contributing

Feel free to submit issues and enhancement requests.

## Support

For support, please open an issue in the GitHub repository.
