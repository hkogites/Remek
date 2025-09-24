@echo off
setlocal enableextensions
REM Prefer WinGet PHP 8.3 for this session
set "PHP83=C:\Users\user\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.3_Microsoft.Winget.Source_8wekyb3d8bbwe"
if exist "%PHP83%\php.exe" (
  set "PATH=%PHP83%;%PATH%"
) else (
  echo PHP 8.3 not found at %PHP83%
  exit /b 1
)

cd /d "%~dp0"
php -v
php artisan --version
php artisan serve --host=127.0.0.1 --port=8000

