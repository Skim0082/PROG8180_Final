<!-- File: src/Template/Posts/index.ctp -->

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
	<h1>Riding Share Posts</h1>
    <?php $this->GoogleMap->map(); ?>
	<table>
		<tr>
			<th>ID</th>
			<th>Request Type</th>
			<th>User Name</th>
            <th>Available Seats</th>
            <th>Cost Per Person</th>
            <th>Preferred Contact</th>
            <th>Departure Date</th>
            <th>Departure Time</th>
            <th>Origin PostalCode</th>
            <th>Destination PostalCode</th>
            <th>Actions</th>
			<?php
				if($loginuser['id'] != null){
					echo "<th>Comments</th>";			
				}

				
				
				if($loginuser['id'] != null){
					echo "<th>Action</th>";
				} 
			?>
		</tr>

		<!-- Here is where we iterate through our $Posts query object, printing out post info -->

		<?php foreach ($Posts as $post): ?>
		<tr>
			<td>
				<?= $post->id ?>
			</td>	
			<td>
				<?= h($post->post_type)==1 ? 'Looking for Car':'Looking for Passenger' ?>
			</td>
			<td>
				<?= $post->user->lastname.', '.$post->user->firstname ?>
			</td>
            <td>
				<?= $post->seatsAvailable ?>
			</td>
            <td>
				<?= $post->costPerPerson ?>
			</td>
            <td>
				<?= $post->preferredContact ?>
			</td>
            <td>
				<?= $post->departureDate ?>
			</td>
            <td>
				<?= $post->departureTime ?>
			</td>
            <td>
				<?= $post->srcPostal ?>
			</td>
            <td>
				<?= $post->dstPostal ?>
			</td>
				<?php
					if($loginuser['id'] != null){
						echo "<td>";
						
						// Comments
						if(count($post -> comments)>0){
							echo "<ul>";
							foreach ($post -> comments as $comment){
								echo "<li>" . $comment -> body . "</li>"; 
							}
							echo "</ul>";
						}
						
						if($loginuser['role'] == 'admin'){
                            echo $this->Form->postLink(
                                        '[Del]',
                                        ['controller' => 'Comments', 'action' => 'delete', $comment->id],
                                        ['confirm' => 'Are you sure?']
                                    );				
                        }
                        echo "</td>";
					}
				?>		
		
			<?php
				if($post->user_id == $loginuser['id'] || $loginuser['role'] == 'admin'){
					echo "<td>";
                    echo $this->Html->link('Add Comment', ['controller'=>'comments','action' => 'add', $post->id]);
                    echo " | ";
                    echo $this->Html->link('View', ['action' => 'view', $post->id]);
                    echo " | ";
					echo $this->Html->link('Edit', ['action' => 'edit', $post->id]);
					echo " | ";
					echo $this->Form->postLink(
						'Delete',
						['action' => 'delete', $post->id],
						['confirm' => 'Are you sure?']
					);					
					echo "</td>";
				} else {
					echo "<td>";
                    echo $this->Html->link('Add Comment', ['controller'=>'comments','action' => 'add', $post->id]);
                    echo " | ";
                    echo $this->Html->link('View', ['action' => 'view', $post->id]);
                    echo "</td>";
                }
			?>					
		</tr>
		<?php endforeach; ?>
	</table>
</div>