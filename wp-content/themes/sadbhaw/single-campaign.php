<?php
get_header();
?>
<div class="container downloads">
  <!-- Heading Start -->
  <div class="iw-heading   style1  center-text">
    <h3 class="iwh-title" style="font-size:40px"><?php the_title(); ?></h3>
  </div><!-- Heading end -->
  <div class="mt">
    <div class="main-content">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="fb-share-button" data-href="<?php the_permalink() ?>" data-layout="button_count" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>&amp;src=sdkpreparse">Share</a></div>
          </div>
          <div class="col-md-6">
            <div id="countdown">
              <!-- Countdown goes here -->
              <span class="days"></span> days
              <span class="hours"></span> hours
              <span class="minutes"></span> minutes
              <span class="seconds"></span> seconds
            </div>
          </div>
        </div>
        <div class="row">
          <?php if(have_posts()): while (have_posts()):the_post();?>
          <div class="col-sm-12 col-xs-12 col-lg-12 col-md-12 blog-content single-content">
            <article id="post-340" class="post-340 post type-post status-publish format-gallery has-post-thumbnail hentry category-blog-listing-page category-bussiness category-charity-events category-mobile-conference tag-charity tag-conference tag-festival tag-kind post_format-post-format-gallery">
              <div class="post-item fit-video">
                <div class="featured-image">
                  <img src="<?php echo the_post_thumbnail_url();?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""/>
                </div>
                <div class="post-content">
                  <div class="post-content-desc">
<!--                                         <div class="post-text">
                      <p><?php the_content()?><span id="more-340"></span></p>
                    </div> -->
                    <div class="post-info">
                      <div class="post-info-date"><i class="fa fa-location-arrow"></i> Venue : <?php the_field('venue') ?></div>
                      <?php
                        $start_date = date('Y-m-d',strtotime(get_field('start_date')));
                        $end_date = date('Y-m-d',strtotime(get_field('end_date')));
                        $start_time = get_field('start_time');
                        $end_time = get_field('end_date');
                      ?>
                      <div class="post-info-date"><i class="fa fa-calendar"></i> Date : <?php echo $start_date." to ".$end_date; ?></div><div class="post-info-date"><i class="fa fa-clock-o"></i> Time Period : <?php echo $start_time." to ".$end_time; ?></div>
                      <div class="post-info-date"><i class="fa fa-user"></i> Contact Person : <?php the_field('contact_person') ?></div>
                      <div class="post-info-date"><i class="fa fa-phone"></i> Reach Out : <?php the_field('contact_number') ?></div>
                    </div>
                  </div>
                  <div class="clear"></div>
                </div>
              </div>
            </article>
            <div class="post-content-desc">
              <div class="post-text">
                <p><?php the_content()?><span id="more-340"></span></p>
              </div>
            </div>
          </div>
          <?php endwhile;endif;?>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="getting-started"></div>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('#countdown').countdown("<?php echo $start_date.' '.$start_time.':00' ?>", function(event) {
      $(this).find('.days').html(event.strftime('%d'));
      $(this).find('.hours').html(event.strftime('%H'));
      $(this).find('.minutes').html(event.strftime('%M'));
      $(this).find('.seconds').html(event.strftime('%S'));
    });
  });
</script>
<?php
get_footer();?>
