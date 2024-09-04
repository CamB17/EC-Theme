<?php if (get_sub_field('row')): ?> 
    <ul class="accordion" data-accordion data-allow-all-closed="true">
        <? $counter = 1; ?>
    	<?php while(has_sub_field('row')): ?>
    
            <li class="accordion-item <? if ( $counter == 1 ) : echo "is-active"; endif; ?>" data-accordion-item>
                <a href="#" class="accordion-title">
                    <h3><?= get_sub_field('title'); ?></h3>
                </a>
        
                <div class="accordion-content" data-tab-content>
                    <?= get_sub_field('content'); ?>
                </div>
            </li>
            <? $counter++; ?>
    	<?php endwhile; ?>
    </ul>
<?php endif; ?>

    
