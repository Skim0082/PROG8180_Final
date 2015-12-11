<!-- File: src/Template/Posts/edit.ctp -->
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
	<h1>Edit Posts</h1>
	<?php
		echo $this->Form->create($post);
		echo $this->Form->input('title');
		echo $this->Form->input('body', ['rows' => '3']);			

		if($loginuser['role'] == 'admin'){
		
			if(count($post -> comments)>0){				
				$i = 0;
				echo "<strong>Approved Comments :</strong>";
				foreach ($post -> comments as $comment){
					echo "<div class='edit-comment'>";
					echo $this->Form->input('comments.' . $i . '.id'); 
					echo $this->Form->input('comments.' . $i . '.comment', ['label'=>false]); 
					echo $this->Form->input('comments.' . $i . '.approved');	
					echo "</div>";
					$i++;
				}
			}

			if(count($post -> unapproved_comments)>0){				
				$i = 0;
				echo "<strong>UnApproved Comments :</strong>";
				foreach ($post -> unapproved_comments as $comment){	
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