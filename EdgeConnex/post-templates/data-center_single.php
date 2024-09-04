<?php
get_template_part( 'includes/header' ); 

//vars
$summary_title = get_field('summary_title');
$summary_content = get_field('summary');
$summary_image = get_field('summary_image');
$image_border = get_field('add_image_border');
$stats_title = get_field('stats_title');
$stats_intro = get_field('stats_intro');
$hide_map = get_field('hide_map');

$additional_info_title = get_field('additional_information_title');

$dc_gallery = get_field('data_center_gallery');

$temp_address = get_field('temporary_address');

$location = get_field('location');
$phone = get_field('phone_number');
$email = get_field('email_address');
$tour = get_field('show_tour_cta');

$data_sheet = get_field('data_sheet');

$form_header = get_field('form_headline');
$form_content = get_field('form_content');
$form_id = get_field('form_id');

if (get_field('map_zoom_level')) :
	$map_zoom = get_field('map_zoom_level');
else :
	$map_zoom = '11';
endif;
?>

<section class="data-center-summary">
    <div class="row align-middle">
        <?php if ($summary_image): ?>
        <div class="columns small-12 medium-4 large-3 image">
            <img class="summary-image" src="<?php echo $summary_image['sizes']['large']; ?>" alt="<?php echo $summary_image['alt']; ?>" />
			<?php if($image_border): ?>
				<style>
				.summary-image {
					border: 3px solid #9AA0A5 !important;
				}
				</style>
			<?php endif; ?>
        </div>
        <?php endif; ?>
         <div class="content columns small-12 <?php if ($summary_image): ?>medium-8 large-9 <?php else: ?> medium-12 <?php endif; ?>">
            <?php if($summary_title) : ?>
                <h2><?php echo $summary_title; ?></h2>
            <?php endif; ?>
            <?php echo $summary_content; ?>
            <?php if ($data_sheet) : ?>
              <a href="<?php echo $data_sheet; ?>" target='_blank' class="button primary" data-download_attr="dc">Download Data Sheet</a>
            <?php endif; ?>
            <? if (get_field('summary_button')):
				while(has_sub_field('summary_button')):
					ec_button();
				endwhile;
			endif; ?>	
        </div>
    </div>
</section>
<!--<section class="wow bounceInUp pb-content_separator custom-margin-bottom">-->
<!--	<div class="hold-me right sep-3">-->
<!--	    <div class="image">-->
<!--	        <img src="<?php echo get_template_directory_uri(); ?>/img/sep-3.svg" alt="" role="presentation">-->
<!--	    </div>-->
<!--	</div>-->
<!--</section>-->
<? if (get_field('wysiwyg_top')): ?>
<section class="data-center-wysiwyg-top">
	<div class="row">
		<div class="column">
			<? if (get_field('wysiwyg_top_title')): ?>
				<h2><?= get_field('wysiwyg_top_title'); ?></h2>
			<? endif; 
			echo get_field('wysiwyg_top'); 
			if (get_field('wysiwyg_top_buttons')):
				while(has_sub_field('wysiwyg_top_buttons')):
					ec_button();
				endwhile;
			endif; ?>		
		</div>
	</div>
</section>
<? endif; ?>
<?php if (get_field('stats')): ?>
<section class="data-center-stats light-gray-bg">
        <img class='background_pattern' src="<?= get_pattern_src("light-gray-bg"); ?>" alt="background pattern" />
        <?php if ($stats_title) : ?>
        <div class="row">
            <div class="columns small-12 medium-9 large-8 title">
                <h2><?php echo $stats_title; ?></h2>
                <?php if ($stats_intro) : ?>
                	<p><?php echo $stats_intro; ?></p>
                <?php endif; ?>
            </div>
         </div>
        <?php endif; ?>
        <div class="row">
        <?php while(has_sub_field('stats')): 
        //vars
        $stat_above = get_sub_field('stat_information_above');
        $stat_number = get_sub_field('stat_number');
        $stat_below = get_sub_field('stat_information_below');
        ?>
        <div class="columns small-12 medium-4 large-3 stat-item">
	        <div class="stat-inner">
	            <?php if ($stat_above) : ?>
	                <span class="stat-info stat-above"><?php echo $stat_above; ?></span>
	            <?php endif; ?>
	            <?php if ($stat_number) : ?>
	                <span class="stat-number h1-style"><?php echo $stat_number; ?></span>
	            <?php endif; ?>
	            <?php if ($stat_below) : ?>
	                <span class="stat-info stat-below"><?php echo $stat_below; ?></span>
	            <?php endif; ?>
	        </div>
        </div>
        <?php endwhile; ?>
    </div>
