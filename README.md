## My Hammer (Coding Challenge)

This project is part of coding challenge, with the requirements being to create an (Restful) API that would be used by the companies Angular Frontend for the Web and as well as by our native iOS and Android Apps.

### Requirements
- docker >= 18.0
- docker-compose >= 1.21.1
- git >= 2.x (Used to clone the code from the repository)

### Installation
#### Cloning the repository
```
$ git clone https://github.com/pulkitswarup/codingchallenge.git
```

#### Setting up the project
```
$ cd codingchallenge
$ cp .env.dist .env
$ docker-compose up -d --build
```
*&#42; Please note: &nbsp;`./entrypoint.sh` script should automatically take care of the migrations and fixture while building the containers. However, in case of issue undermentioned commands can be used to manually setup the database & fixtures.*

#### Setting up the database (Optional)
```
$ docker exec -ti myhammer-source-latest bin/console doctrine:migrations:migrate
```

#### Setting up fixtures (Optional)
```
$ docker exec -ti myhammer-source-latest bin/console doctrine:fixtures:load
```

Once these steps are performed the application is up and running and can be accessed @ http://localhost:8888

### Testing
The tests can be run using the following command:
```
$ docker exec -ti myhammer-source-latest bin/phpunit
```

### Additional Information
1. In order, to gain access to the database the following command can be used:
    ```
    $ docker exec -ti myhammer-database-latest mysql -u<your_username_goes_here> -p<your_password_goes_here>
    ```
2. Application logs can be accessed using:
    ```
    $ docker-compose logs -f
    ```