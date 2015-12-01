function AppCtrl($scope, $http) {
    console.log("Hello World from controller");

    var refresh = function(){
	    $http.get('/userlist').success(function(response){
	    	console.log("I got the data I requested");
	    	$scope.userlist = response;
	    	$scope.user = "";
	    });     	
    };

    refresh();

    $scope.addUser =function(){
    	console.log($scope.user)
    	$http.post('/userlist',$scope.user).success(function(response){
    		console.log(response);
    		refresh();
    	});
    };  

    $scope.remove = function(id){
    	console.log(id);
    	$http.delete('/userlist/' + id).success(function(response){
    		refresh();
    	});
    }; 

    $scope.edit = function(id){
    	console.log(id + " will be edited");
    	$http.get('/userlist/' + id).success(function(response){
    		$scope.user = response;
    	});
    };  

    $scope.update = function(id){
    	console.log("updated ID = " + id);
    	$http.put('/userlist/' + id, $scope.user).success(function(response){
    		refresh();
    	});
    };      

    $scope.deselect = function(){
    	$scope.user = "";
    }       

};    