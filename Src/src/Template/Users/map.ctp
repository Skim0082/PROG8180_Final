<!-- File: src/Template/Users/map.ctp -->
<div class="container clearfix"  id="main">

	<h1>Ride Share Matching</h1>
	<?= $this->Form->create("Search"); ?>
	<fieldset>
	<legend><?= __('Please enter "From" and "To" address') ?></legend>	
	<?php
		echo $this->Form->input('From', ['id'=>'address_1', 'required'=> true, 'placeholder'=>'Departure Address']);	//, 'value'=>'Kitchener, 120 Old Carriage Dr'
		echo $this->Form->input('To', ['id'=>'address_2', 'required'=> true, 'placeholder'=>'Destination Address']);		//, 'value'=>'Kitchener, 299 Doon Valley Dr'p
		echo $this->Form->input('KeyWord', ['placeholder'=>'Enter key word to do filtering in result']);

		echo $this->Form->hidden('latitude1', ['id'=>'latitude_1']);
		echo $this->Form->hidden('longitude1', ['id'=>'longitude_1']);
		echo $this->Form->hidden('latitude2', ['id'=>'latitude_2']);
		echo $this->Form->hidden('longitude2', ['id'=>'longitude_2']);		

		$options = [
			'ROADMAP' => 'ROADMAP',
			'SATELLITE' => 'SATELLITE',
			'HYBRID' => 'HYBRID',
			'TERRAIN' => 'TERRAIN'
		];		
		echo $this->Form->input('Map',['type'=>'select', 'options'=> $options, 'default'=>'ROADMAP']);		

		$optionstype = [
			'DRIVER' => 'DRIVER',
			'PASSENGER' => 'PASSENGER',
			'BOTH' => 'BOTH'
		];		
		echo $this->Form->input('Type',['type'=>'select', 'options'=> $optionstype, 'default'=>'PASSENGER']);	
		echo $this->Form->button('Search Direction', ['type'=>'submit','class'=>'btn btn-primary']);
	?>
	</fieldset>
	<?= $this->Form->end(); ?>
	<div class="view-comment">
		Here is some tips to search. Using the search option of 'Key Word' and 'Type' can get the more close result matching what you want. : Matching direction will be shown as below Google Map.
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
					"width"    => "100%",
					"height"   => "300px",
					"localize" => true,
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

				if($result['latitude1'] == ""){
					//add the directions with geolocation of the 2 points
					echo  $this->GoogleMap->getDirections("map_canvas", "directions1", array(
					    "from" => $result['From'],
					    "to"   => $result['To']
					  ), array(
					    "travelMode" => "DRIVING",
					    "directionsDiv" => "directions",
					  ));
				}else{
				      echo $this->GoogleMap->getDirections("map_canvas", "directions1", array(
				        "from" => array("latitude" => $result['latitude1'], "longitude" => $result['longitude1']),
				        "to"   => array("latitude" => $result['latitude2'], "longitude" => $result['longitude2'])
				      ), array(
				        "travelMode" => "DRIVING",
				        "directionsDiv" => "directions",
				      ));	
				}

			}else{
				// add the marker with latitude and longitude
				echo $this->GoogleMap->addMarker("map_canvas", 2, 
					array(
						"latitude" => 43.389758, 
						"longitude" => -80.405068
						),
					array(
						"draggableMarker" => true,
						"windowText"=>"Conestoga College", 
						"markerTitle"=>"Conestoga College"
						));
				echo $this->GoogleMap->addMarker("map_canvas", 1, 
					array(
						"latitude" => 43.389758, 
						"longitude" => -80.405068
						),
					array(
						"draggableMarker" => true,
						"windowText"=>"Conestoga College", 
						"markerTitle"=>"Conestoga College"
						));		
			}
		?>
	</div>	
</div>