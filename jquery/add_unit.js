

//unit input keypress
$('#unit').on('input', function(event) {
  var regex = /^[a-zA-Z ]*$/;
  var currentValue = $(this).val();

  if (!regex.test(currentValue)) {
    $(this).val(currentValue.slice(0, -1));
    showAlert("Please enter character","warning");
  }

  // prevent multiple consecutive spaces
  if (currentValue.match(/  +/g)) {
    $(this).val(currentValue.replace(/  +/g, ' '));
  }
});

//edit unit
function edit_unit_data(unit_id) {
  document.getElementById('unit_name_span' + unit_id).style.display = 'none';
  document.getElementById('unit_name_input' + unit_id).style.cssText = 'display: block; width: 90%; text-align: center; margin: 0 auto; padding: 5px; border: 1px solid #ccc; border-radius: 5px;';
  document.getElementById('edit_button' + unit_id).innerHTML = '<i class="fa fa-check fa-fw" title="Save"></i>';
  document.getElementById('edit_button' + unit_id).setAttribute('onclick', 'save_unit_data(' + unit_id + ')');
}
//save edited unit
function save_unit_data(unit_id) {
  var unit_name = document.getElementById('unit_name_input' + unit_id).value;
  $.ajax({
    type: 'post',
    url: 'dal/dal_unit.php',
    data: {
      edit_unit: 'edit_unit',
      unit_id: unit_id,
      unit_name:unit_name
    },
    success: function(response) {
      if (response>0) {
        list_unit();
        showAlert('Unit updated successfully!',"success");
      } else {
        showAlert('Failed to update unit. Please try again.',"warning");
        return
      }
    }
  });
  document.getElementById('unit_name_span' + unit_id).innerHTML = unit_name;
  document.getElementById('unit_name_span' + unit_id).style.display = 'block';
  document.getElementById('unit_name_input' + unit_id).style.display = 'none';
  document.getElementById('edit_button' + unit_id).innerHTML = '<i class="fa fa-pencil fa-fw" title="Update"></i>';
  document.getElementById('edit_button' + unit_id).setAttribute('onclick', 'edit_unit_data(' + unit_id + ')');
}

//delete unit
function delete_unit_data(unit_id) {
  var unit_name = document.getElementById('unit_name_input' + unit_id).value;
  if (confirm("Are you sure you want to delete this unit?")) {
    $.ajax({
      type: 'post',
      url: 'dal/dal_unit.php',
      data: {
        delete_unit:'delete_unit',
        unit_id: unit_id,
        unit_name: unit_name
      },
      success: function(response) {
        if (response === 'success') {
          // Remove the row from the DataTable
          list_unit();
          showAlert('Unit deleted successfully!',"success");
        } else {
          showAlert('Failed to delete unit.',"warning");
        }
      }
    });
  }
}

//load  list
function list_unit(){
  $.ajax
        ({
          type:'post',
          url:'dal/dal_unit.php',
          data:{
              list_unit:'list_unit'
            },
            success:function(response){
            debugger;
            if(response){
            document.getElementById('unitTable').innerHTML="";	
            $('#unitTable').append(response);
            $('#unitTable').DataTable();
            }
            else{
            showAlert('Failed to load data.',"danger");
            }
            }
        });
}

//load page
$(document).ready(function() {
  $('#unit').focus().val('');
  list_unit();
  $('#unitForm').submit(addunit); // Attach the addunit function to the form's submit event
  function addunit(event) {
    event.preventDefault();
    var unit_name = $('#unit').val();
    if (!/^[a-zA-Z\s]+$/.test(unit_name)|| unit_name =="") {
      showAlert('Please provide a valid unit.',"warning");
      $('#unit').focus().val('');
      return;
    }
    $.ajax
             ({
                type:'post',
	              url:'dal/dal_unit.php',
	              data:{
		               add_unit:'add_unit',
		               unit_name:unit_name
		             },
		             success:function(response){
			           debugger;
                 if(response>0){
                  showAlert('Unit added successfully.',"success");
                  $('#unit').focus().val('');
                  list_unit();
                 }
                 else{
                  showAlert('Failed to add unit.',"warning");
                 }
		             }
             });//end ajax
  }
});