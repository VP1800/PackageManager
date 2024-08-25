//weight keypress
function isFloat(n) {
  return /^\d+(\.\d+)?$/.test(n);
}
$('#length, #width, #gsm').keypress(function(event) {
  var value = $(this).val();
if ((event.which != 46 || value.indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
  event.preventDefault();
  showAlert("Only numbers and decimal points are allowed",'warning');
}
});

//edit sheet
function edit_sheet_data(sheet_weight_id) {
  document.getElementById('sheet_length_span' + sheet_weight_id).style.display = 'none';
  document.getElementById('sheet_length_input' + sheet_weight_id).style.cssText = 'display: block; width: 90%; text-align: center; margin: 0 auto; padding: 5px; border: 1px solid #ccc; border-radius: 5px;';
  document.getElementById('sheet_width_span' + sheet_weight_id).style.display = 'none';
  document.getElementById('sheet_width_input' + sheet_weight_id).style.cssText = 'display: block; width: 90%; text-align: center; margin: 0 auto; padding: 5px; border: 1px solid #ccc; border-radius: 5px;';
  document.getElementById('sheet_gsm_span' + sheet_weight_id).style.display = 'none';
  document.getElementById('sheet_gsm_input' + sheet_weight_id).style.cssText = 'display: block; width: 90%; text-align: center; margin: 0 auto; padding: 5px; border: 1px solid #ccc; border-radius: 5px;';
  document.getElementById('edit_button' + sheet_weight_id).innerHTML = '<i class="fa fa-check fa-fw" title="Save"></i>';
  document.getElementById('edit_button' + sheet_weight_id).setAttribute('onclick', 'save_sheet_data(' + sheet_weight_id + ')');
}
//save edited sheet
function save_sheet_data(sheet_weight_id) {
  var length = document.getElementById('sheet_length_input' + sheet_weight_id).value;
  var width = document.getElementById('sheet_width_input' + sheet_weight_id).value;
  var gsm = document.getElementById('sheet_gsm_input' + sheet_weight_id).value;
  $.ajax({
    type: 'post',
    url: 'dal/dal_sheet_weight.php',
    data: {
      edit_sheetweight: 'edit_sheetweight',
      sheet_weight_id: sheet_weight_id,
        length: length,
        width:width,
        gsm:gsm
    },
    success: function(response) {
      if (response>0) {
        list_sheetweight();
        showAlert('Sheet updated successfully!',"success");
      } else {
        showAlert('Failed to update sheet. Please try again.',"warning");
        return
      }
    }
  });
  document.getElementById('sheet_length_span' + sheet_weight_id).innerHTML = length;
  document.getElementById('sheet_length_span' + sheet_weight_id).style.display = 'block';
  document.getElementById('sheet_length_input' + sheet_weight_id).style.display = 'none';
  document.getElementById('sheet_width_span' + sheet_weight_id).innerHTML = width;
  document.getElementById('sheet_width_span' + sheet_weight_id).style.display = 'block';
  document.getElementById('sheet_width_input' + sheet_weight_id).style.display = 'none';
  document.getElementById('sheet_gsm_span' + sheet_weight_id).innerHTML = gsm;
  document.getElementById('sheet_gsm_span' + sheet_weight_id).style.display = 'block';
  document.getElementById('sheet_gsm_input' + sheet_weight_id).style.display = 'none';
  document.getElementById('edit_button' + sheet_weight_id).innerHTML = '<i class="fa fa-pencil fa-fw" title="Update"></i>';
  document.getElementById('edit_button' + sheet_weight_id).setAttribute('onclick', 'edit_sheet_data(' + sheet_weight_id + ')');
}

//delete sheet
function delete_sheet_data(sheetweight_id) {
  var length = document.getElementById('sheet_length_input' + sheetweight_id).value;
  var width = document.getElementById('sheet_width_input' + sheetweight_id).value;
  var gsm = document.getElementById('sheet_gsm_input' + sheetweight_id).value;
  if (confirm("Are you sure you want to delete this sheet?")) {
    $.ajax({
      type: 'post',
      url: 'dal/dal_sheet_weight.php',
      data: {
        delete_sheetweight:'delete_sheetweight',
        sheetweight_id: sheetweight_id,
        length: length,
        width:width,
        gsm:gsm
      },
      success: function(response) {
        if (response === 'success') {
          // Remove the row from the DataTable
          list_sheetweight();
          showAlert('Sheet deleted successfully!',"success");
        } else {
          showAlert('Failed to delete sheet.',"warning");
        }
      }
    });
  }
}

//load  list
function list_sheetweight(){
$.ajax
      ({
        type:'post',
        url:'dal/dal_sheet_weight.php',
        data:{
            list_sheetweight:'list_sheetweight'
          },
          success:function(response){
          debugger;
          if(response){
          document.getElementById('sheetweightTable').innerHTML="";	
          $('#sheetweightTable').append(response);
          $('#sheetweightTable').DataTable();
          }
          else{
          showAlert('Failed to load data.',"danger");
          }
          }
      });
}

//loading page
$(document).ready(function() {
    $('#length').focus().val('');

    list_sheetweight();
    $('#sheetWeightForm').submit(addsheetWeight); // Attach the additem function to the form's submit event
    function addsheetWeight(event) {
    event.preventDefault(); // Prevent the form from submitting

    // Get form values
    var length = $('#length').val().trim();
    var width = $('#width').val().trim();
    var gsm = $('#gsm').val().trim();

    // Validation (you can add more validation as needed)
    if (length === '') {
      showAlert('Please provide length!','warning');
      $('#length').focus().val(''); // focus on the input and clear it
      return;
    }
    if(!isFloat(length)) {
      showAlert('Please provide a valid length!','warning');
      $('#length').focus().val(''); // focus on the input and clear it
      return;
    }
    if(width === ''){
      showAlert('Please provide width!','warning');
      $('#width').focus().val(''); // focus on the input and clear it
      return;
    }
    if(!isFloat(width)) {
      showAlert('Please provide a valid width!','warning');
      $('#width').focus().val(''); // focus on the input and clear it
      return;
    }
    if(gsm === ''){
      showAlert('Please provide gsm!','warning');
      $('#gsm').focus().val(''); // focus on the input and clear it
      return;
    }
    if(!isFloat(gsm)) {
      showAlert('Please provide a valid gsm!','warning');
      $('#gsm').focus().val(''); // focus on the input and clear it
      return;
    }

    $.ajax
             ({
                type:'post',
	              url:'./dal/dal_sheet_weight.php',
	              data:{
                  add_sheetweight:'add_sheetweight',
		               length:length,
                   width:width,
                   gsm:gsm
		             },
		             success:function(response){
			           debugger;
                 if(response>0){
                  showAlert('Sheet added successfully.',"success");
                  list_sheetweight();
                  $('#length').focus().val('');
                  // document.getElementById('width').value='';
                  // document.getElementById('gsm').value='';
                  $('#width').val('');
                  $('#gsm').val('');
                  
                 }
                 else{
                  showAlert('Failed to add sheet.',"warning");
                 }
		             }
             });
    // Add event listeners to buttons in the new row
    // var editButton = newRow.find('.edit-btn');
    // editButton.on('click', function() {
    //   editSheetWeight(newRow);
    // });

    // var deleteButton = newRow.find('.delete-btn');
    // deleteButton.on('click', function() {
    //   deleteSheetWeight(newRow);
    // });

    // // Append row to table
    // tableBody.append(newRow);

    // // Clear form fields
    // $('#length').val('');
    // $('#weight').val('');

    // // Optional: Display success message or perform other actions after submission
    // alert('Sheet weight added successfully!');
  }

  // Function to handle editing a sheet weight entry
  function editSheetWeight(row) {
    var cells = row.find('td');
    var sheetName = cells.eq(0).text().trim();
    var weight = cells.eq(1).text().trim();

    // Example: You can prompt for new values and update the row
    var newSheetName = prompt('Enter new sheet name or length:', sheetName);
    var newWeight = prompt('Enter new weight (kg):', weight);

    // Update the row if new values are provided
    if (newSheetName!== null && newSheetName.trim()!== '') {
      cells.eq(0).text(newSheetName.trim());
    }
    if (newWeight!== null && newWeight.trim()!== '') {
      cells.eq(1).text(newWeight.trim());
    }
  }

  // Function to handle deleting a sheet weight entry
  function deleteSheetWeight(row) {
    if (confirm('Are you sure you want to delete this sheet weight entry?')) {
      row.remove();
      alert('Sheet weight entry deleted successfully!');
      if ($('#sheetWeightTableBody tr').length == 0) {
        $('#sheetWeightTableBody').append('<tr><td colspan="3" class="w3-center">No data available</td></tr>');
        alert('No data available in the table!');
      }
    }
  }
});