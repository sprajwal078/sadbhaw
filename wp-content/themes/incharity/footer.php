<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package inCharity
 */
$inwave_cfg = Inwave_Main::getConfig();
$inwave_smof_data = Inwave_Main::getConfig('smof');

?>
<?php
get_template_part('footer/footer-' . $inwave_cfg['footer-option']);
?>
</div> <!--end .content-wrapper -->
<?php wp_footer(); ?>
</body>
</html>
