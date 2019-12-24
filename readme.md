# Advent of Code 04/09/2019

### Begin 

1. Requires Composer and PHP 
2. Open the project directory and run composer install to install PHPUnit
3. To run unit tests. Open the projects root directory in the command line and run `vendor/bin/phpunit test/`. The tests/ directory is already configured in phpunit.xml so you can exclude it. You can also use the `--filter=testmethod` flag to run individual tests
4. There is a UI available and it requires a web server. The target file is the index.php file located in the project root folder. 
5. To run the project in a command line, open the app folder and uncomment lines **193 - 197** in **VenusFuelDepot.php**. You can change the default arguments used in my test which are the start and end input range supplied as part of my challange.  Navigate to the app folder in your terminal and run `php VenusFuelDepot.php` to see the output.
