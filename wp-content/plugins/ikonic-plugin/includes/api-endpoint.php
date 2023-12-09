<?php

// Register REST API endpoint
function register_custom_posts_api_endpoint() {
  register_rest_route('ikonic/v1', '/architecture-projects', array(
      'methods'             => 'GET',
      'callback'            => 'get_custom_posts_api_data',
      'permission_callback' => function () {
        return true; // Allow access to all users
    },
  ));
}
add_action('rest_api_init', 'register_custom_posts_api_endpoint');


// REST API callback function
function get_custom_posts_api_data() {
  $response_data = array();

  // Check if the user is logged in
  $is_user_logged_in = false;

  // Define the cookie name
  $cookie_name = '';

  // Get all cookies
  $cookies = $_COOKIE;

  // Loop through the cookies to find the authentication cookie
  foreach ($cookies as $name => $value) {
      if (strpos($name, 'wordpress_logged_in_') === 0) {
          $cookie_name = $name;
          break;
      }
  }

  // Check if the authentication cookie was found
  if (!empty($cookie_name)) {
    $is_user_logged_in = true;
  }

  // Get the number of posts allowed based on the permission callback
  $allowed_posts = $is_user_logged_in ? 6 : 3;

  // Define query parameters
  $args = array(
      'post_type'      => 'projects',
      'posts_per_page' => $allowed_posts,
      'tax_query'      => array(
          array(
              'taxonomy' => 'project_type',
              'field'    => 'slug',
              'terms'    => 'architecture',
          ),
      ),
      'orderby'        => 'date',
      'order'          => 'DESC',
  );

  // Run the query
  $query = new WP_Query($args);

  // Prepare the response data
  if ($query->have_posts()) {
      while ($query->have_posts()) {
          $query->the_post();
          $response_data[] = array(
              'id'    => get_the_ID(),
              'title' => get_the_title(),
              'link'  => get_permalink(),
          );
      }
  }

  // Reset post data
  wp_reset_postdata();

  // Send JSON response
  return rest_ensure_response(array('success' => true, 'data' => $response_data));
}