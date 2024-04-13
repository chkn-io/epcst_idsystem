# EPCST ID System for Employees
The Employee Personal Code and Security Tag (EPCST) Time Tracking System is a specialized solution designed to accurately record the time-in and time-out of employees within an organization. This system streamlines attendance management while ensuring data security and privacy.

## Notes
1. Make sure that the PC name is Eastwoods
2. Camera is installed and working
3. RFID is installed and working
4. Minimum Requirements
   * Intel Core i3 7th Gen or above
   * 8GB RAM or above
   * 250GB SSD or above
   * Windows 10
5. Internet Connection for Backup - 10Mbps+
   
## Installation
1. Open OneDrive and Sign-in using biometrics@epcst.edu.ph
    * Make sure to check the Desktop on backup
2. Install the following Applications (OneDrive - Desktop/Installer):
   * Laragon
     - Install phpmyadmin
     - Enable (Run laragon when Windows starts, Run minimized, Start all automatically)
     - Enable SSL on Apache
     - Add mysql/bin on PATH
    * Winrar
    * Gzip
      - Add bin on PATH
    * Composer
      - Add composer to PATH
    * NodeJS
    * Visual Studio Code
    * Github Desktop
    * Chrome
3. Clone project to laragon/www/epcst_idsystem. Setup .env.
   * Paste all the old snapshots inside storage/app/public/snapshots
   * Paste all the old images inside storage/app/images
   * composer install
   * npm install
   * php artisan key generate
   * php artisan storage:link
   * npm run build
5. Import latest database to phpmyadmin.
6. Import Tasks(Desktop/Task Scheduler) to Windows Task Scheduler
   * Run Dev - On Log (once)
   * Execute DB Backup - On Log (every 30 minutes)
   * DB Backup - On Log (every 30 minutes)
   * Backup Images - On Log (every 30 minutes)
   * Backup Snapshots - On Log (every 30 minutes)
   * Load Kiosk - On Log (once)
