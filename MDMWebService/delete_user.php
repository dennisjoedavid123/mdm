<?php
/**
 * Created by PhpStorm.
 * User: parul
 * Date: 1/3/15
 * Time: 5:37 PM
 */
function deleteuser($data)
{

    $employee_id = '';

    foreach ($data['info'] as $log) {
        if ($log['name'] == 'employee_id') {
            $employee_id = $log['value'];
        }
    }
    $conn=connect();
//    mysql_select_db('edetailing_7feb2014');
    // echo $username . " " . $password;
    if($conn==null){
        return json_decode('{"status":"db connection error.."}');
    }
    else {

        $sql = "update gst_employee_profile set employee_status = 3 where employee_id=$employee_id";
        $result = mysql_query($sql);
        if ($result) {

            '{"status":"success"}';
        } else {
            echo '{"status":"failed : '.mysql_error().'"}';
        }
    }



}
?>