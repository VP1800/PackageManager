// Custom alert
function showAlert(message, type) {
    const alertBox = document.getElementById('alert-box');
    alertBox.innerHTML = message;
    alertBox.className = `w3-${type} w3-center w3-padding w3-round`;
    alertBox.classList.remove('w3-hide');
    setTimeout(() => {
        alertBox.classList.add('w3-hide');
    }, 3500); // hide the notification after 3 seconds
}
  
// function for redirection
function redirect(url) {
    window.location.href = url;
}
// Loading saved page
function loadPage(page) {
    $('#content-placeholder').load(page, function() {
        // Store the last loaded page in localStorage
        localStorage.setItem('lastPage', page);

        // Initialize DataTable after the page is loaded, if applicable
        if ($('#example').length) {
            $('#example').DataTable({
                responsive: true
            });
        }
    });
}

//load page
$(document).ready(function() {
    // Load the last visited page or default to index.html
    var lastPage = localStorage.getItem('lastPage') || 'home.php';
    loadPage(lastPage);
    $(document).ajaxStart(function() {
    // console.log('AJAX start triggered');
    $('#overlay').fadeIn();
    }).ajaxStop(function() {
        // console.log('AJAX stop triggered');
        $('#overlay').fadeOut();
    });

    // Handle responsiveness on smaller screens
    if (window.innerWidth < 768) {
        toggleSidebar();
    }
});

//sidebar
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');
    if (sidebar.style.display === 'block') {
        sidebar.style.display = 'none';
        mainContent.style.marginLeft = '0';
    } else {
        sidebar.style.display = 'block';
        mainContent.style.marginLeft = '250px';
    }
}