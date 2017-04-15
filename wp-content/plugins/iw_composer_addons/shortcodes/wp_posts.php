<?php
/*
 * @package Inwave Athlete
 * @version 1.0.0
 * @created Mar 27, 2015
 * @author Inwavethemes
 * @email inwavethemes@gmail.com
 * @website http://inwavethemes.com
 * @support Ticket https://inwave.ticksy.com/
 * @copyright Copyright (c) 2015 Inwavethemes. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *
 */

/**
 * Description of wp_posts
 *
 * @Developer duongca
 */
if (!class_exists('Inwave_WP_Posts')) {

    class Inwave_WP_Posts {

        private $params;

        function __construct() {
            $this->initParams();
            add_action('vc_before_init', array($this, 'heading_init'));
            add_shortcode('inwave_wp_posts', array($this, 'inwave_wp_posts_shortcode'));
        }

        function initParams() {
            global $iw_shortcodes;
            $_categories = get_categories();
            $cats = array(__("All", "inwavethemes") => '');
            foreach ($_categories as $cat) {
                $cats[$cat->name] = $cat->term_id;
            }
            $this->params = array(
                'name' => 'WP Posts',
                'description' => __('Display a list of posts ', 'inwavethemes'),
                'base' => 'inwave_wp_posts',
                'icon' => 'iw-default',
                'category' => 'Custom',
                'params' => array(
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "heading" => __("Title", "inwavethemes"),
                        "value" => "",
                        "param_name" => "title",
                        "description" => __('Title of wp_posts block.', "inwavethemes")
                    ),
                    array(
                        'type' => 'textfield',
                        "heading" => __("Post Ids", "inwavethemes"),
                        "value" => "",
                        "param_name" => "post_ids",
                        "description" => __('Id of posts you want to get. Separated by commas.', "inwavethemes")
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Post Category", "inwavethemes"),
                        "param_name" => "category",
                        "value" => $cats,
                        "description" => __('Category to get posts.', "inwavethemes")
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Post number", "inwavethemes"),
                        "param_name" => "post_number",
                        "value" => "3",
                        "description" => __('Number of posts to display on box.', "inwavethemes")
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Order By", "inwavethemes"),
                        "param_name" => "order_by",
                        "value" => array(
                            'ID' => 'ID',
                            'Title' => 'title',
                            'Date' => 'date',
                            'Modified' => 'modified',
                            'Ordering' => 'menu_order',
                            'Random' => 'rand'
                        ),
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => __("Order Type", "inwavethemes"),
                        "param_name" => "order_type",
                        "value" => array(
                            'ASC' => 'ASC',
                            'DESC' => 'DESC'
                        ),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Excerpt Word Limit", "inwavethemes"),
                        "param_name" => "excerpt_limit",
                        "value" => "30"
                    ),
                    array(
                        'type' => 'textfield',
                        "holder" => "div",
                        "heading" => __("Read More Text", "inwavethemes"),
                        "value" => "more",
                        "param_name" => "read_more_text"
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Extra Class", "inwavethemes"),
                        "param_name" => "class",
                        "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', "inwavethemes")
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Style",
                        "heading" => __("Style", "inwavethemes"),
                        "param_name" => "layout",
                        "value" => array(
                            'Style 1' => 'style1',
                            'Style 2' => 'style2',
                            'Style 3' => 'style3'
                        )
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Style",
                        "heading" => __("Show date", "inwavethemes"),
                        "param_name" => "show_date",
                        "value" => array(
                            'Yes' => '1',
                            'No' => '0'
                        )
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Style",
                        "heading" => __("Show category", "inwavethemes"),
                        "param_name" => "show_category",
                        "value" => array(
                            'Yes' => '1',
                            'No' => '0'
                        )
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Style",
                        "heading" => __("Show Author", "inwavethemes"),
                        "param_name" => "show_author",
                        "value" => array(
                            'Yes' => '1',
                            'No' => '0'
                        )
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Style",
                        "heading" => __("Show thumbnail", "inwavethemes"),
                        "param_name" => "show_thumbnail",
                        "value" => array(
                            'Yes' => '1',
                            'No' => '0'
                        )
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Style",
                        "heading" => __("Show description", "inwavethemes"),
                        "param_name" => "show_desc",
                        "value" => array(
                            'Yes' => '1',
                            'No' => '0'
                        )
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Style",
                        "heading" => __("Show comment count", "inwavethemes"),
                        "param_name" => "show_comment_count",
                        "value" => array(
                            'Yes' => '1',
                            'No' => '0'
                        )
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Style",
                        "heading" => __("Show like counter", "inwavethemes"),
                        "param_name" => "show_view_count",
                        "value" => array(
                            'Yes' => '1',
                            'No' => '0'
                        )
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Style",
                        "heading" => __("Show facebook share", "inwavethemes"),
                        "param_name" => "show_fb_share",
                        "value" => array(
                            'Yes' => '1',
                            'No' => '0'
                        )
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Style",
                        "heading" => __("Show read-more", "inwavethemes"),
                        "param_name" => "show_readmore",
                        "value" => array(
                            'Yes' => '1',
                            'No' => '0'
                        )
                    ),
                    array(
                        "type" => "dropdown",
                        "group" => "Style",
                        "heading" => __("Show post type icon", "inwavethemes"),
                        "param_name" => "show_posttype_icon",
                        "value" => array(
                            'Yes' => '1',
                            'No' => '0'
                        )
                    ),
                    array(
                        "type" => "textfield",
                        "group" => "Style",
                        "heading" => __("Columns Desktop", "inwavethemes"),
                        "description" => __("Number of columns on Desktop devices", "inwavethemes"),
                        "param_name" => "items_desktop",
                        "value" => '4'
                    ),
                    array(
                        "type" => "textfield",
                        "group" => "Style",
                        "heading" => __("Columns Small Desktop", "inwavethemes"),
                        "description" => __("Number of columns on Small Desktop devices", "inwavethemes"),
                        "param_name" => "items_desktopsmall",
                        "value" => '3'
                    ),
                    array(
                        "type" => "textfield",
                        "group" => "Style",
                        "heading" => __("Columns Tablet", "inwavethemes"),
                        "description" => __("Number of columns on Tablet devices", "inwavethemes"),
                        "param_name" => "items_tablet",
                        "value" => '2'
                    ),
                    array(
                        "type" => "textfield",
                        "group" => "Style",
                        "heading" => __("Columns Mobile", "inwavethemes"),
                        "description" => __("Number of columns on Mobile Desktop devices", "inwavethemes"),
                        "param_name" => "items_mobile",
                        "value" => '1'
                    ),
                )
            );
            $iw_shortcodes['inwave_wp_posts'] = $this->params;
        }

        function heading_init() {
            if (function_exists('vc_map')) {
                // Add banner addon
                vc_map($this->params);
            }
        }

        // Shortcode handler function for list Icon
        function inwave_wp_posts_shortcode($atts, $content = null) {
            global $authordata;
            $output = $title = $post_ids = $category = $items_desktop = $items_desktopsmall = $items_tablet = $items_mobile = $excerpt_limit = $post_number = $order_by = $order_type = $layout = $show_date = $show_category = $show_author = $show_thumbnail = $show_desc = $show_comment_count = $show_view_count = $show_fb_share = $show_readmore = $show_posttype_icon = $read_more_text = $class = '';
            extract(shortcode_atts(array(
                'title' => '',
                'post_ids' => '',
                'category' => '',
                'show_author' => '1',
                'items_desktop' => 4,
                'items_desktopsmall' => 3,
                'items_tablet' => 2,
                'items_mobile' => 1,
                'excerpt_limit' => 15,
                'post_number' => 3,
                'order_by' => 'ID',
                'order_type' => 'DESC',
                'layout' => 'style1',
                'show_date' => '1',
                'show_category' => '1',
                'show_thumbnail' => '1',
                'show_desc' => '1',
                'show_comment_count' => '1',
                'show_view_count' => '1',
                'show_fb_share' => '1',
                'show_readmore' => '1',
                'show_posttype_icon' => '1',
                'read_more_text' => 'more',
                'class' => ''
                            ), $atts));

            $args = array();
            if ($post_ids) {
                $args['post__in'] = explode(',', $post_ids);
            } else {
                if ($category) {
                    $args['category__in'] = $category;
                }
            }
            $args['posts_per_page'] = $post_number;
            $args['order'] = $order_type;
            $args['orderby'] = $order_by;
            $query = new WP_Query($args);
            $class .= ' ' . $layout;
            ob_start();
            switch ($layout) {
                case 'style1':
                case 'style2':
                    $sliderConfig = '{';
                    $sliderConfig .= '"navigation":false';
                    $sliderConfig .= ',"autoPlay":false';
                    $sliderConfig .= ',"items":' . $items_desktop;
                    $sliderConfig .= ',"itemsDesktop":[1199,' . $items_desktop . ']';
                    $sliderConfig .= ',"itemsDesktopSmall":[979,' . $items_desktopsmall . ']';
                    $sliderConfig .= ',"itemsTablet":[768,' . $items_tablet . ']';
                    $sliderConfig .= ',"itemsMobile":[479,' . $items_mobile . ']';
                    $sliderConfig .= '}';
                    ?>
                    <div class="row">
                        <div class="iw-posts owl-carousel <?php echo $class ?>"
                             data-plugin-options='<?php echo $sliderConfig ?>'>
                    <?php
                    while ($query->have_posts()) : $query->the_post();
                        ?>
                                <div class="iw-posts-item">
                        <?php if ($show_thumbnail): ?>
                                        <div class="iw-posts-thumb featured-image fit-video">
                                         <?php
                                         $post_format = get_post_format();

                                         if ($show_posttype_icon) :
                                             ?>
                                                <div
                                                    class="iw-posts-icon <?php echo $layout == 'style2' ? 'theme-bg' : '' ?>">
                                                <?php
                                                $post_format = get_post_format();
                                                switch ($post_format) {
                                                    case 'gallery':
                                                        ?>
                                                            <i class="fa fa-picture-o"></i>
                                                                <?php
                                                                break;
                                                            case 'video':
                                                                ?>
                                                            <i class="fa fa-play-circle"></i>
                                                            <?php
                                                            break;
                                                        default:
                                                            ?>
                                                            <i class="fa fa-camera"></i>
                                                            <?php
                                                            break;
                                                    }
                                                    ?>
                                                </div>
                                                <?php endif ?>
                                                <?php
                                                $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail');
                                                if (count($img) && $img[0]) {
                                                    ?>
                                                <a href="<?php echo get_permalink() ?>"><img
                                                        src="<?php echo $img[0]; ?>"
                                                        alt=""></a>
                                                <?php
                                            } else {
                                                ?>
                                <?php
                                $contents = get_the_content();
                                switch ($post_format) {
                                    case 'video':
                                        $video = inwave_getElementByTags('embed', $contents);
                                        if ($video) {
                                            echo apply_filters('the_content', $video[0]);
                                        }
                                        break;
                                    case 'gallery':
                                        $gallery = inwave_getElementByTags('gallery', $contents, 2);
                                        if ($gallery) {
                                            echo apply_filters('the_content', $gallery[0]);
                                        }
                                        break;
                                }
                            }
                            ?>
                                            <div class="date-category">
                                                <?php if ($show_date): ?>
                                                    <div class="iw-date">
                                                        <i class="fa fa-calendar-o"></i>
                                                    <?php printf(__('%s'), get_the_date('j F, Y')) ?>
                                                    </div>
                                                <?php endif; ?>
                            <?php
                            $categories = get_the_category();
                            if ($show_category && $categories):
                                ?>
                                                    <div class="iw-post-category">
                                                        <i class="fa fa-folder-open-o"></i>
                                                    <?php echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>'; ?>
                                                    </div>
                            <?php endif; ?>
                                                    <?php if ($show_author): ?>
                                                    <div class="iw-author">
                                                        <i class="fa fa-user"></i>
                                                    <?php printf(__('%s'), get_the_author_link()) ?>
                                                    </div>
                            <?php endif; ?>
                                            </div>
                                        </div>
                                            <?php endif; ?>
                                    <div class="iw-posts-content">
                                        <div class="iw-post-info">
                                            <div class="iw-title"><a <?php echo $layout == 'style2' ? 'class="theme-color"' : 'class="theme-color-hover"' ?>
                                                    href="<?php echo get_permalink(); ?>"><?php the_title() ?></a>
                                            </div>
                        <?php if ($show_desc): ?>
                                                <p><?php echo Inwave_Helper::substrword(get_the_excerpt(), $excerpt_limit); ?></p>
                                            </div>
                                            <?php endif; ?>
                                        <div class="iw-bottom-item">
                        <?php if ($show_comment_count): ?>
                                                <div class="comment-count float-left">
                                                    <div <?php echo $layout == 'style2' ? 'class="theme-color"' : '' ?>>
                                                        <i class="fa fa-comment"></i>
                                                        <span><?php echo get_comments_number(); ?></span>
                                                    </div>
                                                </div>
                        <?php endif; ?>
                        <?php if ($show_view_count): ?>
                                                <div class="view-count float-left">
                                                    <div <?php echo $layout == 'style2' ? 'class="theme-color"' : '' ?>>
                                                        <i class="fa fa-heart"></i>
                                                        <span><?php echo inwave_get_post_views(get_the_ID()); ?></span>
                                                    </div>
                                                </div>
                        <?php endif; ?>
                        <?php if ($show_fb_share): ?>
                                                <div class="share-fb float-left">
                                                    <div <?php echo $layout == 'style2' ? 'class="theme-color"' : '' ?>>
                                                <?php
                                                inwave_social_sharing_fb(get_permalink(), Inwave_Helper::substrword(get_the_excerpt(), 10), get_the_title());
                                                ?>
                                                    </div>
                                                </div>
                                                    <?php endif; ?>
                                                    <?php if ($show_readmore): ?>
                                                <div class="read-more theme-bg-hover float-right">
                                                    <a <?php echo $layout == 'style2' ? 'class="theme-color"' : '' ?>
                                                        href="<?php echo get_permalink(); ?>"><?php echo $read_more_text ?></a>
                                                </div>
                        <?php endif; ?>
                                            <div style="clear: both;padding: 0;margin: 0"></div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                        </div>
                    </div>
                            <?php
                            break;
                        case 'style3':
                            ?>
                    <div class="row">
                        <div class="iw-posts <?php echo $class ?>">
                    <?php
                    $i = 0;
                    while ($query->have_posts()) : $query->the_post();
                        if ($i == 1) {
                            echo '<div class="col-md-6 col-sm-6">';
                        }
                        ?>
                                <div class="iw-posts-item iw-posts-item-<?php echo $i ?> <?php echo $i == 0 ? 'col-md-6 col-sm-6' : 'iw-posts-item-small' ?>">
                                    <div class="iw-post-wrap">
                                <?php if ($show_thumbnail): ?>
                                            <div class="iw-posts-thumb featured-image fit-video <?php echo $i == 0 ? '' : 'col-md-6 col-sm-12' ?>">
                            <?php
                            $post_format = get_post_format();
                            if ($show_posttype_icon) :
                                ?>
                                                    <div>
                                                    <?php
                                                    switch ($post_format) {
                                                        case 'gallery':
                                                            ?>
                                                                <i class="fa fa-picture-o"></i>
                                                                <?php
                                                                break;
                                                            case 'video':
                                                                ?>
                                                                <i class="fa fa-play-circle"></i>
                                                                <?php
                                                                break;
                                                            default:
                                                                ?>
                                                                <i class="fa fa-camera"></i>
                                                                <?php
                                                                break;
                                                        }
                                                        ?>
                                                    </div>
                                                    <?php endif ?>
                                                    <?php
                                                    $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail');
                                                    $video = get_media_embedded_in_content($content);
                                                    if (count($img) && $img[0]) {
                                                        ?>
                                                    <a href="<?php echo get_permalink() ?>">
                                                        <div class="square"></div>
                                                        <img src="<?php echo $img[0]; ?>" alt="">
                                                    </a>
                                <?php
                            } else {
                                ?>
                                                    <?php
                                                    $contents = get_the_content();
                                                    switch ($post_format) {
                                                        case 'video':
                                                            $video = inwave_getElementByTags('embed', $contents);
                                                            if (!$video) {
                                                                $video = inwave_getElementByTags('video', $contents);
                                                            }
                                                            if ($video) {
                                                                echo apply_filters('the_content', $video[0]);
                                                            }
                                                            break;
                                                        case 'gallery':
                                                            $gallery = inwave_getElementByTags('gallery', $contents, 2);
                                                            if ($gallery) {
                                                                echo apply_filters('the_content', $gallery[0]);
                                                            }
                                                            break;
                                                    }
                                                }
                                                ?>
                                                <div class="date-category">
                                                <?php if ($show_date): ?>
                                                        <div class="iw-date">
                                                            <i class="fa fa-calendar-o"></i>
                                <?php printf(__('%s'), get_the_date('j F, Y')) ?>
                                                        </div>
                                                        <?php endif; ?>
                                                    <?php
                                                    $categories = get_the_category();
                                                    if ($show_category && $categories):
                                                        ?>
                                                        <div class="iw-post-category">
                                                            <i class="fa fa-folder-open-o"></i>
                                                            <?php echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>'; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if ($show_author): ?>
                                                        <div class="iw-author">
                                                            <i class="fa fa-user"></i>
                                                            <?php printf(__('%s'), get_the_author_link()) ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="iw-posts-content <?php echo $i == 0 ? '' : 'col-md-6 col-sm-12' ?>">
                                            <div class="iw-post-info">
                                                <div class="iw-title <?php echo $i == 0 ? 'col-md-6 col-sm-12' : '' ?>"><a class="theme-color-hover" href="<?php echo get_permalink(); ?>"><?php the_title() ?></a>
                                                </div>
                                                <div class="<?php echo $i == 0 ? 'style-post0 col-md-6 col-sm-12' : '' ?>">
                                                    <?php if ($show_desc): ?>
                                                        <p><?php echo Inwave_Helper::substrword(get_the_excerpt(), $excerpt_limit); ?></p>
                                                    <?php endif; ?>
                                                    <?php if ($show_readmore): ?>
                                                        <div class="read-more">
                                                            <a class="theme-bg" href="<?php echo get_permalink(); ?>"><?php echo $read_more_text ?></a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div style="clear: both;"></div>
                                            </div>
                                            <div class="iw-bottom-item">
                                                <?php if ($show_comment_count): ?>
                                                    <div class="comment-count float-left">
                                                        <div>
                                                            <i class="fa fa-comment"></i>
                                                            <span><?php echo get_comments_number(); ?></span>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($show_view_count): ?>
                                                    <div class="view-count float-left">
                                                        <div>
                                                            <i class="fa fa-heart"></i>
                                                            <span><?php echo inwave_get_post_views(get_the_ID()); ?></span>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($show_fb_share): ?>
                                                    <div class="share-fb float-left">
                                                        <div>
                                                            <?php
                                                            inwave_social_sharing_fb(get_permalink(), Inwave_Helper::substrword(get_the_excerpt(), 10), get_the_title());
                                                            ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div style="clear: both;padding: 0;margin: 0"></div>
                                            </div>
                                        </div>
                                        <div style="clear: both;padding: 0;margin: 0"></div>
                                    </div>
                                </div>
                                <?php
                                $i++;
                            endwhile;
                            if ($i >= 2) {
                                echo '</div>';
                            }
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                    <?php
                    break;
            }
            $html = ob_get_contents();
            ob_end_clean();
            return $html;
        }

    }

}
new Inwave_WP_Posts();
if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_Inwave_WP_Posts extends WPBakeryShortCode {
        
    }

}