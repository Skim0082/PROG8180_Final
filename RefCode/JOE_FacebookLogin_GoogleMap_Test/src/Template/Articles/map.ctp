<!-- File: src/Template/Articles/map.ctp -->
<div id="logout">
	<?php
		if($loginuser['id'] != null){
			echo $this->Html->link('Log Out', ['controller' => 'Users', 'action' => 'logout'], ['class'=>'facebookLogout']); 
		}else{
			echo $this->Html->link('Log In', ['controller' => 'Users', 'action' => 'login']);
		}
	?>
</div>
<div id="Gmap">

	<h1>Ride Share Matching</h1>
	<?= $this->Form->create("Search"); ?>
	<fieldset>
	<legend><?= __('Please enter "From" and "To" address') ?></legend>	
	<?php
		echo $this->Form->input('From', ['required'=> true]);	//, 'value'=>'Kitchener, 120 Old Carriage Dr'
		echo $this->Form->input('To', ['required'=> true]);		//, 'value'=>'Kitchener, 299 Doon Valley Dr'

		$options = [
			'ROADMAP' => 'ROADMAP',
			'SATELLITE' => 'SATELLITE',
			'HYBRID' => 'HYBRID',
			'TERRAIN' => 'TERRAIN'
		];
		
		echo $this->Form->input('Map',['type'=>'select', 'options'=> $options, 'default'=>'ROADMAP']);			
		echo $this->Form->button(__('Search Direction'));
	?>
	</fieldset>
	<?= $this->Form->end(); ?>
	<div class="view-comment">
		Here is description : Matching direction will be shown as below Google Map.
	</div>
	<div>
		<?= $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'); ?>
		<?= $this->Html->script('http://maps.google.com/maps/api/js'); ?>
		
		<div class="GgoogleMap">
			<h4>Google Map Driection </h4>
			<?php
				$type = "ROADMAP";
				if(!empty($result))
					$type = $result['Map'];

				$map_options = array(
					"id"       => "map_canvas",
					"width"    => "597px",
					"height"   => "400px",
					"localize" => false,
					"zoom"     => 14,
					"marker"   => false,
					"address" => "Kitchener, 229 Doon Valley Dr",
					"infoWindow" => true,
					"type"     => $type
				);
			?>
		</div>
		<!-- print the map -->
		<?= $this->GoogleMap->map($map_options); ?>
		<?php
			//echo empty($result);
			if(!empty($result)){
				//Add the div where the directions will be printed
				echo '<div id="directions"></div>';
				//add the directions with geolocation of the 2 points
				echo  $this->GoogleMap->getDirections("map_canvas", "directions1", array(
				    "from" => $result['From'],
				    "to"   => $result['To']
				  ), array(
				    "travelMode" => "DRIVING",
				    "directionsDiv" => "directions",
				  ));				
			}else{
				// add the marker with options
				/*
				echo $this->GoogleMap->addMarker("map_canvas", 2, "Toronto, ON", array(
				"showWindow"   => true,
				"windowText"   => "Marker",
				"markerTitle"  => "Title",
				"markerIcon"   => "http://labs.google.com/ridefinder/images/mm_20_purple.png",
				"markerShadow" => "http://labs.google.com/ridefinder/images/mm_20_purpleshadow.png"
				));
				*/
				// add the marker with latitude and longitude
				echo $this->GoogleMap->addMarker("map_canvas", 1, array(
						"showWindow" => true,
						"windowText"=>"Conestoga College", 
						"markerTitle"=>"Conestoga College", 						
						"latitude" => 43.389758, 
						"longitude" => -80.405068));

				// add the marker with address
				//echo $this->GoogleMap->addMarker("map_canvas", 2, "Waterloo, ON");		
			}
		?>

	</div>	
</div>