<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Cocors:Conestoga College Ride Sharing System';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('cocors.css') ?>
    <?php /*This is for jquery */ ?>
    <?= $this->Html->css('http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css') ?>
    <?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.8.8/jquery.timepicker.min.css') ?>
    <?= $this->Html->script('http://code.jquery.com/jquery-1.10.2.js') ?>
    <?= $this->Html->script('http://code.jquery.com/ui/1.11.4/jquery-ui.js') ?>
    <?= $this->Html->script('http://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.8.8/jquery.timepicker.min.js') ?>
    <?= $this->Html->script('getinput.js');  ?>
    
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header>
    <h1>COCORS<small>Conestoga College Ride Sharing System</small><a href="http://cocors.heroku.com"></h1>
    
    </header>
    <nav class="top-bar expanded navmenu" data-topbar role="navigation">
        <div class="container">
            <ul class="title-area navmenu pull-right" id="pull-right">
                <li>
                    <?= $this->Html->link('My profile', ['controller' => 'Users', 'action' => 'view']) ?>				
                </li>
                <li>
                    <?= $this->Html->link('User Management', ['controller' => 'Users', 'action' => 'index', ]) ?>		
                </li>
            </ul>
            <ul class="title-area navmenu" id="pull-left">
                <li>
                    <?= $this->Html->link('Home', ['controller' => 'pages', 'action' => 'display']) ?>				
                </li>
                <li>
                    <?= $this->Html->link('Add Post', ['controller' => 'Posts', 'action' => 'add']) ?>				
                </li>
                <li>
                    <?= $this->Html->link('Search', ['controller' => 'Posts', 'action' => 'index']) ?>				
                </li>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <section class="container clearfix">
        <?= $this->fetch('content') ?>
    </section>
    <footer>
		<nav class="top-bar expanded" data-topbar role="navigation">
			<ul class="title-area large-3 medium-4 columns">
				<li class="name">
					<h1><li><a target="_blank" href="http://cocors.heroku.com">Cocors</a></li></h1>
				</li>
			</ul>
			<section class="top-bar-section">
				<ul class="right">
					<li><a target="_blank" href="http://cocors.heroku.com">Conestoga College Ride Sharing System</li>
				</ul>
			</section>
		</nav>	
	
    </footer>
</body>
</html>
