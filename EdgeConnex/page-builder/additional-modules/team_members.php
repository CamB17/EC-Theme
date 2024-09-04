<?
// set the post type to use
$postType = "team-member";

// the wp query
$loop = new WP_Query( array( 'post_type' => $postType, 'posts_per_page' => '-1', 'orderby' => 'title' ) );

// initialize the array to store the types that currently exist
$foundTypes = array();

// loop through the found posts to find all of the values of the checkboxes that currently exist
if ( $loop->have_posts() ) :
    while ( $loop->have_posts() ) : $loop->the_post();
        $types = get_field('type');
        if ( is_array($types) ) {
            foreach ( $types as $type ) {
                if ( !in_array($type, $foundTypes) ) {

                    // if the this is a unique type, add it to the array
                    $foundTypes[] = $type;

                }
            }
        }
    endwhile;
endif;
wp_reset_postdata();
?>

<div class="row sort">


    <div class="small-12 medium-12 columns types filter-option" >
        <h4>Type</h4>
        <?
        // loop through all the found types, adding it to the navigation
        if ( is_array($foundTypes) ) :
            foreach ( $foundTypes as $type ) :
                $cleanType = str_replace(' ', '', $type);
                $cleanType = str_replace('/', '', $cleanType);
                ?>
                <div class="small-6 medium-4 columns input-values">
                    <input type="checkbox" name="type" value=".<?= $cleanType; ?>" id="<?= $cleanType; ?>" />
                    <label for="<?= $cleanType; ?>"><?= $type; ?></label>
                </div>
            <? endforeach; ?>
        <? endif; ?>
    </div>

</div>
<div class="row">
    <div class="member-container">
        <?
        if ( $loop->have_posts() ) :
            $counter = 1;
            while ( $loop->have_posts() ) : $loop->the_post();
    
                // make sure the css classes array is empty
                unset($cssClasses, $link, $class);
                $types = get_field('type');
                $moreThanOneClass = 0;
    
                // create the correct css classes based on the types that
                // are selected for this post
                if ( is_array($types) ) :
                    foreach ($types as $type) :
    
                        $cleanType = str_replace(' ', '', $type);
                        $cleanType = str_replace('/', '', $cleanType);
    
                        if ( $moreThanOneClass ) :
                            $cssClasses .= " ";
                        endif;
    
                        $cssClasses .= $cleanType;
                        $moreThanOneClass++;
    
                    endforeach;
                endif;
                ?>
                <div class="small-12 medium-6 large-4 columns member <?= $cssClasses; ?>">
                    <div class="member-border">
                        <? $image = get_field('headshot'); ?>
                         <?
                        // if it's in popup mode, set the correct variables
                        if ( get_sub_field('pop_up_mode') ) :
                            $link = "#popup" . $counter;
                            $class = "open-popup-link";
                        else :
                            $link = get_the_permalink();
                        endif;
                        ?>
                        <div class="image">
                            <a href="<?= $link; ?>" class="<?= $class; ?>">
                                <img src="<?= $image['sizes']['portrait-medium']; ?>">
                            </a>
                        </div>
                        <div class="info">
                            <a href="<?= $link; ?>" class="<?= $class; ?>">
                                <h5><? the_title(); ?></h5>
                            </a>
                            <? if ( get_field('title') ) : ?>
                                <h6><?= get_field('title'); ?></h6>
                            <? endif; ?>
                           
    
                            <a href="<?= $link; ?>" class="button primary <?= $class; ?>">Learn More</a>
                        </div>
                    </div>
                </div>
                <? $counter++; ?>
            <? endwhile; ?>
        <? endif; ?>
        <? wp_reset_postdata(); ?>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {
        
        $(window).load(function(){
        
            $('.pb-team_members .team-members .team-member .hold-me').click(function() {
                window.location = $(this).find('a').attr('href');
            });
        
             // if you need to be able to filter by a search field, see the larimer project
            var checkFilter;
            var $checkboxes = $('.sort input');
    
            // init Isotope
            var $container = $('.member-container').isotope({
                itemSelector: '.member',
                layoutMode: 'fitRows',
                filter: function() {
                    var $this = $(this);
                    var checkResult = checkFilter ? $this.is(checkFilter) : true;
                    return checkResult;
                }
            });
            /*
            $('#filters').on('click', 'button', function() {
                buttonFilter = $(this).attr('data-filter');
                $container.isotope();
            });
            */
    
            $checkboxes.click(function() {
                wasChecked = $(this).prop('checked');
                var filters = [];
                // get checked checkboxes values
                $checkboxes.filter(':checked').each(function() {
                    filters.push(this.value);
                });
                // ['.red', '.blue'] -> '.red, .blue'
                checkFilter = filters.join('');
                $container.isotope();
            });
        });

       

    });
</script>

<?
// if pop up mode is enabled, write the html popup code and the jquery init code
if ( get_sub_field('pop_up_mode') ) :

    if ( $loop->have_posts() ) :
        $counter = 1;
        while ( $loop->have_posts() ) : $loop->the_post(); ?>

            <div id="popup<?= $counter; ?>" class="white-popup mfp-hide">
                <? $image = get_field('headshot'); ?>

                <img src="<?= $image['sizes']['portrait-medium']; ?>">
                <h4><? the_title(); ?></h4>
                <? if ( get_field('title') ) : ?>
                    <h6><?= get_field('title'); ?></h6>
                <? endif; ?>
                <?= get_field('bio'); ?>
            </div>


            <?
            $counter++;
        endwhile;
    endif;
    wp_reset_postdata();
    ?>
    <script>
        jQuery(document).ready(function($) {
            $('.open-popup-link').magnificPopup({
                type:'inline',
                midClick: true,
            });
        });
    </script>

<? endif; ?>
