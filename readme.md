## Simple search portal frontend for Elasticsearch

This is a search portal built using [Laravel 5.1](https://laravel.com/docs/5.1) for interfacing with [Elasticsearch](https://www.elastic.co/products/elasticsearch).

## 1. Requirements

* PHP (5.5.9 or later)
* Composer https://getcomposer.org (to install/update packages)
* Running instance or cluster of Elasticsearch https://www.elastic.co/products/elasticsearch (requires Java)

## 2. Setup

__a.__ Clone this repository

```
git clone https://github.com/NordicHealthData/search-portal.git
```

__b.__ Install packages using composer by navigating to the project folder and running

```
composer install
```

__c.__ Copy ```.env.example``` to a new file named ```.env```

__d.__ Edit the configuration file ```.env``` and change ELASTICSEARCH_HOST to your Elasticsearch host (default localhost:9200)

```
ELASTICSEARCH_HOST=yourhost:9200
```

__e.__ Start Elasticsearch by running a [local instance of Elasticsearch](https://www.elastic.co/products/elasticsearch) or via [Docker](https://github.com/dockerfile/elasticsearch).

## 3. Transform and import records to Elasticsearch

The portal has built-in functionality to transform DDI into json and put it into Elasticsearch.

### Transform DDI-XML to json
   
You can configure the default location of the source xml-folder in your .env file
DDI from SND, NSD, FSD and DDA can be downloaded via http://dev.snd.gu.se/sites/dev.snd.gu.se/files/metadata-2016-03-01.zip

Run the transformation

```
php artisan xslt:ddi-to-json {path=null} {outpath=null}
```
 
### Import json document to the index

You can configure the default location of the json files in your .env file

```
php artisan es:ingest-documents path\to\documents
```

## Run

There are several ways to run the portal in development or production. Use one of the following methods.

### Run app using php builtin webserver (the easy way)

```
php artisan serve
```

Go to: http://localhost:8000

Make sure your local instance of Elasticsearch is running.

### Using vagrant

Go to the root directory of the project and generate a new SSH key
 
```
ssh-keygen -t rsa -C "your@email.com"
```

Run vagrant
 
```
vagrant up
```
 
### Using apache

add a site/vhost and point it to the directory ```./search-portal/public``` 

### Using docker

```
cp .env.example .env
vim .env
docker build -t nordichealthportal .
docker run --name portal -p 80:80 -it nordichealthportal
```

## Contributors

* DDA https://www.sa.dk/undervisning-forskning/dda-dansk-data-arkiv
* FSD http://www.fsd.uta.fi
* NSD http://nsd.uib.no
* SND http://snd.gu.se

## License

This project is licensed under the terms of the [MIT license](http://opensource.org/licenses/MIT).
