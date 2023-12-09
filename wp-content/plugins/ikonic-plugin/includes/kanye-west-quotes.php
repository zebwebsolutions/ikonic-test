<?php
//function for display random 5 quotes form kanye west api
function get_kanye_quotes($count = 5) {
	// API endpoint URL
	$api_url = 'https://api.kanye.rest/';

	// Initialize an empty array to store the quotes
	$quotes = array();

	// Fetch quotes from the API
	for ($i = 0; $i < $count; $i++) {
			// Send a GET request to the API endpoint
			$response = wp_remote_get($api_url);

			// Check if the request was successful
			if (is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200) {
					// Error handling, if needed
					return array();
			}

			// Get the response body (JSON data)
			$data = wp_remote_retrieve_body($response);

			// Parse the JSON data
			$quote_data = json_decode($data);

			// Check if the JSON data was successfully parsed and contains the "quote" property
			if ($quote_data && isset($quote_data->quote)) {
					// Add the quote to the quotes array
					$quotes[] = $quote_data->quote;
			}
	}

	// Return the array of quotes
	return $quotes;
}