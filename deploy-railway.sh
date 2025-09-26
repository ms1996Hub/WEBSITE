#!/bin/bash

# Railway Deployment Helper
echo "🚀 Railway Deployment Helper for PHP Website"
echo "============================================"

echo ""
echo "🔧 Step 1: Prepare Railway Account"
echo "1. Go to https://railway.app"
echo "2. Sign up/Login to your account"
echo "3. Click 'New Project'"
echo ""

echo "🔧 Step 2: Deploy from GitHub"
echo "1. Choose 'Deploy from GitHub repo'"
echo "2. Authorize Railway to access your GitHub"
echo "3. Select your 'WEBSITE' repository"
echo "4. Railway will auto-detect PHP and create MySQL"
echo ""

echo "🔧 Step 3: Configure Environment Variables"
echo "In Railway dashboard, go to 'Variables' and add:"
echo "- APP_ENV=production"
echo "- APP_DEBUG=false"
echo "- APP_URL=https://your-app-name.railway.app"
echo ""

echo "🔧 Step 4: Database Setup"
echo "Railway will automatically provide MySQL database"
echo "Get the database credentials from Railway dashboard"
echo "Update the environment variables with actual DB values"
echo ""

echo "🎉 Your app will deploy automatically!"
echo "Access it at: https://your-app-name.railway.app"
echo ""

read -p "Would you like me to help you with any specific step? (y/n): " help

if [ "$help" = "y" ]; then
    echo "Which step do you need help with?"
    echo "1. Railway account setup"
    echo "2. GitHub connection"
    echo "3. Environment variables"
    echo "4. Database configuration"
    echo "5. Other"

    read -p "Enter step number: " step

    case $step in
        1)
            echo "📋 Railway Account Setup:"
            echo "1. Go to https://railway.app"
            echo "2. Click 'Sign Up' or 'Login'"
            echo "3. Use GitHub/Google for quick signup"
            echo "4. Verify your email if prompted"
            ;;
        2)
            echo "📋 GitHub Connection:"
            echo "1. In Railway, click 'New Project'"
            echo "2. Select 'Deploy from GitHub repo'"
            echo "3. Click 'Configure GitHub App'"
            echo "4. Authorize Railway to access your repos"
            echo "5. Select your 'WEBSITE' repository"
            ;;
        3)
            echo "📋 Environment Variables:"
            echo "After deployment starts:"
            echo "1. Go to your Railway project"
            echo "2. Click on 'Variables' tab"
            echo "3. Add each variable listed above"
            echo "4. Railway will restart the app automatically"
            ;;
        4)
            echo "📋 Database Configuration:"
            echo "Railway provides MySQL automatically:"
            echo "1. In Railway dashboard, click 'MySQL'"
            echo "2. Copy the connection details"
            echo "3. Update environment variables with real values"
            echo "4. Database schema is already in database.sql"
            ;;
        5)
            echo "Please describe what you need help with:"
            read -p "Description: " desc
            echo "I'll help you with: $desc"
            ;;
    esac
fi

echo ""
echo "✅ Your Railway deployment is ready!"
echo "Follow the steps above and your PHP website will be live!"
