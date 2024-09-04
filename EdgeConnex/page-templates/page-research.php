<?php
/*
Template Name: Resources
*/

// url variables
$resourceTypes = explode(',', $_GET['types']);
$solutions =  explode(',', $_GET['solutions']);
// $industries = explode(',', $_GET['industries']);
$industries = array();
$search = $_GET['search'];


if (  $resourceTypes[0] !== "" || $solutions[0] !== "" || $industries[0] !== "" || $search !== "" )  {
    $filtered = 1;
}

$background_color = get_field("background_color") ?: 'default';


$currentPage = $_GET['pageNumber'];
$postsPerPage = 12;
// $industryArgs = array (
//   'type' => 'resource',
//   'child_of' => 0,
//   'orderby' => 'name',
//   'order' => 'ASC',
//   'hide_empty' => 1,
//   'hierarchical' => 1,
//   'taxonomy' => 'Industry',
//   'pad_counts' => false 
//  );
// $industryList = get_categories( $industryArgs );

$solutionArgs = array (
  'type' => 'resource',
  'child_of' => 0,
  'orderby' => 'name',
  'order' => 'ASC',
  'hide_empty' => 1,
  'hierarchical' => 1,
  'taxonomy' => 'Solution',
  'pad_counts' => false,

 );
$solutionList = get_categories( $solutionArgs );
//ec_print_r($allTechnologies);

get_template_part( 'includes/header' ); ?>

<?

$queryArray = array(
    'post_type' => 'resource',
    'posts_per_page' => 12,
    's' => $search,
    'paged' => $currentPage,
);




$taxQuery = array(
    'relation' => 'AND',

);
if ( !empty($resourceTypes[0]) ) :
    $metaQuery = array(
        'relation' => 'OR',
        array(
            'key'     => 'resource_type',
            'value'   => $resourceTypes,
            'compare' => 'IN',
        ),
    );
endif;
// if ( !empty($industries[0]) ) :
//    $taxQuery[] = array(
//         'taxonomy'         => 'Industry',
//         'terms'            => $industries,
//         'field'            => 'term_id',
//         'operator'         => 'IN',
//         'include_children' => true,
//     );
// endif; 
if ( !empty($solutions[0]) ) :
   $taxQuery[] = array(
        'taxonomy'         => 'Solution',
        'terms'            => $solutions,
        'field'            => 'term_id',
        'operator'         => 'IN',
        'include_children' => true,
    );
endif; 

$queryArray['meta_query'] = $metaQuery;
$queryArray['tax_query'] = $taxQuery;
?>



<? 
if ( $search ) {
  $loop = new SWP_Query( $queryArray ); 
} else {
  $loop = new WP_Query( $queryArray ); 
}

// if ( $search ) :
//    $loop->parse_query( $queryArray );
//    relevanssi_do_query( $loop );
// endif;
?>

<? $resourceCount = $loop->found_posts; ?>


