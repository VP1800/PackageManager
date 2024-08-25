// keypress
$('#plocation').blur(function() {
    if ($(this).val() === null) {
        showAlert('Please select a location','warning');
    }
});

$('#po-no, #invoice-no, #inward-no').keypress(function(event) {
    var regex = /^[a-zA-Z0-9-]+$/;
    var charCode = event.which;
    var keyValue = String.fromCharCode(charCode);

    if (!regex.test(keyValue)) {
        event.preventDefault();
        
        return false;
    }
});
$('#po-no, #invoice-no, #inward-no').blur(function() {
    var regex = /^[a-zA-Z0-9-]+$/;
    var value = $(this).val();

    if (value === "" || !regex.test(value)) {
        showAlert('Enter valid NO','warning');
        return false;
    }
});
var currentDate = new Date();
var maxDate = currentDate.toISOString().split('T')[0];
$('#po-date,#inward-date,#invoice-date').attr('max', maxDate);
$('#po-date,#inward-date,#invoice-date').on('blur', function() {
    var currentDate = new Date();
    var currentDateFormatted = currentDate.toISOString().split('T')[0];
    var enteredDate = new Date($(this).val());

    if ($(this).val() === '' || enteredDate > currentDate) {
        $(this).val(currentDateFormatted); // set the current date as the value
        showAlert('Invalid date','warning');
    } else if (!enteredDate instanceof Date) {
        showAlert('Invalid date format','warning');
    }
    if ($(this).is('#inward-date')) {
        var inwardDate = $(this).val();
        updateDueDate(inwardDate);
        document.getElementById('supplier-info').style.display = 'none';
    }
});

//load  supplier
function updateDueDate(inwardDate) {
    $.ajax({
        type: 'post',
        url: 'dal/dal_purchase.php',
        data: {
            due_date: 'due_date',
            inward_date: inwardDate
        },
        success: function(response) {
            debugger;
            if (response) {
                $('#supplier-list').val('');
                $('#supplier').empty().append(response);
            } else {
                showAlert('Failed to load Due Date.', "danger");
            }
        }
    });
}
$('#supplier-list').on('blur', function(event) {
    var supplierName = $(this).val();
    if (supplierName === "") {
        showAlert('Please provide supplier name!', 'warning');
    } else {
        supplier_validation(supplierName, function(isValid) {
            if (!isValid) {
                showAlert('Invalid supplier name!', 'warning');
                $(this).val('');
            }
        });
    }
});
function supplier_validation(supplierName, callback) {
    $.ajax({
        type: 'POST',
        url: 'dal/dal_purchase.php',
        data: { verify_supplier: supplierName },
        success: function(response) {
            if (response === 'true') {
                callback(true);
            } else {
                showAlert('Invalid supplier name!', 'warning');
                $('#supplier-list').val('');
                callback(false);
            }
        }
    });
}

$('#mill-list').on('blur', function(event) {
    var millName = $(this).val();
    if (millName === "") {
        showAlert('Please provide mill name!', 'warning');
    } else {
        mill_validation(millName, function(isValid) {
            if (!isValid) {
                showAlert('Invalid mill name!', 'warning');
                $(this).val('');
            }
        });
    }
});

function mill_validation(millName, callback) {
    $.ajax({
        type: 'POST',
        url: 'dal/dal_purchase.php',
        data: { verify_mill: millName },
        success: function(response) {
            if (response === 'true') {
                callback(true);
            } else {
                showAlert('Invalid mill name!', 'warning');
                $('#mill-list').val('');
                callback(false);
            }
        }
    });
}


$('#remarks').on('blur', function(event) {
    if ($(this).val() === "") {
        showAlert('Please provide remark!','warning');
    }
});
$('#tdetail').on('blur', function(event) {
    if ($(this).val() === "") {
        showAlert('Please provide transport details!','warning');
    }
});

