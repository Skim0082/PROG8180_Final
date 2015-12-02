var myApp = angular.module('prog8010App',[]);

myApp.controller('CommentCtrl', ['$scope','$http', function($scope, $http) {    

    console.log("Comment controller");

    var refresh = function(){
	    $http.get('/commentlist').success(function(response){
	    	console.log("I got the data I requested");
	    	$scope.commentlist = response;
	    	$scope.comment = "";
	    });     	
    };

    refresh(); 

    $scope.remove = function(pid, uid){
    	console.log("post_id = " + pid + ", user_id= " + uid + " will be deleted");
    	$http.delete('/commentlist/' + pid + '/' + uid).success(function(response){
    		refresh();
    	});
    }; 

    $scope.edit = function(pid, uid){
    	console.log("post_id = " + pid + ", user_id= " + uid + " will be edited");
    	$http.get('/commentlist/' + pid + '/' + uid).success(function(response){
    		$scope.comment = response;
            console.log(response);
    	});
    };  

    $scope.update = function(pid, uid){
    	console.log("post_id = " + pid + ", user_id= " + uid + " will be updated");
    	$http.put('/commentlist/' + pid + '/' + uid, $scope.comment).success(function(response){
    		refresh();
    	});
    };      

    $scope.deselect = function(){
    	$scope.comment = "";
    }       

}]);    