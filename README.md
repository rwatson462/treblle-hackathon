# treblle-hackathon
Treblle security hackathon code

### Installation
Check out the repository and run in a Laravel environment of some sort.
After checking out the repository, running the below commands should get you going:
1. `composer install`
2. `php artisan key:generate`
3. `php artisan migrate`
4. `php artisan serve`

The code is also running at https://hackathon.source-pot.dev.

### Tests
A phpunit test suite is included, just run `php artisan test` and watch the magic.

### Endpoints

1. Register
2. Login
3. Logout
4. Create table
5. Add data to table
6. Retrieve data from table

### Security notes

I've removed many parts of Laravel that are not related to the API - views, package.json, css/js files, etc.  
Robots.txt has been updated to (hopefully) tell any crawlers to leave the site alone
