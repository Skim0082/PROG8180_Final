<nav class="large-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Articles'), ['controller' => 'Articles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Article'), ['controller' => 'Articles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="comments index large-10 medium-8 columns content">
    <h3><?= __('Comments') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('body') ?></th>
                <th><?= $this->Paginator->sort('isApproved') ?></th>
                <th><?= $this->Paginator->sort('author') ?></th>
                <th><?= $this->Paginator->sort('article_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comments as $comment): ?>
            <tr>
                <td><?= $this->Number->format($comment->id) ?></td>
                <td><?= h($comment->body) ?></td>
                <td><?= $comment->isApproved ? __('Yes') : __('No'); ?></td>
                <td><?= $comment->has('user') ? $this->Html->link($comment->user->username, ['controller' => 'Users', 'action' => 'view', $comment->user->user_id]) : '' ?></td>
                <td><?= $comment->has('article') ? $this->Html->link($comment->article->title, ['controller' => 'Articles', 'action' => 'view', $comment->article->article_id]) : '' ?></td>
                <td><?= h($comment->created) ?></td>
                <td><?= h($comment->modified) ?></td>
                <td class="actions">
                    <?= $comment->isApproved ? '' :$this->Html->link(__('Approve'), ['controller'=>'comments','action' => 'approve', $comment->id]) ?>
                    <?= $this->Html->link(__('View'), ['action' => 'view', $comment->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $comment->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $comment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comment->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
     <p class="mynotice">* Comment will be posted after appoval of admin</p>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
