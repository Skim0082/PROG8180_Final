# PROG8180_Final
PROG8180 - Web Technologies
  
  **User List Example Source Codes**
  
    - I uploaded the example files of User list.
    - It contains from AngularJS to access to the mySQL 'users' table.
    - DB schema file is located in the 'config' folder, so you can create db and table including some test data
    - It contains the source codes for CRUD functions
    - I hope these files would be helpful to start our project.
    - Before using them, several node packages are necessary to install
      -- NodeJS v4.2.2 (https://nodejs.org/dist/v4.2.2/node-v4.2.2-x64.msi)
      -- Express (npm install express --save)
      -- mySql (npm install mysql --save)
      -- body-parser (npm install body-parser --save)
    -- AngularJS : it was already enclosed in the folder.
      -- I used the version 1.2.28 which means 1.4.8 or latest version is not compatable with older version.
    -- Bootstrap : Style and JavaScript are included in the folder
    - In my opinion, please review these example codes to catch up with the usage with AngularJS, NodeJS, and mySQL.
    - I'm willing to help you how these work.
    - Then as soon as possible, we should discuss further steps together.

    - root
    -- Root
	-config			
		-schema		
			-database.sql	
	-server			
		-relevate db access files		
	-mvc			
		-controllers		
		-views		
			-user	
				-signup.ejs
				-signin
				-index
				-view
				-edit
			-post	
				-add
				-index
				-view
				-edit
			-partials	
				-header
				-footer
				-head
			-pages	
				-index
				-about
				-contact
	-public			
		-css		
		-js		
	-node_modules
	-server.js (or app.js)			
	-package.json