<section class="filter-controls <?= $background_color; ?>">
   <div class="row">
      <div class="small-12 medium-12 large-8 filters column">
         <div class="narrow">
            <h5 class='caps'>Filter by:</h5>
             <div class="clear-button">
               <a id="clear-filters" class='h5-style caps'>
                  Clear Filters
               </a>
            </div>
         </div>
         <div class="filter-box">
            <div class="filter types">
               <span class="filter-button filter-clicky h5-style caps">Resource Type</span>
               <div class="close">
                  (X)
               </div>
               <ul class="submenu">
                  <div class="wrapper">
                
                        <li>
                            <input type="checkbox" name="resource-types" filter-value="success-story" value="success-story" id="success-story" 
                                <? if ( in_array( 'success-story', $resourceTypes) ) : echo "checked"; endif; ?>>
                            <label for="success-story">
                                Success Stories
                            </label>
                        </li>
                        <li>
                            <input type="checkbox" name="resource-types" filter-value="video" value="video" id="video" 
                                <? if ( in_array( 'video', $resourceTypes) ) : echo "checked"; endif; ?>>
                            <label for="video">
                                Videos
                            </label>
                        </li>
                        <li>
                            <input type="checkbox" name="resource-types" filter-value="whitepaper" value="whitepaper" id="whitepaper" 
                                <? if ( in_array( 'whitepaper', $resourceTypes) ) : echo "checked"; endif; ?>>
                            <label for="whitepaper">
                                White Papers
                            </label>
                        </li>
                        <li>
                            <input type="checkbox" name="resource-types" filter-value="brochure" value="brochure" id="brochure" 
                                <? if ( in_array( 'brochure', $resourceTypes) ) : echo "checked"; endif; ?>>
                            <label for="brochure">
                                Brochures
                            </label>
                        </li>
                       <li>
                            <input type="checkbox" name="resource-types" filter-value="data-sheet" value="data-sheet" id="data-sheet" 
                                <? if ( in_array( 'data-sheet', $resourceTypes) ) : echo "checked"; endif; ?>>
                            <label for="data-sheet">
                                Data Sheets
                            </label>
                        </li>
                        <li>
                            <input type="checkbox" name="resource-types" filter-value="ebook" value="ebook" id="ebook" 
                                <? if ( in_array( 'ebook', $resourceTypes) ) : echo "checked"; endif; ?>>
                            <label for="ebook">
                                Ebooks
                            </label>
                        </li>
                        <li>
                            <input type="checkbox" name="resource-types" filter-value="solutions-brief" value="solutions-brief" id="solutions-brief" 
                                <? if ( in_array( 'solutions-brief', $resourceTypes) ) : echo "checked"; endif; ?>>
                            <label for="solutions-brief">
                                Solutions Brief
                            </label>
                        </li>
                        <li>
                            <input type="checkbox" name="resource-types" filter-value="infographic" value="infographic" id="infographic" 
                                <? if ( in_array( 'infographic', $resourceTypes) ) : echo "checked"; endif; ?>>
                            <label for="infographic">
                                Infographics
                            </label>
                        </li>
                  </div>
               </ul>
            </div>
            <? /*
            <div class="filter industries">
               <span class="filter-button filter-clicky h5-style caps">Industry</span>
               <div class="close">
                  (X)
               </div>
               <ul class="submenu">
                  <div class="wrapper">
                    <?
                     foreach( $industryList as $industry) : ?>
                        <li>
                           <input type="checkbox" filter-value="<?= $industry->slug; ?>" name="industry" value="<?= $industry->term_id; ?>" id="industry-<?= $industry->term_id; ?>" 
                              <? if ( in_array( $industry->term_id, $industries) ) : echo "checked"; endif; ?>>
                           <label for="industry-<?= $industry->term_id; ?>">
                              <?= $industry->name; ?>
                           </label>
                        </li>
                     <? endforeach; ?>
                  </div>
               </ul>
            </div>
            */ ?>
            <div class="filter solutions">
               <span class="filter-button filter-clicky h5-style caps">Solution</span>
               <div class="close">
                  (X)
               </div>
               <ul class="submenu">
                  <?
                  foreach( $solutionList as $solution) : ?>
                     <li>
                        <input type="checkbox" filter-value="<?= $solution->slug; ?>" name="solution" value="<?= $solution->term_id; ?>" id="solution-<?= $solution->term_id; ?>"
                           <? if ( in_array( $solution->term_id, $solutions) ) : echo "checked"; endif; ?>
                        >
                        <label for="solution-<?= $solution->term_id; ?>">
                           <?= $solution->name; ?>
                        </label>
                     </li>
                  <? endforeach; ?>
              
               </ul>
            </div>
            
            <div class="filter go">
               <span class="filter-button filter-clicky h5-style caps">Filter Results</span>
            </div>
         </div>
         
      </div>
      <div class="small-12 medium-12 large-4 search-box column">
         <div class="search-wrapper">
            <label for="keyword-search" class="visuallyhidden">Search </label>
            <input type="text" id="resource-search" class='h5-style caps' name="keyword-search" placeholder="Search" 
               <? if ( isset($search)) : echo "value='" . $search ."'"; endif; ?>
            >
             <div class="submit" id="submitButton">
                <img src="<?php echo get_template_directory_uri(); ?>/img/icon-search-blue.svg" alt="keyword search button">
             </div>
          </div>
      
      </div>
   </div>
    <div>
                    
                  </div>
</section>

<? if ( $filtered ) : ?>
    <section class="filtered <?= $background_color; ?>">
        <div class="row">
            <div class="column">
                <? if ( $resourceTypes[0] !== "" ) : ?>
                    <? foreach ( $resourceTypes as $resourceTermSlug ) : ?>
                        <div class="item" data-value="<?= $resourceTermSlug; ?>">
                            Type: <?= ucwords(str_replace('-', ' ', $resourceTermSlug)); ?>
                        </div>
                    <? endforeach; ?>
                <? endif; ?>
                <? if ( $solutions[0] !== "" ) : ?>
                    <? foreach ( $solutions as $solutionTermID ) : ?>
                        <div class="item" data-value="<?= get_term_by('id', $solutionTermID, 'Solution', 'ARRAY_A')['slug']; ?>">
                            Solution: <?= $solutionDisplay = get_term_by('id', $solutionTermID, 'Solution', 'ARRAY_A')['name']; ?>
                            </a>
                        </div>
                    <? endforeach; ?>
                <? endif; ?>
                <? 
                /*
                if ( $industries[0] !== "" ) : ?>
                    <? foreach ( $industries as $industryTermID ) : ?>
                        <div class="item" data-value="<?= get_term_by('id', $industryTermID, 'Industry', 'ARRAY_A')['slug']; ?>">
                            Industry: <?= $termDisplay = get_term_by('id', $industryTermID, 'Industry', 'ARRAY_A')['name']; ?>
                        </div>
                    <? endforeach; ?>
                <? endif; */ ?>
                <? if ( isset($search) ) : ?>
                    <div class="item" data-value="">
                        Search Term: <?= $search; ?>
                        
                    </div>
                <? endif; ?>
            </div>
        </div>
    </section>

