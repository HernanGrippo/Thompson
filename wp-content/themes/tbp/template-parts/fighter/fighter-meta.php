<div class="d-none d-md-block">
  <div class="meta-right">
    <div class="container">
      <div class="row">
        <div class="col-4 d-lg-none">
          <div class="d-flex align-items-center">
            <?php while (have_rows('country')) : the_row(); ?>
              <div>
                <img src="<?php echo get_sub_field("flag"); ?>" class="born-place" alt="<?php echo get_sub_field("alt"); ?>">
              </div>
            <?php endwhile; ?>
            <p class="d-inline-block m-0">
              <?php while (have_rows('tbp_fighter_profile_datas')) : the_row(); ?>
                <span class="city d-block"><?php echo get_sub_field("tbp_fighter_profile_birthplace"); ?></span>
              <?php endwhile; // (have_rows('tbp_fighter_profile_datas')) : the_row(); 
              ?>
            </p>
          </div>
        </div>
        <div class="col-8 col-lg-12">
          <div class="container data-wrapper">
            <div class="row">
              <div class="col-6 col-lg-4 d-md-none d-lg-block">
                <div class="d-flex align-items-center">
                  <?php while (have_rows('country')) : the_row(); ?>
                    <div>
                      <img src="<?php echo get_sub_field("flag"); ?>" class="born-place" alt="<?php echo get_sub_field("alt"); ?>">
                    </div>
                  <?php endwhile; ?>
                  <p class="d-inline-block m-0">
                    <?php while (have_rows('tbp_fighter_profile_datas')) : the_row(); ?>
                      <?php $birthPlace = explode(',', get_sub_field("tbp_fighter_profile_birthplace")); ?>
                      <?php foreach ($birthPlace as $index => $w) : ?>
                        <span class="city <?= $index === 0 ? 'd-block' : 'd-inline-block'; ?>"><?php echo $w; ?><?= $index !== 0 && $index !== count($birthPlace) - 1 ? ', ' : ' '; ?></span>
                      <?php endforeach; //($birthPlace as $place)
                      ?>
                    <?php endwhile; // (have_rows('tbp_fighter_profile_datas')) : the_row(); 
                    ?>
                  </p>
                </div>
              </div>
              <div class="col-6 col-lg-4">
                <span class="meta-label">Born</span>
                <span class="meta-text"><?php echo get_sub_field("birthday"); ?></span>
              </div>
              <div class="col-6 col-lg-4">
                <span class="meta-label">Current Residence</span>
                <span class="meta-text"><?php echo get_sub_field("current_residence"); ?></span>
              </div>
              <div class="col-6 col-lg-4">
                <span class="meta-label">Height</span>
                <?php while (have_rows('tbp_fighter_profile_datas')) : the_row(); ?>
                  <span class="meta-text"><?php echo get_sub_field("tbp_fighter_profile_height"); ?></span>
                <?php endwhile; // (have_rows('tbp_fighter_profile_datas')) : the_row(); ?>
              </div>
              <div class="col-6 col-lg-4">
                <span class="meta-label">Weight</span>
                <span class="meta-text"><?php echo get_sub_field("weight"); ?></span>
              </div>
              <div class="col-6 col-lg-4">
                <span class="meta-label">Amateur Record</span>
                <span class="meta-text"><?php echo get_sub_field("amateur_record"); ?></span>
              </div>
              <div class="col-6 col-lg-4">
                <span class="meta-label">Pro Record</span>
                <span class="meta-text"><?php echo get_sub_field("pro_record"); ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>