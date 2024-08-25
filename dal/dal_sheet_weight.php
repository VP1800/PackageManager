<?php
require 'dal_db.php';
require 'dal_load_data.php';
//query to add unit
if (isset($_POST['add_sheetweight'])) {
    $adduserdate=date('y/m/d h:m:s');
    mysqli_query($con, "set @p_sheet_weight_id=0");
    $sheet_result = mysqli_query($con,"CALL sheet_weight(@p_sheet_weight_id,'$_POST[length]','$_POST[width]','$_POST[gsm]',0,1,1,1,'$adduserdate',1)");
    // echo "set set @p_sheet_weight_id=0;CALL sheet_weight(@p_sheet_weight_id,'$_POST[length]','$_POST[width]','$_POST[gsm]',0,1,1,1,'$adduserdate',1)";
    $sheet_list = mysqli_query($con,"SELECT @p_sheet_weight_id");
    $sheet_row = mysqli_fetch_assoc($sheet_list);
    echo $sheet_row['@p_sheet_weight_id'];
    mysqli_close($con);
    exit();
}

//query to edit unit
if (isset($_POST['edit_sheetweight'])) {
    $adduserdate=date('y/m/d h:m:s');
    mysqli_query($con, "set @p_sheet_weight_id =".$_POST['sheet_weight_id']);
    $unit_result = mysqli_query($con,"CALL sheet_weight(@p_sheet_weight_id,'$_POST[length]','$_POST[width]','$_POST[gsm]',0,1,1,1,'$adduserdate',2)");
    $sheet_list = mysqli_query($con,"SELECT @p_sheet_weight_id");
    
    $sheet_row = mysqli_fetch_assoc($sheet_list);
    echo $sheet_row['@p_sheet_weight_id'];
    mysqli_close($con);
    exit();
}

//query to delete sheet
if (isset($_POST['delete_sheetweight'])) {
    $adduserdate=date('y/m/d h:m:s');
    mysqli_query($con, "set @p_sheet_weight_id =".$_POST['sheetweight_id']);
    $unit_result = mysqli_query($con,"CALL sheet_weight(@p_sheet_weight_id,'$_POST[length]','$_POST[width]','$_POST[gsm]',0,1,1,1,'$adduserdate',3)");

    echo "success";
    mysqli_close($con);
    exit();
}

//query to display sheetweight
if (isset($_POST['list_sheetweight'])) {
    $datatablelist = get_data("sheet_weight_id,sheet_length,sheet_width,sheet_gsm,sheet_weight","tbl_sheet_weight");
	$datatablerowid = 0;
	$output ='<thead>
                <tr>
                    <th scope="col" class="w3-center">Sr. no.</th>
                    <th scope="col" class="w3-hide w3-center">Sheet id</th>
                    <th scope="col" class="w3-center">Length</th>
                    <th scope="col" class="w3-center">Width</th>
                    <th scope="col" class="w3-center">GSM</th>
                    <th scope="col" class="w3-center">Weight (Kg)</th>  
                    <th scope="col" class="w3-center">Actions</th>
                </tr>
                </thead>
                <tbody>';
		       if(isset($datatablelist)){
			     while($sheet_data_row = mysqli_fetch_array($datatablelist)){
			       $datatablerowid++;
				   //$set_outlet_db_session = $sheet_data_row['outlet_db'];
				   $output =$output.'<tr>
                   <td  class="w3-center">'.$datatablerowid.'</td>
                    <td class="w3-center w3-hide">'.$sheet_data_row['sheet_weight_id'].'</td>
                    <td class="w3-center">
                        <span id="sheet_length_span' . $sheet_data_row['sheet_weight_id'] . '">' . $sheet_data_row['sheet_length'] . '</span>
                        <input type="text" id="sheet_length_input' . $sheet_data_row['sheet_weight_id'] . '" value="' . $sheet_data_row['sheet_length'] . '" style="display: none;">
                    </td>
                    <td class="w3-center">
                        <span id="sheet_width_span' . $sheet_data_row['sheet_weight_id'] . '">' . $sheet_data_row['sheet_width'] . '</span>
                        <input type="text" id="sheet_width_input' . $sheet_data_row['sheet_weight_id'] . '" value="' . $sheet_data_row['sheet_width'] . '" style="display: none;">
                    </td>
                    <td class="w3-center">
                        <span id="sheet_gsm_span' . $sheet_data_row['sheet_weight_id'] . '">' . $sheet_data_row['sheet_gsm'] . '</span>
                        <input type="text" id="sheet_gsm_input' . $sheet_data_row['sheet_weight_id'] . '" value="' . $sheet_data_row['sheet_gsm'] . '" style="display: none;">
                    </td>
                    <td class="w3-center">'.$sheet_data_row['sheet_weight'].'</td>
					<td  class="w3-center">';
                    $output = $output . '<button href="#" class="w3-text-grey w3-hover-text-white w3-center w3-hover-blue w3-button" id="edit_button' . $sheet_data_row['sheet_weight_id'] . '" onclick="edit_sheet_data(' . $sheet_data_row['sheet_weight_id'] . ')"><i class="fa fa-pencil fa-fw" title="Update"></i></button>&nbsp;&nbsp;';
                    $output =$output.'<button href="#" class="w3-text-grey w3-hover-text-white we-center w3-hover-red w3-button " id="delete_button'.$sheet_data_row['sheet_weight_id'].'" onclick="delete_sheet_data('.$sheet_data_row['sheet_weight_id'].')"><i class="fa fa-trash fa-fw" title="Delete"></i></button>';
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