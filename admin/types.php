<?php
/*** Register new Custom Post types & Taxonomies here ***/


// Register Custom Post Type
function events_post_type() {

	$labels = array(
		'name'                  => _x( 'Events', 'Post Type General Name', 'greyowl' ),
		'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'greyowl' ),
		'menu_name'             => __( 'Events', 'greyowl' ),
		'name_admin_bar'        => __( 'Events', 'greyowl' ),
		'archives'              => __( 'Events Archives', 'greyowl' ),
		'attributes'            => __( 'Events Attributes', 'greyowl' ),
		'parent_item_colon'     => __( 'Parent Event:', 'greyowl' ),
		'all_items'             => __( 'All Events', 'greyowl' ),
		'add_new_item'          => __( 'Add New Event', 'greyowl' ),
		'add_new'               => __( 'Add New Events', 'greyowl' ),
		'new_item'              => __( 'New Event', 'greyowl' ),
		'edit_item'             => __( 'Edit Event', 'greyowl' ),
		'update_item'           => __( 'Update Event', 'greyowl' ),
		'view_item'             => __( 'View IEvent', 'greyowl' ),
		'view_items'            => __( 'View Events', 'greyowl' ),
		'search_items'          => __( 'Search Event', 'greyowl' ),
		'not_found'             => __( 'Not found', 'greyowl' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'greyowl' ),
		'featured_image'        => __( 'Featured Image', 'greyowl' ),
		'set_featured_image'    => __( 'Set featured image', 'greyowl' ),
		'remove_featured_image' => __( 'Remove featured image', 'greyowl' ),
		'use_featured_image'    => __( 'Use as featured image', 'greyowl' ),
		'insert_into_item'      => __( 'Insert into item', 'greyowl' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'greyowl' ),
		'items_list'            => __( 'Items list', 'greyowl' ),
		'items_list_navigation' => __( 'Items list navigation', 'greyowl' ),
		'filter_items_list'     => __( 'Filter items list', 'greyowl' ),
	);
	$args = array(
		'label'               => __( 'Event', 'greyowl' ),
		'description'         => __( 'Events', 'greyowl' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'taxonomies'          => array( 'event_cat' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-calendar-alt',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'events', $args );

}
add_action( 'init', 'events_post_type', 0 );

// Register Custom Taxonomy
function custom_event_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Category', 'Taxonomy General Name', 'greyowl' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'greyowl' ),
		'menu_name'                  => __( 'Category', 'greyowl' ),
		'all_items'                  => __( 'All Items', 'greyowl' ),
		'parent_item'                => __( 'Parent Category', 'greyowl' ),
		'parent_item_colon'          => __( 'Parent Category:', 'greyowl' ),
		'new_item_name'              => __( 'New Category Name', 'greyowl' ),
		'add_new_item'               => __( 'Add New Category', 'greyowl' ),
		'edit_item'                  => __( 'Edit Category', 'greyowl' ),
		'update_item'                => __( 'Update Category', 'greyowl' ),
		'view_item'                  => __( 'View Category', 'greyowl' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'greyowl' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'greyowl' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'greyowl' ),
		'popular_items'              => __( 'Popular Items', 'greyowl' ),
		'search_items'               => __( 'Search Items', 'greyowl' ),
		'not_found'                  => __( 'Not Found', 'greyowl' ),
		'no_terms'                   => __( 'No items', 'greyowl' ),
		'items_list'                 => __( 'Items list', 'greyowl' ),
		'items_list_navigation'      => __( 'Items list navigation', 'greyowl' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'event_cat', array( 'events' ), $args );

}
add_action( 'init', 'custom_event_taxonomy', 0 );



// Register Custom Post Type
function news_post_type() {

	$labels = array(
		'name'                  => _x( 'News', 'Post Type General Name', 'greyowl' ),
		'singular_name'         => _x( 'News', 'Post Type Singular Name', 'greyowl' ),
		'menu_name'             => __( 'News', 'greyowl' ),
		'name_admin_bar'        => __( 'News', 'greyowl' ),
		'archives'              => __( 'News Archives', 'greyowl' ),
		'attributes'            => __( 'News Attributes', 'greyowl' ),
		'parent_item_colon'     => __( 'Parent News:', 'greyowl' ),
		'all_items'             => __( 'All News', 'greyowl' ),
		'add_new_item'          => __( 'Add New News', 'greyowl' ),
		'add_new'               => __( 'Add New News', 'greyowl' ),
		'new_item'              => __( 'New News', 'greyowl' ),
		'edit_item'             => __( 'Edit News', 'greyowl' ),
		'update_item'           => __( 'Update News', 'greyowl' ),
		'view_item'             => __( 'View News', 'greyowl' ),
		'view_items'            => __( 'View News', 'greyowl' ),
		'search_items'          => __( 'Search News', 'greyowl' ),
		'not_found'             => __( 'Not found', 'greyowl' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'greyowl' ),
		'featured_image'        => __( 'Featured Image', 'greyowl' ),
		'set_featured_image'    => __( 'Set featured image', 'greyowl' ),
		'remove_featured_image' => __( 'Remove featured image', 'greyowl' ),
		'use_featured_image'    => __( 'Use as featured image', 'greyowl' ),
		'insert_into_item'      => __( 'Insert into item', 'greyowl' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'greyowl' ),
		'items_list'            => __( 'Items list', 'greyowl' ),
		'items_list_navigation' => __( 'Items list navigation', 'greyowl' ),
		'filter_items_list'     => __( 'Filter items list', 'greyowl' ),
	);
	// $rewrite = array(
	// 	'slug'       => 'all-news',
	// 	'with_front' => true,
	// 	'pages'      => true,
	// 	'feeds'      => true,
	// );
	$args = array(
		'label'               => __( 'News', 'greyowl' ),
		'description'         => __( 'News', 'greyowl' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'taxonomies'          => array( 'news_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 7,
		'menu_icon'           => 'dashicons-media-document',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'show_in_rest'        => true,
		// 'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'news', $args );

}
add_action( 'init', 'news_post_type', 0 );

// Register Custom Taxonomy
function custom_taxonomy_news_tag() {

	$labels = array(
		'name'                       => _x( 'Tags', 'Taxonomy General Name', 'greyowl' ),
		'singular_name'              => _x( 'Tags', 'Taxonomy Singular Name', 'greyowl' ),
		'menu_name'                  => __( 'Tags', 'greyowl' ),
		'all_items'                  => __( 'All Tags', 'greyowl' ),
		'parent_item'                => __( 'Parent Tag', 'greyowl' ),
		'parent_item_colon'          => __( 'Parent Tag:', 'greyowl' ),
		'new_item_name'              => __( 'New Tag Name', 'greyowl' ),
		'add_new_item'               => __( 'Add New Tag', 'greyowl' ),
		'edit_item'                  => __( 'Edit Tag', 'greyowl' ),
		'update_item'                => __( 'Update Tag', 'greyowl' ),
		'view_item'                  => __( 'View Tag', 'greyowl' ),
		'separate_items_with_commas' => __( 'Separate Tags with commas', 'greyowl' ),
		'add_or_remove_items'        => __( 'Add or remove Tags', 'greyowl' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'greyowl' ),
		'popular_items'              => __( 'Popular Tags', 'greyowl' ),
		'search_items'               => __( 'Search Tags', 'greyowl' ),
		'not_found'                  => __( 'Not Found', 'greyowl' ),
		'no_terms'                   => __( 'No Tags', 'greyowl' ),
		'items_list'                 => __( 'Tags list', 'greyowl' ),
		'items_list_navigation'      => __( 'Items Tagsnavigation', 'greyowl' ),
	);
	$args = array(
		'labels'            => $labels,
		'hierarchical'      => false,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'show_in_rest'      => true,
	);
	register_taxonomy( 'news_tag', array( 'news' ), $args );

}
add_action( 'init', 'custom_taxonomy_news_tag', 0 );


// Register Custom Post Type
function researchers_post_type() {

	$labels = array(
		'name'                  => _x( 'Researchers', 'Post Type General Name', 'greyowl' ),
		'singular_name'         => _x( 'Researchers', 'Post Type Singular Name', 'greyowl' ),
		'menu_name'             => __( 'Researchers', 'greyowl' ),
		'name_admin_bar'        => __( 'Researchers', 'greyowl' ),
		'archives'              => __( 'Researchers Archives', 'greyowl' ),
		'attributes'            => __( 'Researchers Attributes', 'greyowl' ),
		'parent_item_colon'     => __( 'Parent Researcher:', 'greyowl' ),
		'all_items'             => __( 'All Researchers', 'greyowl' ),
		'add_new_item'          => __( 'Add New Researcher', 'greyowl' ),
		'add_new'               => __( 'Add New Researchers', 'greyowl' ),
		'new_item'              => __( 'New Researcher', 'greyowl' ),
		'edit_item'             => __( 'Edit Researcher', 'greyowl' ),
		'update_item'           => __( 'Update Researcher', 'greyowl' ),
		'view_item'             => __( 'View Researcher', 'greyowl' ),
		'view_items'            => __( 'View Researchers', 'greyowl' ),
		'search_items'          => __( 'Search Researcher', 'greyowl' ),
		'not_found'             => __( 'Not found', 'greyowl' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'greyowl' ),
		'featured_image'        => __( 'Featured Image', 'greyowl' ),
		'set_featured_image'    => __( 'Set featured image', 'greyowl' ),
		'remove_featured_image' => __( 'Remove featured image', 'greyowl' ),
		'use_featured_image'    => __( 'Use as featured image', 'greyowl' ),
		'insert_into_item'      => __( 'Insert into item', 'greyowl' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Researcher', 'greyowl' ),
		'items_list'            => __( 'Researchers list', 'greyowl' ),
		'items_list_navigation' => __( 'Researchers list navigation', 'greyowl' ),
		'filter_items_list'     => __( 'Filter Researchers list', 'greyowl' ),
	);
	$args = array(
		'label'               => __( 'Researchers', 'greyowl' ),
		'description'         => __( 'Researchers', 'greyowl' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 8,
		'menu_icon'           => 'dashicons-admin-users',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'show_in_rest'        => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'researchers', $args );

}
add_action( 'init', 'researchers_post_type', 0 );

// Register Custom Post Type
function research_post_type() {

	$labels = array(
		'name'                  => _x( 'Research', 'Post Type General Name', 'greyowl' ),
		'singular_name'         => _x( 'Research', 'Post Type Singular Name', 'greyowl' ),
		'menu_name'             => __( 'Research', 'greyowl' ),
		'name_admin_bar'        => __( 'Research', 'greyowl' ),
		'archives'              => __( 'Research Archives', 'greyowl' ),
		'attributes'            => __( 'Research Attributes', 'greyowl' ),
		'parent_item_colon'     => __( 'Parent Researcher:', 'greyowl' ),
		'all_items'             => __( 'All Research', 'greyowl' ),
		'add_new_item'          => __( 'Add New Researcher', 'greyowl' ),
		'add_new'               => __( 'Add New Research', 'greyowl' ),
		'new_item'              => __( 'New Researcher', 'greyowl' ),
		'edit_item'             => __( 'Edit Researcher', 'greyowl' ),
		'update_item'           => __( 'Update Researcher', 'greyowl' ),
		'view_item'             => __( 'View Researcher', 'greyowl' ),
		'view_items'            => __( 'View Research', 'greyowl' ),
		'search_items'          => __( 'Search Researcher', 'greyowl' ),
		'not_found'             => __( 'Not found', 'greyowl' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'greyowl' ),
		'featured_image'        => __( 'Featured Image', 'greyowl' ),
		'set_featured_image'    => __( 'Set featured image', 'greyowl' ),
		'remove_featured_image' => __( 'Remove featured image', 'greyowl' ),
		'use_featured_image'    => __( 'Use as featured image', 'greyowl' ),
		'insert_into_item'      => __( 'Insert into item', 'greyowl' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Researcher', 'greyowl' ),
		'items_list'            => __( 'Research list', 'greyowl' ),
		'items_list_navigation' => __( 'Research list navigation', 'greyowl' ),
		'filter_items_list'     => __( 'Filter Research list', 'greyowl' ),
	);
	$args = array(
		'label'               => __( 'Research', 'greyowl' ),
		'description'         => __( 'Research', 'greyowl' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'taxonomies'          => array( 'research_category' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 9,
		'menu_icon'           => 'dashicons-media-document',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'show_in_rest'        => true,
		'capability_type'     => 'page',
		'show_in_rest'        => true,
	);
	register_post_type( 'research', $args );

}
add_action( 'init', 'research_post_type', 0 );

// Register Custom Taxonomy
function custom_taxonomy_research_category() {

	$labels = array(
		'name'                       => _x( 'Category', 'Taxonomy General Name', 'greyowl' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'greyowl' ),
		'menu_name'                  => __( 'Category', 'greyowl' ),
		'all_items'                  => __( 'All Category', 'greyowl' ),
		'parent_item'                => __( 'Parent Tag', 'greyowl' ),
		'parent_item_colon'          => __( 'Parent Tag:', 'greyowl' ),
		'new_item_name'              => __( 'New Tag Name', 'greyowl' ),
		'add_new_item'               => __( 'Add New Tag', 'greyowl' ),
		'edit_item'                  => __( 'Edit Tag', 'greyowl' ),
		'update_item'                => __( 'Update Tag', 'greyowl' ),
		'view_item'                  => __( 'View Tag', 'greyowl' ),
		'separate_items_with_commas' => __( 'Separate Category with commas', 'greyowl' ),
		'add_or_remove_items'        => __( 'Add or remove Category', 'greyowl' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'greyowl' ),
		'popular_items'              => __( 'Popular Category', 'greyowl' ),
		'search_items'               => __( 'Search Category', 'greyowl' ),
		'not_found'                  => __( 'Not Found', 'greyowl' ),
		'no_terms'                   => __( 'No Category', 'greyowl' ),
		'items_list'                 => __( 'Category list', 'greyowl' ),
		'items_list_navigation'      => __( 'Items Category navigation', 'greyowl' ),
	);
	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'show_in_rest'      => true,
	);
	register_taxonomy( 'research_category', array( 'research' ), $args );

}
add_action( 'init', 'custom_taxonomy_research_category', 0 );

// Register Custom Post Type
function publications_post_type() {

	$labels = array(
		'name'                  => _x( 'Publications', 'Post Type General Name', 'greyowl' ),
		'singular_name'         => _x( 'Publications', 'Post Type Singular Name', 'greyowl' ),
		'menu_name'             => __( 'Publications', 'greyowl' ),
		'name_admin_bar'        => __( 'Publications', 'greyowl' ),
		'archives'              => __( 'Publications Archives', 'greyowl' ),
		'attributes'            => __( 'Publications Attributes', 'greyowl' ),
		'parent_item_colon'     => __( 'Parent Publication:', 'greyowl' ),
		'all_items'             => __( 'All Publications', 'greyowl' ),
		'add_new_item'          => __( 'Add New Publication', 'greyowl' ),
		'add_new'               => __( 'Add New Publications', 'greyowl' ),
		'new_item'              => __( 'New Publication', 'greyowl' ),
		'edit_item'             => __( 'Edit Publication', 'greyowl' ),
		'update_item'           => __( 'Update Publication', 'greyowl' ),
		'view_item'             => __( 'View Publication', 'greyowl' ),
		'view_items'            => __( 'View Publications', 'greyowl' ),
		'search_items'          => __( 'Search Publication', 'greyowl' ),
		'not_found'             => __( 'Not found', 'greyowl' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'greyowl' ),
		'featured_image'        => __( 'Featured Image', 'greyowl' ),
		'set_featured_image'    => __( 'Set featured image', 'greyowl' ),
		'remove_featured_image' => __( 'Remove featured image', 'greyowl' ),
		'use_featured_image'    => __( 'Use as featured image', 'greyowl' ),
		'insert_into_item'      => __( 'Insert into item', 'greyowl' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Publication', 'greyowl' ),
		'items_list'            => __( 'Publications list', 'greyowl' ),
		'items_list_navigation' => __( 'Publications list navigation', 'greyowl' ),
		'filter_items_list'     => __( 'Filter Publications list', 'greyowl' ),
	);
	$args = array(
		'label'                 => __( 'Publications', 'greyowl' ),
		'description'           => __( 'Publications', 'greyowl' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 10,
		'menu_icon'             => 'dashicons-media-document',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'show_in_rest'          => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'publications', $args );

}
add_action( 'init', 'publications_post_type', 0 );
