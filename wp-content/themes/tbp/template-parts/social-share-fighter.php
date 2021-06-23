<?php while (have_rows('tbp_social_share_options', 'home_options')) : the_row(); ?>
  <div class="d-block d-md-none">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="single-social-share-fighter">
            <div class="d-flex justify-content-between">
              <?php while (have_rows('tbp_social_medias', 'home_options')) : the_row(); ?>
                <div class="clearfix">
                  <a
                    class="d-block"
                    href="#"
                    data-toggle="popover"
                    title="<?php echo get_sub_field('title', 'home_options'); ?>"
                    id="<?php echo get_sub_field('id', 'home_options'); ?>"
                    target="_blank">
                      <img
                        src="<?php echo get_sub_field('icon', 'home_options'); ?>"
                        class="social"
                        alt="<?php echo get_sub_field('title', 'home_options'); ?>">
                  </a>
                </div>
              <?php endwhile; ?>
              <div>
                <svg width="60" height="14" viewBox="0 0 60 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M7.76 2.6C7.12 1.416 5.984 0.728 4.64 0.728C2.848 0.728 1.264 1.928 1.264 3.8C1.264 5.528 2.48 6.248 3.888 6.888L4.624 7.208C5.744 7.72 6.848 8.2 6.848 9.608C6.848 10.968 5.664 11.96 4.368 11.96C3.072 11.96 2.128 10.952 1.952 9.72L0.64 10.088C1.024 11.96 2.464 13.208 4.4 13.208C6.496 13.208 8.192 11.592 8.192 9.48C8.192 7.56 6.864 6.776 5.296 6.088L4.496 5.736C3.68 5.368 2.608 4.888 2.608 3.848C2.608 2.744 3.536 1.976 4.608 1.976C5.632 1.976 6.208 2.456 6.688 3.288L7.76 2.6ZM14.4415 5.832V0.936H13.0975V13H14.4415V7.08H20.6175V13H21.9615V0.936H20.6175V5.832H14.4415ZM34.2954 9.576L35.7194 13H37.2074L31.7834 0.36L26.2154 13H27.6874L29.1434 9.576H34.2954ZM33.7674 8.328H29.6874L31.7514 3.496L33.7674 8.328ZM42.7469 2.184H43.1469C44.7629 2.184 46.2189 2.376 46.2189 4.36C46.2189 6.232 44.6829 6.52 43.1629 6.52H42.7469V2.184ZM42.7469 7.704H43.0829L46.7309 13H48.3789L44.5389 7.592C46.3949 7.432 47.5629 6.12 47.5629 4.264C47.5629 1.544 45.4349 0.936 43.1469 0.936H41.4029V13H42.7469V7.704ZM52.9548 13H59.2108V11.752H54.2988V7.016H59.0668V5.768H54.2988V2.184H59.2108V0.936H52.9548V13Z" fill="#707174"/>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endwhile; ?>
