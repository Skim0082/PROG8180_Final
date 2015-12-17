<!-- File: src/Template/Posts/index.ctp -->
<div id="main-list">
    <div class="column content">
	<table cellpadding="0" cellspacing="0">
		<tr>
            <th class="large-1 medium-1">ID</th>
			<th class="large-1 medium-1">Request Type</th>
            <th class="large-1 medium-1">User</th>
            <th class="large-1 medium-1">Available Seats</th>
            <th class="large-1 medium-1">Cost Per Person</th>
            <th class="large-1 medium-1">Departure Date</th>
            <th class="large-1 medium-1">Departure Time</th>
            <th class="large-2 medium-2">From</th>
            <th class="large-2 medium-2">To</th>
            <th class="large-1 medium-1">#Of Comments</th>
            <th class="large-1 medium-1">Actions</th>
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
				<?= $post->user->nickname ?>
			</td>
            <td>
				<?= $post->seatsAvailable ?>
			</td>
            <td>
				<?= $post->costPerPerson ?>
			</td>
            <td>
				<?= $post->departureDate ?>
			</td>
            <td>
				<?= $post->departureTime ?>
			</td>
            <td>
				<?= $post->srcAddr ?>
			</td>
            <td>
				<?= $post->dstAddr ?>
			</td>	
            <td>
				<?= $post->comment_count ?>
			</td>
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
</div>