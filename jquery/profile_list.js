//edit profile
function edit_profile_data(profile_id) {
    $.ajax({
        type: "POST",
        url: "dal/dal_profile.php",
        data: {
            edit_profile_id:'edit_profile_id',
            profile_id:profile_id
        },
        success: function(data) {
            debugger;
            redirect('./edit_profile.php');
        }
    });
}

//delete profile
function delete_profile_data(profile_id) { 
    if (confirm("Are you sure you want to delete this unit?")) {
      $.ajax({
        type: 'post',
        url: 'dal/dal_profile.php',
        data: {
          delete_profile:'delete_profile',
          profile_id: profile_id
        },
        success: function(response) {
          debugger;
          if (response === 'success') {
            // Remove the row from the DataTable
            list_profile();
            showAlert('Profile deleted successfully!',"success");
          } else {
            showAlert('Failed to delete profile.',"warning");
          }
        }
      });
    }
}

//load  profile
function list_profile(){
    $.ajax
          ({
            type:'post',
            url:'./dal/dal_profile.php',
            data:{
                list_profile:'list_profile'
              },
              success:function(response){
              debugger;
              if(response){
              document.getElementById('profileTable').innerHTML="";	
              $('#profileTable').append(response);
              $('#profileTable').DataTable();
              }
              else{
              showAlert('Failed to load data.',"danger");
              }
              }
          });
}

$(document).ready(function() {
    list_profile();
});