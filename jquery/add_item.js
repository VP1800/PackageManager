//unit keypress
$('#name').on('input', function(event) {
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

//edit item
function edit_item_data(item_id) {
document.getElementById('item_category_span' + item_id).style.display = 'none';
document.getElementById('item_category_input' + item_id).style.cssText = 'display: block; width: 90%; text-align: center; margin: 0 auto; padding: 5px; border: 1px solid #ccc; border-radius: 5px;';
document.getElementById('item_name_span' + item_id).style.display = 'none';
document.getElementById('item_name_input' + item_id).style.cssText = 'display: block; width: 90%; text-align: center; margin: 0 auto; padding: 5px; border: 1px solid #ccc; border-radius: 5px;';
document.getElementById('item_hsn_span' + item_id).style.display = 'none';
document.getElementById('item_hsn_input' + item_id).style.cssText = 'display: block; width: 90%; text-align: center; margin: 0 auto; padding: 5px; border: 1px solid #ccc; border-radius: 5px;';
document.getElementById('item_unit_span' + item_id).style.display = 'none';
document.getElementById('item_unit_input' + item_id).style.cssText = 'display: block; width: 90%; text-align: center; margin: 0 auto; padding: 5px; border: 1px solid #ccc; border-radius: 5px;';
document.getElementById('edit_button' + item_id).innerHTML = '<i class="fa fa-check fa-fw" title="Save"></i>';
document.getElementById('edit_button' + item_id).setAttribute('onclick', 'save_item_data(' + item_id + ')');
}
//save edited sheet
function save_item_data(item_id) {
var category = document.getElementById('item_category_input' + item_id).value;
var name = document.getElementById('item_name_input' + item_id).value;
var hsn = document.getElementById('item_hsn_input' + item_id).value;
var unit = document.getElementById('item_unit_input' + item_id).value;
$.ajax({
  type: 'post',
  url: 'dal/dal_item.php',
  data: {
    edit_item: 'edit_item',
    item_id: item_id,
    category: category,
    name: name,
    hsn: hsn,
    unit: unit
     },
  success: function(response) {
    if (response>0) {
      list_item();
      showAlert('Item updated successfully!',"success");
    } else {
      showAlert('Failed to update item. Please try again.',"warning");
      return
    }
  }
});

document.getElementById('item_category_span' + item_id).style.display = 'block';
document.getElementById('item_category_input' + item_id).style.display = 'none';
// document.getElementById('item_name_span' + item_id).innerHTML = name;
document.getElementById('item_name_span' + item_id).style.display = 'block';
document.getElementById('item_name_input' + item_id).style.display = 'none';
// document.getElementById('item_hsn_span' + item_id).innerHTML = hsn;
document.getElementById('item_hsn_span' + item_id).style.display = 'block';
document.getElementById('item_hsn_input' + item_id).style.display = 'none';
document.getElementById('item_unit_span' + item_id).style.display = 'block';
document.getElementById('item_unit_input' + item_id).style.display = 'none';
document.getElementById('edit_button' + item_id).innerHTML = '<i class="fa fa-pencil fa-fw" title="Update"></i>';
document.getElementById('edit_button' + item_id).setAttribute('onclick', 'edit_sheet_data(' + item_id + ')');
}

//delete item
function delete_item_data(item_id){

  var category = document.getElementById('item_category_input' + item_id).value;
  var name = document.getElementById('item_name_input' + item_id).value;
  var hsn = document.getElementById('item_hsn_input' + item_id).value;
  var unit = document.getElementById('item_unit_input' + item_id).value;
  if (confirm("Are you sure you want to delete this item?")) {
    $.ajax({
      type: 'post',
      url: 'dal/dal_item.php',
      data: {
        delete_item:'delete_item',
        item_id: item_id,
        category: category,
        name: name,
        hsn: hsn,
        unit: unit
      },
      success: function(response) {
        if (response === 'success') {
          // Remove the row from the DataTable
          list_item();
          showAlert('Item deleted successfully!',"success");
        } else {
          showAlert('Failed to delete item.',"warning");
        }
      }
    });
  }
  return;
}

//load  list
function list_item(){
$.ajax
      ({
      type:'post',
      url:'dal/dal_item.php',
      data:{
          list_item:'list_item'
          },
          success:function(response){
          debugger;
          if(response){
          document.getElementById('itemTable').innerHTML="";	
          $('#itemTable').append(response);
          $('#itemTable').DataTable();
          }
          else{
          showAlert('Failed to load data.',"danger");
          }
          }
      });
}

//load unit
function list_unit(){
  $.ajax
      ({
          type:'post',
          url:'dal/dal_item.php',
          data:{
              list_unit:'list_unit'
          },
          success:function(response){
          debugger;
          if(response){
          //   document.getElementById('unit').innerHTML="";	
          $('#unit').append(response);
          }
          else{
          showAlert('Failed to load unit.',"danger");
          }
          }
      });
}

//load page
$(document).ready(function() {
  $('#category').focus();
  list_item();
  list_unit();
  $('#itemForm').submit(additem); // Attach the additem function to the form's submit event
  function additem(event) {
      event.preventDefault(); // Prevent the form from submitting
      // Get form values
      var category = $('#category').val();
      // alert($('#category').val());
      var name = $('#name').val();
      var hsn = $('#hsn').val();
      var unit = $('#unit').val();
      // Validation (you can add more validation as needed)
      if ($('#category').val() == null) {
        showAlert('Please choose category!','warning');
        $('#category').prop('selectedIndex', 0).focus();
        return;
      }
      if(name === ''){
        showAlert('Please provide item name!','warning');
        $('#name').focus().val(''); // focus on the input and clear it
        return;
      }
      // if(hsn === ''){
      //   showAlert('Please provide hsn!','warning');
      //   $('#hsn').focus().val(''); // focus on the input and clear it
      //   return;
      // }
      if ($('#unit').val() == null) {
        showAlert('Please choose unit!','warning');
        $('#unit').prop('selectedIndex', 0).focus();
        return;
      }
      
      $.ajax
               ({
                  type:'post',
                    url:'./dal/dal_item.php',
                    data:{
                    add_item:'add_item',
                    category:category,
                    name:name,
                    hsn:hsn,
                    unit:unit
                    },
                    success:function(response){
                        debugger;
                    if(response>0){
                    list_item();
                    showAlert('Item added successfully.',"success");
                    $('#category').focus().val('');
                    $('#name').val('');
                    $('#hsn').val('');
                    $('#unit').val('');
                   }
                   else{
                    showAlert('Failed to add item.',"warning");
                   }
                       }
               });
    }
});