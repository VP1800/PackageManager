<div class="w3-card w3-padding w3-white">
    <div class="w3-center">
    <h1>Purchase</h1>
  </div></br>
    <form id="purchaseForm">
    <div class="w3-row">
  <div class="w3-col s3  w3-padding">
    <label for="plocation">Purchase Location</label>
    <select class="w3-input" id="plocation" class="w3-input w3-border">
      <option value="" disabled selected>Choose Location</option>
                <option value="A">A</option>
                <option value="B">B</option>
    </select>
  </div>
  <div class="w3-col s3  w3-padding">
    <label for="po-no">PO No</label>
    <input type="text" id="po-no" class="w3-input w3-border" placeholder="Enter po-no">
  </div>
  <div class="w3-col s3 w3-padding">
    <label for="po-date">PO Date</label>
    <input type="date" id="po-date" class="w3-input w3-border" id="po-date" placeholder="Enter po-date">
  </div>
</div>
    <div class="w3-row">
  <div class="w3-col s3 w3-padding">
    <label for="invoice-no">Invoice/Challan No</label>
    <input type="text" id="invoice-no" class="w3-input w3-border" placeholder="Enter Invoice/Challan no.">
  </div>
  <div class="w3-col s3 w3-padding">
    <label for="invoice-date">Invoice Date</label>
    <input type="date" id="invoice-date" class="w3-input w3-border" placeholder="Enter Innvoice date">
  </div>
  <div class="w3-col s3 w3-padding">
    <label for="inward-no">Inward No</label>
    <input type="text" id="inward-no" class="w3-input w3-border" placeholder="Enter Inward no.">
  </div>
  <div class="w3-col s3 w3-padding">
    <label for="inward-date">Inward Date</label>
    <input type="date" id="inward-date" class="w3-input w3-border" placeholder="Enter Inward date">
  </div>
</div>
<div class="w3-row">
<div class="w3-col s3 w3-padding">
  <label for="supplier-list">Supplier</label>
  <input list="supplier" id="supplier-list" class="w3-input w3-border" placeholder="Enter supplier">
<datalist id="supplier">
  <!-- Add more options here -->
</datalist>
<div class="menu" id="supplier-info" style="display: none;">
  <div class="nav-login name-cont" style="display: none;" id="supplier_id"></div>
  <i class="fa fa-fw fa-calendar-o"></i><span id="due-date"></span>&nbsp;
  <i class="fa fa-fw fa-money"></i><span id="outstanding"></span>
</div>
</div>

    <div class="w3-col s3 w3-padding">
        <label for="mill-list">Mill</label>
        <input list="mill" id="mill-list" class="w3-input w3-border" placeholder="Enter mill">
  <datalist id="mill">
    <!-- Add more options here -->
  </datalist>
  <p id="mill_id" class="w3-hide"></p>  
    </div>

    <div class="w3-col s6 w3-padding">
        <label for="remarks">Remarks</label>
        <input type="text" id="remarks" class="w3-input w3-border" placeholder="Enter Remark" >
    </div>
    
</div>
<div class="w3-row">
<div class="w3-col s3 w3-padding">
        <label for="tdetail">Transport Details</label>
        <input type="text" id="tdetail" class="w3-input w3-border" placeholder="Enter Transport Detail" >
    </div>
    <div class="w3-col s3 w3-padding">
        <label for="vehicleno">Vehicle No</label>
        <input type="text" id="vehicleno" class="w3-input w3-border" placeholder="Enter Vehicle No. (MH00AB0000)" >
    </div>
    <div class="w3-col s3 w3-padding">
        <label for="tname">Transport Name</label>
        <input type="text" id="tname" class="w3-input w3-border" placeholder="Enter Transport name" >
    </div>
    <div class="w3-col s3 w3-padding" style="margin-top: 6px;">
    <button type="submit" class="w3-btn w3-blue w3-margin-top" style="width:100%;">Submit</button>
    </div>
</div>  
    </form>
</div>

<div class="w3-card w3-padding w3-white w3-margin-top">
    <h3>Data Table</h3>
    <table id="example" class="display responsive nowrap" style="width:100%">
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
                            <td><span class="button-container">
    <button type="button" class="w3-btn w3-red remove-row">-</button>
    <button type="button" class="w3-btn w3-green add-row">+</button>
  </span></td>
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
            <table class="w3-table w3-bordered w3-hide">
                <thead>
                    <tr>
                        <th colspan="1">Item</th>
                        <th>Rate</th>
                        <th>Taxable</th>
                        <th>GST %</th>
                        <th>GST</th>
                        <th>Net</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <tr class="w3-hide">
                        <td colspan="1">
                            <select class="w3-input" id="item">
                                <option value="item1">Item 1</option>
                                <option value="item2">Item 2</option>
                                <option value="item3">Item 3</option>
                                <!-- Add more items as needed -->
                            </select>
                        </td>
                        <td><input type="number" class="w3-input w3-border" id="rate"></td>
                        <td><input type="number" class="w3-input w3-border" id="taxable"></td>
                        <td><input type="number" class="w3-input w3-border" id="gst-percentage"></td>
                        <td><input type="number" class="w3-input w3-border" id="gst"></td>
                        <td><input type="number" class="w3-input w3-border" id="net"></td>
                        <td><button href="#" class="w3-text-grey w3-hover-text-white w3-center w3-hover-blue w3-button" id="add_button" onclick=""><i class="fa fa-plus fa-fc" title="Add"></i></button></td>
                </tr>
                <tr class="w3-hide">
                        <td></td>
                        <td><input type="number" class="w3-input w3-border" id="totaltaxable"></td>
                        <td></td>
                        <td></td>
                        <td><input type="number" class="w3-input w3-border" id="totalgst"></td>
                        <td><input type="number" class="w3-input w3-border" id="totalnet"></td>
                        <td></td>
                </tr>
                    <!-- Add more rows as needed -->
                </tbody>
                <tfoot>
                        <tr>
                            <th colspan="2">Total</th>
                            <th><input type="number" class="w3-input" id="total-taxable" readonly></th>
                            <th></th>
                            <th><input type="number" class="w3-input" id="total-gst" readonly></th>
                            <th><input type="number" class="w3-input" id="grand-total" readonly></th>
                            <th></th>
                        </tr>
                    </tfoot>
            </table>
    </table>
</div>
<script src="./jquery/purchase.js"></script>