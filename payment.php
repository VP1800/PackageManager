<div class="w3-card w3-padding w3-white">
<div class="w3-center">
        <h1>Separate Payment Receipt</h1>
    </div>
    <div class="content">
        <div class="w3-card-4 w3-margin">
            <div class="w3-container w3-blue">
                <h2>Payment Receipt Form</h2>
            </div>
            <div class="w3-container w3-padding">
                <form>
                    <div class="w3-row-padding">
                        <div class="w3-col s6">
                            <label for="supplier">Supplier</label>
                            <select class="w3-input" id="supplier">
                                <option value="supplier1">Supplier 1</option>
                                <option value="supplier2">Supplier 2</option>
                                <option value="supplier3">Supplier 3</option>
                                <!-- Add more suppliers as needed -->
                            </select>
                        </div>
                        <div class="w3-col s6">
                            <label for="invoice">Invoice/Challan</label>
                            <select class="w3-input" id="invoice">
                                <option value="invoice1">Invoice 1</option>
                                <option value="invoice2">Invoice 2</option>
                                <option value="invoice3">Invoice 3</option>
                                <!-- Add more invoices as needed -->
                            </select>
                        </div>
                    </div>
                    <div class="w3-row-padding">
                        <div class="w3-col s6">
                            <label for="mode">Mode</label>
                            <select class="w3-input" id="mode">
                                <option>Cash</option>
                                <option>Cheque</option>
                                <option>Online</option>
                            </select>
                        </div>
                        <div class="w3-col s6">
                            <label for="amount">Amount</label>
                            <input type="text" class="w3-input" id="amount">
                        </div>
                    </div>
                    <div class="w3-row-padding">
                        <div class="w3-col s12">
                            <label for="remarks">Remarks</label>
                            <input type="text" class="w3-input" id="remarks">
                        </div>
                    </div>
                    <button type="submit" class="w3-btn w3-blue">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="./jquery/payment.js"></script>