<?php if (get_sub_field('stats')):
  $count = count(get_sub_field('stats'));
  ?>
    <div class="row stats-wrap">
    	<?php while(has_sub_field('stats')):
        //vars
        $number = get_sub_field('number');
        $description = get_sub_field('description');
        $source = get_sub_field('source');

        if($count == 1) :
          $col = 'medium-6 large-6 has-1';
        elseif($count == 2) :
          $col = 'medium-6 large-6 has-2';
        elseif($count == 3) :
          $col = 'medium-6 large-4 has-3';
        elseif($count == 4) :
          $col = 'medium-6 large-6 xlarge-3 has-4';
        elseif($count == 5) :
            $col = 'medium-6 large-6 xlarge-3 has-5';
        else:
          $col = 'medium-6 large-4 has-6';
        endif;
        ?>
        <div class="columns small-12 <?php echo $col; ?>">
            <div class="stat">
               <?php if ($number): ?>
                 <div class="number" id="number-<?php echo $count; ?>"><?php echo $number; ?></div>
               <?php endif; ?>
               <?php if ($description): ?>
                 <p class="description"><?php echo $description; ?></p>
               <?php endif; ?>
              <?php if ($source): ?>
                <p class="source">*<?php echo $source; ?></p>
              <?php endif; ?>
             </div>
        </div>



    	<?php endwhile; ?>
    </div>
<?php endif; ?>