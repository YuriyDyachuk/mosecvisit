<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## ABOUT DOCUMENTATION FOR [MOSECVISIT]()

FIRST STEPS:

        Uninstall old versions
        Older versions of Docker were called docker, docker.io, or docker-engine. If these are installed, uninstall them:
        - sudo apt-get remove docker docker-engine docker.io containerd runc

        Install Docker Engine:

        - sudo apt-get update
        - sudo apt-get install docker-ce docker-ce-cli containerd.io
        - sudo systemctl start docker

NEXT STEPS:

        - git clone - link to GitHub project
        - copy file .env.exapmle in .env - [ cp env.example .env ]

NEXT STEPS:

        Start command in bash terminal - for Docker:
        - make build
        next:
        - make start

        Generation APP_KEY hash command: 
        - make artisan-command CMD:key:generate

        Give permission to access the directory to write logs [storage/*]:
        - chmod -R 775 storage/

        Give permission to access the directory to write logs [bootstrap/*]:
        - chmod -R 775 storage/

        Generation links folder storage [storage/ for public/]:
        - make artisan-command CMD:storage:link

        Generate migration table databases and seeder:
        - make artisan-command CMD:migrate --seed

NEXT STEPS - OPENING LOCAL SITES IN BROWSER:

        - http://localhost:3001 - First [default] page project
        - http://localhost:3003 - Swagger RESTfull API [login - admin; pass - 123456]

   
