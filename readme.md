## Simple search portal frontend for Elastic Search

This is a an instance of Laravel 5.1 for interfacing with Elastic Search

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Requirements

* PHP
* Composer https://getcomposer.org (to instal/update packages)

## Setup

1. Clone this repository
2. Update packages using composer
   ```composer update```
3. Copy ```.env.exmaple``` to a new file named ```.env```
4. Edit the config (database curerntly not used)

## Run

Run app using php builtin webserver:

```php artisan serve```

Using vagrant:
 go to the projects root directory
 
 generate ssh key:
 
 ```ssh-keygen -t rsa -C "your@email.com"```

 run vagrant:
 
 ```vagrant up```
 
Using apache:

 add a site/vhost and point it to the directory ```./search-portal/public``` 
 
### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
