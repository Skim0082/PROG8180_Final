<!-- File: src/Template/Posts/index.ctp -->
<div class="container clearfix" id="main-list">
    <?php
        if ($mode === null) {
            $title = 'Post List';
        } else  {
            if($mode == 'comment') {
                $title = 'My Comment List';
            } else if ($mode == '0') {
                $title = 'All Post List';
            } else {
                $title = 'My Posted List';
            }
        }
    ?>
    <h1 class = 'left'><?= $title ?></h1>
    <div class="column content">
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th class="large-1 medium-1"><?= $this->Paginator->sort('postType','Request Type') ?></th>
            <th class="large-1 medium-1"><?= $this->Paginator->sort('user_id','User') ?></th>
            <th class="large-1 medium-1"><?= $this->Paginator->sort('seatsAvailable','Available Seats') ?></th>
            <th class="large-1 medium-1"><?= $this->Paginator->sort('costPerPerson','Cost Per Person') ?></th>
            <th class="large-2 medium-1"><?= $this->Paginator->sort('departureDate','Departure Date') ?></th>
            <th class="large-2 medium-2"><?= $this->Paginator->sort('srcAddr','From') ?></th>
            <th class="large-2 medium-2"><?= $this->Paginator->sort('dstAddr','To') ?></th>
            <th class="large-1 medium-1">#Of Comments</th>
            <th class="large-1 medium-1">Actions</th>
		</tr>

		<!-- Here is where we iterate through our $Posts query object, printing out post info -->

		<?php foreach ($Posts as $post): ?>
		<tr>
			<td>
				<?= $post->postType == 1 ? 'Looking for Car':'Looking for Passenger' ?>
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
                    if ($loginuser['role'] == 'admin') {
                        echo " | ";
                        echo $this->Form->postLink(
                            'Delete',
                            ['action' => 'delete', $post->id],
                            ['confirm' => 'Are you sure?']
                        );		
                    }
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