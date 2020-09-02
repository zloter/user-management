#Installation guide
To install I recommend to use this docker-compose:
https://gitea.pagepartner.provps.pl/zygmunt.loter/laravel_simple_docker

```
docker-compose exec php bash
composer install
chmod -R 777 /var/www/laravel/storage/logs/
chmod -R 777 /var/www/laravel/storage/framework/
```

To generate fake entries for users you can use this command:
```
php artisan seed:users 
```
There is also additional configuration:

        {--type=default  : one of: default, plain, lecturers, employee, both}
        {--amount=100000 : amount of faked account. Up to 100 000}";

You can add additional type to user by tags.
By default about 1/3 will  be an employee \n
And 1/3 will be an lecturer (partially overlapping).

Default amount of records is set to 100 000, but it's taking a lot of time (22 min during last try).
Also faked data will not be added to audit. 
