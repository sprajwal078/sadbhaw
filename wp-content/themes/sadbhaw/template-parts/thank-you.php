<?php
/*
*Template name: Thank You Sadbhaw
*/
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
              <h4 class="text-left">What's Next?</h4>
              <p class="iwh-content"><?php echo $post->post_content; ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
get_footer();
