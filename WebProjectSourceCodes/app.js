var express = require('express');
var app = express();
var bodyParser = require('body-parser');

app.use(express.static(__dirname + "/public"));
app.use(express.static(__dirname + "/mvc"));
app.use(bodyParser.json());

// set the view engine to ejs
app.set('view engine', 'ejs');
app.set('views', __dirname + '/mvc/views');

// index page - just for test
app.get('/', function(req, res){
	//below is just example of AngularJS
    var drinks = [
        { name: 'Bloody Mary', drunkness: 3 },
        { name: 'Martini', drunkness: 5 },
        { name: 'Scotch', drunkness: 10 }
    ];
    var tagline = "Any code of your own that you haven't looked at for six or more months might as well have been written by someone else.";

    res.render('pages/index', {
        drinks: drinks,
        tagline: tagline
    });
});
// about page
app.get('/about', function(req, res){
	res.render('pages/about');
});
// contact page
app.get('/contact', function(req, res){
	res.render('pages/contact');
});
// user page
app.get('/user', function(req, res){
	res.render('users/index');
});
// post page
app.get('/post', function(req, res){
	res.render('posts/index');
});
// comment page
app.get('/comment', function(req, res){
	res.render('comments/index');
});

// Select all data from users table
app.get('/userlist', function(req, res){

	console.log("I received a GET request");

	var mysqlConProvider = require('./server/mysqlConnectionStringProvider.js');
	var con = mysqlConProvider.mysqlConnectionStringProvider.connectDatabase();


	// Select data from table
	con.query('SELECT * FROM users', function(err, rows){
		if(err) throw err;

		console.log('Data received from users table:\n');
		console.log(rows);
		res.json(rows);
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
		'DELETE FROM users WHERE user_id = ?',
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
    console.log("Selected user_id = " + id);

	var mysqlConProvider = require('./server/mysqlConnectionStringProvider.js');
	var con = mysqlConProvider.mysqlConnectionStringProvider.connectDatabase();

	// Select data from table
	con.query('SELECT * FROM users WHERE user_id = ?', 
		[id], 
		function(err, rows){
			if(err) throw err;

			console.log('Data received from users table with user_id = ' + id);
			console.log(rows[0]);
			res.json(rows[0]);
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

    console.log("user name : " + user.nickname);

	// Update data
	con.query(
		'UPDATE users SET nickname = ?, email = ?, contactDetail = ? WHERE user_id = ?',
		[user.nickname, user.email, user.contactDetail, id],
		function(err, doc){
			if(err) throw err

			console.log('Updated ' + doc.changedRows + ' rows');
			res.json(doc);
		}
	);

	mysqlConProvider.mysqlConnectionStringProvider.closeConnectionDatabase(con);

});

// Select all data from posts table
app.get('/postlist', function(req, res){

	console.log("I received a GET request");

	var mysqlConProvider = require('./server/mysqlConnectionStringProvider.js');
	var con = mysqlConProvider.mysqlConnectionStringProvider.connectDatabase();


	// Select data from post table
	con.query('SELECT * FROM posts', function(err, rows){
		if(err) throw err;

		console.log('Data received from posts table:\n');
		console.log(rows);
		res.json(rows);
	});	

	mysqlConProvider.mysqlConnectionStringProvider.closeConnectionDatabase(con);

});

// Add new post
app.post('/postlist', function(req, res){

    console.log(req.body);

	var mysqlConProvider = require('./server/mysqlConnectionStringProvider.js');
	var con = mysqlConProvider.mysqlConnectionStringProvider.connectDatabase();

	// Insert data
	var post = req.body;
	con.query('INSERT INTO posts SET ?', post, function(err, doc){
		if(err) throw err;

		console.log('Last insert ID: ', doc.insertId);
		res.json(doc);
	});

	mysqlConProvider.mysqlConnectionStringProvider.closeConnectionDatabase(con);

});

// Delete Post
app.delete('/postlist/:id', function(req, res){

    var id = req.params.id;
    console.log(id);

	var mysqlConProvider = require('./server/mysqlConnectionStringProvider.js');
	var con = mysqlConProvider.mysqlConnectionStringProvider.connectDatabase();

	// Delete data from table
	con.query(
		'DELETE FROM posts WHERE post_id = ?',
		[id],
		function(err, doc){
			if(err) throw err;

			console.log('Delete ' + doc.affectedRows + ' rows');
			res.json(doc);
		}
	);      

	mysqlConProvider.mysqlConnectionStringProvider.closeConnectionDatabase(con);

});

//Select with post id
app.get('/postlist/:id', function(req, res){

    var id = req.params.id;
    console.log("Selected post_id = " + id);

	var mysqlConProvider = require('./server/mysqlConnectionStringProvider.js');
	var con = mysqlConProvider.mysqlConnectionStringProvider.connectDatabase();

	// Select data from posts table
	con.query('SELECT * FROM posts WHERE post_id = ?', 
		[id], 
		function(err, rows){
			if(err) throw err;

			console.log('Data received from posts table with post_id = ' + id);
			console.log(rows[0]);
			res.json(rows[0]);
		}
	);

	mysqlConProvider.mysqlConnectionStringProvider.closeConnectionDatabase(con);

});

// Update Post
app.put('/postlist/:id', function(req, res){
    var id = req.params.id;

	var mysqlConProvider = require('./server/mysqlConnectionStringProvider.js');
	var con = mysqlConProvider.mysqlConnectionStringProvider.connectDatabase();

    var post = req.body;

    console.log("source postal : " + post.srcPostal);

	// Update data
	con.query(
		'UPDATE posts SET srcPostal = ?, dstPostal = ?, departureData = ? WHERE post_id = ?',
		[post.srcPostal, post.dstPostal, post.departureData, id],
		function(err, doc){
			if(err) throw err

			console.log('Updated ' + doc.changedRows + ' rows');
			res.json(doc);
		}
	);

	mysqlConProvider.mysqlConnectionStringProvider.closeConnectionDatabase(con);

});

// Select all data from comments table
app.get('/commentlist', function(req, res){

	console.log("I received a GET request");

	var mysqlConProvider = require('./server/mysqlConnectionStringProvider.js');
	var con = mysqlConProvider.mysqlConnectionStringProvider.connectDatabase();


	// Select data from comments table
	con.query('SELECT * FROM comments', function(err, rows){
		if(err) throw err;

		console.log('Data received from comments table:\n');
		console.log(rows);
		res.json(rows);
	});	

	mysqlConProvider.mysqlConnectionStringProvider.closeConnectionDatabase(con);

});


//Select comments with post id & user id
app.get('/commentlist/:pid/:uid', function(req, res){
	console.log("comment edit");

    var pid = req.params.pid;
    var uid = req.params.uid;
    console.log("Selected post_id = " + pid + ", user_id= " + uid);

	var mysqlConProvider = require('./server/mysqlConnectionStringProvider.js');
	var con = mysqlConProvider.mysqlConnectionStringProvider.connectDatabase();

	// Select data from comments table
	con.query('SELECT * FROM comments WHERE post_id = ? AND user_id = ?', 
		[pid, uid], 
		function(err, rows){
			if(err) throw err;

			console.log("Data received from posts table with post_id = " + pid + ", user_id= " + uid);
			console.log(rows[0]);
			res.json(rows[0]);
		}
	);

	mysqlConProvider.mysqlConnectionStringProvider.closeConnectionDatabase(con);

});

// Update comments
app.put('/commentlist/:pid/:uid', function(req, res){
    var pid = req.params.pid;
    var uid = req.params.uid;

	var mysqlConProvider = require('./server/mysqlConnectionStringProvider.js');
	var con = mysqlConProvider.mysqlConnectionStringProvider.connectDatabase();

    var comment = req.body;

    console.log("post_id : " + comment.post_id);

	// Update data
	con.query(
		'UPDATE comments SET body = ?, isApproved = ? WHERE post_id = ? AND user_id = ?',
		[comment.body, comment.isApproved, comment.post_id, comment.user_id],
		function(err, doc){
			if(err) throw err

			console.log('Updated ' + doc.changedRows + ' rows');
			res.json(doc);
		}
	);

	mysqlConProvider.mysqlConnectionStringProvider.closeConnectionDatabase(con);

});

// Delete Comments
app.delete('/commentlist/:pid/:uid', function(req, res){

    var pid = req.params.pid;
    var uid = req.params.uid;
    console.log("Selected post_id = " + pid + ", user_id= " + uid);

	var mysqlConProvider = require('./server/mysqlConnectionStringProvider.js');
	var con = mysqlConProvider.mysqlConnectionStringProvider.connectDatabase();

	// Delete data from table
	con.query(
		'DELETE FROM comments WHERE post_id = ? AND user_id = ?',
		[pid, uid],
		function(err, doc){
			if(err) throw err;

			console.log('Delete ' + doc.affectedRows + ' rows');
			res.json(doc);
		}
	);      

	mysqlConProvider.mysqlConnectionStringProvider.closeConnectionDatabase(con);

});

app.listen(3000);
console.log("Server running on port 3000");