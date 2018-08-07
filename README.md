## My Hammer (Coding Challenge)

This project is part of coding challenge, with the requirements to create an API (Restful) that would be used by the companies Angular Frontend for the Web and as well as by our native iOS and Android Apps.

### Requirements
- docker >= 18.0
- docker-compose >= 1.21.1
- git >= 2.x (Used to clone the code from the repository)

### Installation
#### Cloning the repository
```bash
$ git clone https://github.com/pulkitswarup/codingchallenge.git
```

#### Setting up the project
```bash
$ cd codingchallenge
$ cp .env.dist .env
$ mkdir -p var/log var/cache && chmod -R 777 var/
$ docker-compose up -d --build
```

#### Setting up dependencies/libraries
```bash
$ docker exec -it myhammer-source-latest php composer.phar install
```

#### Setting up the database
```bash
$ # Run migrations
$ docker exec -ti myhammer-source-latest bin/console doctrine:migrations:migrate -n
$ # Check migrations status
$ docker exec -ti myhammer-source-latest bin/console doctrine:migrations:status

 == Configuration

    >> Name:                                               Application Migrations
    >> Database Driver:                                    pdo_mysql
    >> Database Name:                                      myhammer
    >> Configuration Source:                               manually configured
    >> Version Table Name:                                 migration_versions
    >> Version Column Name:                                version
    >> Migrations Namespace:                               DoctrineMigrations
    >> Migrations Directory:                               /app/myhammer/src/Migrations
    >> Previous Version:                                   Already at first version
    >> Current Version:                                    0
    >> Next Version:                                       2018-08-07 21:23:00 (20180807212300)
    >> Latest Version:                                     2018-08-07 21:23:00 (20180807212300)
    >> Executed Migrations:                                1
    >> Executed Unavailable Migrations:                    0
    >> Available Migrations:                               1
    >> New Migrations:                                     0
```

#### Setting up fixtures
```bash
$ docker exec -ti myhammer-source-latest bin/console doctrine:fixtures:load -n
```

Once these steps are performed the application is up and running and can be accessed @ http://localhost:8888

### Testing
The tests can be run using the following command:
```bash
$ docker exec -ti myhammer-source-latest ./vendor/bin/simple-phpunit
```
### API Reference
For more details refer [here](http://htmlpreview.github.io/?https://github.com/pulkitswarup/codingchallenge/blob/master/apidoc/doc.html?rnd=1)
### Additional Information
1. In order, to gain access to the database the following command can be used:
    ```bash
    $ docker exec -ti myhammer-database-latest mysql -u<your_username_goes_here> -p<your_password_goes_here>
    ```
2. Application logs can be accessed using:
    ```bash
    $ docker-compose logs -f
    ```
3. Host entry for better usability:
    ```bash
    # /etc/hosts
    127.0.0.1 myhammer.local
    ```
### Known Issues
1. There are still issues/bugs in the code, with respect to constraint validation.
2. `EntityNotFoundException` is currently thrown with status code 500 instead of 404 (which would have been more suitable)
