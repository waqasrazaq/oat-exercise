# OAT Exercise (REST API )
The goal of the exercise is to create a REST API that will handle two different resources :
* multiple-choice questions 
* choices related to a question

Only specific endpoints are required as part of this exercise and are described in shared the open-api.yaml.


## Technologies Used
* PHP 7.2
* Laravel Framework 6.11.0
* Composer as package manager
* Google-translate-php

## Prerequisites

Make sure that required version of **PHP**, **Git** and **Composer package manager** is already installed on the system. If not then follow the instructions to download and install all of these dependencies from the below links

* [Git](https://git-scm.com/downloads)
* [Composer package manager](https://getcomposer.org/)
* [Web server for Mac](https://www.mamp.info/en/downloads/)
* [Web server for Windows](http://www.wampserver.com/en/)


## Installation
The installation process is quite simple and straightforward. Just follow the below steps
 
- Open the terminal and navigate into the root directory of the web server and then execute the below command to download the code from github
```
git clone https://github.com/waqasrazaq/oat-exercise.git
```
- Once the code is downloaded then navigate into project directory (oat-exercise) and execute the below command in the root directory and wait for the process to download and install all the required components and dependencies

```composer install```

It will take some time, so wait for a couple of minutes to complete the process.

Once the process is completed then Run the local dev server as below
```
php artisan serve
```

That's it. Our oat-exercise is installed and configured. Double check that dev web server is started and not down the base path

## End Points
**1- Get Questions**: 

Method: Get

Example URL http://127.0.0.1:8000/api/questions?lang=en

For valid response, HTTP status code 200 with list of all the questions items into the files (json format) and status code 500 in case any error on the server.


**2- Save Question** 

Method: Post 

Example URL http://127.0.0.1:8000/api/questions

Payload: JSON Object of Question schema as below. 
```
{
    "text": "What is the capital of Luxembourg ?",
    "createdAt": "2019-06-01 00:00:00",
    "choices": [
      {
        "text": "Luxembourg"
      },
      {
        "text": "Paris"
      },
      {
        "text": "Berlin"
      }
    ]
  }
```

For valid response, HTTP status code 200 with the newly created JSON object and status code 500 in case any error on the server.


## A brief introduction to project structure
Although the information below on the application structure is very brief, at least it gives a starting point for the developers to work on the project


* **routes/api.php** Contains the routes for both end points
* **app/Http/Controllers/QuestionController.php** Handles end points request
* **app/Http/Requests/GetQuestionsRequest, SaveQuestionPostRequest** Controls validates the api request
* **app/Domains/Question** directory holds the complete business logic of these end points
* **config/common.php** Holds configuration variables, for example variables to select data sources (JSON or CSV etc)
* **storage/app** Contains the data file for questions
* **test/Feature/QuestionAPITest.php** Contains end point test cases
* **vendor** - Contains all the composer dependencies

For more details on the files structure, follow this docs https://laravel.com/docs/ link.

### Execute Tests
Execute below command to run the tests
```
./vendor/bin/phpunit
```

## References
Below link contains the best practices (Design principles and Design patterns specific to Laravel) and Coding standards which i have followed in this project

http://www.laravelbestpractices.com/
