<section class="<?php echo TBP_PREFIX; ?>-questions">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="text-center">
          <div class="faq-head">
            <h2 class="title"><?php echo get_sub_field("title"); ?></h2>
            <p class="everything"><?php echo get_sub_field("sub_title"); ?></p>
          </div>
          <div class="accordion" id="accordionQuestions">
            <?php $counter = 1; ?>
            <?php while (have_rows("question")) : the_row(); ?>
              <div class="card">
                <div class="card-header" id="heading-<?php echo $counter; ?>">
                  <h2 class="mb-0 text-left">
                    <button class="d-flex align-items-center justify-content-between btn-link<?php echo ($counter > 1) ? " collapsed" : ""; ?>" type="button" data-toggle="collapse" data-target="#collapse-<?php echo $counter; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $counter; ?>">
                      <span class="text"><?php echo get_sub_field("title"); ?></span>
                      <span class="icon">
                        <div class="wrapper <?php echo ($counter > 1) ? "closed" : "opened"; ?>">
                          <div class="circle">
                            <div class="horizontal"></div>
                            <div class="vertical"></div>
                          </div>
                        </div>
                      </span>
                    </button>
                  </h2>
                </div>
                <div id="collapse-<?php echo $counter; ?>" class="collapse<?php echo ($counter == 1) ? " show" : ""; ?>" aria-labelledby="heading-<?php echo $counter; ?>" data-parent="#accordionQuestions">
                  <div class="card-body">
                    <?php echo get_sub_field("text"); ?>
                  </div>
                </div>
              </div>
              <?php $counter++; ?>
            <?php endwhile; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
