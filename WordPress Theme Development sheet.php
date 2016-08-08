<?php
/* This code is for html to wordpress convert(only homepage) */
/* <=================================================================> */
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?>>
	<head>
		<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<?php wp_get_archives('type=monthly&format=link&limit=12'); ?>
		
		
<!-- To make dynamic <head> section's all href and all images src -->
At first we need a screenshot.png(images) for show picture in wordpress theme
<?php echo get_template_directory_uri(); ?>/     or,
<?php bloginfo('stylesheet_url'); ?>
 <?php wp_head(); ?>
 </head>
 <?php wp_footer(); ?>
</body>

<!-- This is for part of index.php -->
======================================
1. Seperate (header.php), (sidebar.php), (footer.php), from index.php


<!-- This code for style.css -->
For style css=>
======================================
/*
Theme Name: A theme for wordpress
Theme URI: http://www.designingway.com
Description: A theme for WordPress
Version: 1.0
Author: Rasel Ahmed
Author URI: http://www.rrfoundation.net
*/

<!-- Now the site is converted in wordpress-->
==============================================


<!-- To make dynamic logo -->
==============================================
<a href="<?php bloginfo('home'); ?>"></a>


<!-- To make dynamic mainmenu(simple menu) -->
==============================================
<?php wp_nav_menu( array( 'theme_location' => 'main_menu') ); ?> (in index.php)
in function.php=>
<?php
/**
 * Bilanti functions and definitions
 *
 * Sets up the theme and provides some helper functions. 
 *
 * @package WordPress
 * @subpackage Bilanti
 */
 
/* WordPress 3.0 Menu Editor ********************************************/

	// add menu support and fallback menu if menu doesn't exist
	add_action('init', 'wpj_register_menu');
	function wpj_register_menu() {
		if (function_exists('register_nav_menu')) {
			register_nav_menu( 'main_menu', __( 'Main Menu', 'bilanti' ) );
		}
	}

/* To make dynamic mainmenu(dropdown menu) */
/* <=================================================================> */
 in index.php=>
				<?php
				if (function_exists('wp_nav_menu')) {
					wp_nav_menu(array('theme_location' => 'wpj-main-menu', 'menu_id' => 'nav', 'fallback_cb' => 'wpj_default_menu'));
				}
				else {
					wpj_default_menu();
				}
				?>
in function.php=>
<?php
/**
 * Bilanti functions and definitions
 *
 * Sets up the theme and provides some helper functions. 
 *
 * @package WordPress
 * @subpackage Bilanti
 */

 
 /**
 * Breadcoumb Support
 */

include_once( 'includes/breadcoumb.php' ); 

 
/* WordPress 3.0 Menu Editor ********************************************/

	// add menu support and fallback menu if menu doesn't exist
	add_action('init', 'wpj_register_menu');
	function wpj_register_menu() {
		if (function_exists('register_nav_menu')) {
			register_nav_menu( 'wpj-main-menu', __( 'Main Menu', 'brightpage' ) );
		}
	}
	function wpj_default_menu() {
		echo '<ul id="nav">';
		if ('page' != get_option('show_on_front')) {
			echo '<li><a href="'. home_url() . '/">Home</a></li>';
		}
		wp_list_pages('title_li=');
		echo '</ul>';
	}
	
/* This code is for dynamic footer menu */
	if you have footer menu code in index=>
/* <=================================================================> */
	<?php wp_nav_menu( array( 'theme_location' => 'main_menu') ); ?>
	in funtion.php=>
	register_nav_menu( 'menu_footer', __( 'Footer Menu', 'bilanti' ) );

	
/* To make dynamic widgeds */
	===================================
	<?php dynamic_sidebar('id_name'); ?> (in index.php)
	
	In function.php=>
	
	 /* Register sidebars and widgetized areas ********************************************/
	
	function bilanti_widget_areas() {

		
   	    register_sidebar( array(
			'name' => __( 'here wp widged name', 'bilanti' ),
			'id' => 'id_name',
			'before_widget' => '<div class="single_promo floatleft fix">',
	        'after_widget' => '</div>',
	        'before_title' => '<h2>',
	        'after_title' => '</h2>',
	    ) );
		
		}
	add_action('widgets_init', 'bilanti_widget_areas');
	
<=========================================================>
	
/* This code is for making any template for the theme pages =>
1. We need to copy(index.php) for making this new pages.
2. Then we set up our own "content" for this page.
*/
===========================================================
in template pages=>
/*
Template Name: (pages name) Template
*/

