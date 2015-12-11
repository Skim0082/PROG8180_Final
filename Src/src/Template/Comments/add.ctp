<!-- src/Template/Comments/add.ctp -->
<div id="logout">
	<?php
		if($loginuser['id'] != null){
			echo $this->Html->link('Log Out', ['controller' => 'Users', 'action' => 'logout'], ['class'=>'facebookLogout']); 
		}else{
			echo $this->Html->link('Log In', ['controller' => 'Users', 'action' => 'login']);
		}
	?>
</div>
<div id="main">
	<?= $this->Form->create($comment) ?>
		<fieldset>
			<legend><?= __('Add Comment') ?></legend>
			<?= $this->Form->input('body') ?>
	   </fieldset>
	<?= $this->Form->button(__('Save Comment')); ?>
	<?= $this->Form->end() ?>
</div>