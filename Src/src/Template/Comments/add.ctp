<!-- src/Template/Comments/add.ctp -->
<div class="container clearfix" id="main">	
	<?= $this->Form->create($comment) ?>
	<legend><?= __('Add Comment') ?></legend>
	<fieldset>
		<?= $this->Form->input('body') ?>
		<?= $this->Form->button('Save Comment', ['type'=>'submit','class'=>'btn btn-primary']); ?>
	</fieldset>	
	<?= $this->Form->end() ?>
</div>