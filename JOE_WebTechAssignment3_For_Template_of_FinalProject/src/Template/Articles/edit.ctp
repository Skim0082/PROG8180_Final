<!-- File: src/Template/Articles/edit.ctp -->
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
	<h1>Edit Article</h1>
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
		

		echo $this->Form->input('tags._ids',[
			'type' => 'select',
			'multiple' => 'checkbox',
			'options' => $options
		]);	

		if($loginuser['role'] == 'admin'){
		
			if(count($article -> comments)>0){				
				$i = 0;
				echo "<strong>Approved Comments :</strong>";
				foreach ($article -> comments as $comment){
					echo "<div class='edit-comment'>";
					echo $this->Form->input('comments.' . $i . '.id'); 
					echo $this->Form->input('comments.' . $i . '.comment', ['label'=>false]); 
					echo $this->Form->input('comments.' . $i . '.approved');	
					echo "</div>";
					$i++;
				}
			}

			if(count($article -> unapproved_comments)>0){				
				$i = 0;
				echo "<strong>UnApproved Comments :</strong>";
				foreach ($article -> unapproved_comments as $comment){	
					echo "<div class='edit-comment'>";
					echo $this->Form->input('unapproved_comments.' . $i . '.id'); 
					echo $this->Form->input('unapproved_comments.' . $i . '.comment', ['label'=>false]); 
					echo $this->Form->input('unapproved_comments.' . $i . '.approved');		
					echo "</div>";					
					$i++;
				}
			}			
			
		}
		echo $this->Form->button(__('Edit Article'));
		echo $this->Form->end();
	?>
</div>