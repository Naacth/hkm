#!/bin/bash

# Script untuk fix masalah gambar tidak muncul di hosting
# HIMAKOM UYM - Image Upload Fix Script

echo "========================================="
echo "  HIMAKOM - Fix Image Upload Issues"
echo "========================================="
echo ""

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# 1. Check current directory
echo -e "${YELLOW}[1/7]${NC} Checking current directory..."
if [ ! -f "artisan" ]; then
    echo -e "${RED}Error: artisan file not found. Please run this script from Laravel root directory!${NC}"
    exit 1
fi
echo -e "${GREEN}✓ Current directory is correct${NC}"
echo ""

# 2. Create folders if not exist
echo -e "${YELLOW}[2/7]${NC} Creating upload folders..."
mkdir -p public/uploads/events
mkdir -p public/uploads/qris
mkdir -p public/uploads/certificates/manual
mkdir -p public/uploads/certificates/generated
mkdir -p public/uploads/certificates/batch
mkdir -p public/uploads/proof_of_payment
mkdir -p public/uploads/products
echo -e "${GREEN}✓ Folders created${NC}"
echo ""

# 3. Set permissions
echo -e "${YELLOW}[3/7]${NC} Setting folder permissions..."
chmod -R 775 public/uploads
chmod -R 775 storage
chmod -R 775 bootstrap/cache
echo -e "${GREEN}✓ Permissions set to 775${NC}"
echo ""

# 4. Check folder structure
echo -e "${YELLOW}[4/7]${NC} Verifying folder structure..."
ls -la public/uploads/
echo ""

# 5. Clear Laravel cache
echo -e "${YELLOW}[5/7]${NC} Clearing Laravel cache..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
echo -e "${GREEN}✓ Cache cleared${NC}"
echo ""

# 6. Check .env APP_URL
echo -e "${YELLOW}[6/7]${NC} Checking APP_URL configuration..."
if [ -f ".env" ]; then
    APP_URL=$(grep "^APP_URL=" .env | cut -d '=' -f2)
    echo "Current APP_URL: $APP_URL"
    
    # Detect if we're on localhost or production
    if [[ $APP_URL == *"localhost"* ]] || [[ $APP_URL == *"127.0.0.1"* ]]; then
        echo -e "${YELLOW}⚠ Warning: APP_URL is set to localhost. Update it for production!${NC}"
    else
        echo -e "${GREEN}✓ APP_URL looks good${NC}"
    fi
else
    echo -e "${RED}✗ .env file not found!${NC}"
fi
echo ""

# 7. Test image access
echo -e "${YELLOW}[7/7]${NC} Testing image folder access..."
if [ -d "public/uploads/events" ]; then
    FILE_COUNT=$(find public/uploads/events -type f | wc -l)
    echo "Found $FILE_COUNT files in events folder"
    
    if [ $FILE_COUNT -gt 0 ]; then
        echo "Sample files:"
        ls -lh public/uploads/events | head -5
    else
        echo -e "${YELLOW}⚠ No files found in events folder${NC}"
    fi
else
    echo -e "${RED}✗ Events folder not found!${NC}"
fi
echo ""

# Summary
echo "========================================="
echo "  Summary"
echo "========================================="
echo -e "${GREEN}✓ Folders created and permissions set${NC}"
echo -e "${GREEN}✓ Laravel cache cleared${NC}"
echo ""
echo "Next steps:"
echo "1. Upload file debug-images.php ke folder public/"
echo "2. Akses https://yourdomain.com/debug-images.php"
echo "3. Check hasil debugging"
echo "4. Test upload gambar baru via admin panel"
echo ""
echo "If images still not showing:"
echo "1. Check APP_URL in .env matches your domain"
echo "2. Run SQL to fix image paths in database"
echo "3. Check .htaccess file in public folder"
echo ""
echo -e "${GREEN}Done!${NC}"
