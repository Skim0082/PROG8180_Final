<!-- File: src/Template/Users/login.ctp -->
<div id="main">
	<h1>Log In</h1>
	<?= $this->Flash->render('auth') ?>
	<?= $this->Form->create() ?>
		<fieldset>
			<legend><?= __('Please enter your email and password') ?></legend>
			<?= $this->Form->input('email') ?>
			<?= $this->Form->input('password') ?>
		</fieldset>
	<?= $this->Form->button(__('Login')); ?>
	<?= $this->Form->end() ?>
</div>	
<div id="FbLoging">
<p>	
	<a href="/users/facebook" class="facebookConnect">
		<img src="/img/fb_login.png" alt="Login with Facebook">
	</a>	
</p>
</div>