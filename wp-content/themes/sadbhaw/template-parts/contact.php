  <?php
  /*
  *Template name: Contact Sadbhaw
  */
  get_header(); ?>

  <div class="page-heading">
   <div class="container">
    <div class="page-title">
     <div class="iw-heading-title"><h1>Contact Us</h1></div> </div>
   </div>
  </div>
  <div class="container">
      <div class="vc_row wpb_row vc_row-fluid iw-map vc_custom_1445586865423" style="margin-left:0;margin-right:0;background-size:100% auto">
          <div class="wpb_column vc_column_container vc_col-sm-12">
              <div class="vc_column-inner vc_custom_1471336175417">
                  <div class="wpb_wrapper">
                      <div class="contact-map ">
                          <div class="map-contain" data-title="inwavethemes" data-image="http://inwavethemes.com/wordpress/incharity/wp-content/uploads/2015/10/map-maker.png" data-lat="40.6700" data-long="-73.9400" data-zoom="11" data-info="">
                              <div class="map-view map-frame" style="height:610px"></div>
                          </div>
                      </div>
                      <div class="wpb_text_column wpb_content_element  map-info">
                          <div class="wpb_wrapper">
                              <div class="contact-map-info">
                                  <div class="contact-map-image"><img src="../wp-content/uploads/2015/10/xmap-maker-image.jpg.pagespeed.ic.GUdTn8XflP.jpg" alt="map-maker-image"/></div>
                                  <div class="contact-info-detail">
                                      <div class="title">Heading office</div>
                                      <div class="desc">Lorem ipsum dolor sit amet, consectetur adipi scing elit suspendisse in.</div>
                                      <div class="contact-details">
                                          <div class="detail-add"><i class="fa fa-map-marker theme-color"></i> #302 Rainbow Building, Van Quan, Ha Noi, Viet nam</div>
                                          <div class="detail-email"><i class="fa fa-envelope-o theme-color"></i> support@inwavethemes.com</div>
                                          <div class="detail-phone"><i class="fa fa-phone theme-color"></i> 084 1234 56789</div>
                                          <div class="detail-website"><i class="fa fa-globe theme-color"></i> http://inwavethemes.com</div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div id="contact-form" class="vc_row wpb_row vc_row-fluid vc_custom_1457075974857 vc_row-has-fill" style="margin-left:0;margin-right:0;background-size:100% auto">
          <div class="container">
              <div class="row">
                  <div class="wpb_column vc_column_container vc_col-sm-12">
                      <div class="vc_column-inner ">
                          <div class="wpb_wrapper">
                              <div class="iw-contact iw-contact-us  default">
                                  <div class="ajax-overlay">
                                      <span class="ajax-loading"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
                                  </div>
                                  <div class="headding-bottom"></div>
                                  <form method="post" name="contact-form">
                                      <div class="title_contact_form"> Leave A Message</div>
                                      <div class="row">
                                          <div class="form-group col-md-4 col-md-6 col-xs-12">
                                              <input type="text" placeholder="First Name" required="required" class="control" name="name">
                                          </div>
                                          <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                              <input type="email" placeholder="Email Address" required="required" class="control" name="email">
                                          </div>
                                          <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                              <input type="text" placeholder="Your Website" class="control" name="website">
                                          </div>
                                          <div class="form-group col-xs-12">
                                              <textarea placeholder="Write message" rows="8" class="control" required="required" id="message" name="message"></textarea>
                                          </div>
                                          <div class="form-group form-submit col-xs-12">
                                              <input name="action" type="hidden" value="sendMessageContact">
                                              <input name="mailto" type="hidden" value="">
                                              <div class="">
                                                  <button class="btn-submit theme-bg" name="submit" type="submit">SEND MESSAGE</button>
                                              </div>
                                          </div>
                                          <div class="form-group col-md-12 form-message"></div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <?php
  get_footer();?>
  