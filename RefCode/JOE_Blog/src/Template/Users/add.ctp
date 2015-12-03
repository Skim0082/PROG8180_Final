<!-- src/Template/Users/add.ctp -->
<div id="main">
	<?= $this->Form->create($user) ?>
		<fieldset>
			<legend><?= __('Add User') ?></legend>
			<?= $this->Form->input('username') ?>
			<?= $this->Form->input('password') ?>
			<?= $this->Form->input('role', [
				'options' => ['author' => 'Author']
			]) ?>			
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>	