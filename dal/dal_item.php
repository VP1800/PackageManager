<?php
require 'dal_db.php';
require 'dal_load_data.php';
//query to add item
if (isset($_POST['add_item'])) {
    $adduserdate=date('y/m/d h:m:s');
    mysqli_query($con, "set @p_item_id=0");
    $item_result = mysqli_query($con,"CALL item(@p_item_id,$_POST[category],'$_POST[name]','$_POST[hsn]',$_POST[unit],1,1,1,'$adduserdate',1)");
    // echo "set set @p_item_id=0;CALL sheet_weight(@p_item_id,'$_POST[length]','$_POST[width]','$_POST[gsm]',0,1,1,1,'$adduserdate',1)";
    $item_list = mysqli_query($con,"SELECT @p_item_id");
    $item_row = mysqli_fetch_assoc($item_list);
    echo $item_row['@p_item_id'];
    mysqli_close($con);
    exit();
}

//query to edit item
if (isset($_POST['edit_item'])) {
    $adduserdate=date('y/m/d h:m:s');
    mysqli_query($con, "set @p_item_id =".$_POST['item_id']);
    $item_result = mysqli_query($con,"CALL item(@p_item_id,$_POST[category],'$_POST[name]','$_POST[hsn]',$_POST[unit],1,1,1,'$adduserdate',2)");
    $item_list = mysqli_query($con,"SELECT @p_item_id");
    
    $item_row = mysqli_fetch_assoc($item_list);
    echo $item_row['@p_item_id'];
    mysqli_close($con);
    exit();
}

//query to delete item
if (isset($_POST['delete_item'])) {
    $adduserdate=date('y/m/d h:m:s');
    mysqli_query($con, "set @p_item_id =".$_POST['item_id']);
    $item_result = mysqli_query($con,"CALL item(@p_item_id,$_POST[category],'$_POST[name]','$_POST[hsn]',$_POST[unit],1,1,1,'$adduserdate',3)");

    echo "success";
    mysqli_close($con);
    exit();
}

//query to display unit
if (isset($_POST['list_unit'])) {
    $datatablelist = get_data("unit_id,unit_name","tbl_unit");
	$datatablerowid = 0;
	if(isset($datatablelist)){
        $output='<option value="" disabled selected>Choose Unit</option>';
        while($unit_data_row = mysqli_fetch_array($datatablelist)){
            $output =$output.'<option value="'. $unit_data_row['unit_id'] .'">' . $unit_data_row['unit_name'] . '</option>';
        }  
    }
    echo $output;
    mysqli_close($con);
    exit();
}
//query to display item
if (isset($_POST['list_item'])) {
    $datatablelist = get_data("item_id,item_category,item_name,hsn_code,unit_id","tbl_item");
    $unittablelist = get_data("unit_id,unit_name","tbl_unit");
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
<!-- call item(bigint p_item_id, tinyint p_item_category, varchar p_item_name, varchar p_hsn_code, int unit_id, int p_cmpid, int p_yid, int p_adduserid, datetime p_adduserdate, int p_mode); -->