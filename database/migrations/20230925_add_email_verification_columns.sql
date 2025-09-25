-- Add email verification columns to users table
ALTER TABLE users 
ADD COLUMN verification_token VARCHAR(64) NULL,
ADD COLUMN verified TINYINT(1) NOT NULL DEFAULT 0,
ADD COLUMN verified_at TIMESTAMP NULL,
ADD INDEX (verification_token);
