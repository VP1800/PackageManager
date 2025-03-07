// index.js
$(document).ready(function() {
    $('button[type="button"]').on('click', function() {
      var username = $('input[type="text"]').val();
      var password = $('input[type="password"]').val();
  
      // Basic validation
      if (username === "" || password === "") {
        alert("Please enter both username and password.");
        return false;
      }
  
      // AJAX request
      $.ajax({
        url: 'dal/dal_login.php',
        type: 'POST',
        data: {
          us: username,
          pwd: password
        },
        success: function(response) {
          if (response === 'success') {
            // Clear the localStorage
            
            window.location.href = 'home.php';
          } else {
            alert("Invalid username or password. Please try again.");
          }
        },
        error: function() {
          alert("An error occurred. Please try again.");
        }
      });
    });
  });
  