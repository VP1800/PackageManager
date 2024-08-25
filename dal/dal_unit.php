<?php
require 'dal_db.php';
require 'dal_load_data.php';
//query to add unit
if (isset($_POST['add_unit'])) {
    $adduserdate=date('y/m/d h:m:s');
    mysqli_query($con, "set @p_unit_id =0");
    $unit_result = mysqli_query($con,"CALL unit(@p_unit_id,'$_POST[unit_name]',1,1,1,'$adduserdate',1)");
    //echo "CALL dispatch_pert(@dispatch_pert_id,'$_POST[warehouse_unit_id]','$_POST[outlet_unit_id]','$_POST[item_name]','$_POST[hsn_code]','$_POST[stripcode]','$_POST[barcode]','$_POST[box_no]','$_POST[item_qty]','$_POST[item_dp]','$_POST[item_amt]','$_POST[item_discount]','$_POST[tax]','$_POST[taxable]','$_POST[tax_amt]','$_POST[net_payable]',1,'$adduserdate','$_POST[mode]')";
    $unit_list = mysqli_query($con,"SELECT @p_unit_id");
    
    $unit_row = mysqli_fetch_assoc($unit_list);
    echo $unit_row['@p_unit_id'];
    mysqli_close($con);
    exit();
}

//query to edit unit
if (isset($_POST['edit_unit'])) {
    $adduserdate=date('y/m/d h:m:s');
    mysqli_query($con, "set @p_unit_id =".$_POST['unit_id']);
    $unit_result = mysqli_query($con,"CALL unit(@p_unit_id,'$_POST[unit_name]',1,1,1,'$adduserdate',2)");
    $unit_list = mysqli_query($con,"SELECT @p_unit_id");
    
    $unit_row = mysqli_fetch_assoc($unit_list);
    echo $unit_row['@p_unit_id'];
    mysqli_close($con);
    exit();
}

//query to delete unit
if (isset($_POST['delete_unit'])) {
    $adduserdate=date('y/m/d h:m:s');
    mysqli_query($con, "set @p_unit_id =".$_POST['unit_id']);
    $unit_result = mysqli_query($con,"CALL unit(@p_unit_id,'$_POST[unit_name]',1,1,1,'$adduserdate',3)");

    echo "success";
    mysqli_close($con);
    exit();
}
//query to display unit
if (isset($_POST['list_unit'])) {
    $datatablelist = get_data("unit_id,unit_name","tbl_unit");
	$datatablerowid = 0;
	$output ='<thead>
                <tr>
                    <th scope="col">Sr. no.</th>
                    <th scope="col" class="w3-hide">Unit id</th>
                    <th scope="col">Unit Name</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>';
		       if(isset($datatablelist)){
			     while($unit_data_row = mysqli_fetch_array($datatablelist)){
			       $datatablerowid++;
				   //$set_outlet_db_session = $unit_data_row['outlet_db'];
				   $output =$output.'<tr>
                   <td  class="w3-center">'.$datatablerowid.'</td>
                    <td class="w3-center w3-hide">'.$unit_data_row['unit_id'].'</td>
				    <td class="w3-center">
                        <span id="unit_name_span' . $unit_data_row['unit_id'] . '">' . $unit_data_row['unit_name'] . '</span>
                        <input type="text" id="unit_name_input' . $unit_data_row['unit_id'] . '" value="' . $unit_data_row['unit_name'] . '" style="display: none;">
                    </td>
					<td  class="w3-center">';
                    $output = $output . '<button href="#" class="w3-text-grey w3-hover-text-white w3-center w3-hover-blue w3-button" id="edit_button' . $unit_data_row['unit_id'] . '" onclick="edit_unit_data(' . $unit_data_row['unit_id'] . ')"><i class="fa fa-pencil fa-fw" title="Update"></i></button>&nbsp;&nbsp;';
                    $output =$output.'<button href="#" class="w3-text-grey w3-hover-text-white we-center w3-hover-red w3-button " id="delete_button'.$unit_data_row['unit_id'].'" onclick="delete_unit_data('.$unit_data_row['unit_id'].')"><i class="fa fa-trash fa-fw" title="Delete"></i></button>';
                    $output =$output.'</td>
				</tr>';
			   }  
		       $output =$output."</tbody>";
			   //$_SESSION['outlet_db_name_in_dispatch']=$set_outlet_db_session;
		      }
		      echo $output;
              mysqli_close($con);
              exit();
}
?>
<!-- call item(bigint p_item_id, tinyint p_item_category, varchar p_item_name, varchar p_hsn_code, int p_cmpid, int p_yid, int p_adduserid, datetime p_adduserdate, int p_mode);
call unit(int p_unit_id, varchar p_unit_name, int p_cmpid, int p_yid, int p_adduserid, datetime p_adduserdate, int p_mode); -->