<!-- src/Template/Users/facebook.ctp -->
<div class="container clearfix" id="main">
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
		<?= $this->Form->input('password') ?>
		<?= $this->Form->input('role', [
			'options' => ['user' => 'User']
		]) ?>			
		<?= $this->Form->button('Sign Up', ['type'=>'submit','class'=>'btn btn-primary']); ?>
	</fieldset>
	<?= $this->Form->end() ?>
</div>	