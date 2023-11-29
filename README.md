

## Setup 
this project was developed using laravel 10 and sail 
you can run it using docker by running the next command
```bash
composer install
./vendor/bin/sail up -d

composer install 
sail  artisan migrate

sail  artisan db:seed


```

but if you want to run it as a normal laravel project you can do it by following the next steps

composer install
and then run
php artisan migrate
php artisan db:seed

after seed all cities will be imported to the database 
and default user will be created with the next credentials
email admin@admin.com
password 12345678
try to login and navigate to the dashboard and then try to create trip 
be attention you should add all cities to the line to grantee that the scenario going in the right way

after creating first trip you are ready now to test the api use the doc I put pick a set collection.postman_collection.json
and for test I did't have time to write unit test for all cases I will create anther branch for remaining feature like authicticaiton on level of api  which I wish I had a time to do it 



