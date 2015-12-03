<!-- File: src/Template/Posts/add.ctp -->
<div id="logout">
	<?php
		if($loginuser['id'] != null){
			echo $this->Html->link('Log Out', ['controller' => 'Users', 'action' => 'logout']); 
		}else{
			echo $this->Html->link('Log In', ['controller' => 'Users', 'action' => 'login']);
		}
	?>
</div>
<div id="main">
	<h1>Add Posts</h1>
	<?php
		echo $this->Form->create($post);
		echo $this->Form->input('postType',['options' => ['1' => 'Looking for Car','2' => 'Looking for Passenger']]);
        echo $this->Form->input('seatsAvailable',['min' => '0','max' => '10','default'=>'1']);
        echo $this->Form->input('costPerPerson',['min' => '0','default' => '0']);
        echo $this->Form->input('preferredContact',['options' => ['email' => 'Email','textmsg' => 'Text Message']]);
        
    // Using jQEURY DatePicker
        echo $this->Form->input('departureDate',['id' => 'datepicker']);
        echo $this->Form->input('departureTime',['id' => 'timepicker','type' => 'text', 'class'=>'ui-timepicker-input']);
    //For simplicity, start with postal code
        echo $this->Form->input('srcPostal',['label' => 'Departure Postal Code']);
        echo $this->Form->input('dstPostal',['label' => 'Destination Postal Code']);
	
		echo $this->Form->button(__('Save Post'));
				
		echo $this->Form->end();
	?>
    
</div>