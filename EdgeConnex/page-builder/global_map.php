<?
	// array for all data centers
	$all_data_centers = array();
	
	// get which map to show
	$map_to_show = get_sub_field('map_to_show');

	$hide_datacenter_count = get_sub_field('hide_datacenter_count');
	
	// map title
	$map_title = get_sub_field('title');
	
	// get all data centers
	$query_array = array(
	    'post_type' => 'data-center',
	    'posts_per_page' => -1,
	    'no_found_rows' => true,
		'orderby' => 'title',
		'order'   => 'ASC',
	);
    $queryArray['meta_query'] = array();
	if( $map_to_show == 'eur' ) {
		// $map_title = "Data Centers: EMEA";
        $metaQuery = array(
            'relation' => 'OR',
            array(
                'key'     => 'region',
                'value'   => 'europe',
                'compare' => '=',
            ),
            array(
                'key'     => 'region',
                'value'   => 'middle-east',
                'compare' => '=',
            ),
        );
	    $query_array['meta_query'] = $metaQuery;
	} elseif ($map_to_show == 'na') {
		// $map_title = "Data Centers: Americas";
        $metaQuery = array(
            'relation' => 'OR',
            array(
                'key'     => 'region',
                'value'   => 'north-america',
                'compare' => '=',
            ),
            array(
                'key'     => 'region',
                'value'   => 'south-america',
                'compare' => '=',
            ),
        );
	    $query_array['meta_query'] = $metaQuery;
	} elseif ($map_to_show == 'asia-pacific') {
		// $map_title = "Data Centers: Asia-Pacific";
		$metaQuery = array(
			'relation' => 'or',
			array(
				'key'     => 'region',
				'value'   => 'asia-pacific',
				'compare' => '=',
			),
			array(
				'key'     => 'region',
				'value'   => 'india',
				'compare' => '=',
			),
			array(
				'key'     => 'region',
				'value'   => 'china',
				'compare' => '=',
			),
		);
	    $query_array['meta_query'] = $metaQuery;
	} else {
		// global map
		// $map_title = "Global Data Centers";
	}
	$query = new WP_Query( $query_array );
	$na_count = 0;
	$emea_count = 0;
	$ap_count = 0;
	if($query->have_posts()) :
	    while($query->have_posts()) : $query->the_post();
	    	$region = get_field('region');
	    	if($region == "asia-pacific" || $region == "india" || $region == "china") {
	    		$ap_count++;
	    	}
	    	if($region == "north-america" || $region == "south-america") {
	    		$na_count++;
	    	}
	    	if($region == "europe" || $region == "middle-east") {
	    		$emea_count++;
	    	}
	    	
		    if( have_rows('locations') ):
		    	
			    $selected_location = null; // Variable to hold the selected location
		
		        // First pass: Check if any location has 'display_this_location' set
		        while (have_rows('locations')): the_row();
			        if(!$selected_location) {
			            if (get_sub_field('display_this_location')) {
			                $selected_location = get_row();
			                // break; // Exit the loop as we found our location
			            }
			        }
		        endwhile;
		
		        // If no selected location was set, default to the first location
		        if ($selected_location == NULL) {
	                $selected_location = get_field('locations')[0];
		        }
		        
			    // while ( have_rows('locations') ) : the_row();
			        $location = $selected_location['location'];
			        if(!$location) {
			        	$location = $selected_location["field_5eb4f2de450ad"];
			        }
			        // $is_regional_headquarters = get_field('is_regional_headquarters');
			        $enable_single_page = get_field('enable_single_page');
			        $type = get_field('type');
			        $city_code = strtoupper(substr(get_the_title(), 0, 3));
			        if(get_field('city_code')) {
			        	$city_code = strtoupper(get_field('city_code'));
			        }
			        if(is_array($location)) {
			        	// if location data is present on that data center, add it to the global array above
				        array_push($all_data_centers, array("lat" => $location["lat"], "lng" => $location["lng"], "code" => "$city_code", "type" => $type, "title" => get_the_title(), "url" => get_the_permalink(), "enable_single_page" => $enable_single_page));
			        }
			    // endwhile;
			endif;
	    endwhile; wp_reset_postdata();
	endif;
		        // avd($all_data_centers);
	
	$form_locations = get_sub_field('form_location_maps');
	$automatic_count_overrides = get_sub_field('automatic_count_overrides');
	$na_count_override = $automatic_count_overrides['data_center_value'];
	$emea_count_override = $automatic_count_overrides['emea_value'];
	$ap_count_override = $automatic_count_overrides['asia_pacific_value'];
	if($na_count_override) {
		$na_count = $na_count_override;
	}
	if($emea_count_override) {
		$emea_count = $emea_count_override;
	}
	if($ap_count_override) {
		$ap_count = $ap_count_override;
	}