</section>
<?php endif; ?>


<?php if ($dc_gallery): ?>
<section class="data-center-gallery">
    <div class="photo-slider">
        <?php foreach( $dc_gallery as $image ): 
        	$image_source = fly_get_attachment_image_src( $image["ID"], array( 500, 250 ), true )['src'];
        	// $attributes = get_image_attributes($image["ID"], 500, 250);
        ?>
            <div class="photo-slider-item">
                <div class="photo-slider-item-wrap">
                	<!--<img <?= $attributes; ?> />-->
                    <img src="<?= $image_source; ?>" alt="<?php echo $image['alt']; ?>" />
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<script type="text/javascript">
    jQuery(document).ready(function($){

        $('.photo-slider').slick({
            arrows:true,
            autoplay:false,
            centerMode: false,
            slidesToShow: 4,
            variableWidth: false,
            dots:false,
            prevArrow:"<img class='slick-prev slick-arrow' src='<?php echo get_template_directory_uri(); ?>/img/icon-slider-left.svg'>",
            nextArrow:"<img class='slick-next slick-arrow' src='<?php echo get_template_directory_uri(); ?>/img/icon-slider-right.svg'>",
            responsive: [
			    {
			      breakpoint: 1024,
			      settings: {
			        slidesToShow: 3,
			        slidesToScroll: 3,
			      }
			    },
			    {
			      breakpoint: 600,
			      settings: {
			        slidesToShow: 2,
			        slidesToScroll: 2
			      }
			    },
			    {
			      breakpoint: 480,
			      settings: {
			        slidesToShow: 1,
			        slidesToScroll: 1
			      }
			    }
			  ]
        });

    });
</script>
<?php endif; ?>

<?php if (get_field('columns')) : ?>
<section class="data-center-additional-info">
	<?php if ($additional_info_title) : ?>
	<div class="row column">
		<h2><?php echo $additional_info_title; ?></h2>
	</div>
	<?php endif; ?>
	<?php get_template_part('page-builder/content_section'); ?>
</section>
<?php endif; ?>

<?php if ($hide_map) : ?>
<section class="data-center-location hide-map">
</section>

<? else: ?>

<section class="data-center-location dark-blue-bg">
    <img class='background_pattern' src="<?= get_template_directory_uri(); ?>/img/pattern_location.svg" alt="background pattern" />
	<div class="row row-location ">
		<div class="columns small-12 medium-4 large-3 location-address">
			<h2>Location</h2>
			<div class="location-contact location-contact-address">
				<strong>Address</strong></br>
				<?php echo $temp_address; ?>
				
			</div>
			<?php if ($email) : ?>
			<div class="location-contact location-contact-email">
				<strong>Email Address</strong></br>
				<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
			</div>
			<?php endif; ?>
			<?php if ($phone) : ?>
			<div class="location-contact location-contact-phone">
				<strong>Phone Number</strong></br>
				<a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
			</div>
			<?php endif; ?>
			<?php if ($tour) : ?>
				<a href="#contact" class="button tertiary">Take a Tour</a>
			<?php endif; ?>
		</div>
		<? if (get_field('locations')): ?>

			<div class="columns small-12 medium-8 large-9 acf-map">
				
				<? while(has_sub_field('locations')): 
					
					$location = get_sub_field('location');
					
					if (!empty($location) ) : ?>

						<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>

					<? endif; 
			
				endwhile; ?>
			
			</div>
		
		<? endif; ?>
		
		
	</div>
</section>
<?php endif; ?>
<? if (get_field('wysiwyg_bottom')): ?>
<section class="data-center-wysiwyg-bottom">
	<div class="row">
		<div class="column">
			<? if (get_field('wysiwyg_bottom_title')): ?>
				<h2><?= get_field('wysiwyg_bottom_title'); ?></h2>
			<? endif;	
			echo get_field('wysiwyg_bottom');
			if (get_field('wysiwyg_bottom_buttons')):
				while(has_sub_field('wysiwyg_bottom_buttons')):
					ec_button();
				endwhile;
			endif; ?>
		</div>
	</div>
