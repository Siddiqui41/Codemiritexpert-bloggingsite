@echo off
title Nexus Smashing Magazine - Laravel Server
echo ========================================================
echo   Starting Nexus Smashing Magazine (Smashing Clone)
echo   Laravel 12.70.2 on PHP 8.3.28 (Upload Limit: 64MB)
echo ========================================================
echo.

:: Free up port 8000 if occupied
for /f "tokens=5" %%a in ('netstat -aon ^| findstr :8000 ^| findstr LISTENING 2^>nul') do (
    taskkill /F /PID %%a >nul 2>&1
)

echo Front-End URL:    http://127.0.0.1:8000
echo Admin Panel URL:  http://127.0.0.1:8000/admin
echo Admin Login:      admin@smashing.dev
echo Admin Password:   password123
echo.
echo Press Ctrl+C anytime to stop server.
echo ========================================================
php -d upload_max_filesize=64M -d post_max_size=64M -d memory_limit=256M artisan serve --port=8000
pause
