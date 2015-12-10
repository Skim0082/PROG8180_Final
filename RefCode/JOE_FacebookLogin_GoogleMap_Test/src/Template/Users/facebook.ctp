<!-- src/Template/Users/facebook.ctp -->
<div id="logout">
	<?php
		if($loginuser['id'] != null && $loginuser['id'] != ""){
			echo $this->Html->link('Log Out', ['controller' => 'Users', 'action' => 'logout'], ['class'=>'facebookLogout']); 
		}else{
			echo $this->Html->link('Log In', ['controller' => 'Users', 'action' => 'login']);
		}
	?>
</div>
<div id="main">
	<h1>Hello <?= $username ?>!</h1>
	<?= $this->Flash->render('auth') ?>
	<?php if($username != null && $username != ""){
		echo "<h3>Your facebook account has been authenticated!</h3>";
		echo "<legend>" . __('Please set your password to login') . "</legend>";
	}else{
		echo "<h3>Facebook account has not been authenticated!</h3>";
		echo "<legend>" . __('Please move to login') . "</legend>";
	}
	?>	
	<?= $this->Form->create() ?>
		<fieldset>
			<legend><?= __('Sign Up - set password') ?></legend>
			<?= $this->Form->input('password') ?>
			<?= $this->Form->input('role', [
				'options' => ['user' => 'User']
			]) ?>			
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>	