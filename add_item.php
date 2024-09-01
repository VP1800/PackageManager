<?php
 require("header.php");
?>
<link rel="stylesheet" href="./css/additem.css">
<div id="main-content">
<div class="p-card w3-padding w3-white">
  <div class="header">
<h1>Item Form</h1>
  </div>
    <form id="itemForm">
    <div class="w3-row">
  <div class="w3-col s2  w3-padding">
    <label for="category">Item Category</label>
    <select class="w3-input w3-border" id="category">
        <option value="" disabled selected>Choose Category</option>
        <option value="1">RM</option>
        <option value="4">RM-paper</option>
        <option value="2">Semi Finished</option>
        <option value="3">FG</option>
    </select>
  </div>
  <div class="w3-col s2 w3-padding">
    <label for="name">Item name</label>
    <input type="text" id="name" name="name" class="w3-input  w3-border" placeholder="Enter Item name">
  </div>
  <div class="w3-col s3 w3-padding">
    <label for="hsn">HSN</label>
    <input type="text" id="hsn" name="hsn" class="w3-input  w3-border" placeholder="Enter HSN">
  </div>
  <div class="w3-col s2 w3-padding">
    <label for="unit">Unit</label>
    <select class="w3-input w3-border" id="unit">
    <!-- <option value="" disabled selected>Choose Unit</option> -->
    </select>
  </div>
  <div class="w3-col s2 w3-padding w3-vertical-align" style="margin-top: 6px;">
  <button type="submit" class="w3-btn w3-blue w3-margin-top" onclick="additem(event)">Add Item</button>
  </div>
</div>
    </form>
</div>
<div class="w3-card w3-padding w3-white w3-margin-top">
    <div class="w3-margin-top w3-center">
   <h1>Item List</h1>
  </div>
  <div class="w3-margin-top w3-center">
            <!-- <h2>Profile List</h2> -->
            <div class="w3-center">
            <table id="itemTable" class="display responsive nowrap" style="width:100%">

            </table>
            </div>
    </div>
</div>
</div>
<?php
 require("./footer.php");
?>
<script type="text/javascript" src="./jquery/add_item.js"></script>