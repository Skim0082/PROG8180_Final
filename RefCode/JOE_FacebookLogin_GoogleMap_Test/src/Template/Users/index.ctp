<!-- File: src/Template/Tags/index.ctp -->
<div id="logout">
	<?php
		if($loginuser['id'] != null){
			if($loginuser['role'] == 'admin'){
				echo $this->Html->link('New Tag', ['controller' => 'Tags', 'action' => 'add']); 
				echo " | ";
			}
			echo $this->Html->link('Log Out', ['controller' => 'Users', 'action' => 'logout']); 
		}else{
			echo $this->Html->link('Log In', ['controller' => 'Users', 'action' => 'login']);
		}
	?>
</div>
<div id="main-list">
	<h1>Tag lists</h1>
	<table>
		<tr>
			<th>ID</th>
			<th>Tag</th>
			<?php if($loginuser['id'] != null && $loginuser['role'] == 'admin'){echo "<th>Action</th>";} ?>
		</tr>

		<!-- Here is where we iterate through our $tags query object, printing out tag info -->

		<?php foreach ($tags as $tag): ?>
		<tr>
			<td>
				<?= $tag->id ?>
			</td>	
			<td>
				<?= $tag->tag ?>
			</td>
			<?php
				if($loginuser['id'] != null && $loginuser['role'] == 'admin'){
					echo "<td>";
					echo $this->Html->link('Edit', ['action' => 'edit', $tag->id]);
					echo " | ";
					echo $this->Form->postLink(
						'Delete',
						['action' => 'delete', $tag->id],
						['confirm' => 'Are you sure?']
					);
					echo "</td>";					
				}
			?>			
		</tr>
		<?php endforeach; ?>
	</table>
</div>