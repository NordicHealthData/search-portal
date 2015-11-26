## Simple search portal frontend for Elastic Search

This is a an instance of Laravel 5.1 for interfacing with Elastic Search

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Requirements

* PHP (5.5.9 or newer)
* Composer https://getcomposer.org (to install/update packages)

## Setup

1. Clone this repository

2. Install packages using composer

   ```composer install```

3. Copy ```.env.exmaple``` to a new file named ```.env```

4. Edit the config (database curerntly not used)
    
    change ``ELASTICH_SEARCH_HOST`` to your elastic search host

## Run

There is several ways to run the portal during development or for production. Use one of the following methods.

### Run app using php builtin webserver

```php artisan serve```

### Using vagrant
 go to the projects root directory
 
 generate ssh key:
 
 ```ssh-keygen -t rsa -C "your@email.com"```

 run vagrant:
 
 ```vagrant up```
 
### Using apache

 add a site/vhost and point it to the directory ```./search-portal/public``` 

### Using docker

```
 cp .env.example .env
 vim .env
 docker build -t nordichealthportal .
 docker run --name portal -p 80:80 -it nordichealthportal
```

### Transform DDI-XML to json
   
  You can configure the default location of the source xml-folder in your .env file

  Run the transformation

  ```php artisan xslt:ddi-to-json {path=null} {outpath=null}```
 
### Import json document to the index

  You can configure the default location of the json files in your .env file

```php artisan es:ingest-documents path\to\documents``

 
### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
