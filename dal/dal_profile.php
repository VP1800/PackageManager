<?php
require 'dal_db.php';
require 'dal_load_data.php';
//query to add profile
if (isset($_POST['add_profile'])) {
    $adduserdate=date('y/m/d h:m:s');
    mysqli_query($con, "set @p_profile_id=0");
    $profile_result = mysqli_query($con,"CALL profile(@p_profile_id,$_POST[type],'$_POST[name]','$_POST[alias]','$_POST[gstNumber]','$_POST[tallyReference]','$_POST[contact]',$_POST[opening],$_POST[current],$_POST[days],'".$_POST['states']."',1,1,1,'$adduserdate',1)");
    // echo "set set @p_profile_id=0;CALL profile(@p_profile_id,$_POST[type],'$_POST[name]','$_POST[alias]','$_POST[gstNumber]','$_POST[tallyReference]','$_POST[contact]',$_POST[opening],$_POST[current],'".$_POST['states']."',1,1,1,'$adduserdate',1))";
    $profile_list = mysqli_query($con,"SELECT @p_profile_id");
    $profile_row = mysqli_fetch_assoc($profile_list);
    echo $profile_row['@p_profile_id'];
    mysqli_close($con);
    exit();
}

//set profile_id for update
if (isset($_POST['edit_profile_id'])) {
    session_start();
    $_SESSION['profile_id'] = $_POST['profile_id'];
    $profile_id = $_POST['edit_profile_id'];
    echo $_SESSION['profile_id'];
    exit();
}

//set data for update form
if (isset($_POST['set_data'])) {
    session_start();
    $profile_id = $_SESSION['profile_id'];
    $profile_data = get_data("$profile_id,profile_type_id,profile_name,profile_alias,gst_no,tally_reference_name,contact_numbers,opening_balance,current_balance,state,credit_days","tbl_profile where profile_id=$_SESSION[profile_id]");
    $profile_data_row = mysqli_fetch_assoc($profile_data);
    echo json_encode($profile_data_row);
    mysqli_close($con);
    exit();
}
//query to edit profile
if (isset($_POST['edit_profile'])) {
    $adduserdate=date('y/m/d h:m:s');
    session_start();
    mysqli_query($con, "set @p_profile_id=$_SESSION[profile_id]");
    $profile_result = mysqli_query($con,"CALL profile(@p_profile_id,$_POST[type],'$_POST[name]','$_POST[alias]','$_POST[gstNumber]','$_POST[tallyReference]','$_POST[contact]',$_POST[opening],$_POST[current],$_POST[days],'".$_POST['states']."',1,1,1,'$adduserdate',2)");
    // echo "set set @p_profile_id=0;CALL profile(@p_profile_id,$_POST[type],'$_POST[name]','$_POST[alias]','$_POST[gstNumber]','$_POST[tallyReference]','$_POST[contact]',$_POST[opening],$_POST[current],'".$_POST['states']."',1,1,1,'$adduserdate',1))";
    $profile_list = mysqli_query($con,"SELECT @p_profile_id");
    $profile_row = mysqli_fetch_assoc($profile_list);
    echo $profile_row['@p_profile_id'];
    mysqli_close($con);
    session_destroy();
    exit();
}

//query to delete profile
if (isset($_POST['delete_profile'])) {
    $adduserdate=date('y/m/d h:m:s');
    mysqli_query($con, "set @p_profile_id =".$_POST['profile_id']);
    $item_result = mysqli_query($con,"CALL profile(@p_profile_id,0,'','','','','',0.00,0.00,0,'',1,1,1,'$adduserdate',3)");

    echo "success";
    mysqli_close($con);
    exit();
}

