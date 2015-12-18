## PROG8180 Web Technologies - Final Project
  ### Group 1 : Changho Choi, Hassan Nahhal, Nicholas Collins, SungJoe KIM

- We have tested using **Google Chrome Browser**, Please review my works with Chrome Browser.
- This project was worked with **cakephp version 3.1.2**
- Heroku URL is (http://cocors.herokuapp.com/)

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
  - **'Assignment3'** in the below URL is **case sensitive** and others are case insensitive.
  - **Articles List** : ```http://localhost/Assignment3/articles/index```
  - **Add new article** : ```http://localhost/Assignment3/articles/add```
  - **Log in** : ```http://localhost/Assignment3/users/login```
  - **Tag List** : ```http://localhost/Assignment3/Tags/index```
  - **Tag Add** : ```http://localhost/Assignment3/Tags/add```

## LogIn Information
  - **login access as admin** : user name / password --> **admin** / **admin**
     - above Assignment3_DB.sql includes admin data in the users table
     - if users table has no data of admin, can add the add page as below;
       - http://localhost/Assignment3/users/add
  -  **Author password** : all Authors password are same with **aaa**

![Build Status](https://github.com/Skim0082/PROG8180_Assignment3/blob/master/tablesRelation.JPG)
![Build Status](https://github.com/Skim0082/PROG8180_Assignment3/blob/master/Screenshot01.png)

