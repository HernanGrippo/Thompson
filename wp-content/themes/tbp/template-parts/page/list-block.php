<section class="<?php echo TBP_PREFIX; ?>-page-list-block">
	<div class="container">
		<div class="<?php echo TBP_PREFIX; ?>-page-content d-flex align-items-center">
			<div class="content-inner pt-0 pb-0">
        <?php
          if(get_sub_field("list_type") == 'with_bullet'): $listStart = '<ul>'; $listEnd = '</ul>';
          else: $listStart = '<ol>'; $listEnd = '</ol>';
          endif;
        ?>
        <?=$listStart;?>
        <?php foreach(get_sub_field("list") as $item): ?>
          <li><?=$item['text'];?></li>
        <?php endforeach; //(get_sub_field("list") as $item): ?>
        <?=$listEnd;?>
			</div>
		</div>
	</div>
</section>
