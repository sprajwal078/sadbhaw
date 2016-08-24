<?php
/**
 * The template part for displaying social links
 * @package inhost
 */
global $inwave_smof_data;
?>
<ul class="iw-social-all">
    <?php if ($inwave_smof_data['facebook_link']): ?>
        <li class="theme-bg-hover"><a class="iw-social-fb" href="<?php echo esc_url($inwave_smof_data['facebook_link']); ?>" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
    <?php endif; ?>
    <?php if ($inwave_smof_data['twitter_link']): ?>
        <li class="theme-bg-hover"><a class="iw-social-twitter" href="<?php echo esc_url($inwave_smof_data['twitter_link']); ?>" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
    <?php endif; ?>
    <?php if ($inwave_smof_data['linkedin_link']): ?>
        <li class="theme-bg-hover"><a class="iw-social-linkedin" href="<?php echo esc_url($inwave_smof_data['linkedin_link']); ?>" target="_blank" title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
    <?php endif; ?>
    <?php if ($inwave_smof_data['rss_link']): ?>
        <li class="theme-bg-hover"><a class="iw-social-rss" href="<?php echo esc_url($inwave_smof_data['rss_link']); ?>" target="_blank" title="RSS"><i class="fa fa-rss"></i></a></li>
    <?php endif; ?>
    <?php if ($inwave_smof_data['dribbble_link']): ?>
        <li class="theme-bg-hover"><a class="iw-social-dribbble" href="<?php echo esc_url($inwave_smof_data['dribbble_link']); ?>" target="_blank" title="Dribbble"><i class="fa fa-dribbble"></i></a></li>
    <?php endif; ?>
    <?php if ($inwave_smof_data['youtube_link']): ?>
        <li class="theme-bg-hover"><a class="iw-social-youtube" href="<?php echo esc_url($inwave_smof_data['youtube_link']); ?>" target="_blank" title="Youtube"><i class="fa fa-youtube"></i></a></li>
    <?php endif; ?>
    <?php if ($inwave_smof_data['pinterest_link']): ?>
        <li class="theme-bg-hover"><a class="iw-social-pinterest" href="<?php echo esc_url($inwave_smof_data['pinterest_link']); ?>" target="_blank" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
    <?php endif; ?>
    <?php if ($inwave_smof_data['flickr_link']): ?>
        <li class="theme-bg-hover"><a class="iw-social-flickr" href="<?php echo esc_url($inwave_smof_data['flickr_link']); ?>" target="_blank" title="Flickr"><i class="fa fa-flickr"></i></a></li>
    <?php endif; ?>
    <?php if ($inwave_smof_data['vimeo_link']): ?>
        <li class="theme-bg-hover"><a class="iw-social-vimeo" href="<?php echo esc_url($inwave_smof_data['vimeo_link']); ?>" target="_blank" title="Vimeo"><i class="fa fa-vimeo-square"></i></a></li>
    <?php endif; ?>
    <?php if ($inwave_smof_data['tumblr_link']): ?>
        <li class="theme-bg-hover"><a class="iw-social-tumblr" href="<?php echo esc_url($inwave_smof_data['tumblr_link']); ?>" target="_blank" title="Tumblr"><i class="fa fa-tumblr"></i></a></li>
    <?php endif; ?>
    <?php if ($inwave_smof_data['google_link']): ?>
        <li class="theme-bg-hover"><a class="iw-social-google" href="<?php echo esc_url($inwave_smof_data['google_link']); ?>" target="_blank" title="Google+"><i class="fa fa-google-plus"></i></a></li>
    <?php endif; ?>
    <?php if ($inwave_smof_data['weibo_link']): ?>
        <li class="theme-bg-hover"><a class="iw-social-weibo" href="<?php echo esc_url($inwave_smof_data['weibo_link']); ?>" target="_blank" title="Weibo"><i class="fa fa-weibo"></i></a></li>
    <?php endif; ?>
    <?php if ($inwave_smof_data['dropbox_link']): ?>
        <li class="theme-bg-hover"><a class="iw-social-dropbox" href="<?php echo esc_url($inwave_smof_data['dropbox_link']); ?>" target="_blank" title="Dropbox"><i class="fa fa-dropbox"></i></a></li>
    <?php endif; ?>
    <?php if ($inwave_smof_data['skype_link']): ?>
        <li class="theme-bg-hover"><a class="iw-social-skype" href="skype:<?php echo esc_attr($inwave_smof_data['skype_link']); ?>" target="_blank" title="Skype"><i class="fa fa-skype"></i></a></li>
    <?php endif; ?>
    <?php if ($inwave_smof_data['instagram_link']): ?>
        <li class="theme-bg-hover"><a class="iw-social-instagram" href="<?php echo esc_url($inwave_smof_data['instagram_link']); ?>" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li>
    <?php endif; ?>
    <?php if ($inwave_smof_data['email_link']): ?>
        <li class="theme-bg-hover"><a class="iw-social-email" href="mailto:<?php echo esc_attr($inwave_smof_data['email_link']); ?>" target="_blank" title="Email"><i class="fa fa-envelope"></i></a></li>
    <?php endif; ?>
    <?php if ($inwave_smof_data['github_link']): ?>
        <li class="theme-bg-hover"><a class="iw-social-github" href="<?php echo esc_url($inwave_smof_data['github_link']); ?>" target="_blank" title="Github"><i class="fa fa-github"></i></a></li>
    <?php endif; ?>
    <?php if ($inwave_smof_data['appstore_link']): ?>
        <li class="theme-bg-hover"><a class="iw-social-appstore" href="<?php echo esc_url($inwave_smof_data['appstore_link']); ?>" target="_blank" title="Appstore"><i class="fa fa-apple"></i></a></li>
    <?php endif; ?>
    <?php if ($inwave_smof_data['android_link']): ?>
        <li class="theme-bg-hover"><a class="iw-social-android" href="<?php echo esc_url($inwave_smof_data['android_link']); ?>" target="_blank" title="Playstore"><i class="fa fa-android"></i></a></li>
    <?php endif; ?>
</ul>