<===========================================================>


/* This code is for (post.php) but it is no page, All (post.php) code is set up in (index.php) for show update wordpress post in my "visitor page" */
=====================================================

<?php if(have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>        
 
<!-- Your Post Query here --> /* Here we set up our (post-loop.php), which is given in below */  
 
<?php endwhile; ?>    
<?php endif; ?>
 
 
Pagination in index.php
=====================================
 
<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts') ); ?></div>

<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>') ); ?></div>
 
 
Post Information Query in index.php
=====================================
 
<?php the_title(); ?> = For post title.
<?php the_permalink(); ?> = For post link.
<?php the_time('M d, Y') ?> = For post time.
<?php the_excerpt(); ?> = For post summary.
<?php the_content(); ?> = For full post.
<?php the_category(', '); ?> = For post different class.
<?php comments_popup_link('No Comment', '1 Comment', '% Comments'); ?> = For post comment number and post link.

===============================================================
/* This code is for (post-loop.php) */

					<?php if(have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>        

						<div class="single_post">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<div class="post_info">
								Posted In: <?php the_category(', '); ?> | Posted on: <?php the_time('M, d, Y') ?> 
								<?php if ( comments_open() ) : ?>
                                            <span class="entry-comments right"><i class="fa fa-comment-o"><?php comments_popup_link('No Comment', '1 Comment', '% Comments'); ?></span>
                                        	<?php endif; ?>
							</div>
							<div class="post_content">
								<?php the_content(); ?>
							</div>
						</div>

					<?php endwhile; ?>    
					<?php endif; ?>
					
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts') ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>') ); ?></div>
					
<==============================================================>

/* This is(page.php), which is use for my "home page". If I make a page(no template) that has no content, then this page show this (page.php) page("home page") 
*/
===================
/* This code is for (page.php) */
===================================
It is your home page that you already dynamic at above this page.

<================================================================>

/* This is(single.php), which is use for show per wordpress post in "single page".
In this single page we need a "comment box", so for "comment box" code is given below after (single.php)
*/
=================================
/* This code is for (single.php) */
============================================
			<?php if(have_posts()): ?><?php while(have_posts()): the_post(); ?>
				<h2><?php the_title(); ?></h2>
					<?php the_content(); ?>
				   <?php comments_template( '', true ); ?>  				 
				<?php endwhile; ?>
				
				<?php else : ?>
				<h3><?php _e('404 Error: Not Found'); ?></h3>
				<?php endif; ?>

=============================================================

/* This code is for (comment.css) It is a css file, so you keep this code in extra css file(comments.css). This file has a code of (functions.php) that is given in below after (comment.css). You need to link this css in (header.php) */
=================================
 /* ===================== comments ===================== */ 

