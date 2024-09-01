<?php
 require("header.php");
?>
<link rel="stylesheet" href="./css/addunit.css">
<div id="main-content">
<div class="p-card w3-padding w3-white">
  <div class="header">
<h1>Unit Form</h1>
  </div>
    <form id="unitForm">
    <div class="form-row">
        <div class="form-group">
        <!-- <label for="unit">Unit</label> -->
        <input type="text" id="unit" class="unit" name="unit" placeholder="Enter unit">
        </div>
        <div  class="form-group">
            <button type="submit" onclick="addunit(event)" class="submit w3-btn w3-blue">Add unit</button>
        </div>
      </div>
    </form>
</div>
<div class="w3-card w3-padding w3-white w3-margin-top">
    <div class="w3-margin-top w3-center">
   <h1>Units List</h1>
  </div>
  <div class="w3-margin-top w3-center">
            <!-- <h2>Profile List</h2> -->
            <div class="w3-center">
            <table id="unitTable" class="display responsive nowrap" style="width:100%">

            </table>
            </div>
    </div>
</div>
</div>
<?php
 require("./footer.php");
?>
<script type="text/javascript" src="./jquery/add_unit.js"></script>
</body>
</html>