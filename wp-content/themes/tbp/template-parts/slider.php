<?php if (get_sub_field('activation_of_slider') === true) : ?>
  <section class="<?php echo TBP_PREFIX; ?>-slider">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card mx-auto">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe src="https://player.vimeo.com/video/<?php echo get_sub_field('video_id'); ?>" width="640" height="360" frameborder="0" allow="autoplay; fullscreen"></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>
