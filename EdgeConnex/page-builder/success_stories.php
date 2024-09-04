<?php if (get_sub_field('success_stories')): ?> 
    <? $counter = 1; ?>
	<?php while(has_sub_field('success_stories')): ?>
	
        <? $storyID = get_sub_field('success_story'); ?>
        <div class="hold-me <? if ( $counter % 2 == 0 ) : ?>content-first <? endif; ?>">
            <div class="story">
                <div class="image">
                    <img src="<?= get_field('cover_image', $storyID)['sizes']['large-square']; ?>">
                </div>
                <div class="content">
                    <div class="hold-me">
                        <h2>
                            <?= get_the_title($storyID); ?>
                        </h2>
                        <?= get_field('description', $storyID); ?>
                        <a href="<?= get_the_permalink($storyID); ?>" class="button primary">
                            Learn More
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
        <? $counter++; ?>
	<?php endwhile; ?>

<?php endif; ?>