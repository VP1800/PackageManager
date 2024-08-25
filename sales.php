<div class="w3-card w3-padding w3-white">
    <div class="w3-center">
        <h2>Sales</h2>
    </div>
    <form>
        <!-- Sale Section -->
        <div class="w3-row-padding">
            <div class="w3-col s6">
                <label for="po-no">PO No</label>
                <input type="text" class="w3-input" id="po-no">
            </div>
            <div class="w3-col s6">
                <label for="po-date">PO Date</label>
                <input type="date" class="w3-input" id="po-date">
            </div>
        </div>
        <div class="w3-row-padding">
            <div class="w3-col s6">
                <label for="inv-no">Invoice No</label>
                <input type="text" class="w3-input" id="inv-no">
            </div>
            <div class="w3-col s6">
                <label for="inv-date">Invoice Date</label>
                <input type="date" class="w3-input" id="inv-date">
            </div>
        </div>
        <div class="w3-row-padding">
            <div class="w3-col s6">
                <label for="customer">Customer</label>
                <select class="w3-input" id="customer">
                    <option value="customer1">Customer 1</option>
                    <option value="customer2">Customer 2</option>
                    <option value="customer3">Customer 3</option>
                    <!-- Add more customers as needed -->
                </select>
            </div>
            <div class="w3-col s6">
                <label for="remarks">Remarks</label>
                <input type="text" class="w3-input" id="remarks">
            </div>
        </div>

        <!-- Table Section -->
        <table class="w3-table w3-bordered" id="sales-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Particulars</th>
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
                </tr>
                <!-- More rows will be added here dynamically -->
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Total</th>
                    <th><input type="number" class="w3-input" id="total-qty" readonly></th>
                    <th></th>
                    <th></th>
                    <th><input type="number" class="w3-input" id="total-taxable" readonly></th>
                    <th></th>
                    <th><input type="number" class="w3-input" id="total-gst" readonly></th>
                    <th><input type="number" class="w3-input" id="grand-total" readonly></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        
        <button type="submit" class="w3-btn w3-blue">Submit</button>
    </form>
</div>
<script src="./jquery/sales.js"></script>