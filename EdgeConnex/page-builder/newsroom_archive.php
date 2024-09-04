<?php

$postsPerPage = 15;
$currentPage = $_GET['pageNumber'];

$queryArray = array(
    'post_type' => 'newsroom',
    'posts_per_page' => $postsPerPage,
    'paged' => $currentPage,
);
$loop = new WP_Query( $queryArray ); 

$newsroomCount = $loop->found_posts;
$hide_tile_snippets = get_sub_field('hide_tile_snippets');

?>

<section class="results <?= $background_color; ?>">
   <div class="row">
      <? if ( $loop->have_posts() ) :
         while ( $loop->have_posts() ) : $loop->the_post(); 
            echo display_single_newsroom(get_the_ID(), $hide_tile_snippets);
         endwhile;
         ?>
    </div>
    <? $pages = ceil( $newsroomCount / $postsPerPage );
         
        // build the query string and remove the page number from it for use in pagination
        $query_string = $_SERVER['QUERY_STRING'];
        parse_str($query_string, $query_string_array);
        $counter = 1;
        foreach( $query_string_array as $key => $variable ) {
            if ( $key !== "pageNumber") {
                if ( $counter > 1 ) {
                    $built_url .= "&";
                }
                $built_url .= $key . "=" . $variable;
                $counter++;
            }
        }

        if ( $pages > 1 ) : ?>
            <div class="row pagination">
               <div class="column small-12">
                    <span class="pages">Pages:</span>
                  <ul>
                    <!--Pagination previous arrow-->
                    <? 
                    if ( $currentPage > 1 ) :
                        $previous_page = intval($_GET['pageNumber']) - 1;
                        echo '<li><a class="next page-numbers" href="' . "?" . $built_url ."&pageNumber=". $previous_page .'">«</a></li>';
                    endif;
                    ?>
                    <!--Pagination previous arrow ends here-->
                     <?
                     $counter = 1;
                     while ( $counter <= $pages ) :
                        global $wp;
                        
                        echo "<li>";
                        
                        if ( $counter == $currentPage ) :
                           
                           echo "<span class='page-numbers current'>";
                           echo $counter;
                           echo "</span>";
                        elseif ($counter == 1 && $currentPage == null) :
                            // on the first page and first item
                           echo "<span class='page-numbers current'>";
                           echo $counter;
                           echo "</span>";
                        else :
                        echo "<a class='page-numbers' href='" . home_url( $wp->request ) . "?". $built_url ."&pageNumber=". $counter ."'>";
                           echo $counter;
                           echo "</a>";
                        endif;
                        echo "</li>";
                        
                        $counter++;
                     endwhile;
                    
                    // Pagination next arrow
                    if ( $currentPage == null ) :
                        echo '<li><a class="next page-numbers" href="?pageNumber=2">»</a></li>';
                    elseif ( $currentPage < 4 ) :
                        echo '<li><a class="next page-numbers" href="' . "?" . $built_url ."&pageNumber=". ++$currentPage .'">»</a></li>';
                    endif;
                    // Pagination next arrow ends here
                     ?>
                  </ul>
               </div>
               
            </div>
         <? endif; ?>
      </section>
<? else : ?>
            <div class="column" style="padding-bottom:40px;">
                <h4>Sorry, no results.</h4>
                <p>Try broadening your search terms.</p>
            </div>
        </div>
    </section>
<? endif; ?>
      
<? wp_reset_postdata();