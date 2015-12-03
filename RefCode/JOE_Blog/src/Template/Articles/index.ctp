<!-- File: src/Template/Articles/index.ctp -->


<div id="logout">
	<?php
		if($loginuser['id'] != null){
			echo $this->Html->link('Log Out', ['controller' => 'Users', 'action' => 'logout']); 
		}else{
			echo $this->Html->link('Log In', ['controller' => 'Users', 'action' => 'login']);
		}
	?>
</div>
<div id="main-list">
	<h1>Blog articles</h1>
	<table>
		<tr>
			<th>ID</th>
			<th>Title</th>
			<th>Author</th>
			<?php
				//debug($loginuser['role']);
				if($loginuser['id'] != null){
					echo "<th>Comments</th>";			
				}

				echo "<th>Tags</th>";
				
				if($loginuser['id'] != null){
					echo "<th>Action</th>";
				} 
			?>
		</tr>

		<!-- Here is where we iterate through our $articles query object, printing out article info -->

		<?php foreach ($articles as $article): ?>
		<tr>
			<td>
				<?= $article->id ?>
			</td>	
			<td>
				<?= $this->Html->link($article->title, ['action' => 'view', $article->id]) ?>
			</td>
			<td>
				<?= $article->author->username ?>
			</td>
				<?php
					if($loginuser['id'] != null){
						echo "<td>";
						
						// Approved Comments
						if(count($article -> comments)>0){
							echo "<ul>";
							foreach ($article -> comments as $comment){
								echo "<li>" . $comment -> comment . "</li>"; 
							}
							echo "</ul>";
						}
						// Unapproved Comments are shown as admin role
						if($loginuser['role'] == 'admin'){
							if(count($article -> unapproved_comments)>0){
								echo "<ul class='unapprovedcomment'>";
								foreach ($article -> unapproved_comments as $comment){
									echo "<li>" . $comment -> comment;
						
								echo " - ";
								echo $this->Form->postLink(
									'[Del]',
									['controller' => 'Comments', 'action' => 'delete', $comment->id],
									['confirm' => 'Are you sure?']
								);									
								
								echo "</li>"; 
								}
								echo "</ul>";
							}
						}
						echo "</td>";
					}
				?>		
			<td>
				<?php
					if(count($article -> tags)>0){
						echo "<ul>";
						foreach ($article -> tags as $tag){
							echo "<li>" . $tag -> tag . "</li>"; 
						}
						echo "</ul>";
					}		
				?>
			</td>				
			<?php
				if($article->author->id == $loginuser['id'] || $loginuser['role'] == 'admin'){
					echo "<td>";
					echo $this->Html->link('Edit', ['action' => 'edit', $article->id]);
					echo " | ";
					echo $this->Form->postLink(
						'Delete',
						['action' => 'delete', $article->id],
						['confirm' => 'Are you sure?']
					);					
					echo "</td>";
				}
			?>					
		</tr>
		<?php endforeach; ?>
	</table>
</div>