<? endif; ?>


<section class="results <?= $background_color; ?>">
   <div class="row">
      
      <? if ( $loop->have_posts() ) : ?>
          
         <? 
         while ( $loop->have_posts() ) : $loop->the_post(); 
             
            displaySingleResource(get_the_ID());
      
         endwhile;
         ?>
         

         </div>
         <? $pages = ceil( $resourceCount / $postsPerPage ); ?>
         
         
        <?
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
     
        ?>
         
         
         <? if ( $pages > 1 ) : ?>
            <div class="row pagination">
               <div class="column small-12">
                 
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
      
      <? wp_reset_postdata(); ?>

<script type="text/javascript">
	jQuery(document).ready(function($){
	
      $(".filter-clicky").click(
         function () {
            if ( $(this).parent().hasClass('active') ) {
               
               $(this).parent().find('.submenu').slideUp('fast');
               $(this).parent().removeClass('active');
            }
            else {
               $('.filter.active .submenu').slideUp('fast');
               $('.filter').removeClass('active');
               $(this).parent().find('.submenu').slideDown('fast');
               $(this).parent().addClass('active');
   
            }
            
         }
      );
      
      $(".close").click(function() {
         $('.filter.active .submenu').slideUp('fast');
         $('.filter.active').removeClass('active');
      });
      
      $('#clear-filters').click(function() {
         $('.filter-box input').prop('checked', false);
         //$('#resource-search').val('');         
         submitFilters();
         //window.location.href = "/research-library/search/";
         
      });
      
        $('.filtered .item').on('click', function() {
            var filterValue = $(this).attr('data-value');
            $('.filter-box input[filter-value="' + filterValue + '"]').prop('checked', false);
            $(this).remove();
            $('#resource-search').val('');
            submitFilters();
        });  
        
        $('.filtered .item').on('click', function() {
            var filterValue = $(this).attr('data-value');
            
            $(this).remove();
            
        });
      
      function submitFilters() {
         var currentURLWithoutParams = window.location.protocol + "//" + window.location.host + window.location.pathname;
         var urlString = currentURLWithoutParams + "?";
         var param_counter = 0;
         
         //types
         typeCounter = 1;
         typeParam = false;
         $('.types input[type=checkbox]').each(function() {
            if ( this.checked ) {
                 typeParam = true;
                if ( typeCounter == 1 ) {
                    if ( param_counter > 0 ) {
                      urlString += "&types=";
                    } else {
                      urlString += "types=";
                    }
                } else {
                  urlString += ",";
               }
               urlString += $(this).val()
               typeCounter++;
            }
         });
         if(typeParam) {
           param_counter++;
         }
         
         //industries
        //  industryCounter = 1;
        //  industryParam = false;
        //  $('.industries input[type=checkbox]').each(function() {
        //     if ( this.checked ) {
        //          industryParam = true;
        //        if ( industryCounter == 1 ) {
        //            if ( param_counter > 0 ) {
        //               urlString += "&industries=";
        //             } else {
        //               urlString += "industries=";
        //             }
        //        } else {
        //           urlString += ",";
        //        }
        //        urlString += $(this).val()
        //        industryCounter++;
        //     }
        //  });
        //  if(industryParam) {
        //    param_counter++;
        //  }
         
         //solutions
         solutionCounter = 1;
         solutionsParam = false;
         $('.solutions input[type=checkbox]').each(function() {
            if ( this.checked ) {
             solutionsParam = true;
               if ( solutionCounter == 1 ) {
                     if ( param_counter > 0 ) {
                      urlString += "&solutions=";
                    } else {
                      urlString += "solutions=";
                    }
               } else {
                  urlString += ",";
               }
               urlString += $(this).val()
               solutionCounter++;
            }
         });
         if(solutionsParam) {
           param_counter++;
         }
         
         
         if ( $('#resource-search').val() !== "" ) {
            urlString += "&search=";
            urlString += $('#resource-search').val();
         }
         
         console.log(urlString);
         window.location.href = urlString;
      }
      
      $('#submitButton').click(function() {
         submitFilters();
      });
      
      $('.filter.go').click(function() {
         
         submitFilters();
   
      });
      
      
      
      $('#resource-search').bind("enterKey",function(e){
         
      });
      $('#resource-search').keyup(function(e){
          if(e.keyCode == 13)
          {
              submitFilters();
          }
      });
      
      //add click event to entire tile
    //   const postCells = document.querySelectorAll('.results .result');
    // Array.prototype.forEach.call(postCells, postCell => {
    //     let down, up, link = postCell.querySelector('.button');
    //     postCell.onmousedown = () => down = +new Date();
    //     postCell.onmouseup = () => {
    //         up = +new Date();
    //         if ((up - down) < 200) {
    //             link.click();
    //         }
    //     }
    //     postCell.style.cursor = 'pointer';
    // });


	});
</script>

<?php get_template_part( 'includes/footer' ); ?>
