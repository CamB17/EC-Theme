<div class="row heading">
    <div class="columns small-12 large-6 title">
        <h2>
            <? if ( get_sub_field('title_override') ) : ?>
                <?= get_sub_field('title_override'); ?>
            <? else : ?>
                Data Center Locations
            <? endif; ?>
            <? $page_title = get_the_title(); ?>
        </h2>
    </div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('.counter_circle').each(function() {
		   let location_count = $(this).parents('.accordion-item').find('.column').length; 
		   $(this).text(location_count);
		});

	});
</script>
<div class="row locations">
    <div class="column small-12 medium-12">
        <ul class="accordion" data-accordion data-allow-all-closed="true">
        <? $counter = 1; ?>
        <li class="accordion-item <? if (strpos($page_title, 'North America') !== false) : echo "is-active"; endif; ?>"  data-accordion-item>
             <a href="#" class="accordion-title">
                <div class='counter_circle'></div> North America
            </a>
            <div class="hold-me row accordion-content" data-tab-content>
                <?
                $queryArray = array(
                    'post_type' => 'data-center',
                    'posts_per_page' => -1,
                    'order' => 'ASC',
                    'orderby' => 'title',
                    'post_parent' => 0
                );
                
                $metaQuery = array(
                    'relation' => 'AND',
                    array(
                        'key'     => 'region',
                        'value'   => 'north-america',
                        'compare' => '=',
                    ),
                );
             
                $queryArray['meta_query'] = $metaQuery;
                ?>
                
                <? $loop = new WP_Query( $queryArray ); 
                ?>
                
                <? if ( $loop->have_posts() ) : ?>
                    
                    <? while ( $loop->have_posts() ) : $loop->the_post();
                    $rand = rand(1, 9999);
                    ?>
                    
                        <? if ( get_field('type') !== "under-consideration" ) : ?>
                            <div class="small-12 medium-6 large-2 column">
                                <? if (has_children()) : ?>
                                    <a class="toggle-sub-data-centers-<?php echo $rand; ?>">
                                <? elseif ( get_field('enable_single_page') ): ?>
                                    <a href="<?= get_the_permalink(); ?>">
                                <? elseif ( get_field('data_sheet') && ! get_field('enable_single_page') ) : ?>
                                    <a href="<?= get_field('data_sheet'); ?>" target=”_blank”>
                                <? endif; ?>
                                <? the_title(); ?>
                                    </a>
                                <? if ( get_field('number_of_data_centers') > 1 ) : ?>
                                    <span class="multiple">(<?= get_field('number_of_data_centers'); ?>)</span>
                                <? endif; ?>
                                <? if ( get_field('type') !== "active" && get_field('type') !== "coming-soon" ) : ?>
                                    <span class="dot <?= get_field('type'); ?>"></span>
                                <? endif; ?>
                                <?php if (has_children()) : ?>
                                <div class="sub-data-centers" id="sub-data-centers-<?php echo $rand; ?>">
                                    	<?php
    	                                	if ( get_field('data_sheet') && !get_field('enable_single_page') ) : ?>
    	                                		<a href="<?php echo get_field('data_sheet'); ?>" target="_blank">
    	                                			<?php
    	                                			if (get_field('data_center_id')) :
    	                                				echo get_field('data_center_id') . '<span>&#10515;</span>';
    	                                			else:
    	                                				echo 'Download Data Sheet';
    	                                			endif; ?>
    	                                		</a>
    	                                	<?php endif; ?>
    	                                	<?php if ( get_field('enable_single_page')) : ?>
    		                                	<a href="<?php the_permalink(); ?>">
    		                                		<?php
    	                                			if (get_field('data_center_id')) :
    	                                				echo get_field('data_center_id') . '<span>&#10132;</span>';
    	                                			else:
    	                                				echo 'Learn More';
    	                                			endif; ?>
    		                                	</a>
    		                                <?php endif; ?>
                                    <?php
    								// WP_Query arguments
    								$parentID = get_the_ID();
    								
    								$child_args = array(
    									'post_type' => 'data-center',
    					                'posts_per_page' => -1,
    					                //'post_parent__not_in' => array(0),
    					                'post_parent' => $parentID ,
    								);
    							    // The Query
    								$child_query = new WP_Query( $child_args );
    								
    								?>
    								<?php if ( $child_query->have_posts() )  : ?>
    								    <?php while ( $child_query->have_posts() ) :
    										$child_query->the_post(); 
    										?>
                                            	<?php
    	                                	if ( get_field('data_sheet') && !get_field('enable_single_page') ) : ?>
    	                                		<a href="<?php echo get_field('data_sheet'); ?>" target="_blank">
    	                                			<?php
    	                                			if (get_field('data_center_id')) :
    	                                				echo get_field('data_center_id') . '<span>&#10515;</span>';
    	                                			else:
    	                                				echo 'Download Data Sheet';
    	                                			endif; ?>
    	                                		</a>
    	                                	<?php endif; ?>
    	                                	<?php if ( get_field('enable_single_page')) : ?>
    		                                	<a href="<?php the_permalink(); ?>">
    		                                		<?php
    	                                			if (get_field('data_center_id')) :
    	                                				echo get_field('data_center_id') . '<span>&#10132;</span>';
    	                                			else:
    	                                				echo 'Learn More';
    	                                			endif; ?>
    		                                	</a>
    		                                <?php endif; ?>
    									<?php endwhile; ?>
    								<?php endif;
    										
    										// Restore original Post Data
    										wp_reset_postdata();
    										?>
    
                                </div>
                                <script>
                                    jQuery(document).ready(function($){
                                        $('.toggle-sub-data-centers-<?php echo $rand; ?>').click(function(){
                                            $('#sub-data-centers-<?php echo $rand; ?>').toggleClass('is-showing');
                                            
                                        });
                                    });
                                </script>
                                <?php endif; ?>
                            </div>
                        <? endif; ?>
                
                    <? endwhile; ?>
                   
                <? endif; ?>
                
                <? wp_reset_postdata(); ?>
            </div>
            </li>
            <!--EMEA-->
            <li class="accordion-item <? if ( $page_title == 'Data Centers: EMEA' ) : echo "is-active"; endif; ?>" data-accordion-item>
                <a href="#" class="accordion-title">
                    <span class='counter_circle <?= $na_count; ?>'></span>  EMEA
                </a>
                <div class="hold-me row accordion-content" data-tab-content>
                    <?
                    $queryArray = array(
                        'post_type' => 'data-center',
                        'posts_per_page' => -1,
                        'order' => 'ASC',
                        'orderby' => 'title',
                    );
                    
                    $metaQuery = array(
                        'relation' => 'AND',
                        array(
                            'key'     => 'region',
                            'value'   => 'europe',
                            'compare' => '=',
                        ),
                    );
                 
                    $queryArray['meta_query'] = $metaQuery;
                    ?>
                    
                    <? $loop = new WP_Query( $queryArray ); ?>
                    
                    <? if ( $loop->have_posts() ) : ?>
                        
                        <? while ( $loop->have_posts() ) : $loop->the_post();
                        $rand = rand(1, 9999);
                        ?>
                            <? if ( get_field('type') !== "under-consideration" ) : ?>
                                <div class="small-12 medium-6 large-4 column">
                                    <? if (has_children()) : ?>
                                        <a class="toggle-sub-data-centers-<?php echo $rand; ?>">
                                    <? elseif ( get_field('enable_single_page') ): ?>
                                        <a href="<?= get_the_permalink(); ?>">
                                    <? elseif ( get_field('data_sheet') && ! get_field('enable_single_page') ) : ?>
                                        <a href="<?= get_field('data_sheet'); ?>" target=”_blank”>
                                    <? endif; ?>
                                    <? the_title(); ?>
                                        </a>
                                    <? if ( get_field('number_of_data_centers') > 1 ) : ?>
                                        <span class="multiple">(<?= get_field('number_of_data_centers'); ?>)</span>
                                    <? endif; ?>
                                    <? if ( get_field('type') !== "active" && get_field('type') !== "coming-soon" ) : ?>
                                        <span class="dot <?= get_field('type'); ?>"></span>
                                    <? endif; ?>
                                    <?php if (has_children()) : ?>
                                    <div class="sub-data-centers" id="sub-data-centers-<?php echo $rand; ?>">
                                        <? if ( get_field('enable_single_page') ): ?>
                                                <a href="<?= get_the_permalink(); ?>">
                                            <? elseif ( get_field('data_sheet') && ! get_field('enable_single_page') ) : ?>
                                                <a href="<?= get_field('data_sheet'); ?>" target=”_blank”>
                                            <? endif; ?>
                                            <? the_title(); ?> <?php if (get_field('data_center_id')) : echo '(' . get_field('data_center_id') . ')'; endif; ?>
                                                </a>
                                        <?php
        								// WP_Query arguments
        								$parentID = get_the_ID();
        								$child_args = array(
        									'post_type' => 'data-center',
        					                'posts_per_page' => -1,
        					                //'post_parent__not_in' => array(0),
        					                'post_parent' => $parentID ,
        								);
        							    // The Query
        								$child_query = new WP_Query( $child_args ); ?>
        								<?php if ( $child_query->have_posts() )  : ?>
        								    <?php while ( $child_query->have_posts() ) :
        										$child_query->the_post(); ?>
                                                <? if ( get_field('enable_single_page') ): ?>
                                                    <a href="<?= get_the_permalink(); ?>">
                                                <? elseif ( get_field('data_sheet') && ! get_field('enable_single_page') ) : ?>
                                                    <a href="<?= get_field('data_sheet'); ?>" target=”_blank”>
                                                <? endif; ?>
                                                <? the_title(); ?> <?php if (get_field('data_center_id')) : echo '(' . get_field('data_center_id') . ')'; endif; ?>
                                                    </a>
        									<?php endwhile; ?>
        								<?php endif;
        										
        										// Restore original Post Data
        										wp_reset_postdata();
        										?>
        
                                    </div>
                                    <script>
                                        jQuery(document).ready(function($){
                                            $('.toggle-sub-data-centers-<?php echo $rand; ?>').click(function(){
                                                $('#sub-data-centers-<?php echo $rand; ?>').toggleClass('is-showing');
                                                
                                            });
                                        });
                                    </script>
                                    <?php endif; ?>
                                </div>
                            <? endif; ?>
                    
                        <? endwhile; ?>
                       
                    <? endif; ?>
                    
                    <? wp_reset_postdata(); ?>
                </div>
            </li>
            
            <!--South America-->
            <li class="accordion-item <? if (strpos($page_title, 'South America') !== false) : echo "is-active"; endif; ?>"  data-accordion-item>
                <a href="#" class="accordion-title">
                    <span class='counter_circle <?= $na_count; ?>'></span>  South America
                </a>
                <div class="hold-me row accordion-content" data-tab-content>
                    <?
                    $queryArray = array(
                        'post_type' => 'data-center',
                        'posts_per_page' => -1,
                        'order' => 'ASC',
                        'orderby' => 'title',
                    );
                    
                    $metaQuery = array(
                        'relation' => 'AND',
                        array(
                            'key'     => 'region',
                            'value'   => 'south-america',
                            'compare' => '=',
                        ),
                    );
                 
                    $queryArray['meta_query'] = $metaQuery;
                    ?>
                    
                    <? $loop = new WP_Query( $queryArray ); ?>
                    
                    <? if ( $loop->have_posts() ) : ?>
                        
                        <? while ( $loop->have_posts() ) : $loop->the_post();
                        $rand = rand(1, 9999);
                        ?>
                            <? if ( get_field('type') !== "under-consideration" ) : ?>
                                <div class="small-12 medium-6 large-4 column">
                                    <? if (has_children()) : ?>
                                        <a class="toggle-sub-data-centers-<?php echo $rand; ?>">
                                    <? elseif ( get_field('enable_single_page') ): ?>
                                        <a href="<?= get_the_permalink(); ?>">
                                    <? elseif ( get_field('data_sheet') && ! get_field('enable_single_page') ) : ?>
                                        <a href="<?= get_field('data_sheet'); ?>" target=”_blank”>
                                    <? endif; ?>
                                    <? the_title(); ?>
                                        </a>
                                    <? if ( get_field('number_of_data_centers') > 1 ) : ?>
                                        <span class="multiple">(<?= get_field('number_of_data_centers'); ?>)</span>
                                    <? endif; ?>
                                    <? if ( get_field('type') !== "active" && get_field('type') !== "coming-soon" ) : ?>
                                        <span class="dot <?= get_field('type'); ?>"></span>
                                    <? endif; ?>
                                    <?php if (has_children()) : ?>
                                    <div class="sub-data-centers" id="sub-data-centers-<?php echo $rand; ?>">
                                        <? if ( get_field('enable_single_page') ): ?>
                                                <a href="<?= get_the_permalink(); ?>">
                                            <? elseif ( get_field('data_sheet') && ! get_field('enable_single_page') ) : ?>
                                                <a href="<?= get_field('data_sheet'); ?>" target=”_blank”>
                                            <? endif; ?>
                                            <? the_title(); ?> <?php if (get_field('data_center_id')) : echo '(' . get_field('data_center_id') . ')'; endif; ?>
                                                </a>
                                        <?php
        								// WP_Query arguments
        								$parentID = get_the_ID();
        								$child_args = array(
        									'post_type' => 'data-center',
        					                'posts_per_page' => -1,
        					                //'post_parent__not_in' => array(0),
        					                'post_parent' => $parentID ,
        								);
        							    // The Query
        								$child_query = new WP_Query( $child_args ); ?>
        								<?php if ( $child_query->have_posts() )  : ?>
        								    <?php while ( $child_query->have_posts() ) :
        										$child_query->the_post(); ?>
                                                <? if ( get_field('enable_single_page') ): ?>
                                                    <a href="<?= get_the_permalink(); ?>">
                                                <? elseif ( get_field('data_sheet') && ! get_field('enable_single_page') ) : ?>
                                                    <a href="<?= get_field('data_sheet'); ?>" target=”_blank”>
                                                <? endif; ?>
                                                <? the_title(); ?> <?php if (get_field('data_center_id')) : echo '(' . get_field('data_center_id') . ')'; endif; ?>
                                                    </a>
        									<?php endwhile; ?>
        								<?php endif;
        										
        										// Restore original Post Data
        										wp_reset_postdata();
        										?>
        
                                    </div>
                                    <script>
                                        jQuery(document).ready(function($){
                                            $('.toggle-sub-data-centers-<?php echo $rand; ?>').click(function(){
                                                $('#sub-data-centers-<?php echo $rand; ?>').toggleClass('is-showing');
                                                
                                            });
                                        });
                                    </script>
                                    <?php endif; ?>
                                </div>
                            <? endif; ?>
                    
                        <? endwhile; ?>
                       
                    <? endif; ?>
                    
                    <? wp_reset_postdata(); ?>
                </div>
            </li>
            
            <!--India-->
            <li class="accordion-item <? if (strpos($page_title, 'India') !== false) : echo "is-active"; endif; ?>"  data-accordion-item>
                <a href="#" class="accordion-title">
                    <span class='counter_circle <?= $na_count; ?>'></span> India
                </a>
                <div class="hold-me row accordion-content" data-tab-content>
                    <?
                    $queryArray = array(
                        'post_type' => 'data-center',
                        'posts_per_page' => -1,
                        'order' => 'ASC',
                        'orderby' => 'title',
                    );
                    
                    $metaQuery = array(
                        'relation' => 'AND',
                        array(
                            'key'     => 'region',
                            'value'   => 'india',
                            'compare' => '=',
                        ),
                    );
                 
                    $queryArray['meta_query'] = $metaQuery;
                    ?>
                    
                    <? $loop = new WP_Query( $queryArray ); ?>
                    
                    <? if ( $loop->have_posts() ) : ?>
                        
                        <? while ( $loop->have_posts() ) : $loop->the_post();
                        $rand = rand(1, 9999);
                        ?>
                            <? if ( get_field('type') !== "under-consideration" ) : ?>
                                <div class="small-12 medium-6 large-4 column">
                                    <? if (has_children()) : ?>
                                        <a class="toggle-sub-data-centers-<?php echo $rand; ?>">
                                    <? elseif ( get_field('enable_single_page') ): ?>
                                        <a href="/locations/india/india-data-centers/">
                                    <? elseif ( get_field('data_sheet') && ! get_field('enable_single_page') ) : ?>
                                        <a href="<?= get_field('data_sheet'); ?>" target=”_blank”>
                                    <? endif; ?>
                                    <? the_title(); ?>
                                        </a>
                                    <? if ( get_field('number_of_data_centers') > 1 ) : ?>
                                        <span class="multiple">(<?= get_field('number_of_data_centers'); ?>)</span>
                                    <? endif; ?>
                                    <? if ( get_field('type') !== "active" && get_field('type') !== "coming-soon" ) : ?>
                                        <span class="dot <?= get_field('type'); ?>"></span>
                                    <? endif; ?>
                                    <?php if (has_children()) : ?>
                                    <div class="sub-data-centers" id="sub-data-centers-<?php echo $rand; ?>">
                                        <? if ( get_field('enable_single_page') ): ?>
                                                <a href="<?= get_the_permalink(); ?>">
                                            <? elseif ( get_field('data_sheet') && ! get_field('enable_single_page') ) : ?>
                                                <a href="<?= get_field('data_sheet'); ?>" target=”_blank”>
                                            <? endif; ?>
                                            <? the_title(); ?> <?php if (get_field('data_center_id')) : echo '(' . get_field('data_center_id') . ')'; endif; ?>
                                                </a>
                                        <?php
        								// WP_Query arguments
        								$parentID = get_the_ID();
        								$child_args = array(
        									'post_type' => 'data-center',
        					                'posts_per_page' => -1,
        					                //'post_parent__not_in' => array(0),
        					                'post_parent' => $parentID ,
        								);
        							    // The Query
        								$child_query = new WP_Query( $child_args ); ?>
        								<?php if ( $child_query->have_posts() )  : ?>
        								    <?php while ( $child_query->have_posts() ) :
        										$child_query->the_post(); ?>
                                                <? if ( get_field('enable_single_page') ): ?>
                                                    <a href="<?= get_the_permalink(); ?>">
                                                <? elseif ( get_field('data_sheet') && ! get_field('enable_single_page') ) : ?>
                                                    <a href="<?= get_field('data_sheet'); ?>" target=”_blank”>
                                                <? endif; ?>
                                                <? the_title(); ?> <?php if (get_field('data_center_id')) : echo '(' . get_field('data_center_id') . ')'; endif; ?>
                                                    </a>
        									<?php endwhile; ?>
        								<?php endif;
        										
        										// Restore original Post Data
        										wp_reset_postdata();
        										?>
        
                                    </div>
                                    <script>
                                        jQuery(document).ready(function($){
                                            $('.toggle-sub-data-centers-<?php echo $rand; ?>').click(function(){
                                                $('#sub-data-centers-<?php echo $rand; ?>').toggleClass('is-showing');
                                                
                                            });
                                        });
                                    </script>
                                    <?php endif; ?>
                                </div>
                            <? endif; ?>
                    
                        <? endwhile; ?>
                       
                    <? endif; ?>
                    
                    <? wp_reset_postdata(); ?>
                </div>
            </li>
            <!--China-->
            <li class="accordion-item <? if (strpos($page_title, 'China') !== false) : echo "is-active"; endif; ?>"  data-accordion-item>
                <a href="#" class="accordion-title">
                    <span class='counter_circle <?= $na_count; ?>'></span> China
                </a>
                <div class="hold-me row accordion-content" data-tab-content>
                    <?
                    $queryArray = array(
                        'post_type' => 'data-center',
                        'posts_per_page' => -1,
                        'order' => 'ASC',
                        'orderby' => 'title',
                    );
                    
                    $metaQuery = array(
                        'relation' => 'AND',
                        array(
                            'key'     => 'region',
                            'value'   => 'china',
                            'compare' => '=',
                        ),
                    );
                 
                    $queryArray['meta_query'] = $metaQuery;
                    ?>
                    
                    <? $loop = new WP_Query( $queryArray ); ?>
                    
                    <? if ( $loop->have_posts() ) : ?>
                        
                        <? while ( $loop->have_posts() ) : $loop->the_post();
                        $rand = rand(1, 9999);
                        ?>
                            <? if ( get_field('type') !== "under-consideration" ) : ?>
                                <div class="small-12 medium-6 large-4 column">
                                    <? if (has_children()) : ?>
                                        <a class="toggle-sub-data-centers-<?php echo $rand; ?>">
                                    <? elseif ( get_field('enable_single_page') ): ?>
                                        <a href="<?= get_the_permalink(); ?>">
                                    <? elseif ( get_field('data_sheet') && ! get_field('enable_single_page') ) : ?>
                                        <a href="<?= get_field('data_sheet'); ?>" target=”_blank”>
                                    <? endif; ?>
                                    <? the_title(); ?>
                                        </a>
                                    <? if ( get_field('number_of_data_centers') > 1 ) : ?>
                                        <span class="multiple">(<?= get_field('number_of_data_centers'); ?>)</span>
                                    <? endif; ?>
                                    <? if ( get_field('type') !== "active" && get_field('type') !== "coming-soon" ) : ?>
                                        <span class="dot <?= get_field('type'); ?>"></span>
                                    <? endif; ?>
                                    <?php if (has_children()) : ?>
                                    <div class="sub-data-centers" id="sub-data-centers-<?php echo $rand; ?>">
                                        <? if ( get_field('enable_single_page') ): ?>
                                                <a href="<?= get_the_permalink(); ?>">
                                            <? elseif ( get_field('data_sheet') && ! get_field('enable_single_page') ) : ?>
                                                <a href="<?= get_field('data_sheet'); ?>" target=”_blank”>
                                            <? endif; ?>
                                            <? the_title(); ?> <?php if (get_field('data_center_id')) : echo '(' . get_field('data_center_id') . ')'; endif; ?>
                                                </a>
                                        <?php
        								// WP_Query arguments
        								$parentID = get_the_ID();
        								$child_args = array(
        									'post_type' => 'data-center',
        					                'posts_per_page' => -1,
        					                //'post_parent__not_in' => array(0),
        					                'post_parent' => $parentID ,
        								);
        							    // The Query
        								$child_query = new WP_Query( $child_args ); ?>
        								<?php if ( $child_query->have_posts() )  : ?>
        								    <?php while ( $child_query->have_posts() ) :
        										$child_query->the_post(); ?>
                                                <? if ( get_field('enable_single_page') ): ?>
                                                    <a href="<?= get_the_permalink(); ?>">
                                                <? elseif ( get_field('data_sheet') && ! get_field('enable_single_page') ) : ?>
                                                    <a href="<?= get_field('data_sheet'); ?>" target=”_blank”>
                                                <? endif; ?>
                                                <? the_title(); ?> <?php if (get_field('data_center_id')) : echo '(' . get_field('data_center_id') . ')'; endif; ?>
                                                    </a>
        									<?php endwhile; ?>
        								<?php endif;
        										
        										// Restore original Post Data
        										wp_reset_postdata();
        										?>
        
                                    </div>
                                    <script>
                                        jQuery(document).ready(function($){
                                            $('.toggle-sub-data-centers-<?php echo $rand; ?>').click(function(){
                                                $('#sub-data-centers-<?php echo $rand; ?>').toggleClass('is-showing');
                                                
                                            });
                                        });
                                    </script>
                                    <?php endif; ?>
                                </div>
                            <? endif; ?>
                    
                        <? endwhile; ?>
                       
                    <? endif; ?>
                    
                    <? wp_reset_postdata(); ?>
                </div>
            </li>
            
            <!--Asia Pacific-->
            <li class="accordion-item <? if (strpos($page_title, 'Asia-Pacific') !== false) : echo "is-active"; endif; ?>"  data-accordion-item>
                <a href="#" class="accordion-title">
                    <span class='counter_circle <?= $na_count; ?>'></span> Asia-Pacific
                </a>
                <div class="hold-me row accordion-content" data-tab-content>
                    <?
                    $queryArray = array(
                        'post_type' => 'data-center',
                        'posts_per_page' => -1,
                        'order' => 'ASC',
                        'orderby' => 'title',
                    );
                    
                    $metaQuery = array(
                        'relation' => 'AND',
                        array(
                            'key'     => 'region',
                            'value'   => 'asia-pacific',
                            'compare' => '=',
                        ),
                    );
                 
                    $queryArray['meta_query'] = $metaQuery;
                    ?>
                    
                    <? $loop = new WP_Query( $queryArray ); ?>
                    
                    <? if ( $loop->have_posts() ) : ?>
                        
                        <? while ( $loop->have_posts() ) : $loop->the_post();
                        $rand = rand(1, 9999);
                        ?>
                            <? if ( get_field('type') !== "under-consideration" ) : ?>
                                <div class="small-12 medium-6 large-4 column">
                                    <? if (has_children()) : ?>
                                        <a class="toggle-sub-data-centers-<?php echo $rand; ?>">
                                    <? elseif ( get_field('enable_single_page') ): ?>
                                        <a href="<?= get_the_permalink(); ?>">
                                    <? elseif ( get_field('data_sheet') && ! get_field('enable_single_page') ) : ?>
                                        <a href="<?= get_field('data_sheet'); ?>" target=”_blank”>
                                    <? endif; ?>
                                    <? the_title(); ?>
                                        </a>
                                    <? if ( get_field('number_of_data_centers') > 1 ) : ?>
                                        <span class="multiple">(<?= get_field('number_of_data_centers'); ?>)</span>
                                    <? endif; ?>
                                    <? if ( get_field('type') !== "active" && get_field('type') !== "coming-soon" ) : ?>
                                        <span class="dot <?= get_field('type'); ?>"></span>
                                    <? endif; ?>
                                    <?php if (has_children()) : ?>
                                    <div class="sub-data-centers" id="sub-data-centers-<?php echo $rand; ?>">
                                        <? if ( get_field('enable_single_page') ): ?>
                                                <a href="<?= get_the_permalink(); ?>">
                                            <? elseif ( get_field('data_sheet') && ! get_field('enable_single_page') ) : ?>
                                                <a href="<?= get_field('data_sheet'); ?>" target=”_blank”>
                                            <? endif; ?>
                                            <? the_title(); ?> <?php if (get_field('data_center_id')) : echo '(' . get_field('data_center_id') . ')'; endif; ?>
                                                </a>
                                        <?php
        								// WP_Query arguments
        								$parentID = get_the_ID();
        								$child_args = array(
        									'post_type' => 'data-center',
        					                'posts_per_page' => -1,
        					                //'post_parent__not_in' => array(0),
        					                'post_parent' => $parentID,
        								);
        							    // The Query
        								$child_query = new WP_Query( $child_args ); ?>
        								<?php if ( $child_query->have_posts() )  : ?>
        								    <?php while ( $child_query->have_posts() ) :
        										$child_query->the_post(); ?>
                                                <? if ( get_field('enable_single_page') ): ?>
                                                    <a href="<?= get_the_permalink(); ?>">
                                                <? elseif ( get_field('data_sheet') && ! get_field('enable_single_page') ) : ?>
                                                    <a href="<?= get_field('data_sheet'); ?>" target=”_blank”>
                                                <? endif; ?>
                                                <? the_title(); ?> <?php if (get_field('data_center_id')) : echo '(' . get_field('data_center_id') . ')'; endif; ?>
                                                    </a>
        									<?php endwhile; ?>
        								<?php endif;
        										
        										// Restore original Post Data
        										wp_reset_postdata();
        										?>
        
                                    </div>
                                    <script>
                                        jQuery(document).ready(function($){
                                            $('.toggle-sub-data-centers-<?php echo $rand; ?>').click(function(){
                                                $('#sub-data-centers-<?php echo $rand; ?>').toggleClass('is-showing');
                                                
                                            });
                                        });
                                    </script>
                                    <?php endif; ?>
                                </div>
                            <? endif; ?>
                    
                        <? endwhile; ?>
                       
                    <? endif; ?>
                    
                    <? wp_reset_postdata(); ?>
                </div>
            </li>
            <? $counter++; ?>
        <!--End Accordion-->
        </ul>
    </div>
   
</div>