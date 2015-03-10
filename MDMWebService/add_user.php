<?php
/**
 * Created by PhpStorm.
 * User: parul
 * Date: 27/2/15
 * Time: 10:15 PM
 */


include('util.php');

function adduser($data) {
    $conn=connect();
//    mysql_select_db('mdm2_12nov2014');
    $designation_id=$device_id=$first_name=$login_name=$password=$dob=$gender_id=$marital_status_id=$email=$photo=$address=$city=$state=$pincode=$country_id=$landline=$mobile=$employee_status='';
    $employee_id=0;
    foreach ($data['info'] as $log) {
        if ($log['name'] == 'first_name') {
            $first_name = $log['value'];
        }
        if ($log['name'] == 'middle_name') {
            $middle_name = $log['value'];
        }
        if ($log['name'] == 'last_name') {
            $last_name = $log['value'];
        }
        if ($log['name'] == 'employee_code') {
            $employee_code = $log['value'];
        }
        if ($log['name'] == 'login_name') {
            $login_name = $log['value'];
        }
        if ($log['name'] == 'password') {
            $password = $log['value'];
        }
        if ($log['name'] == 'dob') {
            $dob = $log['value'];
        }
        if ($log['name'] == 'gender') {
            $gender_id = convertValuesID("gst_gender_master","gender_id","gender",$log['value']);
        }
        if ($log['name'] == 'marital_status') {
            $marital_status_id = convertValuesID("gst_marital_status","marital_status_id","marital_status",$log['value']);
        }
        if ($log['name'] == 'email') {
            $email = $log['value'];
        }
        if ($log['name'] == 'photo') {
            $photo = $log['value'];
        }
        if ($log['name'] == 'address') {
            $address = $log['value'];
        }
        if ($log['name'] == 'city') {
            $city = $log['value'];
        }
        if ($log['name'] == 'state') {
            $state = $log['value'];
        }
        if ($log['name'] == 'pincode') {
            $pincode = $log['value'];
        }
        if ($log['name'] == 'country') {
            $country_id = convertValuesID("gst_country_master","country_id","country_name",$log['value']);
        }
        if ($log['name'] == 'landline') {
            $landline = $log['value'];
        }
        if ($log['name'] == 'mobile') {
            $mobile = $log['value'];
        }
        if ($log['name'] == 'employee_status') {
            $employee_status = convertValuesID("gst_employee_status","employee_status_id","employee_status",$log['value']);
        }
        if($log['name']=='action_flag'){
            $action_flag = $log['value'];
        }

        if($log['name']=='device_id'){
            $device_id=$log['value'];
        }
        if($log['name']=='designation'){
            $designation_id = convertValuesID("gst_department_hierarchy","hierarchy_id","hierarchy_name",$log['value']);
        }
       // echo $first_name. " welcome";
        $profile_id=101;
    }

    if($conn==null){
        echo 'connection null';
        return json_decode('{"status":"db connection error.."}');
    }
    else {
//        echo 'inside adduser.';
//        $sql = "insert into gst_employee_profile(employee_code,first_name,middle_name,last_name,login_name,password,dob,gender_id,marital_status_id,email,photo,address,city,state,pincode,country_id,landline,mobile,employee_status) values('".$employee_code."','".$first_name."','".$middle_name."','".$last_name."','".$login_name."','".$password."','".$dob."',$gender_id,$marital_status_id,'".$email."','".$photo."','".$address."','".$city."','".$state."','".$pincode."',$country_id,'".$landline."','".$mobile."','".$employee_status."') ";
//        echo $sql;
        $sql = "CALL gst_add_user(" . $action_flag . "," . $employee_id . ", '" . $first_name . "','" . $middle_name . "',
            '" . $last_name . "'," . $designation_id. ",'" . $employee_code . "','" .date("Y-m-d"). "', " . $gender_id . ",
            " . $marital_status_id . ",'" . $email . "','" .  $landline . "','" .$mobile. "','" . $address . "',
                    '" . $photo . "','" . $login_name. "','" . $password . "','" . $city . "','" . $state . "','" . $pincode . "',
                        " . $country_id . "," . $device_id . "," . $profile_id . ",@status , @user_id , '')";
        echo $sql;
        $result = mysql_query($sql);
        if ($result) {
            echo '{"status":"success"}';
        } else {
            echo '{"status":"failed : '.mysql_error().'"}';
        }
    }



}
?>