$('#vehicleno').keypress(function(event) {
    var charCode = event.which;
    var vehicleNo = $(this).val();
    var cursorPosition = $(this)[0].selectionStart;
  
    // Allow only alphanumeric characters and backspace
    if (charCode == 8) {
      return true; // Allow backspace
    }
  
    if (cursorPosition == 0 || cursorPosition == 1 || cursorPosition == 4 || cursorPosition == 5) {
      if (charCode >= 97 && charCode <= 122) {
        event.preventDefault();
        $(this).val(vehicleNo.substring(0, cursorPosition) + String.fromCharCode(charCode - 32) + vehicleNo.substring(cursorPosition));
      } else if (charCode >= 48 && charCode <= 57) {
        event.preventDefault(); // Prevent numbers in first two positions
      }
    } else if (cursorPosition <= 9) {
      if (charCode >= 48 && charCode <= 57) {
        $(this).val(vehicleNo.substring(0, cursorPosition) + String.fromCharCode(charCode) + vehicleNo.substring(cursorPosition));
      } else {
        event.preventDefault(); // Prevent non-numeric characters
      }
    } else {
      event.preventDefault(); // Prevent characters beyond 10th position
    }
});

$('#vehicleno').blur(function() {
    var vehicleNo = $(this).val().toUpperCase(); // Convert to uppercase
    if (vehicleNo === ''){
      showAlert('Please enter a vehicle number','warning');
      return;
    } else if (vehicleNo.length !== 10) {
      showAlert('Vehicle number should be 10 characters long','warning');
      return;
    } else if (!/^[A-Z]{2}[0-9]{1,2}[A-Z]{1,2}[0-9]{1,4}$/.test(vehicleNo)) {
      showAlert('Invalid Vehicle Number format!','warning');
      return;
    }
    $(this).val(vehicleNo);
});

$('#tname').on('blur', function(event) {
    if ($(this).val() === "") {
        showAlert('Please provide transport name!','warning');
    }
});
//edit Purchase
  
//delete Purchase
  

  
//load mill
function mill(){
    $.ajax
        ({
            type:'post',
            url:'dal/dal_purchase.php',
            data:{
                list_mill:'list_mill'
            },
            success:function(response){
            debugger;
            if(response){
            $('#mill').append(response);
            }
            else{
            showAlert('Failed to load mill.',"danger");
            }
            }
    });
}
document.getElementById('supplier-list').addEventListener('input', function() {
    var selectedOption = document.querySelector('option[value="' + this.value + '"]');
    if (selectedOption) {
      var dueDate = selectedOption.getAttribute('data-duedate');
      var outstanding = selectedOption.textContent.split('Outstanding: ')[1];
      var p_id = selectedOption.getAttribute('data-supplierid');
  
      document.getElementById('supplier_id').textContent = 'Supplier_id: ' + p_id;
      document.getElementById('due-date').textContent = dueDate;
      document.getElementById('outstanding').textContent = outstanding;
      document.getElementById('supplier-info').style.display = 'block';
    } else {
      document.getElementById('supplier_id').textContent = '';
      document.getElementById('due-date').textContent = '';
      document.getElementById('outstanding').textContent = '';
      document.getElementById('supplier-info').style.display = 'none';
    }
  });

document.getElementById('mill-list').addEventListener('input', function() {
    var selectedOption = document.querySelector('option[value="' + this.value + '"]');
    if (selectedOption) {
        var p_id = selectedOption.getAttribute('data-millid');
        document.getElementById('mill_id').textContent = 'Mill_id: ' + p_id;
    }
});
  //load page
