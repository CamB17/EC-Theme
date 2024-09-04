<?
$custom = get_sub_field('customized_resources');
$customTitle = get_sub_field('custom_title');
$customLinkText = get_sub_field('custom_link_text');
$customLinkURL = get_sub_field('custom_link_title');
$type = get_sub_field('type_of_resource');
// $industry = get_sub_field('industries');
$solution = get_sub_field('solutions');


if (get_sub_field('specific_resources')): 

	while(has_sub_field('specific_resources')):

        $specificResources[] = get_sub_field('resource');

	endwhile; 

endif; 


displayResources($custom, $customTitle, $customLinkText, $customLinkURL, $type, null, $solution, $specificResources);

?>

<script type="text/javascript">
	jQuery(document).ready(function($){
    
    //Add click event to entire tile
    const postCells = document.querySelectorAll('.results .result');
    Array.prototype.forEach.call(postCells, postCell => {
        let down, up, link = postCell.querySelector('.button');
        postCell.onmousedown = () => down = +new Date();
        postCell.onmouseup = () => {
            up = +new Date();
            if ((up - down) < 200) {
                link.click();
            }
        }
        postCell.style.cursor = 'pointer';
    });



	});
</script>