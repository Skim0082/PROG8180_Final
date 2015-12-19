<!-- File: src/Template/users/contactus.ctp -->
<div class="container clearfix" id="main">
	<h1>Contact Us</h1>
	<fieldset>
	<?= $this->Flash->render('auth') ?>
	<legend>If you have comments or questions about COCORS, please use this form to send an e-mail to the COCORS team.</legend>
	<?= $this->Form->create() ?>				
		<?= $this->Form->input('email', ['label'=>['text'=>'Email'], 'required'=> true, 'placeholder'=>'Your Email']) ?>
		<?= $this->Form->hidden('mailTo', ['label'=>false, 'value' => 'admin@cocos.herokuapp.com']) ?>		
		<?= $this->Form->input('mailSubject', ['label'=>['text'=>'Subject'], 'required'=> true, 'placeholder'=>'Your Subject']) ?>
		<?= $this->Form->input('mailText', ['label'=>['text'=>'Message'], 'rows' => '3', 'required'=> true, 'placeholder'=>'Your Message']) ?>	
	<?= '<button type="submit" class="btn btn-info">Send Message</button>' ?>
	</fieldset>
	<?= $this->Form->end() ?>

<?php
	if(!empty($result)){
		echo "<h3>Your message has been sent successfully!</h3>";
	}
?>
</div>