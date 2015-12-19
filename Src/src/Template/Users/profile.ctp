<!-- File: src/Template/users/view.ctp -->
<div class="container clearfix"  id="main">
	<h1>User Profile</h1>
	<ul>
		<li>First Name : <?= $user['firstname'] ?></li>
		<li>Last Name : <?= $user['lastname'] ?></li>
		<li>User Name : <?= $user['nickname'] ?></li>
        <li>eMail : <?= $user['email'] ?></li>
		<li>Gender : <?= $user['gender']=='M'? "Male" : "Female" ?></li>
		<li>Contact Detail : <?= $user['contactDetail'] ?></li>
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