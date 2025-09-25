#!/bin/bash

# PHP Website Deployment Helper
# This script helps with deployment to various platforms

echo "🚀 PHP Website Deployment Helper"
echo "================================="

# Check if we're in the right directory
if [ ! -f "index.php" ]; then
    echo "❌ Error: Please run this script from the PHP2 project directory"
    exit 1
fi

echo "✅ Found PHP project"

# Check PHP version
if command -v php &> /dev/null; then
    PHP_VERSION=$(php -v | head -n1 | cut -d' ' -f2)
    echo "✅ PHP Version: $PHP_VERSION"
else
    echo "❌ PHP not found. Please install PHP first."
    exit 1
fi

# Check if .env exists
if [ -f ".env" ]; then
    echo "✅ .env file found"
else
    echo "❌ .env file not found. Please create it from .env.example"
    exit 1
fi

echo ""
echo "📋 Available Deployment Options:"
echo "1. Local Development Server (php -S)"
echo "2. Railway (Recommended)"
echo "3. Heroku"
echo "4. DigitalOcean App Platform"
echo "5. Vercel (Limited support)"
echo ""

read -p "Which option would you like to use? (1-5): " choice

case $choice in
    1)
        echo "🚀 Starting local development server..."
        echo "📍 Your website will be available at: http://localhost:8000"
        echo "Press Ctrl+C to stop the server"
        php -S localhost:8000
        ;;
    2)
        echo "🚀 Railway Deployment Instructions:"
        echo "1. Go to https://railway.app"
        echo "2. Create a new project"
        echo "3. Connect your GitHub repository"
        echo "4. Railway will auto-detect PHP and create MySQL"
        echo "5. Set environment variables in Railway dashboard"
        echo "6. Your app will be deployed automatically!"
        ;;
    3)
        echo "🚀 Heroku Deployment Instructions:"
        echo "1. Install Heroku CLI: brew install heroku"
        echo "2. Login: heroku login"
        echo "3. Create app: heroku create your-app-name"
        echo "4. Add PostgreSQL: heroku addons:create heroku-postgresql:hobby-dev"
        echo "5. Update .env for PostgreSQL connection"
        echo "6. Deploy: git push heroku main"
        ;;
    4)
        echo "🚀 DigitalOcean App Platform Instructions:"
        echo "1. Go to https://cloud.digitalocean.com/apps"
        echo "2. Create a new app"
        echo "3. Connect your GitHub repository"
        echo "4. Choose PHP runtime"
        echo "5. Add MySQL database"
        echo "6. Set environment variables"
        echo "7. Deploy!"
        ;;
    5)
        echo "⚠️  Vercel has limited PHP support"
        echo "Note: Vercel doesn't provide MySQL, you'd need external database"
        echo "1. Go to https://vercel.com"
        echo "2. Import your GitHub repository"
        echo "3. Vercel may not fully support this PHP app"
        echo "4. Consider Railway or Heroku instead"
        ;;
    *)
        echo "❌ Invalid choice. Please run the script again."
        exit 1
        ;;
esac
