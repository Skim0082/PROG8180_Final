<h4><?= __('Unapproved Comments') ?></h4>
<table cellpadding="0" cellspacing="0">
<?php foreach ($post->unapproved_comments as $uncomment): ?>
            <tr>
            <div class="commentrow">
                <td class="large-10">
                <h5 class="commentid"><?=$uncomment->user_id==null ? "Anonymous" : $userlist[$uncomment->user_id] ?> </h5>
                <p class="comment"><?= h($uncomment->body) ?></p>
                </td>
                <td class="actions large-2">
                    <?php 
                        $loginuser = $this->request->session()->read('Auth.User');
                        if($loginuser['role'] == 'admin') {
                            echo $this->Html->link(__('Approve'), ['controller'=>'comments','action' => 'approve', $uncomment->id]);
                            echo " | ";
                            echo $this->Form->postLink(__('Delete'), ['controller'=>'comments','action' => 'delete', $uncomment->id],
                                ['confirm' => __('Are you sure you want to delete comment # {0}?', $uncomment->id)]);
                        } else {
                            if($loginuser['id'] == $uncomment->user_id) {
                                echo $this->Form->postLink(__('Delete'), ['controller'=>'comments','action' => 'delete', $uncomment->id], 
                                    ['confirm' => __('Are you sure you want to delete # {0}?', $uncomment->id)]);
                            } 
                            if(($loginuser['id'] == $post->user_id) && ($uncomment->user_id != $post->user_id)) {
                                    if($loginuser['id'] == $uncomment->user_id)
                                        echo " | ";
                                    echo $this->Html->link(__('Approve'), ['controller'=>'comments','action' => 'approve', $uncomment->id]);
                            }
                        }
                    ?>
                 </td>
            </div>
            </tr>
<?php endforeach; ?>
</table>