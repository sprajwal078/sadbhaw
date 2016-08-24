<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package incharity
 */

global $inwave_cfg, $inwave_smof_data;
//$inwave_cfg = Inwave_Main::getConfig();
//$inwave_smof_data = Inwave_Main::getConfig('smof');

get_template_part('inc/initvars');

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php esc_attr(bloginfo('charset')); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php esc_url(bloginfo('pingback_url')); ?>">
    <?php 
    if ($inwave_cfg['pageheading_bg']) {
        echo '<style>body .page-heading{background-image:url(\'' . esc_url($inwave_cfg['pageheading_bg']) . '\')!important;}</style>';
    }
    ?>
    <?php wp_head(); ?>
</head>
<body id="page-top" <?php body_class(); ?>>
<div class="wrapper <?php if (!$inwave_cfg['slide-id']) echo 'no-slider';?>" <?php if($inwave_cfg['inwave_background_color_page'])  echo 'style="background: '.$inwave_cfg['inwave_background_color_page'].';"';?>>
    <?php
    get_template_part('headers/header-' . $inwave_cfg['header-option']);
    ?>
      <?php if ($inwave_cfg['slide-id']) { ?>
        <div class="slide-container <?php echo esc_attr($inwave_cfg['slide-id'])?>">
            <?php putRevSlider($inwave_cfg['slide-id']); ?>
        </div>
    <?php } ?>
    <?php if ($inwave_cfg['show-pageheading']) { ?>
        <div class="page-heading">
            <div class="container">
                <div class="page-title">
				<?php 
                    if(isset($post->ID)){
                    $terms = get_the_terms($post->ID, 'infunding_category' );
                    }
                    if (is_category()) {
                        // Category
                        echo '<div class="iw-heading-title"><h1>';
                        single_cat_title('');
                        echo '</h1></div>';
                    } elseif (is_single()) {
                        // Single post
                        if(has_category('',$post)){
                            echo '<div  class="iw-heading-title">';
                            $cat = get_the_category();
                            $cat = $cat[0];
                            echo '<h1>' . $cat->name . '</h1>';
                            echo '</div>';
                        }else{
                            echo '<div class="iw-heading-title"><h1>'. $post->post_title . '</h1></div>';
                        }
                    } elseif (is_page()) {
                        // Page
                        if ($post->post_parent) {
                            echo '<div class="iw-heading-title"><h1>' . get_the_title($post->post_parent) . '</h1></div>';
                            echo '<div><span>/</span></div>';
                        }
                        echo '<div class="iw-heading-title"><h1>';
                        echo the_title();
                        echo '</h1></div>';
                    } elseif (is_tag()) {
                        // Tag
                        echo '<div class="iw-heading-title iw-tag"><h1>';
                        single_tag_title();
                        echo '</h1></div>';
                    } elseif (is_day()) {
                        // Archive
                        echo '<div class="iw-heading-title"><h1>'.esc_html__('Archive for ','incharity');
                        the_time('F jS, Y');
                        echo '</h1></div>';
                    } elseif (is_month()) {
                        echo '<div class="iw-heading-title"><h1>'.esc_html__('Archive for ','incharity');
                        the_time('F, Y');
                        echo '</h1></div>';
                    } elseif (is_year()) {
                        echo '<div class="iw-heading-title"><h1>'.esc_html__('Archive for ','incharity');
                        the_time('Y');
                        echo '</h1></div>';
                    } elseif (is_author()) {
                        echo '<div class="iw-heading-title"><h1>'.esc_html__('Author Archive','incharity');
                        echo '</h1></div>';
                    } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
                        echo '<div class="iw-heading-title"><h1>' . esc_html__('Blog Archives', 'incharity');
                        echo '</h1></div>';
                    } elseif (is_search()) {
                        echo '<div class="iw-heading-title"><h1>';
                        printf( esc_html__( 'Search Results for: %s', 'incharity' ), get_search_query() );
                        echo '</h1></div>';
                    }elseif (is_404()){
                        echo '<div class="iw-heading-title"><h1>' . esc_html__('Oops! That page can&rsquo;t be found.', 'incharity');
                        echo '</h1></div>';
                    }elseif (function_exists('is_product_category') && is_product_category()){
                        echo '<div class="iw-heading-title"><h1>';
                        $terms = get_the_terms( $post->ID, 'product_cat' );
                        $term = $terms[0];
                        echo wp_kses_post($term->name) ;
                        echo '</h1></div>';
                    }elseif (function_exists('is_product_tag') && is_product_tag()){
                        echo '<div class="iw-heading-title iw-category-2"><h1>';
                        single_tag_title();
                        echo '</h1></div>';
                    }elseif (function_exists('is_shop') && is_shop()){ 
                        echo '<div class="iw-heading-title"><h1>' . esc_html__('Shop', 'incharity');
                        echo '</h1></div>';
                    }elseif (is_array($terms)){
                        echo '<div class="iw-heading-title"><h1>';
                        $term = $terms[0];
                        echo wp_kses_post($term->name) ;
                        echo '</h1></div>';
                    }else{
						echo '<div class="iw-heading-title iw-category-2"><h1>';
                        single_post_title();
                        echo '</h1></div>';						
					}
                    ?>
                </div>
            </div>
        </div>
    <?php } ?>