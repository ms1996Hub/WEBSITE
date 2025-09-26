#!/bin/bash

# Railway Migration from Wasmer
echo "🚀 Migrating from Wasmer to Railway"
echo "===================================="
echo ""
echo "Wasmer doesn't support MySQL, but Railway does!"
echo ""

echo "📋 Railway Setup Steps:"
echo "1. Go to https://railway.app"
echo "2. Sign up with GitHub"
echo "3. Click 'New Project'"
echo "4. Choose 'Deploy from GitHub repo'"
echo "5. Select your WEBSITE repository"
echo "6. Railway auto-detects PHP and creates MySQL"
echo ""

echo "✅ What Railway provides:"
echo "- MySQL database (automatically configured)"
echo "- PHP 8.1+ support"
echo "- Free tier (500 hours/month)"
echo "- Auto HTTPS"
echo "- No database configuration needed"
echo ""

echo "🎯 Your app will work immediately on Railway!"
echo "No code changes required - Railway handles MySQL setup."
echo ""

read -p "Would you like to proceed with Railway deployment? (y/n): " choice

if [ "$choice" = "y" ]; then
    echo ""
    echo "🚀 Opening Railway deployment guide..."
    echo ""
    echo "📋 Follow these steps:"
    echo "1. Open https://railway.app in your browser"
    echo "2. Sign up with your GitHub account"
    echo "3. Click 'New Project'"
    echo "4. Select 'Deploy from GitHub repo'"
    echo "5. Authorize Railway to access your repos"
    echo "6. Choose your WEBSITE repository"
    echo "7. Railway will start deployment automatically"
    echo ""
    echo "⏱️  Deployment takes 2-3 minutes"
    echo "🔗 Your site will be at: https://your-app.railway.app"
    echo ""
    echo "📖 For detailed guide, see: FREE-HOSTING-GUIDE.md"
else
    echo ""
    echo "🔧 Alternative: External MySQL Setup"
    echo ""
    echo "If you want to keep using Wasmer, you'll need:"
    echo "1. An external MySQL database (e.g., from Aiven, PlanetScale)"
    echo "2. Update your .env file with external DB credentials"
    echo "3. Configure CORS if needed"
    echo ""
    echo "This is more complex than switching to Railway."
fi

echo ""
echo "✅ Railway is the easiest solution for your PHP + MySQL app!"
