  <?php
  /*
  *Template name: Donate Sadbhaw
  */
  get_header();
  ?>

  <?php include(locate_template('template-parts/slider-part.php')); ?>
  <!--donate form-->
  <div class="container">
   <div class="wpb_wrapper">
    <div class="vc_row wpb_row vc_inner vc_row-fluid">
     <div class="wpb_column vc_column_container vc_col-sm-12">
      <div class="vc_column-inner vc_custom_1451981561873">
       <div class="wpb_wrapper">
        <div class="iw-heading   style1  center-text">
         <h3 class="iwh-title" style="font-size:40px"></h3>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
   <div class="contents-main" id="contents-main">
    <article id="post-1513" class="post-1513 page type-page status-publish hentry">
     <div class="entry-content">
      <div class="container">
       <div class="vc_row wpb_row vc_row-fluid" style="">
        <div class="wpb_column vc_column_container vc_col-sm-12">
         <div class="vc_column-inner ">
          <div class="wpb_wrapper">
           <div class="vc_row wpb_row vc_inner vc_row-fluid">
            <div class="wpb_column vc_column_container vc_col-sm-12">
             <div class="vc_column-inner ">
              <div class="wpb_wrapper">
               <div class="iw-heading  font-normal style1 vc_custom_1453710803887 center-text">
                <h3 class="iwh-title" style="font-size:30px">Donate Us</h3>
               </div>
              </div>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
      <div class="vc_row wpb_row vc_row-fluid volunteer-contact-intro vc_custom_1453711736106" style="margin-left:0;margin-right:0;background-size:100% auto">
       <div class="container">
        <div class="row">
         <div class="wpb_column vc_column_container vc_col-sm-12">
          <div class="vc_column-inner ">
           <div class="wpb_wrapper">
            <div class="vc_row wpb_row vc_inner vc_row-fluid">
             <div class="wpb_column vc_column_container vc_col-sm-12">
              <div class="vc_column-inner ">
               <div class="wpb_wrapper donate_us">
                <div class="iw-testimonial-item  layout3 vc_custom_1453710551682">
                 <div class="content">
                  <div class="iw-testimonial-info">
                   <div class="testi-text">“I encourage you to accept that you may not be able to see a path right now, but that doesn’t mean it’s not there.“</div>
                  </div>
                 </div>
                 <div style="clear: both;"></div>
                </div>
               </div>
              </div>
             </div>
            </div>
            <div class="wpb_text_column wpb_content_element  vc_custom_1453710569576">
             <div class="wpb_wrapper">
              <p><a class="become-volunteer-button" href="#">Fill the form to be come our volunteer <i class="fa fa-arrow-right"></i></a></p>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
      <div class="vc_row wpb_row vc_row-fluid" style="margin-left:0;margin-right:0;background-size:100% auto">
       <div class="container">
        <div class="row">
         <div class="wpb_column vc_column_container vc_col-sm-12">
          <div class="vc_column-inner ">
           <div class="wpb_wrapper">
            <form action="http://inwavethemes.com/wordpress/incharity/infunding-action.php" method="post">
             <input type="hidden" name="action" value="infVolunteerRegister"/>
             <div class="in-volunteer-contact">
              <h3 class="title-contact-form">Contact Information</h3>
              <div class="in-contact-field">
               <label class="label_field">Full Name*</label>
               <div class="input-field">
																<span class="wpcf7-form-control-wrap">
																<input class="" placeholder="Full Name" required="required" type="text" value="" name="contact_info[full_name]"/> </span>
               </div>
              </div>
              <div class="in-contact-field">
               <label class="label_field">Address*</label>
               <div class="input-field">
																<span class="wpcf7-form-control-wrap">
																<input class="" placeholder="Address" required="required" type="text" value="" name="contact_info[address]"/> </span>
               </div>
              </div>
              <div class="in-contact-field">
               <label class="label_field">Email*</label>
               <div class="input-field">
																<span class="wpcf7-form-control-wrap">
																<input class="" placeholder="Email" required="required" type="email" value="" name="contact_info[email]"/> </span>
               </div>
              </div>
              <div class="in-contact-field">
               <label class="label_field">Phone*</label>
               <div class="input-field">
																<span class="wpcf7-form-control-wrap">
																<input class="" placeholder="Phone" required="required" type="text" value="" name="contact_info[phone]"/> </span>
               </div>
              </div>
              <h3 class="title-contact-form">Volunteer Information</h3>
              <div class="in-contact-field">
               <label class="label_field">Campaign *</label>
               <div class="input-field">
																<span class="wpcf7-form-control-wrap">
																	<select name="volunteer_info[campaign]" required>
																		<option value="">Select Campaign</option>
																		<option value="1825">DJ EZ 24 Hour DJ Set in aid of Cancer Research UK</option>
																		<option value="439">Gone to Ghana in Africa</option>
																	</select>
																</span>
               </div>
              </div>
              <div class="datetimepicker-group">
               <div class="in-contact-field">
                <label class="label_field">Date Start *</label>
                <div class="input-field">
																	<span class="wpcf7-form-control-wrap">
																	<input required="required" type="text" name="volunteer_info[date_start]" value="" placeholder="Date Start" class="datetimepicker-input start" data-configs="{&quot;mask&quot;:&quot;__\/__\/____&quot;,&quot;timepicker&quot;:false,&quot;format&quot;:&quot;m\/d\/Y&quot;}">
																	</span>
                </div>
               </div>
               <div class="in-contact-field">
                <label class="label_field">Date End *</label>
                <div class="input-field">
                 <input required="required" type="text" name="volunteer_info[date_end]" value="" placeholder="Date End" class="datetimepicker-input end" data-configs="{&quot;mask&quot;:&quot;__\/__\/____&quot;,&quot;timepicker&quot;:false,&quot;format&quot;:&quot;m\/d\/Y&quot;}">
                </div>
               </div>
              </div>
              <div class="in-contact-field">
               <label class="label_field">Your Message</label>
               <div class="input-field"><span class="wpcf7-form-control-wrap your-message"><textarea name="volunteer_info[message]" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false"></textarea></span> </div>
              </div>
              <div class="in-contact-field in-submit-field">
               <div class="in-submit-field-inner"><input type="submit" value="Submit Volunteer Form" class="wpcf7-form-control wpcf7-submit"/><i class="fa fa-arrow-right"></i></div>
              </div>
             </div>
            </form>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
    </article>
   </div>
   </div>
  <style>
   .donate_us{
    height:200px;
   }
  </style>
  <?php get_footer()?>
  