?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxX_59Tq_egyZknum0qcoRh_sb7K7839o&libraries=places&language=en"></script>
<script src="<?= get_template_directory_uri(); ?>/scripts/vendor/cluster.js"></script>
<!-- <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script> -->
<div class='map_wrap'>
	<? if(get_sub_field('map_to_show') == 'global') : 
    	$map_summary_data = get_sub_field('map_summary_data');
    	$data_center_value = $map_summary_data['data_center_value'] ?: 60;
    	$data_center_label = $map_summary_data['data_center_label'] ?: "Data Centers";
    	$unique_markets_value = $map_summary_data['unique_markets_value'] ?: 50;
    	$unique_markets_label = $map_summary_data['unique_markets_label'] ?: "Unique Markets";
    	$continents_value = $map_summary_data['continents_value'] ?: 4;
    	$continents_label = $map_summary_data['continents_label'] ?: 'Continents';
    	$countries_value = $map_summary_data['countries_value'] ?: 30;
    	$countries_label = $map_summary_data['countries_label'] ?: 'Countries';
	?>
		<div class='map_number_data row'>
			<div class='columns small-12'>
				<div class='data_centers'>
					<span class='number count_up'><?= $data_center_value; ?>+</span>
					<span class='metric_label'><?= $data_center_label; ?></span>
				</div>
				<div class='unique_markets'>
					<span class='number count_up'><?= $unique_markets_value; ?>+</span>
					<span class='metric_label'><?= $unique_markets_label; ?></span>
				</div>
				<div class='continents'>
					<span class='number'><?= $continents_value; ?></span>
					<span class='metric_label'><?= $continents_label; ?></span>
				</div>
				<div class='countries'>
					<span class='number count_up'><?= $countries_value; ?>+</span>
					<span class='metric_label'><?= $countries_label; ?></span>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function() {
			    $('.count_up').each(function() {
			        var $this = $(this);
			        var finalValue = $this.text();
			
			        // Extract the numeric part of the final value
			        var numericValue = parseInt(finalValue.replace(/[^\d]/g, ''));
			
			        // Animate from 0 to the numeric value
			        $({ Counter: 0 }).animate({ Counter: numericValue }, {
			            duration: 3000,
			            easing: 'swing',
			            step: function() {
			                $this.text(Math.ceil(this.Counter));
			                if (finalValue.includes('+')) {
			                    $this.append('+');
			                }
			            }
			        });
			    });
			});
		</script>
	<? endif; ?>
	<div class='top_of_map row'>
		<div class='columns small-12'>
			<? if(get_sub_field('map_to_show') == 'global') : 
				$data_centers_label_override = get_sub_field('data_centers_label_override') ? get_sub_field('data_centers_label_override') : "Data Centers:";
			?>
				<? if ( !$hide_datacenter_count ) { ?>
					<div class='data_center_summary'>
						<span class="main_label"><?= $data_centers_label_override; ?></span>
						<span class='item'>Americas: <span><?= $na_count; ?></span></span>
						<span class='item'>EMEA: <span><?= $emea_count < 10 ? "0" : "" ?><?= $emea_count; ?></span></span>
						<span class='item'>Asia Pacific: <span><?= $ap_count < 10 ? "0" : "" ?><?= $ap_count; ?></span></span>
					</div>
				<? } ?>
			<? endif; ?>
			<div class='select_box'>
				<span class='select'>Select Data Center Region<img src="<?= get_template_directory_uri(); ?>/img/map/region_dropdown_arrow.svg" alt="select region" /></span>
				<div class='options' style='display: none;'>
					<? if($map_to_show != "global") : ?>
						<a href="/global-map/">Global Map<svg width="24px" height="24px" viewBox="0 0 24 24" style="cursor:pointer"><g stroke-width="2.1" stroke="#666" fill="none" stroke-linecap="round" stroke-linejoin="round"><polyline points="17 13.5 17 19.5 5 19.5 5 7.5 11 7.5"></polyline><path d="M14,4.5 L20,4.5 L20,10.5 M20,4.5 L11,13.5"></path></g></svg></a>
					<? endif; ?>
					<? if($map_to_show != "na") : ?>
						<a href="/americas/">Americas<svg width="24px" height="24px" viewBox="0 0 24 24" style="cursor:pointer"><g stroke-width="2.1" stroke="#666" fill="none" stroke-linecap="round" stroke-linejoin="round"><polyline points="17 13.5 17 19.5 5 19.5 5 7.5 11 7.5"></polyline><path d="M14,4.5 L20,4.5 L20,10.5 M20,4.5 L11,13.5"></path></g></svg></a>
					<? endif; ?>
					<? if($map_to_show != "eur") : ?>
						<a href="/emea/">EMEA<svg width="24px" height="24px" viewBox="0 0 24 24" style="cursor:pointer"><g stroke-width="2.1" stroke="#666" fill="none" stroke-linecap="round" stroke-linejoin="round"><polyline points="17 13.5 17 19.5 5 19.5 5 7.5 11 7.5"></polyline><path d="M14,4.5 L20,4.5 L20,10.5 M20,4.5 L11,13.5"></path></g></svg></a>
					<? endif; ?>
					<? if($map_to_show != "asia-pacific") : ?>
						<a href="/asia-pacific/">Asia-Pacific<svg width="24px" height="24px" viewBox="0 0 24 24" style="cursor:pointer"><g stroke-width="2.1" stroke="#666" fill="none" stroke-linecap="round" stroke-linejoin="round"><polyline points="17 13.5 17 19.5 5 19.5 5 7.5 11 7.5"></polyline><path d="M14,4.5 L20,4.5 L20,10.5 M20,4.5 L11,13.5"></path></g></svg></a>
					<? endif; ?>
				</div>
			</div>
			<div class='search'>
				<input id="map-search" type="text" placeholder="Search Data Center Locations">
				<img src="<?= get_template_directory_uri(); ?>/img/map/mag_icon.svg" class='search_mag' alt='search map' />
			</div>
		</div>
	</div>
	<? if(get_sub_field('show_form') || (!get_sub_field('show_form') && get_sub_field('editor_instead_of_form'))) : ?>
		<div class='row'>
			<div class='columns small-12 medium-7'>
				<div class='map_outer_wrap'>
					<span class='reset_map button primary'>Reset Map</span>
					<div id="map"></div>
				</div>
				<div class='legend_search mobile'>
					<div class='columns small-12 large-9 legend'>
						<div class='item'>
							<span class='icon dc'></span><span>Data Center</span>
						</div>
						<!--<div class='item'>-->
						<!--	<span class='icon rh'></span><span>Regional Headquarters</span>-->
						<!--</div>-->
						<div class='item'>
							<span class='icon cs'></span><span>Coming Soon</span>
						</div>
					</div>
				</div>
			</div>
		   	<? if (get_sub_field('show_form')) : ?>
		        <div class="column small-12 medium-5 location-form">
		        	<div class="form">
						<?= gravity_form($form_locations, true, true, false, '', true, ''); ?>
					</div>
		        </div>
		    <? elseif(get_sub_field('editor_instead_of_form')) : ?>
		        <div class="column small-12 medium-5 location-form editor">
		        	<div class="form">
						<?= get_sub_field('right_content'); ?>
					</div>
		        </div>
		    <? endif; ?>
		</div>
	<? else : ?>
		<div class='map_outer_wrap'>
			<span class='reset_map button primary'>Reset Map</span>
			<div id="map"></div>
		</div>
	<? endif; ?>
	<div class='legend_search row'>
		<div class='columns small-12 large-9 legend'>
			<div class='item'>
				<span class='icon dc'></span><span>Data Center</span>
			</div>
			<!--<div class='item'>-->
			<!--	<span class='icon rh'></span><span>Regional Headquarters</span>-->
			<!--</div>-->
			<div class='item'>
				<span class='icon cs'></span><span>Coming Soon</span>
			</div>
		</div>
	</div>
	<? if(get_sub_field('map_to_show') == 'na' || get_sub_field('map_to_show') == 'eur' || get_sub_field('map_to_show') == 'asia-pacific') : ?>
		<div class='locations_explore_wrap'>
			
			<div class='locations_explore'>
			<? 
				$region = "";
				switch (get_sub_field('map_to_show')) {
					case 'na':
						$region = array("north-america", "south-america");
					break;
					case 'eur':
						$region = array("europe", "middle-east");
					break;
					case 'asia-pacific':
						$region = array("asia-pacific", "india", "china");
					break;
				}
			?>
				<? 
				
				$csqueryArray = array(
				    'post_type' => 'data-center',
				    'posts_per_page' => -1,
				    'no_found_rows' => true,
					'orderby' => 'title',
					'order'   => 'ASC',
				);
				$csmetaQuery = array(
					'relation' => "and",
				    array(
				        'key'     => 'region',
				        'value'   => $region,
				        'compare' => 'IN',
				    ),
				    array(
				        'key'     => 'type',
				        'value'   => "active",
				        'compare' => 'NOT IN',
				    ),
				);
				$csqueryArray['meta_query'] = $csmetaQuery;
				$csquery = new WP_Query( $csqueryArray );
				$cspost_count = count($csquery->posts);
				
				$queryArray = array(
				    'post_type' => 'data-center',
				    'posts_per_page' => -1,
				    'no_found_rows' => true,
					'orderby' => 'title',
					'order'   => 'ASC',
				);
				$metaQuery = array(
					'relation' => "and",
				    array(
				        'key'     => 'region',
				        'value'   => $region,
				        'compare' => 'IN',
				    ),
				    array(
				        'key'     => 'type',
				        'value'   => "active",
				        'compare' => 'IN',
				    ),
				);
				$queryArray['meta_query'] = $metaQuery;
				$query = new WP_Query( $queryArray );
				$post_count = count($query->posts);
				$count_class = "";
				if($post_count < 15) {
					$count_class = "col_large";
				}
				$post_counter = 1;
				if($query->have_posts()) :
			    	$coming_soon = array();
			    	$counter = 1;
				    while($query->have_posts()) : $query->the_post(); 
				    	if($counter == 1 && !get_field('hide_from_global_map')) {
							echo "<div class='link_wrap $count_class'>";
				    	}
						$location_string = get_the_title();
				    	if(get_field('type') == "active") : ?>
				    		<? if(get_field('enable_single_page')) : ?>
						        <a href="<?= get_the_permalink(); ?>" title="<?= get_the_title(); ?>"><?= $location_string; ?></a>
				    		<? endif; ?>
				       <? endif; ?>
				    	<? if($counter == 7 || $post_counter == $post_count && !get_field('hide_from_global_map')) : $counter = 0; ?>
							</div>
				    	<? endif; ?>
				    <? $post_counter++; $counter++; endwhile; wp_reset_postdata(); ?>
					<? if($cspost_count) : ?>
						<div class='link_wrap coming_soon <?= $count_class; ?> <?= $post_count < 8 ? "two_boxes" : "" ?>'>
							<span class='h6-style caps coming_soon_label'>COMING SOON</span>
							<? if($csquery->have_posts()) :
							    while($csquery->have_posts()) : $csquery->the_post(); ?>
								<span class='cs'><?= get_the_title(); ?></span>
							<? endwhile; wp_reset_postdata(); endif; ?>
						</div>
					<? endif; ?>
				<? endif; ?>
			</div>
		</div>
	<? endif; ?>
	<!--<div class='row legend_search_mobile'>-->
	<!--	<div class='columns small-12 large-9 legend'>-->
	<!--		<div class='item'>-->
	<!--			<span class='icon dc'></span><span>Data Center</span>-->
	<!--		</div>-->
			<!--<div class='item'>-->
			<!--	<span class='icon rh'></span><span>Regional Headquarters</span>-->
			<!--</div>-->
		<!--	<div class='item'>-->
		<!--		<span class='icon cs'></span><span>Coming Soon</span>-->
		<!--	</div>-->
		<!--</div>-->
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.search_mag').on('click', function() {
			$(this).parent().find('input').toggleClass("active").focus();
		})
		
		$('.top_of_map .select_box .select').on('click', function() {
			$(this).parent().find('.options').slideToggle('fast');
		})
		
		var custom_map_styling = [ { "featureType": "administrative", "elementType": "geometry", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "color": "#444444" } ] }, { "featureType": "administrative.country", "elementType": "geometry.stroke", "stylers": [ { "color": "#ffffff" }, { "weight": "0.50" }, { "visibility": "on" } ] }, { "featureType": "administrative.country", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.province", "elementType": "all", "stylers": [ { "visibility": "on" } ] }, { "featureType": "administrative.province", "elementType": "geometry.stroke", "stylers": [ { "color": "#ffffff" }, { "visibility": "on" }, { "gamma": "2.00" }, { "weight": "1.00" } ] }, { "featureType": "administrative.province", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.locality", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.locality", "elementType": "geometry.stroke", "stylers": [ { "visibility": "on" } ] }, { "featureType": "administrative.locality", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.neighborhood", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.neighborhood", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.land_parcel", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.land_parcel", "elementType": "geometry", "stylers": [ { "visibility": "off" }, { "color": "#ff0000" } ] }, { "featureType": "administrative.land_parcel", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape", "elementType": "all", "stylers": [ { "color": "#ffffff" }, { "visibility": "off" } ] }, { "featureType": "landscape", "elementType": "geometry", "stylers": [ { "color": "#f4f7f9" } ] }, { "featureType": "landscape", "elementType": "geometry.fill", "stylers": [ { "color": "#ffffff" }, { "visibility": "off" } ] }, { "featureType": "landscape", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape.man_made", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape.man_made", "elementType": "geometry", "stylers": [ { "color": "#ff0000" }, { "visibility": "off" } ] }, { "featureType": "landscape.man_made", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#ebecee" } ] }, { "featureType": "landscape.man_made", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape.natural", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape.natural", "elementType": "geometry", "stylers": [ { "color": "#d4d6d9" }, { "visibility": "on" } ] }, { "featureType": "landscape.natural", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape.natural.landcover", "elementType": "geometry", "stylers": [ { "visibility": "off" }, { "color": "#ff0000" } ] }, { "featureType": "landscape.natural.landcover", "elementType": "geometry.fill", "stylers": [ { "color": "#ff0000" } ] }, { "featureType": "landscape.natural.terrain", "elementType": "geometry.fill", "stylers": [ { "color": "#494b59" } ] }, { "featureType": "landscape.natural.terrain", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "poi", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road", "elementType": "all", "stylers": [ { "saturation": -100 }, { "lightness": 45 }, { "visibility": "off" } ] }, { "featureType": "road.highway", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road.highway.controlled_access", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road.arterial", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] }, { "featureType": "transit", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "water", "elementType": "all", "stylers": [ { "color": "#e8f5fa" }, { "visibility": "on" } ] }, { "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#ffffff" } ] }, { "featureType": "water", "elementType": "labels", "stylers": [ { "visibility": "off" } ] } ]
		
		var custom_map_styling_level_2 =  [ { "featureType": "administrative", "elementType": "geometry", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "color": "#444444" } ] }, { "featureType": "administrative.country", "elementType": "geometry.stroke", "stylers": [ { "color": "#ffffff" }, { "weight": "0.50" }, { "visibility": "on" } ] }, { "featureType": "administrative.country", "elementType": "labels", "stylers": [ { "visibility": "on" } ] }, { "featureType": "administrative.province", "elementType": "all", "stylers": [ { "visibility": "on" } ] }, { "featureType": "administrative.province", "elementType": "geometry.stroke", "stylers": [ { "color": "#ffffff" }, { "visibility": "on" }, { "gamma": "2.00" }, { "weight": "1.00" } ] }, { "featureType": "administrative.province", "elementType": "labels", "stylers": [ { "visibility": "on" } ] }, { "featureType": "administrative.locality", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.locality", "elementType": "geometry.stroke", "stylers": [ { "visibility": "on" } ] }, { "featureType": "administrative.locality", "elementType": "labels", "stylers": [ { "visibility": "on" } ] }, { "featureType": "administrative.neighborhood", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.neighborhood", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.land_parcel", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.land_parcel", "elementType": "geometry", "stylers": [ { "visibility": "off" }, { "color": "#ff0000" } ] }, { "featureType": "administrative.land_parcel", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape", "elementType": "all", "stylers": [ { "color": "#ffffff" }, { "visibility": "off" } ] }, { "featureType": "landscape", "elementType": "geometry", "stylers": [ { "color": "#f4f7f9" } ] }, { "featureType": "landscape", "elementType": "geometry.fill", "stylers": [ { "color": "#ffffff" }, { "visibility": "off" } ] }, { "featureType": "landscape", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape.man_made", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape.man_made", "elementType": "geometry", "stylers": [ { "color": "#ff0000" }, { "visibility": "off" } ] }, { "featureType": "landscape.man_made", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#ebecee" } ] }, { "featureType": "landscape.man_made", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape.natural", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape.natural", "elementType": "geometry", "stylers": [ { "color": "#d4d6d9" }, { "visibility": "on" } ] }, { "featureType": "landscape.natural", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape.natural.landcover", "elementType": "geometry", "stylers": [ { "visibility": "off" }, { "color": "#ff0000" } ] }, { "featureType": "landscape.natural.landcover", "elementType": "geometry.fill", "stylers": [ { "color": "#ff0000" } ] }, { "featureType": "landscape.natural.terrain", "elementType": "geometry.fill", "stylers": [ { "color": "#494b59" } ] }, { "featureType": "landscape.natural.terrain", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "poi", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road", "elementType": "all", "stylers": [ { "saturation": -100 }, { "lightness": 45 }, { "visibility": "off" } ] }, { "featureType": "road.highway", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road.highway.controlled_access", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road.arterial", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] }, { "featureType": "transit", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "water", "elementType": "all", "stylers": [ { "color": "#e8f5fa" }, { "visibility": "on" } ] }, { "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#ffffff" } ] }, { "featureType": "water", "elementType": "labels", "stylers": [ { "visibility": "off" } ] } ]
		
		var custom_map_styling_level_3 =  [ { "featureType": "all", "elementType": "geometry.stroke", "stylers": [ { "visibility": "on" } ] }, { "featureType": "administrative", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative", "elementType": "geometry.stroke", "stylers": [ { "visibility": "on" } ] }, { "featureType": "administrative", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.country", "elementType": "labels", "stylers": [ { "visibility": "on" } ] }, { "featureType": "administrative.province", "elementType": "labels", "stylers": [ { "visibility": "on" } ] }, { "featureType": "administrative.locality", "elementType": "labels", "stylers": [ { "visibility": "on" } ] }, { "featureType": "administrative.neighborhood", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.land_parcel", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape.man_made", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape.natural", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape.natural", "elementType": "labels.text.stroke", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape.natural.landcover", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape.natural.landcover", "elementType": "labels", "stylers": [ { "visibility": "on" } ] }, { "featureType": "landscape.natural.terrain", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ] }, { "featureType": "landscape.natural.terrain", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "poi", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "poi", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ] }, { "featureType": "poi", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "transit", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "color": "#bce2f2" } ] }, { "featureType": "water", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ] }, { "featureType": "water", "elementType": "labels", "stylers": [ { "visibility": "off" } ] } ]

		const regions = {
			Americas: { sw: { lat: -55, lng: -135 }, ne: { lat: 70, lng: -30 } },
			EMEA: { sw: { lat: -35, lng: -30 }, ne: { lat: 70, lng: 75 } },
			AsiaPacific: { sw: { lat: -50, lng: 75 }, ne: { lat: 70, lng: -180 } },
			NorthAmerica: { sw: { lat: 24, lng: -125 }, ne: { lat: 72, lng: -50 } },
			SouthAmerica: { sw: { lat: -56, lng: -81 }, ne: { lat: 13, lng: -34 } }
		};
		
		function updateClusters(map, markers, markerCluster, infowindow) {
		    var zoomLevel = map.getZoom();

		    // show reset map button if zoomed in past default state
			<? if($map_to_show == "na") : ?>
			    if (zoomLevel > 2) {
			<? elseif($map_to_show == "global") : ?>
			    if (zoomLevel > 2) {
			<? else : ?>
			    if (zoomLevel > 4) {
			<? endif; ?>
		        $('.map_outer_wrap .reset_map').addClass('active');
		    } else {
		        $('.map_outer_wrap .reset_map').removeClass('active');
		    }
		
	        if (infowindow) {
	            infowindow.close();
	        }
		}
		
		function initMap() {
			<? if($map_to_show == 'eur' || $map_to_show == 'asia-pacific'): ?>
				var zoom = 4;
			<? elseif($map_to_show == 'na'): ?>
				var zoom = 2;
			<? elseif($map_to_show == 'global'): ?>
				var zoom = 2;
			<? endif; ?>
			if($(window).width() < 640) {
				<? if($map_to_show == 'eur' || $map_to_show == 'asia-pacific'): ?>
					zoom = 3;
				<? elseif($map_to_show == 'na'): ?>
					zoom = 2;
				<? else : ?>
					zoom = 1;
				<? endif; ?>
			}
			var map = new google.maps.Map(document.getElementById("map"), {
				zoom: zoom,
				minZoom: zoom,
				<?php if($map_to_show == 'global'): ?>
				    center: { lat: 15, lng: 0 },
				<?php elseif($map_to_show == 'na'): ?>
				    // Center between North and South America
				    center: { lat: 15, lng: -80 },
				<?php elseif($map_to_show == 'eur'): ?>
				    // Center in Europe
				    center: { lat: 45, lng: 15 },
				<?php elseif($map_to_show == 'asia-pacific'): ?>
				    // Center in Asia
				    center: { lat: 10, lng: 100 },
				<?php endif; ?>
				styles: custom_map_styling,
				
		        // Customizing map controls
		        mapTypeControl: false, // Disables the map/satellite toggle
		        fullscreenControl: false, // Disables the fullscreen button
		        streetViewControl: false, // Disables the street view control
	            zoomControl: true,
		        zoomControlOptions: {
		            position: google.maps.ControlPosition.LEFT_BOTTOM
		        }
			});
			
			$('.map_outer_wrap .reset_map').click(function() {
				<?php if($map_to_show == 'global'): ?>
				    map.setCenter({ lat: 0, lng: 0 });
				    if($(window).width() < 640) {
					    map.setZoom(1);
				    } else {
					    map.setZoom(2);
				    }
				<?php elseif($map_to_show == 'na'): ?>
				    // Center between North and South America
				    map.setCenter({ lat: 20, lng: -80 });
				    map.setZoom(2);
				<?php elseif($map_to_show == 'eur'): ?>
				    // Center in Europe
				    map.setCenter({ lat: 50, lng: 15 });
				    map.setZoom(4);
				<?php elseif($map_to_show == 'asia-pacific'): ?>
				    // Center in Asia
				    map.setCenter({ lat: 25, lng: 120 });
				    map.setZoom(4);
				<?php endif; ?>
			    // map.setCenter(initialMapState.center);
			    // updateClusters(map, markers, markerCluster, infowindow)
			});
			
			<? if($map_to_show == 'global'): ?>
			    $(window).on('resize', function() {
			        var newZoom = 2;
					if($(window).width() < 640) {
						newZoom = 1;
					} else if($(window).width() < 1450) {
						newZoom = 2;
					}
					// console.log(newZoom);
			        // Update the map zoom
			        map.setZoom(newZoom);
			    });
			<? endif; ?>
			
		    // // Create the search box and link it to the UI element
		    var input = document.getElementById('map-search');
		    var searchBox = new google.maps.places.SearchBox(input);
		
		    // Bias the SearchBox results towards current map's viewport
		    map.addListener('bounds_changed', function() {
		        searchBox.setBounds(map.getBounds());
		    });
		
			var infowindow = new google.maps.InfoWindow();
			
		    searchBox.addListener('places_changed', function() {
		        var places = searchBox.getPlaces();
		
		        if (places.length === 0) {
		            return;
		        }
		
		        // For each place, get the icon, name and location
		        var bounds = new google.maps.LatLngBounds();
		        places.forEach(function(place) {
		            if (!place.geometry) {
		                console.log("Returned place contains no geometry");
		                return;
		            }
		            if (place.geometry.viewport) {
		                // Only geocodes have viewport
		                bounds.union(place.geometry.viewport);
		            } else {
		                bounds.extend(place.geometry.location);
		            }
		        });
		        map.fitBounds(bounds);
		        
	            // Set a listener to the 'idle' event to adjust zoom after fitBounds
			    google.maps.event.addListenerOnce(map, 'idle', function() {
			        if (map.getZoom() > 8) {
			            map.setZoom(8); // Set max zoom level
			        }
			    });
		        
	            // Refresh the markers based on the new map state
			    updateClusters(map, markers, markerCluster, infowindow);
		    });
			
			

		    const clusterStyle = [{
		        url: '<?= get_template_directory_uri(); ?>/img/map/cluster_blank.png', // Path to your cluster image
		        height: 46,
		        width: 56,
		        textColor: '#fff', // Set text color
		        textSize: 16, // Set text size
		    }];
	
			// all data center locations
			var locations = [
				<? foreach ($all_data_centers as $center) : 
					$lat = $center["lat"];
					$lng = $center["lng"];
					$code = $center["code"];
					$hq = $center["hq"];
					$type = $center["type"];
					$title = $center["title"];
					$url = $center["url"];
					$enable_single_page = $center["enable_single_page"] ? $center["enable_single_page"] : 0;
				?>
					{ lat: <?= floatvalue($lat); ?>, lng: <?= floatvalue($lng); ?>, code: '<?= $code; ?>', hq: '<?= $hq; ?>', type: '<?= $type; ?>', title: '<?= $title; ?>', url: '<?= $url; ?>', enable_single_page: <?= $enable_single_page; ?>},
				<? endforeach; ?>
			];
			
			var markers = locations.map(function (location, i) {
			    var marker = new CustomMarker(new google.maps.LatLng(location.lat, location.lng), map, location.code, location.hq, location.type, infowindow, location.title, location.url, location.enable_single_page);
			    return marker;
			});
			
		    // Initialize MarkerClusterer with custom styles
			
			// var markerCluster = new markerClusterer.MarkerClusterer(map, markers, {
			var markerCluster = new MarkerClusterer(map, markers, {
			    styles: clusterStyle,
			    maxZoom: 6,
			});
			
			google.maps.event.addListener(markerCluster, 'clusterclick', function(cluster) {
			    // Custom zoom logic
			    var currentZoom = map.getZoom();
			    var maxZoom = 8; // Set the maximum zoom level
			
			    // Check if the current zoom level is less than the maximum zoom level
			    if (currentZoom < maxZoom) {
			        // Only zoom in if below max zoom level
			        map.setCenter(cluster.getCenter());
			        map.setZoom(currentZoom + 2); // Increase zoom by 1
			    } else {
			        // Optionally center the map on the cluster without zooming
			        map.setCenter(cluster.getCenter());
			    }
			});
			  
			google.maps.event.addListener(map, 'zoom_changed', function() {
				
		        var zoomLevel = map.getZoom();
		        
		        // Check the zoom level and apply styles accordingly
		        if(zoomLevel <= 3) {
		            map.setOptions({styles: custom_map_styling});
		        } else if (zoomLevel > 3 && zoomLevel <= 5) {
		            map.setOptions({styles: custom_map_styling_level_2});
		        } else {
		            map.setOptions({styles: custom_map_styling_level_3});
		        }
				updateClusters(map, markers, markerCluster, infowindow);
			});
			
			updateClusters(map, markers, markerCluster, infowindow);
		}
		
		function CustomMarker(latlng, map, code, hq, type, infowindow, title, url, enable_single_page) {
		    this.latlng = latlng;
		    this.code = code;
		    this.hq = hq;
		    this.type = type;
		    this.map = map;
		    this.title = title;
		    this.url = url;
		    this.enable_single_page = enable_single_page;
		    this.setMap(map);
		    this.infowindow = infowindow;
		}
		
		CustomMarker.prototype = new google.maps.OverlayView();
	
		CustomMarker.prototype.draw = function() {
		    var div = this.div_;
		    if (!div) {
		        div = this.div_ = document.createElement('div');
		        if(this.hq) {
			        div.className = 'custom-marker is_hq';
		        } else if(this.type == "coming-soon") {
			        div.className = 'custom-marker coming_soon';
		        } else {
			        div.className = 'custom-marker';
		        }
		        div.innerHTML = this.code;
		
		        var panes = this.getPanes();
		        panes.overlayImage.appendChild(div);
		        
		        // Add a mouseover listener to the div
				google.maps.event.addDomListener(div, 'mouseover', () => {
				    this.infowindow.close();
				    if(this.enable_single_page) {
					    var contentString = '<div class="content">' +
					                        '<img src="/wp-content/themes/edgeconnex/img/map/infowindow_close.svg" alt="close" class="infowindow-close-button" />' +
					                        '<span>' + this.title + '</span>' +
					                        '<a href="' + this.url + '">Learn More</a>' + 
					                        '</div>';
				    } else {
					    var contentString = '<div class="content no_link">' +
					                        '<img src="/wp-content/themes/edgeconnex/img/map/infowindow_close.svg" alt="close" class="infowindow-close-button" />' +
					                        '<span>' + this.title + '</span>' +
					                        '</div>';
				    }
				
				    this.infowindow.setContent(contentString);
				    this.infowindow.setPosition(this.getPosition());
				    this.infowindow.open(this.map);
				
				    // Once the content is set, add a listener to the close button
				    google.maps.event.addListenerOnce(this.infowindow, 'domready', () => {
				        document.querySelector('.infowindow-close-button').addEventListener('click', () => {
				            this.infowindow.close();
				        });
				    });
				});
		    }
		
		    var panes = this.getPanes();
		    panes.overlayImage.appendChild(div);
		
		    var point = this.getProjection().fromLatLngToDivPixel(this.latlng);
		    if (point) {
		        div.style.left = point.x + 'px';
		        div.style.top = point.y + 'px';
		    }
		};
		
		CustomMarker.prototype.setVisible = function(isVisible) {
		    if (this.div_) {
		        this.div_.style.display = isVisible ? 'block' : 'none';
		    }
		};
		
		CustomMarker.prototype.onRemove = function() {
		    if (this.div_ && this.div_.parentNode) {
		        this.div_.parentNode.removeChild(this.div_);
		        this.div_ = null;
		    }
		};
		
		CustomMarker.prototype.getPosition = function() {
		    if (!(this.latlng instanceof google.maps.LatLng)) {
		        this.latlng = new google.maps.LatLng(this.latlng.lat, this.latlng.lng);
		    }
		    return this.latlng;
		};
		google.maps.event.addDomListener(window, "load", initMap);
	})
</script>