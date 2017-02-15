<?php
/**
 * Template Name: Payment Success/Failure Redirect Page
 */
if (isset($_GET['response'])):
	get_header();
	?>
	<div class="container downloads">
	  <div class="wpb_wrapper">
	    <div class="vc_row wpb_row vc_inner vc_row-fluid">
	      <div class="wpb_column vc_column_container vc_col-sm-12">
	        <div class="vc_column-inner vc_custom_1451981561873">
	          <div class="wpb_wrapper">
	            <div class="iw-heading style1 center-text">
	            <?php if ($_GET['response'] == 'success'): ?>
	              <h3 class="iwh-title" style="font-size:40px">Thank you</h3>
	              <h4 class="alert alert-success">
	              	Donation Recieved
	              </h4>
	              <p class="iwh-content">
<!-- 	              <form action = "http://dev.esewa.com.np/epay/transrec" method="POST">
									<input type="hidden" name="refid" value="abde5222-cd16-4958-95cc-d32af125e1c8" />
									<input value="<?php echo $_GET['amt'] ?>" type="hidden" name="amt">
									<input value="<?php echo $_GET['oid'] ?>" type="hidden" name="oid">
									<input value="Verify" type="submit">
									</form> -->
	              	<!-- Content can be added here -->
	              </p>
	            <?php elseif ($_GET['response'] == 'failed'): ?>
	            	<h3 class="iwh-title" style="font-size:40px">Donation Failed</h3>
	              <h4 class="alert alert-warning">
	              	Something went wrong. Please try again
	              </h4>
	              <p class="iwh-content">
	              	<!-- Content can be added here -->
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
else:
	wp_redirect(site_url());
	die;
endif;