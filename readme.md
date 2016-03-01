## Simple search portal frontend for Elastic Search

This is a an search portal built using Laravel 5.1 for interfacing with Elastic Search

## Laravel documentationDocumentation
[Laravel website](http://laravel.com/docs).

## Requirements

* PHP (5.5.9 or later)
* Composer https://getcomposer.org (to install/update packages)
* Running instance or cluster of Eleasticsearch https://www.elastic.co/products/elasticsearch

## Setup

1. Clone this repository (using git)

2. Install packages using composer
   Navigate to the project folder and run:

   ```composer install```

3. Copy ```.env.exmaple``` to a new file named ```.env```

4. Edit the config
    
    change ``ELASTICH_SEARCH_HOST`` to your elastic search host (default ```localhost:9200```)

5. A running instance of Elasticsearch can be achieved by running Elasticsearch in Docker, see:                 https://github.com/dockerfile/elasticsearch 

## Run

There is several ways to run the portal during development or for production. Use one of the following methods.

### Run app using php builtin webserver (tehe easy way)
Run:

```php artisan serve```

Go to: http://localhost:8000

Make sure you local instance of elastic search is running

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

## Transform and import records to Elastic Search

The portal have built in function to transform DDI into json and put it into Elastic Search.

### Transform DDI-XML to json
   
  You can configure the default location of the source xml-folder in your .env file

  Run the transformation

  ```php artisan xslt:ddi-to-json {path=null} {outpath=null}```
 
### Import json document to the index

  You can configure the default location of the json files in your .env file

``php artisan es:ingest-documents path\to\documents``

### Contributors
* DDA https://www.sa.dk/undervisning-forskning/dda-dansk-data-arkiv
* FSD http://www.fsd.uta.fi
* NSD http://nsd.uib.no
* SND http://snd.gu.se


 
### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
