# PowerShell script to optimize website file sizes

Write-Host "Starting optimization..." -ForegroundColor Green

# Remove temporary files older than 1 day
Write-Host "Removing temporary files..." -ForegroundColor Yellow
if (Test-Path "storage\app\private\tmp") {
    Get-ChildItem -Path "storage\app\private\tmp" -File | Where-Object { $_.LastWriteTime -lt (Get-Date).AddDays(-1) } | Remove-Item -Force
    Write-Host "Cleaned storage\app\private\tmp" -ForegroundColor Green
}

if (Test-Path "storage\app\public\lessonsVideo\tmp") {
    Get-ChildItem -Path "storage\app\public\lessonsVideo\tmp" -File | Where-Object { $_.LastWriteTime -lt (Get-Date).AddDays(-1) } | Remove-Item -Force
    Write-Host "Cleaned storage\app\public\lessonsVideo\tmp" -ForegroundColor Green
}

# Clear Laravel cache
Write-Host "Clearing Laravel cache..." -ForegroundColor Yellow
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize autoloader
Write-Host "Optimizing autoloader..." -ForegroundColor Yellow
composer dump-autoload --optimize --no-dev

Write-Host "Optimization complete!" -ForegroundColor Green

