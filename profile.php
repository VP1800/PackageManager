<div class="w3-card w3-padding w3-white">
    <div class="header">
   <h1>Profile</h1>
  </div></br>
    <form id="profileform">
    <!-- <div id="alert-box" class="w3-danger w3-center w3-padding w3-round w3-hide"></div> -->
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="type">Type</label>
          <Select list="types" name="type" id="type">
          <option value="" disabled selected>Choose Profile Type</option>
            <option value="1">Customer</option>
            <option value="2">Agent/Supplier</option>
            <option value="3">Mill</option>
            <option value="4">Worker</option>
            </Select>
        </div>
        <div class="form-group col-md-6">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" placeholder="Enter your name">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="alias">Alias Name</label>
          <input type="text" id="alias" name="alias" placeholder="Enter alias name">
        </div>
        <div class="form-group col-md-6">
        <label for="states">State</label>
          <select id="states" list="states" name="states">
          </select>
          
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="gstNo">GST Number</label>
          <input type="text" id="gstNo" name="gstNo" placeholder="Enter GST number">
        </div>
        <div class="form-group col-md-6">
        <label for="tallyReg">Tally Reference</label>
        <input type="text" id="tallyReg" name="tallyReg" placeholder="Enter Tally Reference">
        </div>
      </div>
      <div class="form-row">
      <div class="form-group col-md-6">
        <label for="contact">Contact info</label>
        <input type="text" id="contact" name="contact" placeholder="Enter contact information">
      </div>
      <div class="form-group col-md-6">
        <label for="days">Credit Days</label>
        <input type="text" id="days" name="days" placeholder="Enter credit days">
      </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="opening">Opening Balance</label>
          <input type="text" id="opening" name="opening" placeholder="Enter opening balance">
        </div>
        <div class="form-group col-md-6">
          <label for="current">Current Balance</label>
          <input type="text" id="current" name="current" placeholder="Enter current balance" readonly>
        </div>
        </div>
        <div class="form-row">
        <div  class="form-group col-md-6">
        <button type="submit" onclick="addform(event)">Submit</button>
        </div>
      </div>
      
    </form>
</div>
<div class="w3-card w3-padding w3-white w3-margin-top" id="customsetting">
  <hr>
    <!-- Table Section -->
    <h2>Contact Types</h2>
    <table id="contactTable">
      <thead>
        <tr>
          <th>Contact Type</th>
          <th>Particulars</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
          <div class="form-group col-md-6">
            <select id="contactType">
              <option value="email">Email</option>
              <option value="phone">Phone</option>
              <option value="address">Address</option>
            </select>
          </div>
          </td>
          <td>
          <div class="form-group col-md-6">
            <input type="text" id="particulars" placeholder="Enter particulars">
          </div>
          </td>
          <td>
          <div class="w3-center">
            <button class="w3-btn w3-green" onclick="addRow()">Add</button>
          </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
<script src="./jquery/profile.js"></script>