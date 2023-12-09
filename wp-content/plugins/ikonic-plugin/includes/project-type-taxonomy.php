<?php

// Register custom taxonomy
function register_project_type_taxonomy() {
	$labels = array(
			'name'                       => 'Project Types',
			'singular_name'              => 'Project Type',
			'search_items'               => 'Search Project Types',
			'all_items'                  => 'All Project Types',
			'parent_item'                => 'Parent Project Type',
			'parent_item_colon'          => 'Parent Project Type:',
			'edit_item'                  => 'Edit Project Type',
			'update_item'                => 'Update Project Type',
			'add_new_item'               => 'Add New Project Type',
			'new_item_name'              => 'New Project Type Name',
			'menu_name'                  => 'Project Type',
	);

	$args = array(
			'hierarchical'          => true,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'query_var'             => true,
			'rewrite'               => array('slug' => 'project-type')
	);

	register_taxonomy('project_type', 'projects', $args);
}
add_action('init', 'register_project_type_taxonomy');