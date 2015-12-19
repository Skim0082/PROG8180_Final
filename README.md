## PROG8180 Web Technologies - Final Project
### COCORS (Ride Sharing System)
### Group 1 : Changho Choi, Hassan Nahhal, Nicholas Collins, SungJoe KIM

- We have tested using **Google Chrome Browser**, Please review our project with Chrome Browser.
- This project was worked with **cakephp version 3.1.2**
- Heroku URL of our project is as like : (http://cocors.herokuapp.com/)

## Develop Information

  - **Development Environment** : CakePhp 3.1.2 / MySQL / PostMark / Heroku
  - **Database** : Embedded in Heroku with MySQl
  - **Table names** : users, posts, poststags, tags, comments
  - **Database access user**  : admin : **admin@gmail.com**  / password : **11111**
    - User is required email and password with Facebook athentification
    - After Facebook athentification, user set the password for our site 
    - This password will be used logIn password (It does not need to be the same with the facebook's)
    - Admin is allow to add new user after login as admin role
    - User is not allowed to modify user's information which come from facebook
    - Admin can modify every information, delete as well
  - There are 3 type of users, unlogined user, logined user, admin user
  - Each user has own limitation to access to the pages and usage

## Important for testing
 - **Due to there's quata for Google GEO API with free key and heroku IP is shared. 
 - **Thus quata limite will be overed easily.
 - **For testing operation adding post that is interoperated with Google geo API, using local Apache server is needed
 - **However, heroku database is still available
 - **For Commercial purpose, commerical key can be bought or proxy server can be used.

