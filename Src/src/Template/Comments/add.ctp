<!-- src/Template/Comments/add.ctp -->

<div id="main">
	<?= $this->Form->create($comment) ?>
		<fieldset>
			<legend><?= __('Add Comment') ?></legend>
			<?= $this->Form->input('comment') ?>
	   </fieldset>
	<?= $this->Form->button(__('Save Comment')); ?>
	<?= $this->Form->end() ?>
</div>