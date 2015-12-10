<!-- File: src/Template/users/view.ctp -->
<div id="logout">
	<?php
		if($user['id'] != null && $user['id'] != ""){
			echo $this->Html->link('Log Out', ['controller' => 'Users', 'action' => 'logout'], ['class'=>'facebookLogout']); 
		}else{
			echo $this->Html->link('Log In', ['controller' => 'Users', 'action' => 'login']);
		}
	?>
</div>
<div id="main">
	<h1>User Profile</h1>
	<ul>
		<li>First Name : <?= $user['first_name'] ?></li>
		<li>Last Name : <?= $user['last_name'] ?></li>
		<li>User Name : <?= $user['username'] ?></li>
		<li>Gender : <?= $user['gender']=='M'? "Male" : "Female" ?></li>
		<li>Contact Detail : <?= $user['contactDetail'] ?></li>
		<li>Default Address : <?= $user['address'] ?></li>
		<li>Vehicle Info. : <?= $user['vehicle'] ?></li>
		<li>Smoking : <?= $user['isSmoking']==1? "Yes" : "No" ?></li>
	</ul>

	<p>
		<?php
			
			if(($user['id'] != null && $user['id'] != "")
				 || $user['role'] == 'admin'){
				echo "<div id='logout'>";
				echo $this->Html->link('Search', ['action' => 'map']);	
				echo " | ";	
				echo $this->Html->link('Edit', ['action' => 'edit', $user['id']]);	
				echo "</div>";
			}			
		?>
	</p>	

</div>