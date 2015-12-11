<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Ride Share</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <li><a href="/">Home <span class="sr-only">(current)</span></a></li>
        <li><a href="/users">User List <span class="sr-only">(current)</span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ride Match <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/posts">Post List</a></li>
            <li><a href="#">Recent View</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="/posts/add">Add New Post</a></li>		            
            <li><a href="#">My Posted List</a></li>
          </ul>		          
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div id="searchbox" class="form-group">
          <input type="text" class="form-control" placeholder="Search Matches">
        </div>
        <button type="submit" class="btn btn-info">Search</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/pages/contact">Contact</a></li>
        <li><a href="/pages/about">About</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php 
              if (is_null($this->request->session()->read('Auth.User.username'))) {
                echo "<li><a href='/users/signup'>Signup</a></li>";
                echo "<li><a href='/users/login'>Login</a></li>";  
              } else{
                echo "<li><a href='/users/profile'>My Profile</a></li>";
                echo "<li><a href='/users/edit'>Edit Profile</a></li>";
                echo "<li><a href='#'>Something else here</a></li>";
                echo "<li role='separator' class='divider'></li>";
                echo "<li><a href='/posts/recent'>My Recent Ride</a></li>";
                echo "<li role='separator' class='divider'></li>";
                echo "<li><a href='/users/logout'>Edit Profile</a></li>";
              }
            ?>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->