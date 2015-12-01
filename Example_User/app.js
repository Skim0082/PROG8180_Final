var express = require('express');
var app = express();
var bodyParser = require('body-parser');

app.use(express.static(__dirname + "/public"));
app.use(bodyParser.json());

// Select all data from users table
app.get('/userlist', function(req, res){

	console.log("I received a GET request");

	var mysqlConProvider = require('./server/mysqlConnectionStringProvider.js');
	var con = mysqlConProvider.mysqlConnectionStringProvider.connectDatabase();

	// Select data from table
	con.query('SELECT * FROM users', function(err, docs){
		if(err) throw err;

		console.log('Data received from users table:\n');
		console.log(docs);
		res.json(docs);
	});	

	mysqlConProvider.mysqlConnectionStringProvider.closeConnectionDatabase(con);

});

// Add new user
app.post('/userlist', function(req, res){

    console.log(req.body);

	var mysqlConProvider = require('./server/mysqlConnectionStringProvider.js');
	var con = mysqlConProvider.mysqlConnectionStringProvider.connectDatabase();

	// Insert data
	var user = req.body;
	con.query('INSERT INTO users SET ?', user, function(err, doc){
		if(err) throw err;

		console.log('Last insert ID: ', doc.insertId);
		res.json(doc);
	});

	mysqlConProvider.mysqlConnectionStringProvider.closeConnectionDatabase(con);

});

// Delete User
app.delete('/userlist/:id', function(req, res){

    var id = req.params.id;
    console.log(id);

	var mysqlConProvider = require('./server/mysqlConnectionStringProvider.js');
	var con = mysqlConProvider.mysqlConnectionStringProvider.connectDatabase();

	// Delete data from table
	con.query(
		'DELETE FROM users WHERE id = ?',
		[id],
		function(err, doc){
			if(err) throw err;

			console.log('Delete ' + doc.affectedRows + ' rows');
			res.json(doc);
		}
	);      

	mysqlConProvider.mysqlConnectionStringProvider.closeConnectionDatabase(con);

});

//Select with user id
app.get('/userlist/:id', function(req, res){

    var id = req.params.id;
    console.log("Selected id = " + id);

	var mysqlConProvider = require('./server/mysqlConnectionStringProvider.js');
	var con = mysqlConProvider.mysqlConnectionStringProvider.connectDatabase();

	// Select data from table
	con.query('SELECT * FROM users WHERE id = ?', 
		[id], 
		function(err, docs){
			if(err) throw err;

			console.log('Data received from users table where id = ' + id);
			console.log(docs[0]);
			res.json(docs[0]);
		}
	);

	mysqlConProvider.mysqlConnectionStringProvider.closeConnectionDatabase(con);

});

// Update User
app.put('/userlist/:id', function(req, res){
    var id = req.params.id;

	var mysqlConProvider = require('./server/mysqlConnectionStringProvider.js');
	var con = mysqlConProvider.mysqlConnectionStringProvider.connectDatabase();

    var user = req.body;

    console.log("name : " + user.name);

	// Update data
	con.query(
		'UPDATE users SET name = ?, email = ?, phonenumber = ? WHERE ID = ?',
		[user.name, user.email, user.phonenumber, id],
		function(err, doc){
			if(err) throw err

			console.log('Updated ' + doc.changedRows + ' rows');
			res.json(doc);
		}
	);

	mysqlConProvider.mysqlConnectionStringProvider.closeConnectionDatabase(con);

});

app.listen(3000);
console.log("Server running on port 3000");