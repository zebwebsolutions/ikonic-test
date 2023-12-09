<?php
//function for getting random coffee link
function hs_give_me_coffee() {
	// API endpoint URL
	$api_url = 'https://coffee.alexflipnote.dev/random.json';

	// Send a GET request to the API endpoint
	$response = wp_remote_get($api_url);

	// Check if the request was successful
	if (is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200) {
			// Error handling, if needed
			return 'Unable to fetch coffee. Please try again later.';
	}

	// Get the response body (JSON data)
	$data = wp_remote_retrieve_body($response);

	// Parse the JSON data
	$coffee_data = json_decode($data);

	// Check if the JSON data was successfully parsed and contains the "file" property
	if (!$coffee_data || empty($coffee_data->file)) {
			return 'Unable to fetch coffee. Please try again later.';
	}

	// Return the direct link to the coffee image
	return $coffee_data->file;
}