$(document).ready(function() {
    $('#plocation').focus();
    var currentDate = new Date();
    var month = currentDate.getMonth() + 1;
    var day = currentDate.getDate();
    var formattedDate = currentDate.getFullYear() + '-' + (month < 10 ? '0' + month : month) + '-' + (day < 10 ? '0' + day : day);
    $('#inward-date').attr('value', formattedDate);
    var inwardDate = $(this).val();
    updateDueDate(inwardDate);
    mill();
    $('#purchaseForm').submit(addpurchase); // Attach the additem function to the form's submit event
    function addpurchase(event) {
    event.preventDefault(); // Prevent the form from submitting
    // Get form values
    var pLocation = $('#plocation').val();
    var poNo = $('#po-no').val();
    var poDate = $('#po-date').val();
    var poDateObject = new Date(poDate);
    var invoiceNo = $('#invoice-no').val();
    var invoiceDate = $('#invoice-date').val();
    var invoiceDateObject = new Date(invoiceDate);
    var inwardNo = $('#inward-no').val();
    var inwardDate = $('#inward-date').val();
    var inwardDateObject = new Date(inwardDate);
    var supplier = $('#supplier-list').val();
    var supplierIdText = $('#supplier_id').text();
    var dueDateText = $('#due-date').text();
    var supplier_id = supplierIdText.replace('Supplier_id: ', '');
    var duedate = dueDateText.replace('Due Date: ', '');
    var mill = $('#mill-list').val();
    var millIdText = $('#mill_id').text();
    var mill_id = millIdText.replace('Mill_id: ', '');
    var remarks = $('#remarks').val();
    var transportDetails = $('#tdetail').val();
    var vehicleNo = $('#vehicleno').val();
    var transportName = $('#tname').val();
    var totalamt = 0;   //$('#grand-total').val()
    var discount = 0;   //to be changed
    var p_net = 0;  //to be changed
    if (pLocation == null) {
        showAlert(duedate,'warning');
        // $('#pLocation').focus();
        showAlert('Please choose location!','warning');
        return;
    }
    if(poNo === '' || !poNo.match(/^[a-zA-Z0-9-]+$/)){
        showAlert('Please enter valid PO Number!','warning');
        $('#po-no').focus().val('');
        return;
    }
    if(poDate === '' || poDateObject > currentDate){
        showAlert('Please enter PO Date!','warning');
        $('#po-date').focus().val('');
        return;
    }
    if(invoiceNo === '' || !invoiceNo.match(/^[a-zA-Z0-9-]+$/)){
        showAlert('Please enter valid Invoice Number!','warning');
        $('#invoice-no').focus().val('');
        return;
    }
    if(invoiceDate === '' || invoiceDateObject > currentDate){
        showAlert('Please enter valid Invoice Date!','warning');
        $('#invoice-date').focus().val('');
        return;
    }
    if(inwardNo === '' || !inwardNo.match(/^[a-zA-Z0-9-]+$/)){
        showAlert('Please enter valid Inward Number!','warning');
        $('#inward-no').focus().val('');
        return;
    }
    if(inwardDate === '' || inwardDateObject > currentDate){
        showAlert('Please enter valid Inward Date!','warning');
        $('#supplier-list').val('');
        $('#inward-date').focus().val('');
        return;
    }
    if(!supplier){
        showAlert('Please choose Supplier!','warning');
        $('#supplier-list').focus();
        return;
    }
    supplier_validation(supplier, function(isValid) {
        if (!isValid) {
            showAlert('Please enter valid Supplier Name!', 'warning');
            return;
        }
    });
    if(duedate === null || outstanding ===null){
        showAlert('Supplier is not valid!','warning');
        $('#remarks').focus().val('');
        return;
    }
    if(!mill){
        showAlert('Please choose Mill!','warning');
        $('#mill-list').focus().val('');
        return;
    }
    mill_validation(mill, function(isValid) {
        if (!isValid) {
            showAlert('Please enter valid Mill Name!', 'warning');
            return;
        }
    });
    if(remarks === ''){
        showAlert('Please enter Remarks!','warning');
        $('#remarks').focus().val('');
        return;
    }
    if(transportDetails === ''){
        showAlert('Please enter Transport Details!','warning');
        $('#tdetail').focus().val('');
        return;
    }
    if(vehicleNo === ''){
        showAlert('Please enter Vehicle Number!','warning');
        $('#vehicleno').focus().val('');
        return;
    }else if (!/^[A-Z]{2}[0-9]{1,2}[A-Z]{1,2}[0-9]{1,4}$/.test(vehicleNo)) {
        showAlert('Invalid Vehicle Number format!','warning');
        $('#vehicleno').focus().val('');
        return;
      }
    if(transportName === ''){
        showAlert('Please enter Transport Name!','warning');
        $('#tname').focus().val('');
        return;
    }
    $.ajax({
        type:'post',
        url:'./dal/dal_purchase.php',
        data:{
            duplicatechecker: 'duplicatechecker',
            inwardNo: inwardNo,
            inwardDate: inwardDate,
            supplier_id: supplier_id
        },
        success:function(response){
            debugger;
            if(response === 'true'){
                showAlert("Duplicate record found!",'warning');
                return;
            }
            else if(response != 'false'){
                showAlert("Query failed","warning");
                return;
            }
        }
    });
    
    $.ajax
                ({
                type:'post',
                    url:'./dal/dal_purchase.php',
                    data:{
                    add_purchase: 'add_purchase',
                    pLocation: pLocation,
                    poNo:poNo,
                    poDate:poDate,
                    invoiceNo: invoiceNo,
                    invoiceDate: invoiceDate,
                    inwardNo: inwardNo,
                    inwardDate: inwardDate,
                    supplier_id: supplier_id,
                    duedate: duedate,
                    mill: mill,
                    remarks: remarks,
                    transportDetails: transportDetails,
                    vehicleNo: vehicleNo,
                    transportName: transportName,
                    totalamt: totalamt,
                    discount: discount,
                    p_net: p_net
                    },
                    success:function(response){
                        debugger;
                    if(response>0){
                    showAlert('Purchase added successfully.',"success");
                    $('#p_location').focus().val('');
                    $('#po-no').val('');
                    $('#po-date').val('');
                    $('#invoice-no').val('');
                    $('#invoice-date').val('');
                    $('#inward-no').val('');
                    $('#inward-date').val('');
                    $('#supplier').val('');
                    $('#mill').val('');
                    $('#remarks').val('');
                    $('#tdetail').val('');
                    $('#vehicleno').val('');
                    $('#tname').val('');
                    }
                    else{
                    showAlert('Failed to add purchase.',"warning");
                    }
                        }
                });
    }
});


