<?php
require 'dal_db.php';
require 'dal_load_data.php';
//query to add item
if (isset($_POST['add_purchase'])) {
    $adduserdate=date('y/m/d h:m:s');
    mysqli_query($con, "set @p_purchase_id=0");
    $purchase_result = mysqli_query($con,"CALL purchase(@p_purchase_id,'$_POST[pLocation]',0,'$_POST[poNo]','$_POST[poDate]','$_POST[invoiceNo]','$_POST[invoiceDate]','$_POST[inwardNo]','$_POST[inwardDate]',$_POST[supplier_id],'$_POST[duedate]','$_POST[mill]','$_POST[transportDetails]','$_POST[vehicleNo]','$_POST[transportName]','$_POST[remarks]',$_POST[totalamt],$_POST[discount],$_POST[p_net],1,1,1,'$adduserdate',1)");
    // echo "set set @p_purchase_id=0;CALL purchase(@p_purchase_id,'$_POST[pLocation]',0,'$_POST[poNo]','$_POST[poDate]','$_POST[invoiceNo]','$_POST[invoiceDate]','$_POST[inwardNo]','$_POST[inwardDate]',$_POST[supplier_id],'$_POST[duedate]','$_POST[mill]','$_POST[transportDetails]','$_POST[vehicleNo]','$_POST[transportName]','$_POST[remarks]',$_POST[totalamt],$_POST[discount],$_POST[p_net],1,1,1,'$adduserdate',1)";
    $purchase_list = mysqli_query($con,"SELECT @p_purchase_id");
    $purchase_row = mysqli_fetch_assoc($purchase_list);
    echo $purchase_row['@p_purchase_id'];
    mysqli_close($con);
    exit();
}

//query to check duplicate
if (isset($_POST['duplicatechecker'])) {
    $datatablelist = get_data("purchase_id","tbl_purchase where inward_no='".$_POST['inwardNo']."' AND inward_date='".$_POST['inwardDate']."' AND supplier_id='".$_POST['supplier_id']."' LIMIT 1");
    if ($datatablelist === NULL) {
        echo 'false'; // query executed, but no results found
        exit();
    }
    if (mysqli_num_rows($datatablelist) > 0) {
        echo 'true';
    } else {
        echo 'false'; // query executed, but no results found
    }
    mysqli_close($con);
    exit();
}

// call purchase(bigint p_purchase_id, varchar p_purchase_location, bigint p_sequence_no, varchar p_pono, date p_po_date, varchar p_inv_challan_no, date p_inv_challan_date, varchar p_inward_no, datetime p_inward_date, bigint p_supplier_id, date p_due_date, varchar p_mill_name, varchar p_transport_vehicle, varchar p_transport_lr, varchar p_transporter, varchar p_remark, decimal p_total_amount, decimal p_discount, decimal p_net, int p_cmpid, int p_yid, int p_adduserid, datetime p_adduserdate, int p_mode);
//query to edit purchase

//query to delete purchase

//query to display supplier
if(isset($_POST['due_date'])) {
    $output=null;
    $datatablelist = get_data("profile_id,profile_type_id,profile_name,current_balance,credit_days","tbl_profile where profile_type_id=2");
	if(isset($datatablelist)){
        // $output='<option value="" disabled selected>Choose Supplier</option>';
        while($profile_data_row = mysqli_fetch_array($datatablelist)){
            $inwardDate = $_POST['inward_date'];
            $creditDays = $profile_data_row['credit_days'];
            $dueDate = date('Y-m-d', strtotime($inwardDate . ' + ' . $creditDays . ' days'));

            $output =$output.'<option value="' . $profile_data_row['profile_name'] . '" data-duedate="' . $dueDate . '" data-supplierid="' . $profile_data_row['profile_id'] . '">' . $dueDate . ' invoice, Outstanding: ' . $profile_data_row['current_balance'] . '</option>';
        }  
    }
    echo $output;
    mysqli_close($con);
    exit();
}

if (isset($_POST['verify_supplier'])) {
    $supplierName = $_POST['verify_supplier'];
    $datatablelist = get_data("profile_id,profile_type_id,profile_name,current_balance,credit_days","tbl_profile where profile_type_id=2 and profile_name='$supplierName'");
    if (mysqli_num_rows($datatablelist) > 0) {
        echo 'true';
    } else {
        echo 'false';
    }
    mysqli_close($con);
    exit();
}

