<?php
/*
*Template name: Home Sadbhaw
*/
get_header();
?>
<?php
 include(locate_template('template-parts/slider-part.php')); ?>
 <div class="contents-main home-content" id="contents-main">
	<article id="post-725" class="post-725 page type-page status-publish hentry">
	 <div class="entry-content">
		<div class="vc_row wpb_row vc_row-fluid theme-bg vc_custom_1454496271895 vc_row-has-fill our-goals" style="margin-left:0;margin-right:0;background-size:100% auto">
		 <div class="container">
			<div class="row">
			 <div class="wpb_column vc_column_container vc_col-sm-2">
				<div class="vc_column-inner ">
				 <div class="wpb_wrapper"></div>
				</div>
			 </div>
			 <div class="wpb_column vc_column_container vc_col-sm-8">
				<div class="vc_column-inner ">
				 <div class="wpb_wrapper">
					<div class="iw-heading   style4  center-text">
					 <h3 class="iwh-title" style="font-size:40px">Our Goal</h3>
					 <div class="iwh-sub-title"><?php the_field('our_goals')?></div>
					</div>
				 </div>
				</div>
			 </div>
			</div>
		 </div>
		</div>
		<!--get the stories post 2 for now -->
		<?php $stories = generate_query(
				array(
						'post_type' => 'story',
						'posts_per_page'	=> -1,
						'orderby'   => 'menu_order',
						'order' => 'ASC')
		);?>
		<div class="container ">
		 <div class="row">
			<div class="col-md-6 col-sm-3 footer-left stories">
				<div class="center-text">
					<h3 class="iwh-title" style="font-size:40px">Stories</h3>
				</div>
				<div class="slide-wrap row">
						<div class ="slide-item">
					 <?php if( $stories->have_posts() ) :
					 while ( $stories->have_posts() ) : $stories->the_post();
						$image = get_field('image');
					 if($stories->current_post % 3 == 0 && $stories->current_post != 0){?>
							 </div>
						<div class ="slide-item" style="display: none">
					 <?php }
					 ?>
						<div class="">
							<div class="media">
								<div class="media-body">
									<h3 class="media-heading"><?php the_title()?></h3>
									<?php $content = get_the_content(); echo wp_trim_words( $content, 25, '... ' );?>
										<a class="read-more" href="<?php the_permalink()?>">read more</a>
								</div>
								<div class="media-right hidden">
									<a href="#">
										<img alt="64x64" class="media-object" data-src="holder.js/64x64" src="<?php echo $image['url']?>" data-holder-rendered="true" width="100%">
									</a>
								</div>
							</div>
						</div>
						<?php endwhile;wp_reset_postdata();endif;?>
						</div>
				</div>

			</div>
			<div class="col-md-6 col-sm-6 footer-right social-tabs">
				<div class="center-text">
					<h3 class="iwh-title" style="font-size:40px">Social Feeds</h3>
				</div>
				<!-- nav tabs -->
					<ul class="nav nav-tabs nav-justified" role="tablist">
						<li role="presentation" class="active">
							<a href="#youtube" aria-controls="youtube" role="tab" data-toggle="tab">
								<i class="fa fa-youtube"></i>
							</a>
						</li>
						<li role="presentation">
							<a href="#facebook" aria-controls="facebook" role="tab" data-toggle="tab">
								<i class="fa fa-facebook-official"></i>
							</a>
						</li>
						<li role="presentation">
							<a href="#twitter" aria-controls="twitter" role="tab" data-toggle="tab">
								<i class="fa fa-twitter"></i>
							</a>
						</li>
					</ul>

				<!-- Tab panes -->
					<div class="col-md-12">
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="youtube"><?php the_field('youtube')?></div>
							<div role="tabpanel" class="tab-pane" id="facebook">
								<div class="fb-page" data-href="https://www.facebook.com/sadbhawscholarships/" data-tabs="timeline" data-width="600" data-height="350" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/sadbhawscholarships/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/sadbhawscholarships/">Sadbhaw Scholarships- Nepali Le Nepali Laai</a></blockquote></div>
							</div>
							<div role="tabpanel" class="tab-pane" id="twitter">
								<a class="twitter-timeline" data-width="600" data-height="350" href="https://twitter.com/AngularJS_News">Tweets by AngularJS News</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
							</div>
						</div>
					</div>

			</div>
		 </div>
		</div>
		<div class="vc_row wpb_row vc_row-fluid vc_custom_1451359398429 our-impacts rollup" style="margin-left:0;margin-right:0;background-size:100% auto;">
		 <div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
				 <div class="vc_row wpb_row vc_inner vc_row-fluid">
						<div class="center-text"><h3 class="iwh-title" style="font-size:40px">Our Impact</h3></div>
						<?php if( have_rows('our_impact') ):
						while ( have_rows('our_impact') ) : the_row();$image = get_sub_field('image');?>
						<div class="wpb_column vc_column_container vc_col-sm-3">
						 <div class="vc_column-inner ">
							<div class="wpb_wrapper">
							 <div class="profile-box item item0  style4  center-text">
								<div class="profile-image"><img src="<?php echo $image['url']?>" alt="sarah stone"></div>
								<div class="item-info-wrap profile-info-wrap">
								 <div class="profile-info">
									<h3 class="name Count"><?php the_sub_field('title')?></h3>
									<div class="position"></div>
									<div class="description"><?php the_sub_field('text')?></div>
								 </div>
								</div>
							 </div>
							</div>
						 </div>
						</div>
						<?php endwhile;endif;?>
				 </div>

				</div>
			</div>
		 </div>
		</div>

		 <div class="vc_row wpb_row vc_row-fluid vc_custom_1469676508172 vc_row-has-fill leaders-profile" style="background:none!important;position:relative;margin-left:0;margin-right:0;background-size:100% auto">
			<div class="container">
				<div class="row">
						<div class="wpb_column vc_column_container vc_col-sm-12">
								 <div class="center-text"><h3 class="iwh-title" style="font-size:40px">Sadbhaw Ambassadors</h3></div>
								 <div class="col-md-10 col-md-offset-1 profile-wrap">
										 <div class="row">
												 <?php
												 $leaders = generate_query(
														 array(
																 'post_type' => 'leader',
																 'posts_per_page'	=> -1,
																 'orderby'   => 'menu_order',
																 'order' => 'ASC')
												 );?>
												 <!-- item1 -->
												 <?php if( $leaders->have_posts() ) :
														 while ( $leaders->have_posts() ) : $leaders->the_post();
																 the_sub_field('location');
																 ?>
																 <div class="col-md-6 profile-item">
																		 <figure>
																				 <img src="<?php the_post_thumbnail_url()?>" alt="img">
																		 </figure>
																		 <div class="detail">
																				 <h3>
																						<?php the_title(); ?>
																						<small>Location: <?php the_field('location');?></small>
																				 </h3>
																				 <p>
																						 <?php $content = get_the_content(); echo wp_trim_words( $content, 35, '...' );?>
																						 <!-- Trigger the leader detail modal with read more link -->
																						 <a href="#" class="leader-readmore read-more" data-toggle="modal" data-target="#leader<?php the_ID(); ?>"> read more</a>
																						 <!-- Modal -->
																							<div id="leader<?php the_ID(); ?>" class="modal fade" role="dialog">
																								<div class="modal-dialog">
																									<!-- Modal content-->
																									<div class="modal-content">
																										<div class="modal-header">
																											<button type="button" class="close" data-dismiss="modal">&times;</button>
																											<h4 class="modal-title">
																												<strong><?php the_title() ?></strong>
																												<br>
																												<small>Location: <?php the_field('location');?></small>
																											</h4>
																										</div>
																										<div class="modal-body">
																											<img align="top" src="<?php the_post_thumbnail_url()?>" alt="img" class="media-object">
																											<p><?php echo $content; ?></p>
																											<div class="social-links"> 
																												<?php if (!empty(get_field('facebook_link'))): ?>
																												<a href="<?php the_field('facebook_link'); ?>"><i class="fa fa-facebook-official"></i></a>
																												<?php endif; ?>
																												<?php if (!empty(get_field('facebook_link'))): ?>
																												<a href="<?php the_field('twitter_link'); ?>"><i class="fa fa-twitter"></i></a>
																												<?php endif; ?>
																												<?php if (!empty(get_field('facebook_link'))): ?>
																												<a href="<?php the_field('google_plus_link'); ?>"><i class="fa fa-google-plus-official"></i></a>
																												<?php endif; ?>
																											</div>
																											<div class="clearfix"></div>
																										</div>
																										<div class="modal-footer">
																											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																										</div>
																									</div>
																								</div>
																							</div><!-- Modal Ends -->
																				 </p>
																		 </div>
																 </div>
														 <?php endwhile;wp_reset_postdata();endif;?>
										 </div>
										 <p class="text-center be-ambassador">
												<span>Want to be an Ambassador ?</span>
												<a href="<?php echo site_url().'/get-engaged/#become-ambassador'?>" class="get-engaged">Get Engaged</a>
										 </p>

								 </div>
						</div>
				</div>
			</div>
		 </div>

		<!-- leaders profile -->
			 <div class="vc_row wpb_row vc_row-fluid vc_custom_1451359398429" style="margin-left:0;margin-right:0;background-size:100% auto;">
					 <div class="vc_row wpb_row vc_inner vc_row-fluid">
							<a href="<?php the_field('donate_link') ?>"><img class="fill" src="<?php the_field('donate_image') ?>"/></a>
					 </div>
			 </div>

			 <!-- an initiation -->
			 <div class="container mb">
					 <div class="row">
								<br>
							 <div class="col-md-10 col-md-offset-1 text-center">
								<h4><?php the_field('footer_text') ?></h4>
								<br>
								<a href="http://himalayanclimate.org/" targer="_blank">
									<?php $himal_image = get_field('footer_image'); ?>
									<img src="<?php echo $himal_image['url']; ?>" alt="<?php echo $himal_image['alt']; ?>">
								</a>
							 </div>
					 </div>
			 </div>
	 </div>
	</article>
 </div>
<?php get_footer()?>
