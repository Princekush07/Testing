###################
ABOUT THIS APP
###################

This app contains a CRUD interface for flower pots as well a notifier on when to water
the flowers.

Technologies used:
1. Javascript
2. jQuery
3. Twitter Bootstrap
4. PHP (with Codeigniter framework)

###################
INSTALLATION
###################

1. Create a database using the sqldump file (database_dump.sql).
2. Make sure to have the correct database settings in ./application/config/database.php
3. Have Apache mod_rewrite enabled
4. Copy .htaccess.example to .htaccess and modify configurations

###################
RUNNING SCHEDULER AS CRON
###################

Create a cron entry that runs every 5 minutes using this command:
*/5 * * * * /usr/local/bin/php /path/to/epam/index.php notifier cron

Note: Make sure email server is configured correctly. You may use this link for reference:
https://www.codeigniter.com/userguide2/libraries/email.html






