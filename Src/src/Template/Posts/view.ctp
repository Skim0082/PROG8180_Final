<!-- File: src/Template/Posts/view.ctp -->
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
	<h1><?= h($post->title) ?> by <?= $user->username?></h1>

	<p><?= h($post->body) ?></p>

	<p>Created : <?= $post->created->format(DATE_RFC850) ?></p>

	<div class="view-comment">
		<?php
			if(count($post -> tags)>0){
				echo "<strong>Tag:</strong><ul>";
				foreach ($post -> tags as $tag){
					echo "<li>" . $tag -> tag . "</li>";
				}
				echo "</ul>";
			}
			
			if($loginuser['id'] != null){
				if(count($post -> comments)>0){
					echo "<strong>Comments:</strong><ul>";
					foreach ($post -> comments as $comment){
						echo "<li>" . $comment -> comment . "</li>";
					}
					echo "</ul>";
				}
			}
			
			if($loginuser['role'] == 'admin'){
				if(count($post -> unapproved_comments)>0){
					echo "<ul class='unapprovedcomment'>";
					foreach ($post -> unapproved_comments as $comment){
						echo "<li>" . $comment -> comment . "</li>";
						
					}
					echo "</ul>";
				}
			}			
		?>
	</div>

	<p>
		<?php
			if($loginuser['id'] != null){
				echo $this->Html->link('Add Comment', ['controller'=>'Comments', 'action' => 'add', $post->id]);	
			}
			
			if($user->id == $loginuser['id'] || $loginuser['role'] == 'admin'){
				echo "<div id='logout'>";
				echo $this->Html->link('Edit', ['action' => 'edit', $post->id]);
				echo " | ";
				echo $this->Form->postLink(
					'Delete',
					['action' => 'delete', $post->id],
					['confirm' => 'Are you sure?']
				);	
				echo "</div>";
			}			
		?>
	</p>
</div>