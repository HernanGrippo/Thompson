<section class="<?php echo TBP_PREFIX; ?>-ask">
  <form class="" id="<?php echo TBP_PREFIX; ?>-form-<?php echo get_sub_field('contact_form_id')[0]; ?>">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="form-box bg-white">
            <div class="container">
              <div class="row">
                <div class="col-12">
                  <div class="top">
                    <h2 class="title"><?php echo get_sub_field('title'); ?></h2>
                    <p class="text-center"><?php echo get_sub_field('title'); ?></p>
                  </div>
                </div>
                <div class="col-12 col-lg-6">
                  <div class="control input-control">
                    <input type="text" name="firstname" id="firstname" required />
                    <div class="floating-label"><?php echo get_sub_field('first_name_label'); ?></div>
                  </div>
                </div>
                <div class="col-12 col-lg-6">
                  <div class="control input-control">
                    <input type="text" name="lastname" id="lastname" required />
                    <div class="floating-label"><?php echo get_sub_field('last_name_label'); ?></div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="control input-control">
                    <input type="email" name="email" id="email" required />
                    <div class="floating-label"><?php echo get_sub_field('email_label'); ?></div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="control textarea-control">
                    <textarea class="textarea" name="message" id="message" required></textarea>
                    <div class="floating-label"><?php echo get_sub_field('message_label'); ?></div>
                  </div>
                </div>
                <div class="col-12">
                  <button type="submit"><?php echo get_sub_field('submit_button_label'); ?></button>
                </div>
								<div class="message col-12 text-center" style="display: none;">
								</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>
