<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## ABOUT DOCUMENTATION FOR [MOSECVISIT]()

##FIRST STEPS
  * Uninstall old versions
  * Older versions of Docker were called docker, docker.io, or docker-engine. If these are installed, uninstall them:

## Command
    sudo apt-get remove docker docker-engine docker.io containerd runc

## Install Docker Engine
    sudo apt-get update
    sudo apt-get install docker-ce docker-ce-cli containerd.io
    sudo systemctl start docker

NEXT STEPS

The extension allows to:
  * git clone - link to GitHub project
  * copy file .env.exapmle in .env

## Command
    cp env.example .env

NEXT STEPS

## Start command in bash terminal - for Docker
    make build

## next
    make start

## Generation APP_KEY hash command
    make artisan-command CMD=key:generate

## Clear cache all
    php artisan route:clear
    php artisan config:clear
    php artisan cache:clear

## Give permission to access the directory to write logs [storage/*]:
    chmod -R 775 storage/

## Give permission to access the directory to write logs [bootstrap/*]:
    chmod -R 775 bootstrap/

## Generation links folder storage [storage/ for public/]:
    make artisan-command CMD=storage:link

## Generate migration table databases:
    make artisan-command CMD=migrate

## Generate seeder:
    make artisan-command CMD=db:seed


NEXT STEPS - OPENING LOCAL SITES IN BROWSER:

## Command First [default] page project
    http://localhost:3001

## Command Swagger RESTfull API
    http://localhost:3003

## LOGIN SWAGGER
    admin 
## PASSWORD SWAGGER
    123456
    
