#  LAMP stack 

A basic LAMP stack environment built using Docker Compose. It consists of the following:

* PHP
* Apache
* MySQL
* phpMyAdmin
* Redis
* MailHog

As of now, we have several different PHP versions. Use the php version you need:

* 5.4.x
* 5.6.x
* 7.1.x
* 7.2.x
* 7.3.x
* 7.4.x

##  Installation
 
* Clone this repository on your local computer
* configure the `.env` as needed 
* Run `docker-compose up -d`.

```shell
cp .env.example .env
// modify .env as needed
docker-compose up -d
// visit your machine's IP Address
```

Your LAMP stack is now ready!! You can access it via `http://localhost` or the address of your Docker machine (for example: `http://192.168.99.100`). You can configure this location in the `.env` file with `HOST_MACHINE_IP_ADDRESS`.

##  Configuration and Usage

### General Information 
This Docker Stack is built for local development and not for production usage.

### Configuration
This package comes with default configuration options. You can modify them by creating the `.env` file in your root directory.
To make it easy, just copy the `.env.example` file and update the environment variable values to your needs.

### Configuration Variables
Configuration values can be overwritten in your own `.env` file.

---
### PHP

_**PHPVERSION**_
Is used to specify which PHP version you want to use. Defaults to the latest PHP version. 

_**PHP_INI**_
Define your custom `php.ini` modification to meet your requirements. 

---
### Apache 


_**DOCUMENT_ROOT**_

This is the document root for the Apache server. The default value for this is `./www`. All your sites will go here and will be synced automatically.

_**VHOSTS_DIR**_

This is for virtual hosts. The default value for this is `./config/vhosts`. You can place your virtual hosts conf files here.

> Make sure you add an entry to your system's `hosts` file for each virtual host.

_**APACHE_LOG_DIR**_

This will be used to store Apache logs. The default value for this is `./logs/apache2`.

---
### Database


_**DATABASE**_

Define which MySQL or MariaDB version you would like to use. 

_**MYSQL_LOG_DIR**_

This will be used to store Apache logs. The default value for this is `./logs/mysql`.

## Web Server

Apache is configured to run on port 80. So, you can access it via `http://localhost`.

### Apache Modules

By default the following modules are enabled:

* rewrite
* headers

> If you want to enable more modules, just update `./bin/webserver/Dockerfile`. You can also generate a PR and we will merge it if it seems good for general purposes.
> You have to rebuild the docker image by running `docker-compose build` and restart the docker containers.

### Connect via SSH

You can connect to the web server using the `docker-compose exec` command to perform various operation on it. Use the command below to login to the container via SSH:

```shell
docker-compose exec webserver bash
```

## PHP

The installed version of PHP depends on your `.env`file. 

#### Extensions

By default the following extensions are installed. 
May differ for older PHP versions <7.x.x

* mysqli
* pdo_sqlite
* pdo_mysql
* mbstring
* zip
* intl
* mcrypt
* curl
* json
* iconv
* xml
* xmlrpc
* gd

> If you want to install more extensions, just update `./bin/webserver/Dockerfile`. You can also generate a PR and we will merge it if it seems good for general purposes.
> You have to rebuild the docker image by running `docker-compose build` and restart the docker containers.

## phpMyAdmin

phpMyAdmin is configured to run on port 8080 by default. You can change this in your `.env` file by changing the `HOST_MACHINE_PMA_PORT` configuration value. Use the following default credentials:

http://localhost:8080
username: docker  
password: secret

## Redis

It comes with Redis. It runs on default port `6379`.

## MailHog

Easily catch your application's outgoing mail with MailHog. Access your mailbox at http://localhost:8025.

Use these configuration values in your application to use MailHog:

```
 MAIL_DRIVER=smtp
 MAIL_HOST=0.0.0.0
 MAIL_PORT=1025
 MAIL_USERNAME=
 MAIL_PASSWORD=
 MAIL_ENCRYPTION=null
 ```

## Why you shouldn't use this stack unmodified in production
We want to empower developers to quickly create creative Applications. Therefore we are providing an easy to set up a local development environment for several different frameworks and PHP versions. 
In Production you should modify the following subjects at a minimum:

* php handler: mod_php=> php-fpm
* secure mysql users with proper source IP limitations