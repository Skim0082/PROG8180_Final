var myApp = angular.module('prog8010App',[]);

myApp.controller('PostCtrl', ['$scope','$http', function($scope, $http) {    

    console.log("Hello World from controller");

    var refresh = function(){
	    $http.get('/postlist').success(function(response){
	    	console.log("I got the data I requested");
	    	$scope.postlist = response;
	    	$scope.post = "";
	    });     	
    };

    refresh();

    $scope.addPost =function(){
    	console.log($scope.post)
    	$http.post('/postlist',$scope.post).success(function(response){
    		console.log(response);
    		refresh();
    	});
    };  

    $scope.remove = function(id){
    	console.log(id);
    	$http.delete('/postlist/' + id).success(function(response){
    		refresh();
    	});
    }; 

    $scope.edit = function(id){
    	console.log(id + " will be edited");
    	$http.get('/postlist/' + id).success(function(response){
    		$scope.post = response;
            console.log(response);
    	});
    };  

    $scope.update = function(id){
    	console.log("updated ID = " + id);
    	$http.put('/postlist/' + id, $scope.post).success(function(response){
    		refresh();
    	});
    };      

    $scope.deselect = function(){
    	$scope.post = "";
    }       

}]);    