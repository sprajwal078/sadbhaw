<?php
get_header();
?>
<?php if(have_posts()): while (have_posts()):the_post();?>
<div class="container story-single mb">
	<div class="downloads mt">
		<div class="main-content">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-xs-12 col-md-9 blog-content single-content">
						<div class="fb-share-button" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_the_permalink()); ?>&amp;src=sdkpreparse">Share</a></div>
						<article id="post-340" class="post-340 post type-post status-publish format-gallery has-post-thumbnail hentry category-blog-listing-page category-bussiness category-charity-events category-mobile-conference tag-charity tag-conference tag-festival tag-kind post_format-post-format-gallery">
							<div class="post-item fit-video">
								<div class="post-content">
									<div class="post-content-head">
										<div class="post-head-detail">
											<h3 class="post-title">
												<?php the_title();?>
											</h3>
										</div>
									</div>
									<div class="post-content-desc">
										<div class="post-text">
											<?php $image = get_field('image'); ?>
											<img src="<?php echo $image['url']?>" alt="" class="pull-left"/>
											<p class="text-justify"><?php the_content()?><span id="more-340"></span></p>
										</div>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</article>
					</div>
					<div class="col-md-3 col-sm-12 col-xs-12">
					  <h3>Other Storires</h3>
						<aside class="other-stories">
						  <?php
						    $other = generate_query(['post_type' => 'story',
					    													'posts_per_page' => 10,
					    													'post__not_in' => [get_the_ID()] ]);
						    while ($other->have_posts()):
						    	$other->the_post();
						  ?>
							<div class="story-container">
								<figure class="text-center">
									<a href="<?php the_permalink(); ?>"><img src="<?php echo get_field('image')['url'] ?>" alt="<?php echo get_field('image')['alt'] ?>"></a>
									<figcaption><?php the_title(); ?></figcaption>
								</figure>
							</div>
						<?php endwhile;wp_reset_postdata(); ?>
						</aside>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endwhile;endif;?>
<?php
get_footer();?>
