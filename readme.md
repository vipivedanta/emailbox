<h2>Email Box</h2>

Built using Laravel 5.8 & mysql

Pending
---------
1. Multiple account management
2. Activity logger

Completed
-------------
1. Email fetching / listing / deleteing / searching

Configuration
---------------
Update Gmail username & app password ( **Not the regular password** ) in app/Contracts/Source/Mail/Gmail/GmailBoxContract.php

Laravel Scheduler for syncing mails
--------------------------------------
command - php artisan email:sync

Installtion
--------------
git clone https://github.com/vipivedanta/emailbox.git emailbox
cd emailbox
update Mysql database credentials in .env
composer install
php artisan migrate
php artisan email:sync <- this has to be called in intervals or set to Laravel scheduler
