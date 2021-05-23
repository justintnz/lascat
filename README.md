
## About Lascat 

This is a Laravel 8 project, which manages School, Classes and Students
A Rest API endpoint provided at (POST) /api/student to add more student
(POST) /api/login & (GET) /api/logout are used for login and logout.

To run this project with Laravel sail ( docker base): 
./vendor/bin/sail up -d
./vendor/bin/sail composer install
./vendor/bin/sail artisan migrate
To add test data:
./vendor/bin/sail db:seed

default admin: admin@admin.com/password
you can create more admin using register page at <domain>/register
To run test :
./vendor/bin/sail test -testsuite=Feature




Cheers,
