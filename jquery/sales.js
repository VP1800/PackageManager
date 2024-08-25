$(document).ready(function() {
    $(document).on('click', '.add-row', function() {
        var newRow = `<tr>
            <td><input type="text" class="form-control" name="item[]"></td>
            <td><input type="text" class="form-control" name="particulars[]"></td>
            <td><input type="number" class="form-control" name="qty[]" onchange="calculateTotals()"></td>
            <td><input type="number" class="form-control" name="rate[]" onchange="calculateTotals()"></td>
            <td><input type="text" class="form-control" name="unit[]"></td>
            <td><input type="number" class="form-control" name="taxable[]" onchange="calculateTotals()"></td>
            <td><input type="number" class="form-control" name="gst-percentage[]" onchange="calculateTotals()"></td>
            <td><input type="number" class="form-control" name="gst[]" onchange="calculateTotals()"></td>
            <td><input type="number" class="form-control" name="total[]" readonly></td>
            <td><button type="button" class="btn btn-danger remove-row">-</button>
            <button type="button" class="btn btn-success add-row">+</button></td>
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