## PROG8180 Web Technologies - Final Project
### Group 1 : Changho Choi, Hassan Nahhal, Nicholas Collins, SungJoe KIM

- We have tested using **Google Chrome Browser**, Please review my works with Chrome Browser.
- This project was worked with **cakephp version 3.1.2**
- Heroku URL of our project is as like : (http://cocors.herokuapp.com/)

## Develop Information

  - **Development Environment** : CakePhp 3.1.2 / MySQL / PostMark / Heroku
  - **Database name** : 
  - **Table names** : users, posts, poststags, tags, comments
  - **Database access user**  : admin : **admin@gmail.com**  / password : **11111**
    - User is required email and password with Facebook athentification
    - After Facebook athentification, user set the password for our site 
    - This password will be used logIn password (It does not need to be the same with the facebook's)
    - admin is allow to add new user after login as admin role
    - User is not 
  - We did not implement to validate specific details such as the wrong url address.
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