.comments {margin: 10px 0;}
.comments h3 {margin:50px 0 30px 0;font-size:24px;}
ol.commentlist { list-style:none; margin:0 0 1em; padding:0; text-indent:0; }
ol.commentlist li { }
ol.commentlist li.alt { }
ol.commentlist li.bypostauthor {}
ol.commentlist li.byuser {}
ol.commentlist li.comment-author-admin {}
ol.commentlist li.comment { border-bottom: 1px solid #ddd; padding:1em; margin-bottom: 10px; }
ol.commentlist li div.comment-author {}
ol.commentlist li div.vcard { font-size:20px;}
ol.commentlist li div.vcard cite.fn { font-style:normal; }
ol.commentlist li div.vcard cite.fn a.url {}
ol.commentlist li div.vcard img.avatar {float:left; margin:0 1em 1em 0; }
ol.commentlist li div.vcard img.avatar-32 {}
ol.commentlist li div.vcard img.photo {}
ol.commentlist li div.vcard span.says {}
ol.commentlist li div.commentmetadata {}
ol.commentlist li div.comment-meta { font-size:9px; margin-bottom: 10px;}
ol.commentlist li div.comment-meta a { color: #aaa; }
ol.commentlist li p { margin: 0; }
ol.commentlist li ul { list-style:square; margin:0 0 1em 2em; }
ol.commentlist li div.reply { font-size:11px; }
ol.commentlist li div.reply a { font-weight:bold; }
ol.commentlist li ul.children { list-style:none; margin:1em 0 0; text-indent:0; }
ol.commentlist li ul.children li {}
ol.commentlist li ul.children li.alt {}
ol.commentlist li ul.children li.bypostauthor {}
ol.commentlist li ul.children li.byuser {}
ol.commentlist li ul.children li.comment {}
ol.commentlist li ul.children li.comment-author-admin {}
ol.commentlist li ul.children li.depth-2 { margin:0 0 .25em .25em; }
ol.commentlist li ul.children li.depth-3 { margin:0 0 .25em .25em; }
ol.commentlist li ul.children li.depth-4 { margin:0 0 .25em .25em; }
ol.commentlist li ul.children li.depth-5 {}
ol.commentlist li ul.children li.odd {}
ol.commentlist li.even { background:#fff; }
ol.commentlist li.odd { background:#f6f6f6; }
ol.commentlist li.parent { }
ol.commentlist li.pingback { margin: 0 0 10px; padding: 1em; border: 1px dashed #ccc; }
ol.commentlist li.thread-alt { }
ol.commentlist li.thread-even { }
ol.commentlist li.thread-odd {}

/* ===================== comment form ===================== */ 

#respond {position: relative;}
#respond input[type="text"],#respond textarea {border:1px solid #ddd;padding:10px}
#respond input[type="text"] {padding:7px;width:300px}
#respond .comment-form-author,
#respond .comment-form-email,
#respond .comment-form-url,
#respond .comment-form-comment { position: relative; }
#respond .comment-form-author label,
#respond .comment-form-email label,
#respond .comment-form-url label,
#respond .comment-form-comment label { background: #eee; color: #555; display: inline-block; left: 4px; min-width: 60px; padding: 4px 10px; position: relative; top: 40px; z-index: 1; }
#respond input[type="text"]:focus,
#respond textarea:focus { text-indent: 0; z-index: 1; }
#respond textarea { resize: vertical; width: 95%; }
#respond .comment-form-author .required,
#respond .comment-form-email .required { color: #bd3500; font-size: 22px; font-weight: bold; left: 75%; position: absolute; top: 45px; z-index: 1; }
#respond .comment-notes,
#respond .logged-in-as { font-size: 13px; }
#respond p { margin: 10px 0; }
#respond .form-submit { float: right; margin: -20px 0 10px; }
#respond input#submit { background: #454545; border: none; -moz-border-radius: 3px; border-radius: 3px; -webkit-box-shadow: 0px 1px 2px rgba(0,0,0,0.3); -moz-box-shadow: 0px 1px 2px rgba(0,0,0,0.3); box-shadow: 0px 1px 2px rgba(0,0,0,0.3); color: #eee; cursor: pointer; padding: 5px 42px 5px 22px; }
#respond input#submit:active { background: #86222D; color: #fff; }
#respond #cancel-comment-reply-link { color: #666; margin-left: 10px; text-decoration: none; }
#respond .logged-in-as a:hover,
#respond #cancel-comment-reply-link:hover { text-decoration: underline; }
.commentlist #respond { margin: 1.625em 0 0; width: auto; }
#reply-title { color: #373737; font-size: 20px; }
#cancel-comment-reply-link { color: #888; display: block; position: absolute; right: 1.625em; text-decoration: none; text-transform: uppercase; top: 1.1em; }
#cancel-comment-reply-link:focus,
#cancel-comment-reply-link:active,
#cancel-comment-reply-link:hover { color: #ff4b33; }
#respond label {display: block; float: right; font-size: 16px; line-height: 2.2em; width: 280px;}
#respond input[type=text] {}
#respond p { font-size: 12px; }
p.comment-form-comment { margin: 0; }
.form-allowed-tags { display: none; }
.trackback { margin: 0 0 10px; padding: 1em; border: 1px dashed #ccc; }	
			
===========================================================

/* This code is for "comment box" which styles we wish to find in wordpress system. For this style we need a code in (functions.php) 
*/
======================
In (functions.php)=>

		/* This code is for comment scripts */
		
		function comment_scripts(){
		   if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
		}
		add_action( 'wp_enqueue_scripts', 'comment_scripts' );
		
<===============================================================>

/* This is (archive.php), which is use for finding "post category". That means, you give a post at any category, then if you enter your category menu, then you see that all post in this category show in the page. In (archive.php) you need to call (post-loop.php) because, your all post show from(post-loop.php)
*/
=================================
/* This code is for (archive.php) */
====================================

<for Archive & Archive Post List>

<h1>

    <?php if (have_posts()) : ?>

        <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

            <?php /* If this is a category archive */ if (is_category()) { ?>

                <?php _e('Archive for the'); ?> '<?php echo single_cat_title(); ?>' <?php _e('Category'); ?>                                    			
            <?php /* If this is a tag archive */  } elseif( is_tag() ) { ?>

                <?php _e('Archive for the'); ?> <?php single_tag_title(); ?> Tag

            <?php /* If this is a daily archive */ } elseif (is_day()) { ?>

                <?php _e('Archive for'); ?> <?php the_time('F jS, Y'); ?>                                        

            <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>

                <?php _e('Archive for'); ?> <?php the_time('F, Y'); ?>                                    

            <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>

                <?php _e('Archive for'); ?> <?php the_time('Y'); ?>                                        

            <?php /* If this is a search */ } elseif (is_search()) { ?>

                <?php _e('Search Results'); ?>                            

            <?php /* If this is an author archive */ } elseif (is_author()) { ?>

                <?php _e('Author Archive'); ?>                                        

            <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>

                <?php _e('Blog Archives'); ?>                                        

    <?php } ?>

</h1>

For archive post query

<?php get_template_part( 'post-loop' ); // Post-loop (post-loop.php) ?>
========================
If no post in archive or 404

<?php else : ?>
	 <h3><?php _e('404 Error&#58; Not Found'); ?></h3>
<?php endif; ?>

For specific page for creating special archive page, this is the code:

					<?php query_posts('post_type=post&category_name=News&post_status=publish&posts_per_page=2&paged='. get_query_var('paged')); ?>
					<?php get_template_part('post-loop'); ?>
						

<============================================================>

/* This is "readmore button", which is use for show details a content in "single page". For this button you have to select fixed words that you show want to your "post page", then if you click this button, you show that in "single page". It has a code of (functions.php) that is given below after "readmore button" code of in (post-loop.php)
*/
========================
/* This code is for "readmore" button" in (post-loop.php) */

Usage: <?php echo excerpt('15,as my wish'); ?>

========================
/* This code is for "readmore button" in (functions.php) */

	function excerpt($num) {

	$limit = $num+1;

	$excerpt = explode(' ', get_the_excerpt(), $limit);

	array_pop($excerpt);

	$excerpt = implode(" ",$excerpt)." <a href='" .get_permalink($post->ID) ." ' class='".readmore."'>Read More</a>";

	echo $excerpt;

	}
	
<===========================================================>

/* This is "featured images", which is use for your "post images" that signed a image for your post. It has a code of (functions.php) that is given in below after "featured images" code of (post-loop.php) & (single.php).
*/
================================
/* This code is for "featured images" in (post-loop.php) */

<?php the_post_thumbnail('post-image', array('class' => 'post-thumb')); ?>
===================
/* This code is for "featured images" in (single.php) */

<?php the_post_thumbnail('single-post-image', array('class' => 'single-post-thumb')); ?>
=========================================================
/* This code is for "featured images" in (functions.php) */

For enable featured image==========
			add_theme_support( 'post-thumbnails', array( 'post' ) );
			
		for enable crop feature============
			set_post_thumbnail_size( 200, 200, true );
			add_image_size( 'post-image', 150, 150, true );
			add_image_size( 'single-post-image', 960, 300, true ); <If you need featured images in your "single page" >
			
<=======================================================>

/* This is "Query post in specific category" that means, I want to make a new templates includes a page. In the page your all post show in your category system, you give a post which category, that category name is show there in heading type and then that categories all post show in under the heading by listing. For this "Query post in specific category" you need to call (post-loop.php)
*/
===========================
/* This code is for "Query post in specific category" in (your new template that made for it) */
 
 <?php query_posts('post_type=post&category_name=news&post_status=publish&posts_per_page=10&paged='. get_query_var('paged')); ?>
 <?php get_template_part('post-loop'); ?>
 
<==========================================================>
 
/* This is "custom post fields tips", which is use for linking your "featured images", that means, If a post have "featured images" then your "selected url" show that post. And if post have not any "featured images" that show your defaulf post link.
*/
==========================
/* This code is for "custom post fields tips" in (post-loop.php) */

Suppose we use custom field as 'url'

 ==================================
Display Custom Field Data
 =====================================
<?php $key="url"; echo get_post_meta($post->ID, $key, true); ?>
 
Display custom field if exists
 ===============================
<?php $image = get_post_meta($post->ID, 'url', true);
if($image) : ?>
<img src="<?php echo $image; ?>" alt="" />
<?php endif; ?>
 
Conditional Custom Field
 ===============================
<?php
$url = get_post_meta( $post->ID, 'url', true );
if ( $url ) {
    echo $url;
} else {
    the_permalink();
}
?>

<===========================================================>

/* This is "Testimonial page", which is use for clients. For this "testimonial page" we have to make a new new template and set up code and call (post.php). It has a code of (functions.php) that is given in below after "testimonial page" code in (new testimonial template)
*/
============================
/* This code is for "Testimonial page" by listing in (testimonial template) */

<?php query_posts('post_type=testimonial&post_status=publish&posts_per_page=10&paged='. get_query_var('paged')); ?>

=============================
/* This code is for "Testimonial page or any type of page that you want to make like the dashboard different items in wordpress, you can see there." in (functions.php) */

/* Register Custom Post Types*********************************/
 This code is for (function.php)
 =================================================
        add_action( 'init', 'create_post_type' );
        function create_post_type() {
                register_post_type( 'testimonial',
                        array(
                                'labels' => array(
                                        'name' => __( 'Testimonial' ),
                                        'singular_name' => __( 'Testimonial' ),
                                        'add_new' => __( 'Add New' ),
                                        'add_new_item' => __( 'Add New Testimonial' ),
                                        'edit_item' => __( 'Edit Testimonial' ),
                                        'new_item' => __( 'New Testimonial' ),
                                        'view_item' => __( 'View Testimonial' ),
                                        'not_found' => __( 'Sorry, we couldn\'t find the Testimonial you are looking for.' )
                                ),
                        'public' => true,
                        'publicly_queryable' => false,
                        'exclude_from_search' => true,
                        'menu_position' => 14,
                        'has_archive' => false,
                        'hierarchical' => false,
                        'capability_type' => 'page',
                        'rewrite' => array( 'slug' => 'testimonial' ),
                        'supports' => array( 'title', 'editor', 'custom-fields' )
                        )
                );
        }
		
<==========================================================>

/* This is "Option tree full system", which is use for changing logo, slider, and others etc. You need it here:
1. You need to download "Option tree"
2. You have to make a folder in your theme location which name is includes and then you need this file, which name is (theme-options.php)
3. It has a code of (functions.php)
4. For getting this "option tree full system" you need to connent data in (header.php)
*/
========================
/* This code is for (theme-options.php) */

<?php

add_action( 'admin_init', 'custom_theme_options', 1 );

function custom_theme_options() {

  $saved_settings = get_option( 'option_tree_settings', array() );
  

  $custom_settings = array(
    'sections'        => array(
      array(
        'id'          => 'general',
        'title'       => 'Site Settings'
      )
    ),
    'settings'        => array(
      array(
        'id'          => 'logo_text',
        'label'       => 'Logo Text',
        'desc'        => 'Use H1, H2, H3 tag',
        'type'        => 'textarea',
        'section'     => 'general'
      ), 
      array(
        'id'          => 'footer_text',
        'label'       => 'Footer Text',
        'type'        => 'textarea',
        'section'     => 'general'
      )
    )
  );

  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}
 ?>
 
 =============================
 /* This code is for "Option tree full system" in (functions.php) */
activate option tree=>
============
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
include_once( 'option-tree/ot-loader.php' );
include_once( 'includes/theme-options.php' );

===============================================
/* This code is for "Option tree full system" in (header.php) */

Get Data From Option Tree
=========>
 This code is for (header.php)
Condtional Data
<?php if ( function_exists( 'get_option_tree') ) : if( get_option_tree( 'your_tree_id') ) : ?>    
    <?php get_option_tree( 'your_tree_id', '', 'true' ); ?>
<?php else : ?>
    Your Default Data
<?php endif; endif; ?>

========================================
/* This code is for "Option tree full system" get simple Data */

<?php get_option_tree( 'facebook', '', 'true' ); ?>
 
<==========================================================>

/* This is (404 Not Found Page), which is use for, if any visitor search a wrong address, then the page show that (404 Not Found page). This page need to stylize in css. 
*/
1. You need to copy any "template page"
2. Then you delete the template pages content and stylize this like as paragraph.
3. You have to choice any (404 Not Found Page) images or template in google.
<============================================================>


Thank you so much.


?>