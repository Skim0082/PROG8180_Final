<!-- File: src/Template/Users/map.ctp -->
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

		echo $this->Form->button(__('Search Direction'));
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
					"width"    => "697px",
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
					      
				      /*
				      $result['latitude1'] = "";
				      $result['latitude2'] = "";
				      $result['longitude1'] = "";
				      $result['longitude2'] = "";
				      */
				}

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


				// add the marker with address
				//echo $this->GoogleMap->addMarker("map_canvas", 2, "Waterloo, ON");		
			}
		?>

	</div>	
</div>
<div id="Gmap">
<?php
	if(!empty($result)){

		echo '<p><h3>Result for: Dec 10, 2015</h3>';
		echo 'From: ' . $result['From'] . " / To: " . $result['To'] . " / Key: " . $result['KeyWord'] . "</p>";

		echo '<table>';
		echo '<tr>';		
		echo '<th class="large-2 medium-4">Poster</th>';
		echo '<th class="large-3 medium-4">Departure Date/Time</th>';
		echo '<th class="large-2 medium-4">Contact</th>';
		echo '<th class="large-1 medium-4">Seats</th>';
		echo '<th class="large-3 medium-4">Place</th>';
		echo '</tr>';

		echo '<tr>';	
		echo '<td>John</td>';
		echo '<td>Dec 10, 16:00 pm</td>';
		echo '<td>Email</td>';
		echo '<td>2</td>';		
		echo '<td>Door 3</td>';
		echo '</tr>';	

		echo '<tr>';
		echo '<td>Emily</td>';		
		echo '<td>Dec 10, 17:00 pm</td>';
		echo '<td>Email</td>';
		echo '<td>1</td>';	
		echo '<td>Door 6</td>';	
		echo '</tr>';

		echo '<tr>';
		echo '<td>Mac</td>';		
		echo '<td>Dec 10, 17:30 pm</td>';
		echo '<td>Phone</td>';
		echo '<td>1</td>';	
		echo '<td>Rec</td>';	
		echo '</tr>';

		echo '<tr>';
		echo '<td>Smith</td>';		
		echo '<td>Dec 11, 10:00 am</td>';
		echo '<td>Phone</td>';
		echo '<td>1</td>';
		echo '<td>Tim Hortons</td>';		
		echo '</tr>';

		echo '<tr>';
		echo '<td>John</td>';		
		echo '<td>Dec 11, 11:00 am</td>';
		echo '<td>Email</td>';
		echo '<td>2</td>';	
		echo '<td>Door 3</td>';	
		echo '</tr>';

		echo '<tr>';
		echo '<td>Mark</td>';		
		echo '<td>Dec 11, 11:30 am</td>';
		echo '<td>Phone</td>';
		echo '<td>1</td>';	
		echo '<td>Door 6</td>';	
		echo '</tr>';

		echo '<tr>';
		echo '<td>Tom</td>';		
		echo '<td>Dec 11, 12:00 am</td>';
		echo '<td>Email</td>';
		echo '<td>1</td>';
		echo '<td>Library</td>';		
		echo '</tr>';									
		echo '</table>';
	}

?>
</div>