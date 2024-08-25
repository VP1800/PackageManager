<div class="w3-card w3-padding w3-white">
    <div class="w3-center">
        <h1>Issue Tracking</h1>
    </div>
    <br>
    <form>
        <!-- Issue Section -->
        <div class="w3-row-padding">
            <div class="w3-col s2">
                <label for="issue-date">Date</label>
            </div>
            <div class="w3-col s10">
                <input type="date" class="w3-input w3-padding-16 w3-margin-bottom" id="issue-date">
            </div>
        </div>
        <div class="w3-row-padding">
            <div class="w3-col s2">
                <label for="profile">Profile</label>
            </div>
            <div class="w3-col s10">
                <input type="text" class="w3-input w3-padding-16 w3-margin-bottom" id="profile">
            </div>
        </div>
        <div class="w3-row-padding">
            <div class="w3-col s2">
                <label for="remarks">Remarks</label>
            </div>
            <div class="w3-col s10">
                <input type="text" class="w3-input w3-padding-16 w3-margin-bottom" id="remarks">
            </div>
        </div>

        <!-- Table Section -->
        <table class="w3-table w3-bordered">
            <thead>
                <tr>
                    <th>Sheet Dimension</th>
                    <th>Item</th>
                    <th>Sheet Qty</th>
                    <th>Disp Qty</th>
                    <th>Reel No</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" class="w3-input" id="sheet-dimension"></td>
                    <td>
                        <select class="w3-select" id="item" multiple>
                            <option value="adc">ADC</option>
                            <option value="item2">Item 2</option>
                            <option value="item3">Item 3</option>
                            <!-- Add more items as needed -->
                        </select>
                    </td>
                    <td><input type="number" class="w3-input" id="sheet-qty"></td>
                    <td><input type="number" class="w3-input" id="disp-qty"></td>
                    <td>
                        <select class="w3-select" id="reel-no" multiple>
                            <option value="12/1102-18.03kg">12/1102 - 18.03kg</option>
                            <option value="option2">Option 2</option>
                            <option value="option3">Option 3</option>
                            <!-- Add more options as needed -->
                        </select>
                    </td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>

        <button type="submit" class="w3-btn w3-blue">Submit</button>
    </form>
</div>

<div class="w3-card w3-padding w3-white w3-margin-top">
    <h3>Data Table</h3>
    <table id="example" class="display responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <!-- Add your table rows here -->
        </tbody>
    </table>
</div>
<script type="module" src="./jquery/issue_tracking.js"></script>