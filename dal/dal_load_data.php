<?php
	//require ('/dal_db.php' );
function get_data($Cols, $Table) {	
	include ('dal_db.php');
	mysqli_query ($con,"set character_set_results='utf8'");   
	$select=mysqli_query($con,"select " . $Cols . " from " . $Table);
	//print_r ($select);
	//echo "1. ".$Cols;
	//echo "2. ".$Table."<br>";
	if (!$select) {
		echo "Error: ". mysqli_error($con);
		return null;
	}
	if(mysqli_num_rows($select) > 0){
		return $select;
	}else{
		return null;
	}
}

function execute_query_and_retunvalue($column, $table_name_where_condition, $return_val) {
  include 'dal_db.php';
  $query = "Select " . $column . " From " . $table_name_where_condition;
  //echo $query . '<br>';
  mysqli_query($con, "set character_set_results='utf8'");
  $result = mysqli_query($con, $query);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    return $row[$return_val];
  }
  mysqli_close($con);
}
?>