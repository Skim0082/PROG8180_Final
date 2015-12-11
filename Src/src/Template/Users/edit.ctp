<!-- File: src/Template/Users/edit.ctp -->
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
	<h1>Edit User Profile</h1>

	<?php
		echo $this->Form->create($user);
		echo $this->Form->input('first_name', ['required'=> true]);	
		echo $this->Form->input('last_name', ['required'=> true]);	
		echo $this->Form->input('username', ['required'=> true]);	
		echo $this->Form->input('email', ['required'=> true]);	
		echo $this->Form->input('address');
		//echo $this->Form->input('gender');
		echo $this->Form->input('gender', [
				'options' => ['M' => 'Male','F' =>'Female']
			]);
		echo $this->Form->input('contactDetail', ['required'=> true]);
		echo $this->Form->input('vehicle');	
		//echo $this->Form->input('isSmoking');
		echo $this->Form->input('isSmoking', [
				'options' => ['1' => 'Yes','0' =>'No']
			]);		
		echo $this->Form->button(__('Edit Profile'));
		echo $this->Form->end();
	?>

</div>