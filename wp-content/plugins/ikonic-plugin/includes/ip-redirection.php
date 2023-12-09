<?php

// Function to check the user's IP address and perform redirection
function ip_redirector_check_ip() {
  // Get the user's IP address
  $user_ip = $_SERVER['REMOTE_ADDR'];

  //echo '<div style="background-color: #f5f5f5; padding: 10px; font-size: 14px; text-align: center;">Your IP Address: ' . $user_ip . '</div>';

  // Check if the IP address starts with '77.29.'
  if (strpos($user_ip, '77.29.') === 0) {
      // Redirect the user away from the site
      wp_redirect('https://rahmanzeb.com');
      exit();
  }
}

// Hook the function to the 'init' action
add_action('init', 'ip_redirector_check_ip');