//check
$(document).ready(function() {
    $(document).on('click', '.add-row', function() {
        var newRow = `<tr>
            <td><input type="text" class="w3-input" name="item[]"></td>
            <td><input type="text" class="w3-input" name="particulars[]"></td>
            <td><input type="number" class="w3-input" name="qty[]" onchange="calculateTotals()"></td>
            <td><input type="number" class="w3-input" name="rate[]" onchange="calculateTotals()"></td>
            <td><input type="text" class="w3-input" name="unit[]"></td>
            <td><input type="number" class="w3-input" name="taxable[]" onchange="calculateTotals()"></td>
            <td><input type="number" class="w3-input" name="gst-percentage[]" onchange="calculateTotals()"></td>
            <td><input type="number" class="w3-input" name="gst[]" onchange="calculateTotals()"></td>
            <td><input type="number" class="w3-input" name="total[]" readonly></td>
            <td><button type="button" class="w3-btn w3-red remove-row">-</button>
            <button type="button" class="w3-btn w3-green add-row">+</button></td>
        </tr>`;
        $('#sales-table tbody').append(newRow);
    });

    $(document).on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
        calculateTotals();
    });
});

function calculateTotals() {
    let totalQty = 0;
    let totalTaxable = 0;
    let totalGST = 0;
    let grandTotal = 0;

    $('#sales-table tbody tr').each(function() {
        const qty = parseFloat($(this).find('input[name="qty[]"]').val()) || 0;
        const rate = parseFloat($(this).find('input[name="rate[]"]').val()) || 0;
        const taxable = parseFloat($(this).find('input[name="taxable[]"]').val()) || 0;
        const gstPercentage = parseFloat($(this).find('input[name="gst-percentage[]"]').val()) || 0;
        const gst = parseFloat($(this).find('input[name="gst[]"]').val()) || 0;

        const total = taxable + gst;

        $(this).find('input[name="total[]"]').val(total.toFixed(2));

        totalQty += qty;
        totalTaxable += taxable;
        totalGST += gst;
        grandTotal += total;
    });

    $('#total-qty').val(totalQty.toFixed(2));
    $('#total-taxable').val(totalTaxable.toFixed(2));
    $('#total-gst').val(totalGST.toFixed(2));
    $('#grand-total').val(grandTotal.toFixed(2));
}