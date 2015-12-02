<!-- File: src/Template/Articles/add.ctp -->
<div id="logout">
	<?php
		if($loginuser['id'] != null){
			echo $this->Html->link('Log Out', ['controller' => 'Users', 'action' => 'logout']); 
		}else{
			echo $this->Html->link('Log In', ['controller' => 'Users', 'action' => 'login']);
		}
	?>
</div>
<div id="main">
	<h1>Add Article</h1>
	<?php
		echo $this->Form->create($article);
		echo $this->Form->input('title');
		echo $this->Form->input('body', ['rows' => '3']);

		$options = [
			'1' => 'Food',
			'2' => 'Fun',
			'3' => 'Family',
			'4' => 'Fiction',
			'5' => 'Documentary',
			'6' => 'Action',
		];
		
		echo $this->Form->select('tags',  $options, [
				'multiple' => 'checkbox'
			]);
			
		echo $this->Form->button(__('Save Article'));
				
		echo $this->Form->end();
	?>
</div>