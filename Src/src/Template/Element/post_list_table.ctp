 <table cellpadding="0" cellspacing="0">
    <tr>
        <th class="large-1 medium-1"><?= $this->Paginator->sort('id','ID') ?></th>
        <th class="large-2 medium-1"><?= $this->Paginator->sort('postType','Request Type') ?></th>
        <th class="large-1 medium-1"><?= $this->Paginator->sort('user_id','User') ?></th>
        <th class="large-1 medium-1"><?= $this->Paginator->sort('costPerPerson','Cost Per Person') ?></th>
        <th class="large-2 medium-1"><?= $this->Paginator->sort('departureDate','Departure Date') ?></th>
        <th class="large-2 medium-2"><?= $this->Paginator->sort('srcAddr','From') ?></th>
        <th class="large-2 medium-2"><?= $this->Paginator->sort('dstAddr','To') ?></th>
        <th class="large-1 medium-1">Actions</th>
    </tr>

    <!-- Here is where we iterate through our $Posts query object, printing out post info -->

    <?php foreach ($Posts as $post): ?>
    <tr>
        <td>
            <?= $post->id ?>
        </td>
        <td>
            <?= $post->postType == 1 ? 'Looking for Car':'Looking for Passenger' ?>
        </td>
        <td>
            <?= $post->user->nickname ?>
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
        <?php
            echo "<td>";
            echo $this->Html->link('Add Comment', ['controller'=>'comments','action' => 'add', $post->id]);
            echo " | ";
            echo $this->Html->link('View', ['action' => 'view', $post->id]);
            echo "</td>";
        ?>					
    </tr>
    <?php endforeach; ?>    
</table>