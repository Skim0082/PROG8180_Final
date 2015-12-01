var mysql = require("mysql");
var mysqlConString = require('./mysqlConnectionString.js');
var mysqlConnectionStringProvider = {

	connectDatabase : function(){
		// Connect to database
		var con = mysql.createConnection(mysqlConString.mysqlConnectionString.connection);
		con.connect(function(err){
			if(err) throw err;
			console.log('Connection to database successfully');			
		});
		return con;
	},

	closeConnectionDatabase : function(con){
		if(con){
			con.end(function(err){
				//The connection is terminated gracefully
				if(err) throw err;
				console.log('Database connection was ended');
			});			
		}		
	}
};

module.exports.mysqlConnectionStringProvider = mysqlConnectionStringProvider;