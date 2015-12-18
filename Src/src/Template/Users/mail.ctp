<!-- File: src/Template/users/view.ctp -->
<div class="jumbotron">
	<h1>Email Message</h1>
	<fieldset>
	<?= $this->Flash->render('auth') ?>
	<legend>Please enter your message to send</legend>
	<?= $this->Form->create() ?>				
		<?= $this->Form->input('From', [
			'label'=>['text'=>'From'], 
			'disabled' => true,
			'value' => 'admin@cocos.herokuapp.com',
			'required'=> true
			]) ?>
		<?= $this->Form->hidden('mailFrom', ['label'=>false, 'value' => 'admin@cocos.herokuapp.com']) ?>
		<?= $this->Form->input('email', ['label'=>['text'=>'To'], 'required'=> true, 'placeholder'=>'Receiver email address']) ?>
		<?= $this->Form->input('mailSubject', ['label'=>['text'=>'Subject'], 'required'=> true, 'placeholder'=>'Enter the Subject']) ?>
		<?= $this->Form->input('mailText', ['label'=>['text'=>'Message'], 'rows' => '3', 'required'=> true, 'placeholder'=>'Enter message']) ?>	
	<?= $this->Form->button(__('Send')); ?>
	</fieldset>
	<?= $this->Form->end() ?>

<?php
	if(!empty($result)){
		echo "<h3>Your message has been sent successfully!</h3>";
		echo "<ul>";
		echo "<li>" . $result['mailFrom'] . "</li>";
		echo "<li>" . $result['email'] . "</li>";
		echo "<li>" . $result['mailSubject'] . "</li>";
		echo "<li>" . nl2br($result['mailText']) . "</li>";
		echo "</ul>";
	}
?>
</div>