### API Setup

#### Introduction
This API can be used to save and fetch locations
This API is available for testing through this link [http://localhost:8080/api/v1](http://localhost:8080/api/v1) after starting the server using the artisan command


#### Quick Start
To load in all php dependencies

````
$ cd gk-test-be
$ composer install
````

Copy the .env.example file to .env and update the following accordingly

````
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=XXX
DB_USERNAME=XXX
DB_PASSWORD=XXX
````

---
Replace the Xs with your actual value in the .env file.

Setup queue connection in .env file as follow

````
QUEUE_CONNECTION=database
````

Update your Google Maps API Credentials in the .env file
````
GOOGLE_MAP_API_KEY=XXXXXXXX
````

Proceed to generating you unique application key with the following command

````
$ php artisan key:generate
````

When all this has been done, you then proceed to running your database migration command
````
$ php artisan migrate
````

Start the application by running the command below>

````
$ php artisan serve
````
