## Simple search portal frontend for Elastic Search

This is a an search portal built using Laravel 5.1 for interfacing with Elastic Search

[Laravel documentation](https://laravel.com/docs/5.1).

## 1. Requirements

* PHP (5.5.9 or later)
* Composer https://getcomposer.org (to install/update packages)
* Running instance or cluster of Eleasticsearch https://www.elastic.co/products/elasticsearch (requires Java)

## 2. Setup

__a.__ Clone this repository (using git)

__b.__ Install packages using composer
   Navigate to the project folder and run:

   ```composer install```

__c.__ Copy ```.env.exmaple``` to a new file named ```.env```

__d.__ Edit the config (.env)
    
    change ELASTICH_SEARCH_HOST to your elastic search host (default localhost:9200)

__e.__ Start elastic search by running a local instance of Elasticsearch 
   By running a local copy of elastic search https://www.elastic.co/products/elasticsearch
   Via docker: https://github.com/dockerfile/elasticsearch 

## 3. Transform and import records to Elastic Search

The portal have built in function to transform DDI into json and put it into Elastic Search.

### Transform DDI-XML to json
   
  You can configure the default location of the source xml-folder in your .env file
  DDI from SND, NSD, FSD and DDA can be downloaded via http://dev.snd.gu.se/sites/dev.snd.gu.se/files/metadata-2016-03-01.zip

  Run the transformation

  ```php artisan xslt:ddi-to-json {path=null} {outpath=null}```
 
### Import json document to the index

  You can configure the default location of the json files in your .env file

``php artisan es:ingest-documents path\to\documents``

## Run

There is several ways to run the portal during development or for production. Use one of the following methods.

### Run app using php builtin webserver (the easy way)
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

### Contributors
* DDA https://www.sa.dk/undervisning-forskning/dda-dansk-data-arkiv
* FSD http://www.fsd.uta.fi
* NSD http://nsd.uib.no
* SND http://snd.gu.se


 
### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
