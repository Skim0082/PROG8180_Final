<!-- File: src/Template/Users/login.ctp -->
<div class="container clearfix" id="main">
	<h1>Log In</h1>
	<fieldset>
	<?= $this->Flash->render('auth') ?>
	<legend><?= __('Please enter your email and password') ?></legend>
	<?= $this->Form->create() ?>				
		<?= $this->Form->input('email', ['required'=> true, 'placeholder'=>'Email']) ?>
		<?= $this->Form->input('password', ['required'=> true, 'placeholder'=>'Password']) ?>		
		<?= $this->Form->button('Log In', ['type'=>'submit','class'=>'btn btn-primary']); ?>
	</fieldset>
	<?= $this->Form->end() ?>
</div>	
<div id="FbLoging">
<p>	
	<a href="/users/facebook" class="facebookConnect">
		<img src="/img/fb_login.png" alt="Login with Facebook">
	</a>	
</p>
</div>