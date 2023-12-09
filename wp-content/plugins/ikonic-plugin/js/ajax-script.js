jQuery(document).ready(function ($) {
  $.ajax({
      url: wpApiSettings.root + '/architecture-projects',
      method: 'GET',
      beforeSend: function (xhr) {
          xhr.setRequestHeader('X-WP-Nonce', wpApiSettings.nonce);
      },
      data: {
          _wpnonce: wpApiSettings.nonce,
      },
      success: function (response) {
          console.log(response);
          console.log(wpApiSettings.nonce);
          // Handle the response as needed
      },
      error: function (error) {
          console.error(error);
      }
  });
});
