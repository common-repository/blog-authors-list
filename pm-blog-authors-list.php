<?php
/*
Plugin Name: PM Blog Authors List
Plugin URI: http://www.php-mastermind.com/display-list-blog-authors-number-posts-wordpress-page/
Description: Display a list of blog authors with number of posts using shortcode [blog_authors_list]
Author: Wasi Abbas (PHP-Mastermind)
Contributors: taufique, khalid
Author URI: http://www.php-mastermind.com
Version: 1.0
*/

function pm_blog_authors_list() {
	
	$authors = get_users(array(
			'orderby' => 'display_name',
			'count_totals' => false,
			'who' => 'authors'
			
		)
	);
	
	$list = '';
	
	if($authors) :
	
		wp_enqueue_style('author-list', plugin_dir_url(__FILE__) . 'css/author-list.css');
	
		$list .= '<ul class="author-list">';
		
			foreach($authors as $author) :
			
				$list .= '<li class="author">';
			
					$archive_url = get_author_posts_url($author->ID);
					
					$list .= get_avatar($author->user_email, 60);
					
					$list .= '<a href="'. $archive_url . '" title="' . __('View all posts by ', 'pippin') . $author->display_name . '">' . ucwords($author->display_name) . '</a>';
					
					$list .= '<p class="author-posts"><i><small>written ' . get_the_author_posts(). ' posts </small></i></p>';
			
					$list .= '<p class="author-bio">' . get_user_meta($author->ID, 'description', true) . '</p>';
			
					$list .= '<p class="author-archive"><a href="'. $archive_url . '" title="' . __('View all posts by ', 'pm') . $author->display_name . '">' . __('View author\'s posts', 'pm') . '</a></p>';
			
				$list .= '</li>';
				
			endforeach;
		
		$list .= '</ul>';
		
	endif;
	
	return $list;
}
add_shortcode('blog_authors_list', 'pm_blog_authors_list');