## PROG8180 Web Technologies - Assignment 3

- I have tested using **Google Chrome Browser**, Please review my works with Chrome Browser.

## CakePHP Association

  - **Development Environment** : WAMP Server
  - **Database name** : assignment3
  - **Table names** : articles, users, comments, tags, articles_tags
  - **Database access user**  : user : **root**  / password : **root**
    - Configuration for connection of database was already set in app.php in config folder of CakePHP 
    - Database schema are located in the folder of 'config/schema' in CakePHP structure
      - **Schema files name** : **Assignment3_DB.sql** which includes creating Database, Tables, and insert data already exist
  - I did not implement to validate specific details such as the wrong url address.
  - public user (not logedin) only can see title, body, tags (no comments)
  - author logedin can see only approved comments
  - admin can see all and edit, delete comments as well.

###Blog Articles Url 
  - **Articles List** : ```http://localhost/Assignment3/Articles/index```
  - **Add new article** : ```http://localhost/Assignment3/articles/add```
  - **Log in** : ```http://localhost/Assignment3/users/login```

## LogIn Information
  - **login access as admin** : user name / password --> **admin** / **admin**
     - above Assignment3_DB.sql includes admin data in the users table
     - if users table has no data of admin, can add the add page as below;
       - http://localhost/Assignment3/users/add
  -  **Author password** : all Authors password are same with **aaa**

![Build Status](https://github.com/Skim0082/PROG8180_Assignment3/blob/master/tablesRelation.JPG)
![Build Status](https://github.com/Skim0082/PROG8180_Assignment3/blob/master/Screenshot01.png)
