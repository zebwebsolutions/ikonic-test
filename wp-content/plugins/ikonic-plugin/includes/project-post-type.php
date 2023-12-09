<?php

// Register custom post type
function register_projects_post_type() {
	$labels = array(
			'name'                  => 'Projects',
			'singular_name'         => 'Project',
			'menu_name'             => 'Projects',
			'add_new'               => 'Add New',
			'add_new_item'          => 'Add New Project',
			'edit'                  => 'Edit',
			'edit_item'             => 'Edit Project',
			'new_item'              => 'New Project',
			'view'                  => 'View',
			'view_item'             => 'View Project',
			'search_items'          => 'Search Projects',
			'not_found'             => 'No projects found',
			'not_found_in_trash'    => 'No projects found in trash',
			'parent'                => 'Parent Project'
	);

	$args = array(
			'labels'                => $labels,
			'public'                => true,
			'has_archive'           => true,
			'publicly_queryable'    => true,
			'query_var'             => true,
			'rewrite'               => array('slug' => 'projects'),
			'capability_type'       => 'post',
			'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
			'taxonomies'            => array('project_type'),
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-portfolio'
	);

	register_post_type('projects', $args);
}
add_action('init', 'register_projects_post_type');