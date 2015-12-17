window.fbAsyncInit = function() {
  FB.init({
    appId      : '964125856995010',
    xfbml      : true,
    status     : true,
    cookie     : true,
    oauth      : true,
    version    : 'v2.3'
  });
};

(function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "//connect.facebook.net/en_US/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));

jQuery(function($){
  $('.facebookConnect').click(function(){
      var url = $(this).attr('href');
      FB.login(function(response){
        if(response.authResponse){
          window.location = url;
          console.log(response);           
        } 
      },{scope : 'public_profile,email'}); 
      return false;     
  }); 
  $('.facebookLogout').click(function(){
      FB.logout(function(response) {
      // Facebook login session is closed
      });
  }); 
});