## PROG8180 Web Technologies - Final Project
### COCORS (Ride Sharing System)
### Group 1 : Changho Choi, Hassan Nahhal, Nicholas Collins, SungJoe KIM

- We have tested using **Google Chrome Browser**, Please review our project with Chrome Browser.
- This project was worked with **cakephp version 3.1.2**
- The URL for our project on Heroku is : (http://cocors.herokuapp.com/)

## Development Information

  - **Development Environment** : CakePhp 3.1.2 / MySQL / PostMark / Heroku
  - **Database** : Embedded in Heroku with MySQl
  - **Table names** : users, posts, poststags, tags, comments
  - **Database access user**  : admin : **admin@gmail.com**  / password : **11111**
    - User is required to sign up and login with email and password or use Facebook authentication
    - After Facebook authentication, the user can set a password for our site 
    - This password will be used as logIn password (It does not need to be the same as facebook's)
    - Admin is allow to add new user after logging in as admin
    - User is not allowed to modify user's information which come from facebook
    - Admin can modify all information, delete as well
  - There are 3 type of users, unlogged in user, logged in user, admin user
  - Each user has limitations to access certain pages and data, and usage

## Important for testing
 - Due to the quota for Google GEO API with free key and heroku IP is shared, so quota limit will be exceeded easily.  
 - Thus, this affects the ability of the system to get GeoLocation data.  
 - For testing the operation of adding a post that uses Google geo API, using local Apache server works any time; on Heroku, it only works until the day's limit has been exceeded(i.e. many users on Heroku can surpass Google's limit since Google sees Heroku as one IP address)
 - However, Database is still available on Heroku
 - For Commercial purpose, commerical key can be bought or proxy server can be used.

