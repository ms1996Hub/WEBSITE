#!/bin/bash

# Quick Free Hosting Setup
echo "🚀 Quick Free Hosting Setup"
echo "==========================="
echo ""
echo "Choose your free hosting option:"
echo "1. Railway (Recommended - 500 hours free/month)"
echo "2. Heroku (Free tier available)"
echo "3. 000webhost (Free PHP hosting)"
echo "4. Railway subdomain (Instant deployment)"
echo ""

read -p "Enter your choice (1-4): " choice

case $choice in
    1)
        echo "🚀 Deploying to Railway..."
        echo ""
        echo "📋 Steps:"
        echo "1. Open: https://railway.app"
        echo "2. Sign up with GitHub"
        echo "3. Click 'New Project'"
        echo "4. Choose 'Deploy from GitHub repo'"
        echo "5. Select your WEBSITE repository"
        echo "6. Railway will auto-deploy!"
        echo ""
        echo "✅ Your site will be at: https://your-app.railway.app"
        echo "✅ MySQL database included"
        echo "✅ Free SSL certificate"
        ;;
    2)
        echo "🚀 Heroku Deployment:"
        echo ""
        echo "Commands to run:"
        echo "heroku create your-app-name"
        echo "heroku addons:create heroku-postgresql:hobby-dev"
        echo "git push heroku master"
        echo ""
        echo "📝 Note: Uses PostgreSQL, not MySQL"
        ;;
    3)
        echo "🚀 000webhost Setup:"
        echo ""
        echo "📋 Steps:"
        echo "1. Go to https://000webhost.com"
        echo "2. Sign up for free account"
        echo "3. Upload your files via FTP or file manager"
        echo "4. Create MySQL database"
        echo "5. Update .env file with database credentials"
        echo ""
        echo "✅ Free hosting with MySQL"
        ;;
    4)
        echo "🚀 Instant Railway Subdomain:"
        echo ""
        echo "📋 Quickest option:"
        echo "1. Go to https://railway.app"
        echo "2. Deploy from GitHub as above"
        echo "3. Use the auto-generated URL: your-app.railway.app"
        echo "4. No DNS setup needed!"
        echo "5. Add custom domain later if desired"
        echo ""
        echo "✅ Deploy in 5 minutes"
        echo "✅ No configuration needed"
        ;;
    *)
        echo "❌ Invalid choice. Please run the script again."
        exit 1
        ;;
esac

echo ""
echo "📖 For detailed guide, see: FREE-HOSTING-GUIDE.md"
echo ""
echo "🎯 Your PHP website is ready for free hosting!"
