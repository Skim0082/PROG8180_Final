<!-- File: src/Template/Posts/index.ctp -->
<div id="main-list">
    <h1 class = 'left'>My Recent Ride</h1>
    <div class="column content">
      <fieldset>
        <legend><?= __('Upcoming riding uploaded by me') ?></legend>
        <?php
            $Posts = $futureUploadedCompletedPosts->toArray();
            echo $this->element('post_list_table',['Posts' => $Posts]);
        ?>
        <legend><?= __('Upcoming riding commented by me') ?></legend>
        <?php
            $Posts = $futureCommentedCompletedPosts;
            echo $this->element('post_list_table',['Posts' => $Posts]);
        ?>
        <legend><?= __('Past riding uploaded by me') ?></legend>
        <?php
            $Posts = $pastUploadedCompletedPosts->toArray();
            echo $this->element('post_list_table',['Posts' => $Posts]);
        ?>
        
        <legend><?= __('Past riding commented by me') ?></legend>
        <?php
            $Posts = $pastCommentedCompletedPosts->toArray();
            echo $this->element('post_list_table',['Posts' => $Posts]);
        ?>
        
      </fieldset>
    </div>
</div>