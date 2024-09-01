<?php
 require("header.php");
?>
<link rel="stylesheet" href="./css/purchase.css">
<div id="main-content">
<div class="p-card w3-padding w3-white">
  <div class="header">
    <h1>Sheet Weight</h1>
  </div>
    <form id="sheetWeightForm">
    <div class="w3-row">
  <div class="w3-col s3  w3-padding">
    <label for="length">Length</label>
    <input type="text" id="length" name="length" class="w3-input w3-border" placeholder="Enter length">
  </div>
  <div class="w3-col s3 w3-padding">
    <label for="width">Width</label>
    <input type="text" id="width" name="width" class="w3-input  w3-border" placeholder="Enter width">
  </div>
  <div class="w3-col s3 w3-padding">
    <label for="gsm">GSM</label>
    <input type="text" id="gsm" name="gsm" class="w3-input  w3-border" placeholder="Enter gsm">
  </div>
  <div class="w3-col s3 w3-padding w3-vertical-align" style="margin-top: 6px;">
    <button type="submit" onclick="addsheetWeight(event)" class="w3-btn w3-blue w3-margin-top">Add Sheet Weight</button>
  </div>
</div>
    </form>
</div>
<div class="w3-card w3-padding w3-white w3-margin-top">
    <div class="w3-margin-top w3-center">
   <h1>Sheet Weight List</h1>
  </div>
  <div class="w3-margin-top w3-center">
            <!-- <h2>Profile List</h2> -->
            <div class="w3-center">
            <table id="sheetweightTable" class="display responsive nowrap" style="width:100%">

            </table>
            </div>
    </div>
</div>
</div>
<?php
 require("./footer.php");
?>
<script type="text/javascript" src="./jquery/sheetweightform.js"></script>
</body>
</html>