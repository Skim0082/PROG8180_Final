<!-- File: src/Template/Posts/add.ctp -->
<div id="main">
	<?php
        $map_options = array(
            "localize" => false,
            "type" => "ROADMAP",
            "zoom" => 10,
            "marker" => true,
            "draggableMarker" => false,
            "width"  => "100%",
            "height" => "20em",
            "showWindow" => true
        );
    
		echo $this->Form->create($post);
		echo $this->Form->input('postType',['options' => ['1' => 'Looking for Car','2' => 'Looking for Passenger']]);
        echo $this->Form->input('seatsAvailable',['min' => '0','max' => '10','default'=>'1']);
        echo $this->Form->input('costPerPerson',['min' => '0','default' => '0','label'=>'Cost Per Person (CAD)']);
        echo $this->Form->input('preferredContact',['options' => ['email' => 'Email','textmsg' => 'Text Message']]);
    
    // Using jQEURY DatePicker
        echo $this->Form->input('departureDate',['id' => 'datepicker']);
        echo $this->Form->input('departureTime',['id' => 'timepicker','type' => 'text', 'class'=>'ui-timepicker-input']);
    
        echo $this->Form->input('description',['label' => 'Additioal Comment', 'rows' => '3']);
  
    //updated by helper, if user move marker
        echo $this->Form->input('srcAddr',['id'=>'address_1', 'label' => 'From','readonly' => true]);
        echo $this->Form->input('dstAddr',['id'=>'address_2', 'label' => 'To', 'readonly' => true]);
        
        echo $this->GoogleMap->map($map_options);
        echo $this->GoogleMap->addMarker(
          "map_canvas",
            1,
          array("latitude" => 43.466159, "longitude" => -80.586285),
          array("draggableMarker" => true, "windowText" => "Origin", "markerTitle"=>"Origin")
        ); 
    
        echo $this->GoogleMap->addMarker(
          "map_canvas",
          2,         
          array("latitude" => 43.6, "longitude" => -80.6),
          array("draggableMarker" => true, "windowText" => "Destination", "markerTitle"=>"Destination")
        );
    
        echo $this->Form->hidden('srcLatitude',['id'=>'latitude_1']);
        echo $this->Form->hidden('srcLongitude',['id'=>'longitude_1']);
        echo $this->Form->hidden('dstLatitude', ['id'=>'latitude_2']);
        echo $this->Form->hidden('dstLongitude',['id'=>'longitude_2']);

		echo $this->Form->button(__('Save Post'));
				
		echo $this->Form->end();
	?>
</div>

