
## About Lascat 

This is a Laravel 8 project, which manages School, Classes and Students
A Rest API endpoint provided at (POST) /api/student to add more student
(POST) /api/login & (GET) /api/logout are used for login and logout.

To run this project with Laravel sail ( docker base): <br/>
./vendor/bin/sail up -d <br/>
./vendor/bin/sail composer install <br/>
./vendor/bin/sail artisan migrate <br/>
To add test data:<br/>
./vendor/bin/sail db:seed<br/>

default admin: admin@admin.com/password<br/>
you can create more admin using register page at <domain>/register<br/>
To run test :<br/>
./vendor/bin/sail test -testsuite=Feature<br/>
<br/>



Cheers,
