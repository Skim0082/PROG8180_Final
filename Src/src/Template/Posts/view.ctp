<!-- File: src/Template/Posts/view.ctp -->
<div id="main">
    <h1>View Posts</h1>
    <?php
        $map_options = array(
            "localize" => false,
            "type" => "ROADMAP",
            "zoom" => 10,
            "marker" => true,
            "draggableMarker" => false,
            "width"  => "100%",
            "height" => "20em",
            "infoWindow" => true
        );
    ?>
    <table class="vertical-table">
            <tr>
                <th><?= __('Post ID') ?></th>
                <td><?= h($post->id) ?></td>
            </tr>
            <tr>
                <th><?= __('User') ?></th>
                <td><?= h($user->nickname) ?></td>
            </tr>
            <tr>
                <th><?= __('Gender') ?></th>
                <td><?= $user->gender=='M' ? __('Male'): __('Female') ?></td>
            </tr>
            <tr>
                <th><?= __('Smoking') ?></th>
                <td><?= $user->isSmoking ? __('Yes'): __('No') ?></td>                
            </tr>
            <tr>
                <th><?= __('Vehicle') ?></th>
                <td><?= h($user->vehicle) ?></td>
            </tr>
            <tr>
                <th><?= __('Post Type') ?></th>
                <td><?= $post->postType==1 ? __('Looking for Car') : __('Looking for Passenger') ?></td>
            </tr>
            <tr>
                <th><?= __('Number of Seats') ?></th>
                <td><?= h($post->seatsAvailable) ?></td>
            </tr>
            <tr>
                <th><?= __('Preferred Contact') ?></th>
                <td><?= h($post->preferredContact) ?></td>
            </tr>
            <tr>
                <th><?= __('Departure Date') ?></th>
                <td><?= h($post->departureDate) ?></td>
            </tr>
            <tr>
                <th><?= __('Departure Time') ?></th>
                <td><?= h($post->departureTime) ?></td>
            </tr>
            <tr>
                <th><?= __('Additional Comment') ?></th>
                <td><?= nl2br(h($post->description)) ?></td>
            </tr>
            <tr>
                <th><?= __('From:') ?></th>
                <td><?= h($post->srcAddr) ?></td>
            </tr>
            <tr>
                <th><?= __('To:') ?></th>
                <td><?= h($post->dstAddr) ?></td>
            </tr>
            <tr>
                <th><?= __('Created') ?></th>
                <td><?= h($post->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Modified') ?></th>
                <td><?= h($post->modified) ?></td>
            </tr>
    </table>
    <h5>Directions by GoogleMap</h5>
    <p class=cocorsnotice>* Directions are shown for user's convenience. It can be changed by driver</p>
	<?php
     echo $this->GoogleMap->map($map_options);
    
     echo '<div id="directions"> </div>';
 
     echo   $this->GoogleMap->getDirections("map_canvas", "directions1", array(
        "from" => array("latitude" => $post->srcLatitude, "longitude" => $post->srcLongitude),
        "to"   => array("latitude" => $post->dstLatitude, "longitude" => $post->dstLongitude)
        ), array(
        "travelMode" => "DRIVING",
        "directionsDiv" => "directions",
       ));
    ?>
    
    <div class="row">
        <h4><?= __('Approved Comments') ?></h4>
        <table cellpadding="0" cellspacing="0">
        <?php foreach ($post->approved_comments as $comment): ?>
            <tr>
                <td class="large-10">
                <div class="commentrow">
                    <h5 class="commentid"><?=$comment->user_id==null ? "Anonymous" : $userlist[$comment->user_id] ?> </h5>
                    <p class="comment"><?= h($comment->body) ?></p>
                </div>
                </td>
                <td class="large-2">
                    <?= __('Approved') ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </table>
        <?php
            echo $this->element('post_uncomment');
        ?>
    </div>
	<p>
		<?php
			if($loginuser['id'] != null){
				echo $this->Html->link('Add Comment', ['controller'=>'Comments', 'action' => 'add', $post->id]);	
			}
            echo "<div id='logout'>";

            if(($user->id == $loginuser['id']) || $loginuser['role'] == 'admin'){
                if ($loginuser['role'] == 'admin') {
                    echo $this->Form->postLink(
					'Delete',
					['action' => 'delete', $post->id],
					['confirm' => 'Are you sure?']
				    );	
                    echo " | ";
			     }
                
                echo $this->Form->postLink(
                'CloseDeal',
                ['action' => 'finish', $post->id],
                ['confirm' => 'After closing deal, posts will not be shown to public. Are you sure?']
                );
            }
            echo "</div>";
		?>
	</p>
</div>