//query to display state
if (isset($_POST['list_state'])) {
    $states = array(
        "Andaman and Nicobar Islands",
        "Andhra Pradesh",
        "Arunachal Pradesh",
        "Assam",
        "Bihar",
        "Chandigarh",
        "Chhattisgarh",
        "Dadra and Nagar Haveli",
        "Daman and Diu",
        "Delhi",
        "Goa",
        "Gujarat",
        "Haryana",
        "Himachal Pradesh",
        "Jammu and Kashmir",
        "Jharkhand",
        "Karnataka",
        "Kerala",
        "Ladakh",
        "Lakshadweep",
        "Madhya Pradesh",
        "Maharashtra",
        "Manipur",
        "Meghalaya",
        "Mizoram",
        "Nagaland",
        "Odisha",
        "Puducherry",
        "Punjab",
        "Rajasthan",
        "Sikkim",
        "Tamil Nadu",
        "Telangana",
        "Tripura",
        "Uttar Pradesh",
        "Uttarakhand",
        "West Bengal"
    );
    $output='<option value="" disabled selected>Choose State</option>';
    foreach ($states as $state) {
        $output =$output. '<option value="' . $state . '">' . $state . '</option>';
    }
    echo $output;
    exit();
}

//query to display profile
if (isset($_POST['list_profile'])) {
    $datatablelist = get_data("profile_id,profile_type_id,profile_name,profile_alias,gst_no,tally_reference_name,contact_numbers,opening_balance,current_balance,state,credit_days","tbl_profile");
	$datatablerowid = 0;
	$output ='<thead>
                <tr>
                    <th scope="col">Sr. no.</th>
                    <th scope="col" class="w3-hide">Profile id</th>
                    <th scope="col">Type</th>
                    <th scope="col">Profile Name</th>
                    <th scope="col">Alias Name</th>
                    <th scope="col">GST No.</th>
                    <th scope="col">Tally Ref Name</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Opening Balance</th>
                    <th scope="col">Current Balance</th>
                    <th scope="col">Credit Days</th>
                    <th scope="col">State</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>';
                $typeMap = [
                    1 => 'Customer',
                    2 => 'Agent/Supplier',
                    3 => 'Mill',
                    4 => 'Worker'
                ];
		       if(isset($datatablelist)){
			     while($profile_data_row = mysqli_fetch_array($datatablelist)){
			       $datatablerowid++;
				   //$set_outlet_db_session = $profile_data_row['outlet_db'];
				   $output =$output.'<tr>
                   <td  class="w3-center">'.$datatablerowid.'</td>
                    <td class="w3-center w3-hide">'.$profile_data_row['profile_id'].'</td>
                    <td class="w3-center">'.$typeMap[$profile_data_row['profile_type_id']].'</td>
				    <td class="w3-center">'.$profile_data_row['profile_name'].'</td>
				    <td class="w3-center">'.$profile_data_row['profile_alias'].'</td>
				    <td class="w3-center">'.$profile_data_row['gst_no'].'</td>
				    <td class="w3-center">'.$profile_data_row['tally_reference_name'].'</td>
				    <td class="w3-center">'.$profile_data_row['contact_numbers'].'</td>
                    <td class="w3-center">'.$profile_data_row['opening_balance'].'</td>
                    <td class="w3-center">'.$profile_data_row['current_balance'].'</td>
                    <td class="w3-center">'.$profile_data_row['credit_days'].'</td>
                    <td class="w3-center">'.$profile_data_row['state'].'</td>
					<td  class="w3-center">';
                    $output = $output . '<button href="#" class="w3-text-grey w3-hover-text-white w3-center w3-hover-blue w3-button" id="edit_button' . $profile_data_row['profile_id'] . '" onclick="edit_profile_data(' . $profile_data_row['profile_id'] . ')"><i class="fa fa-pencil fa-fw" title="Update"></i></button>';
                    $output =$output.'<button href="#" class="w3-text-grey w3-hover-text-white we-center w3-hover-red w3-button " id="delete_button'.$profile_data_row['profile_id'].'" onclick="delete_profile_data('.$profile_data_row['profile_id'].')"><i class="fa fa-trash fa-fw" title="Delete"></i></button>';
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

//custom setting for hiding extra
if(isset($_POST['custome_setting'])) {
    $profilesetting = get_data("value","tbl_profile_customsetting");
	$custom_setting_row = mysqli_fetch_assoc($profilesetting);
    echo $custom_setting_row["value"];
    mysqli_close($con);
    exit();
}
?>