</section>
<? endif; ?>

<section class="data-center-form pb-contact_form">
	<div class="row" id="contact">
	    <div class="small-12 medium-12 large-5 columns">
	    	<div class="contact-info">
		        <div class="contact-content" id="contact">
		        	<?php if ($form_header) : ?>
		            	<h2><?php echo $form_header; ?></h2>
		            <?php endif; ?>
		            <?php if ($form_content) : ?>
		            	<?php echo $form_content; ?>
		            <?php endif; ?>
		        </div>
		    </div>
	 	</div>
	    <div class="small-12 medium-12 large-7 columns">
	        <div class="contact-form">
	            <?php echo gravity_form($form_id, false, false, false, '', true, ''); ?>
	        </div>
	    </div>
	</div>
</section>

<section class="data-center-related">
    <?php // get_template_part('page-builder/global_map'); ?>
</section>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB13lGW3rgS7_scG2DmYRRk_zWHguh2iSs"></script>
<script type="text/javascript">
(function($) {

/*
*  new_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/

function new_map( $el ) {
	
	// var
	var $markers = $el.find('.marker');
	
	
	// vars
	var args = {
		zoom		: 1,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP,
		disableDefaultUI: false,
		scrollwheel: false,
		styles: [{"featureType":"water","elementType":"all","stylers":[{"visibility":"simplified"},{"hue":"#e9ebed"},{"saturation":-78},{"lightness":67}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"simplified"},{"hue":"#e9ebed"},{"saturation":-78},{"lightness":67}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"simplified"},{"hue":"#ffffff"},{"saturation":-100},{"lightness":100}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#e0e0e0"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"},{"hue":"#ffffff"},{"saturation":-100},{"lightness":100}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"visibility":"simplified"},{"hue":"#e9ebed"},{"saturation":-90},{"lightness":-8}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"on"},{"hue":"#e9ebed"},{"saturation":10},{"lightness":69}]},{"featureType":"administrative.locality","elementType":"all","stylers":[{"visibility":"on"},{"hue":"#2c2e33"},{"saturation":7},{"lightness":19}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"on"},{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"visibility":"simplified"},{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":-2}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#000000"}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"visibility":"simplified"},{"color":"#f7f7f7"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#e0e0e0"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#e0e0e0"}]}]
	};
	
	// create map	        	
	var map = new google.maps.Map( $el[0], args);
	
	
	// add a markers reference
	map.markers = [];
	
	
	// add markers
	$markers.each(function(){
		
    	add_marker( $(this), map );
		
	});
	
	
	// center map
	center_map( map );
	
	
	// return
	return map;
	
}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/

function add_marker( $marker, map ) {

	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		clickable: false,
		map			: map,
		icon:     '<?php echo get_template_directory_uri(); ?>/img/pin-data-center.svg'
	});

	// add to array
	map.markers.push( marker );

	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
		// create info window
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});

		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {

			infowindow.open( map, marker );

		});
	}

}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/

function center_map( map ) {

	// vars
	var bounds = new google.maps.LatLngBounds();

	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){

		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

		bounds.extend( latlng );

	});

	// only 1 marker?
	if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( <?php echo $map_zoom; ?> );
	}
	else
	{
		// fit to bounds
		google.maps.event.addListener(map, 'zoom_changed', function() {
		    zoomChangeBoundsListener =
		        google.maps.event.addListener(map, 'bounds_changed', function(event) {
		            if (this.getZoom() > <?php echo $map_zoom; ?> && this.initialZoom == true) {
		                // Change max/min zoom here
		                this.setZoom(<?php echo $map_zoom; ?>);
		                this.initialZoom = false;
		            }
		        google.maps.event.removeListener(zoomChangeBoundsListener);
		    });
		});
		map.initialZoom = true;
		map.fitBounds( bounds );
	}

}

/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/
// global var
var map = null;

$(document).ready(function(){

	$('.acf-map').each(function(){

		// create map
		map = new_map( $(this) );

	});

});

})(jQuery);
</script>

<?php get_template_part( 'includes/footer' ); ?>
