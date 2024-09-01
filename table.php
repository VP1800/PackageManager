<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- custom css -->
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/responsive.css">
    
    <!-- w3-css -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    
    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <title>Table demo</title>
</head>
<body>
<table id="purchase-table" class="display responsive nowrap" style="width:100%">
  <thead>
    <tr>
      <th>Item</th>
      <th>Qty</th>
      <th>Rate</th>
      <th>Unit</th>
      <th>Taxable</th>
      <th>GST %</th>
      <th>GST</th>
      <th>Total</th>
      <th class="action-column">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th>Total</th>
      <th><input type="number" class="w3-input" id="total-qty" readonly></th>
      <th colspan="2"></th>
      <th><input type="number" class="w3-input" id="total-taxable" readonly></th>
      <th></th>
      <th><input type="number" class="w3-input" id="total-gst" readonly></th>
      <th><input type="number" class="w3-input" id="grand-total" readonly></th>
      <th><span class="button-container">
        <!-- <button type="button" class="w3-btn w3-red remove-row">-</button> -->
        <button type="button" class="w3-btn w3-green add-row">+</button>
      </span>
      </th>
    </tr>
    <tr class="w3-hide">
        <td colspan="9"><select class="w3-input" id="item" name="item" class="item">
            <!-- Add options here -->
          </select></td>
    </tr>
    <!-- More rows will be added here dynamically -->
  </tbody>
</table>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    //load item and unit
function list_item_and_unit(){
  $.ajax({
    type:'post',
    url:'dal/dal_table.php',
    data:{
      list_item_and_unit:'list_item_and_unit'
    },
    success:function(response){
      if(response){
        $('#item').append(response);
        // Add event listener to the item select tag
        $(document).on('change', '#item', function() {
          var selectedOption = $(this).find('option:selected');
          var unitId = selectedOption.data('unit-id');
          var unitName = selectedOption.data('unit-name');
          // Populate the unit select tag
          var unitOptions = `<option value="${unitId}">${unitName}</option>`;
          $('#unit').html(unitOptions);
        });
      }
      else{
        showAlert('Failed to load item.',"danger");
      }
    }
  });
}
</script>
<script>
$(document).ready(function() {
    $(document).on('click', '.add-row', function() {
        var newRow = `<tr>
            <td>
                <select class="w3-input" id="item" name="item[]">
                    <!-- Add options here -->
                </select>
            </td>
            <td><input type="number" class="w3-input" name="qty[]" onchange="calculateTotals()"></td>
            <td><input type="number" class="w3-input" name="rate[]" onchange="calculateTotals()"></td>
            <td>
                <select class="w3-input" id="unit" name="unit[]">
                    <option value="">Select Unit</option>
                    <!-- Add options here -->
                </select>
            </td>
            <td><input type="number" class="w3-input" name="taxable[]" readonly></td>
            <td><input type="number" class="w3-input" name="gst-percentage[]" onchange="calculateTotals()"></td>
            <td><input type="number" class="w3-input" name="gst[]" readonly></td>
            <td><input type="number" class="w3-input" name="total[]" readonly></td>
            <td><span class="button-container">
                    <button type="button" class="w3-btn w3-red remove-row" style="font-size: 12px; padding: 4px 8px;">-</button>
                    <a href="#" class="update-row" title="Update"><i class="fa fa-pencil" style="font-size: 12px;"></i></a>
                </span>
            </td>
        </tr>`;
        $('#purchase-table tbody tr:first').after(newRow);
        list_item_and_unit();
    });

    $(document).on('click', '.remove-row', function() {
        if ($('#purchase-table tbody tr').length > 2) {
            $(this).closest('tr').remove();
            calculateTotals();
        }
    });

    $(document).on('click', '.update-row', function() {
        alert("update");
    });

    function calculateTotals() {
        let totalQty = 0;
        let totalTaxable = 0;
        let totalGST = 0;
        let grandTotal = 0;

        $('#purchase-table tbody tr:not(:first)').each(function() {
            const qty = parseFloat($(this).find('input[name="qty[]"]').val()) || 0;
            const rate = parseFloat($(this).find('input[name="rate[]"]').val()) || 0;
            const taxable = qty * rate;
            const gstPercentage = parseFloat($(this).find('input[name="gst-percentage[]"]').val()) || 0;
            const gst = taxable * (gstPercentage / 100);
            const total = taxable + gst;

            $(this).find('input[name="taxable[]"]').val(taxable.toFixed(2));
            $(this).find('input[name="gst[]"]').val(gst.toFixed(2));
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

    // Call calculateTotals() when the page loads
    calculateTotals();

    // Call calculateTotals() on input event
    $(document).on('input', 'input[name="qty[]"], input[name="rate[]"], input[name="gst-percentage[]"]', function(event) {
        calculateTotals();
    });
});
</script>
</body>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="./jquery/headerfooter.js"></script>
</html>