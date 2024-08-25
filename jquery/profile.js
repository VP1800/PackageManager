//key press
$('#name, #alias').keypress(function(event) {
  var regex = /^[a-zA-Z]$/;
  var key = String.fromCharCode(event.which);
  var currentValue = $(this).val();
  var lastIndex = currentValue.length - 1;
  
  if (key == ' ') {
    if (lastIndex >= 0 && currentValue[lastIndex] == ' ') {
      event.preventDefault();
      return false;
    }
  } else if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});
$('#days').keypress(function(event) {
  var regex = /^[0-9]$/;
  var key = String.fromCharCode(event.which);
  if (!regex.test(key)) {
    event.preventDefault();
    showAlert('Please enter days','warning');
    return false;
  }
});
function isFloat(n) {
  return /^\d+(\.\d+)?$/.test(n);
}
$('#gstNo').keypress(function(event) {
  var regex = /^[a-zA-Z0-9]$/;
  var key = String.fromCharCode(event.which);
  var currentValue = $(this).val();
  var lastIndex = currentValue.length - 1;
  
  if (key == ' ') {
    if (lastIndex >= 0 && currentValue[lastIndex] == ' ') {
      event.preventDefault();
      return false;
    }
  } else if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});
$('#opening').keypress(function(event) {
  var value = $(this).val();
  if ((event.which != 46 || value.indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
    event.preventDefault();
    showAlert('Please enter a valid balance', 'warning');
  }
}).keyup(function() {
  var openingValue = $('#opening').val();
  $('#current').val(openingValue);
});


//load state
function list_state(){
  $.ajax
      ({
          type:'post',
          url:'dal/dal_profile.php',
          data:{
              list_state:'list_state'
          },
          success:function(response){
          debugger;
          if(response){
          //   document.getElementById('unit').innerHTML="";	
          $('#states').html(response);
          }
          else{
          showAlert('Failed to load state.',"danger");
          }
          }
      });
}

//load profile data
function list_profile_data() {
  $.ajax
  ({
    type:'post',
      url:'./dal/dal_profile.php',
      data:{
        set_data:'set_data'
      },
      success:function(response){
      debugger;
      if(response){
        //   document.getElementById('unit').innerHTML="";
        // alert(response);
        // alert(response);
        var data = JSON.parse(response);
        $('#alert-box').text(''); // clear the alert box
        $('#type').val(data.profile_type_id); // select the corresponding type option
        $('#name').val(data.profile_name);
        $('#alias').val(data.profile_alias);
        $('#states').val(data.state); // select the corresponding state option
        $('#gstNo').val(data.gst_no);
        $('#tallyReg').val(data.tally_reference_name);
        $('#contact').val(data.contact_numbers);
        $('#opening').val(data.opening_balance);
        $('#current').val(data.current_balance);
        $('#days').val(data.credit_days);
        
        // $('input').html(response);
        }
        else{
        showAlert('Failed to load profile data.',"danger");
        }
      }
  });
}

//custom setting
function custome_setting() {
  $.ajax
  ({
    type:'post',
      url:'./dal/dal_profile.php',
      data:{
        custome_setting:'custom_setting'
      },
      success:function(response){
      debugger;
      if(response<1){
        $('#customsetting').hide();
        }
        else{
        showAlert('Failed to apply custom setting.',"danger");
        }
      }
  });
}
//add function()
function addform(event) {
  event.preventDefault();
      var formId = $(this).attr('id'); // Get the ID of the submitted form
      // var formData = $(this).serialize(); // Serialize the form data
      var type = $('#type').val();
      var name = $('#name').val();
      var alias = $('#alias').val();
      var states = $('#states').val();
      var tallyReference = $('#tallyReg').val();
      var gstNumber = $('#gstNo').val();
      var contact = $('#contact').val();
      var opening = $('#opening').val() || 0;
      $('#current').val($('#opening').val());
      var days = $('#days').val() || 0;
      var isValid = true;
      // Check if all fields are filled
      if ($('#type').find('option:selected').text() == 'Choose Profile Type') {
        showAlert('Please choose profile type.','warning');
        $('#type').prop('selectedIndex', 0).focus();
        return;
    }
      if (!/^[a-zA-Z\s]+$/.test(name)|| name =="") {
        showAlert('Please provide name.','warning');
        $('#name').focus().val('');
        return;
      }
      if (!/^[a-zA-Z\s]+$/.test(alias) && alias !="") {
        showAlert('Please provide valid aliasname.','warning');
        $('#alias').focus().val('');
        return;
      }
      if ($('#states').find('option:selected').text() == 'Choose State') {
        showAlert('Please choose state.','warning');
        $('#states').prop('selectedIndex', 0).focus();
        return;
    }
      if (!/^[0-9a-zA-Z]+$/.test(gstNumber) && gstNumber !="") {
        showAlert('Please provide valid gst Number.','warning');
        $('#gstNo').focus().val('');
        return;
      }
      if(!/^[0-9]+$/.test(days) && days !="") {
        showAlert('Please provide valid Credit days.','warning');
        $('#days').focus().val('');
        return;
      }
      if (!isFloat(opening) && opening !="") {
        showAlert('Please provide valid opening balance.','warning');
        $('#opening').focus().val('');
        return;
      }
      if (current != opening) {
        current=opening;
      }
      $.ajax
      ({
        type:'post',
          url:'./dal/dal_profile.php',
          data:{
          add_profile:'add_profile',
          type:type,
          name:name,
          alias:alias,
          states:states,
          gstNumber:gstNumber,
          tallyReference:tallyReference,
          contact:contact,
          opening:opening,
          current: current,
          days:days
          },
          success:function(response){
          debugger;
          if(response){
          showAlert('Profile added successfully.',"success");
          $('#type').focus().val('');
          $('#name').val('');
          $('#alias').val('');
          $('#tallyReg').val('');
          $('#gstNo').val('');
          $('#contact').val('');
          $('#opening').val('');
          $('#current').val('');
          $('#days').val('');
          $('#states').val('');
          }
          else{
          showAlert('Failed to add profile.',"warning");
          }
              }
      });
}

//edit function()
function editform(event) {
  event.preventDefault();
      // var formData = $(this).serialize(); // Serialize the form data
      var type = $('#type').val();
      var name = $('#name').val();
      var alias = $('#alias').val();
      var states = $('#states').val();
      var tallyReference = $('#tallyReg').val();
      var gstNumber = $('#gstNo').val();
      var contact = $('#contact').val();
      var opening = $('#opening').val() || 0;
      $('#current').val($('#opening').val());
      var days = $('#days').val() || 0;
      var isValid = true;
      // Check if all fields are filled
      if ($('#type').find('option:selected').text() == 'Choose Profile Type') {
        showAlert('Please choose profile type.','warning');
        $('#type').prop('selectedIndex', 0).focus();
        return;
    }
      if (!/^[a-zA-Z\s]+$/.test(name)|| name =="") {
        showAlert('Please provide name.','warning');
        $('#name').focus().val('');
        return;
      }
      if (!/^[a-zA-Z\s]+$/.test(alias) && alias !="") {
        showAlert('Please provide valid aliasname.','warning');
        $('#alias').focus().val('');
        return;
      }
      if ($('#states').find('option:selected').text() == 'Choose State') {
        showAlert('Please choose state.','warning');
        $('#states').prop('selectedIndex', 0).focus();
        return;
    }
      if (!/^[0-9a-zA-Z]+$/.test(gstNumber) && gstNumber !="") {
        showAlert('Please provide valid gst Number.','warning');
        $('#gstNo').focus().val('');
        return;
      }
      if(!/^[0-9]+$/.test(days) && days !="") {
        showAlert('Please provide valid Credit days.','warning');
        $('#days').focus().val('');
        return;
      }
      if (!isFloat(opening) && opening !="") {
        showAlert('Please provide valid opening balance.','warning');
        $('#opening').focus().val('');
        return;
      }
      if (current != opening) {
        current=opening;
      }
      $.ajax
      ({
        type:'post',
          url:'./dal/dal_profile.php',
          data:{
          edit_profile:'edit_profile',
          type:type,
          name:name,
          alias:alias,
          states:states,
          gstNumber:gstNumber,
          tallyReference:tallyReference,
          contact:contact,
          opening:opening,
          current: current,
          days:days
          },
          success:function(response){
          debugger;
          if(response>0){
          showAlert('Profile updated successfully.',"success");
          redirect('./profile_list.php');
          }
          else{
          showAlert('Failed to update profile.',"warning");
          }
              },
              error: function(xhr, status, error) {
                console.error('Error:', error);
              }
      });
}
//load page
$(document).ready(function() {
  list_state();
  var formId2 = $('#editprofileform').attr('id');
  if(formId2 == 'editprofileform'){
    // debugger;
    list_profile_data();
  }
  var formId1 = $('#profileform').attr('id');
  if(formId1 == 'profileform'){
    // debugger;
    custome_setting();
  }
  $('#type').focus();
});

//add below row
function addRow() {
  const contactType = document.getElementById('contactType').value;
  const particulars = document.getElementById('particulars').value.trim();
  
  if (!particulars) {
    alert("Particulars cannot be empty");
    return;
  }

  const table = document.getElementById('contactTable').getElementsByTagName('tbody')[0];
  const newRow = table.insertRow();

  const contactTypeCell = newRow.insertCell(0);
  const particularsCell = newRow.insertCell(1);
  const actionsCell = newRow.insertCell(2);

  contactTypeCell.textContent = contactType.charAt(0).toUpperCase() + contactType.slice(1);
  particularsCell.textContent = particulars;
  actionsCell.innerHTML = `
    <div class="action-buttons">
      <button class="w3-text-grey w3-hover-text-white w3-center w3-hover-blue w3-button" onclick="editRow(this)"><i class="fa fa-pencil fa-fw" title="Update"></i></button>&nbsp;&nbsp;
      <button class="w3-text-grey w3-hover-text-white we-center w3-hover-red w3-button " onclick="deleteRow(this)"><i class="fa fa-trash fa-fw" title="Delete"></i></button>
    </div>
  `;

  document.getElementById('contactType').value = 'email';
  document.getElementById('particulars').value = '';
}

function editRow(button) {
  const row = button.parentNode.parentNode.parentNode;
  const contactType = row.cells[0].textContent.toLowerCase();
  const particulars = row.cells[1].textContent;

  document.getElementById('contactType').value = contactType;
  document.getElementById('particulars').value = particulars;

  row.remove();
}

function deleteRow(button) {
  const row = button.parentNode.parentNode.parentNode;
  row.remove();
}