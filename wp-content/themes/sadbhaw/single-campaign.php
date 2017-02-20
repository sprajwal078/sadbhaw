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
        <div class="row row flex-row align-stretch">

          <!-- Campaign image -->
          <div class="col-md-8">
            <div class="featured-image">
              <img src="<?php echo the_post_thumbnail_url();?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""/>
            </div>
          </div>

          <!-- Campaign Details -->
          <div class="col-md-4 flex-column">
            <!-- Campaign Details -->
            <div class="col-md-12 flex-fill">
              <div class="form-basic row">
                <div class="form-title">
                  <h2>Campaign Details</h2>
                </div>
                <div class="form-row text-center">
                  <?php if(have_posts()): while (have_posts()):the_post();?>

                    <!-- Venue -->
                    <div class="post-info-date">
                      <i class="fa fa-location-arrow"></i> Venue : <?php the_field('venue') ?>
                   </div>
                   <br>

                    <?php
                      $start_date = date('Y-m-d',strtotime(get_field('start_date')));
                      $end_date = date('Y-m-d',strtotime(get_field('end_date')));
                      $start_time = get_field('start_time');
                      $end_time = get_field('end_date');
                    ?>
                   <!-- Campaign date -->
                   <div class="post-info-date">
                    <i class="fa fa-calendar"></i> Date : <?php echo $start_date." to ".$end_date; ?>
                   </div>
                   <br>

                    <!-- Time Period -->
                    <div class="post-info-date">
                      <i class="fa fa-clock-o"></i> Time Period : <?php echo $start_time." to ".$end_time; ?>
                    </div>
                    <br>
                    <!-- Contact Person -->
                    <div class="post-info-date">
                      <i class="fa fa-user"></i> Contact Person : <?php the_field('contact_person') ?>
                    </div>
                    <br>

                    <!-- Reach Out -->
                    <div class="post-info-date">
                      <i class="fa fa-phone"></i> Reach Out : <?php the_field('contact_number') ?>
                    </div>
                    <br>

                    <div class="fb-share-button" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_the_permalink()); ?>&amp;src=sdkpreparse">Share</a></div>
                  <?php endwhile;endif;?>
                </div>
              </div>

            </div>

            <!-- CountDown -->
            <div class="col-md-12">
              <div id="countdown" class="row">
                <!-- Countdown goes here -->
                <span class="days"></span> days
                <span class="hours"></span> hours
                <span class="minutes"></span> minutes
                <span class="seconds"></span> seconds
              </div>
            </div>

          </div>
        </div>
        <div class="row">

          <div class="col-sm-12 col-xs-12 col-lg-12 col-md-12 blog-content single-content">
            <div class="post-content-desc">
              <div class="post-text">
                <p><?php the_content()?><span id="more-340"></span></p>
              </div>
            </div>
          </div>

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
