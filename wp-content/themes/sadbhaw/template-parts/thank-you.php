<?php
/*
*Template name: Thank You Sadbhaw
*/
if (isset($_SERVER['HTTP_REFERER']) && isset($_GET['redirect'])){
  get_header();
?>
  <div class="container downloads">
    <div class="wpb_wrapper">
      <div class="vc_row wpb_row vc_inner vc_row-fluid">
        <div class="wpb_column vc_column_container vc_col-sm-12">
          <div class="vc_column-inner vc_custom_1451981561873">
            <div class="wpb_wrapper">
              <div class="iw-heading   style1  center-text">
                <h3 class="iwh-title" style="font-size:40px"><?php the_title(); ?></h3>
                <!-- Message to show on different thank you redirects -->
                <?php if ($_GET['redirect'] == 'pledge'): ?>
                <h4 class="">What's Next?</h4>
                <p class="iwh-content"><?php echo $post->post_content; ?></p>
              <?php elseif($_GET['redirect'] == 'volunteer' || $_GET['redirect'] == 'ambassador' || $_GET['redirect'] == 'partner'): ?>
                <p class="iwh-content">
                  Your details have been saved. We will contact you shortly
                </p>
              <?php elseif($_GET['redirect'] == 'contact'): ?>
                <p class="iwh-content">
                  Your message has been sent.
                </p>
              <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
  get_footer();
}else{
  wp_redirect(site_url());
  die;
}