//query to display mill
if (isset($_POST['list_mill'])) {
    $datatablelist = get_data("profile_id,profile_type_id,profile_name,current_balance,credit_days","tbl_profile where profile_type_id=3");
    $profileMap = [
        1 => 'Customer',
        2 => 'Agent/Supplier',
        3 => 'Mill',
        4=> 'Job Worker'
    ];
    $output=null;
	if(isset($datatablelist)){
        // $output='<option value="" disabled selected>Choose Mill</option>';
        while($profile_data_row = mysqli_fetch_array($datatablelist)){
            $output =$output.'<option value="'. $profile_data_row['profile_name'] .'" data-millid="' . $profile_data_row['profile_id'] . '">' . $profile_data_row['profile_name'] . '</option>';
        }  
    }
    echo $output;
    mysqli_close($con);
    exit();
}
if (isset($_POST['verify_mill'])) {
    $millName = $_POST['verify_mill'];
    $datatablelist = get_data("profile_id,profile_type_id,profile_name,current_balance,credit_days","tbl_profile where profile_type_id=3 and profile_name='$millName'");
    if (mysqli_num_rows($datatablelist) > 0) {
        echo 'true';
    } else {
        echo 'false';
    }
    mysqli_close($con);
    exit();
}

if (isset($_POST['list_'])) {
    $datatablelist = get_data("item_id,item_category,item_name,hsn_code,unit_id","tbl_item");
    $unittablelist = get_data("profile_id,profile_type,credit_days","tbl_profile");
    $unitMap = [];
foreach ($unittablelist as $unit) {
    $unitMap[$unit['unit_id']] = $unit['unit_name'];
}
	$datatablerowid = 0;
	$output ='<thead>
                <tr>
                    <th scope="col">Sr. no.</th>
                    <th scope="col" class="w3-hide">Item id</th>
                    <th scope="col">Item type</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">HSN</th>
                    <th scope="col">Unit</th>  
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>';
                $categoryMap = [
                    1 => 'RM',
                    2 => 'Semi Finished',
                    3 => 'FG'
                ];
		       if(isset($datatablelist)){
			     while($item_data_row = mysqli_fetch_array($datatablelist)){
                    $unit_name = $unitMap[$item_data_row['unit_id']];
			       $datatablerowid++;
				   //$set_outlet_db_session = $item_data_row['outlet_db'];
				   $output =$output.'<tr>
                   <td  class="w3-center">'.$datatablerowid.'</td>
                    <td class="w3-center w3-hide">'.$item_data_row['item_id'].'</td>
                    <td class="w3-center">';
                    $output = $output.'<span id="item_category_span' . $item_data_row['item_id'] . '">' . $categoryMap[$item_data_row['item_category']] . '</span>
                                <select id="item_category_input' . $item_data_row['item_id'] . '"  style="display: none;">
                                    <option value="1" ' . (($item_data_row['item_category'] == 1) ? 'selected' : '') . '>RM</option>
                                    <option value="2" ' . (($item_data_row['item_category'] == 2) ? 'selected' : '') . '>Semi Finished</option>
                                    <option value="3" ' . (($item_data_row['item_category'] == 3) ? 'selected' : '') . '>FG</option>
                                </select>';
                    $output = $output.'</td>
                    <td class="w3-center">
                        <span id="item_name_span' . $item_data_row['item_id'] . '">' . $item_data_row['item_name'] . '</span>
                        <input type="text" id="item_name_input' . $item_data_row['item_id'] . '" value="' . $item_data_row['item_name'] . '" style="display: none;">
                    </td>
                    <td class="w3-center">
                        <span id="item_hsn_span' . $item_data_row['item_id'] . '">' . $item_data_row['hsn_code'] . '</span>
                        <input type="text" id="item_hsn_input' . $item_data_row['item_id'] . '" value="' . $item_data_row['hsn_code'] . '" style="display: none;">
                    </td>
                    <td class="w3-center">';
                    $output =$output. '
                                <span id="item_unit_span' . $item_data_row['item_id'] . '">' . $unitMap[$item_data_row['unit_id']] . '</span>
                                <select id="item_unit_input' . $item_data_row['item_id'] . '" style="display: none;">';
                    foreach ($unitMap as $unitId => $unitName) {
                        $output =$output. '<option value="' . $unitId . '" ' . (($unitId == $item_data_row['unit_id']) ? 'selected' : '') . '>' . $unitName . '</option>';
                    }
                    $output = $output.'</select></td>
                    <td  class="w3-center">';
                    $output = $output . '<button href="#" class="w3-text-grey w3-hover-text-white w3-center w3-hover-blue w3-button" id="edit_button' . $item_data_row['item_id'] . '" onclick="edit_item_data(' . $item_data_row['item_id'] . ')"><i class="fa fa-pencil fa-fw" title="Update"></i></button>&nbsp;&nbsp;';
                    $output =$output.'<button href="#" class="w3-text-grey w3-hover-text-white we-center w3-hover-red w3-button " id="delete_button'.$item_data_row['item_id'].'" onclick="delete_item_data('.$item_data_row['item_id'].')"><i class="fa fa-trash fa-fw" title="Delete"></i></button>';
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