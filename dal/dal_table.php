<?php
//query to display item
require 'dal_db.php';
require 'dal_load_data.php';
if (isset($_POST['list_item_and_unit'])) {
    $datatablelist = get_data("i.item_id,i.item_name,u.unit_id,u.unit_name","tbl_item i INNER JOIN tbl_unit u ON i.unit_id = u.unit_id");
    $datatablerowid = 0;
    if(isset($datatablelist)){
        $output='<option value="" disabled selected>Choose item</option>';
        while($item_data_row = mysqli_fetch_array($datatablelist)){
            $output =$output.'<option value="'. $item_data_row['item_id'] .'" data-unit-id="'. $item_data_row['unit_id'] .'" data-unit-name="'. $item_data_row['unit_name'] .'">' . $item_data_row['item_name'] .'</option>';
        }  
    }
    echo $output;
    mysqli_close($con);
    exit();
}
?>