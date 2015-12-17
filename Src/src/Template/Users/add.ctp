<!-- src/Template/Users/add.ctp -->
<div id="main">
	<?= $this->Form->create($user) ?>
		<fieldset>
			<legend><?= __('Add User') ?></legend>
            <?= $this->Form->input('email') ?>
            <?= $this->Form->input('password') ?>
			<?= $this->Form->input('lastname') ?>
            <?= $this->Form->input('firstname') ?>
            <?= $this->Form->input('nickname') ?>
            <?= $this->Form->input('gender', [
				'options' => ['M' => 'Male','F' =>'Female']
			]) ?>	
            <?= $this->Form->input('isSmoking', [
				'options' => ['0' =>'No','1' => 'Yes']
			]) ?>	
            <?= $this->Form->input('contactDetail') ?>		
		    <?= $this->Form->input('vehicle') ?>	
			<?= $this->Form->input('role', [
				'options' => ['user' => 'User']
			]) ?>			
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>	