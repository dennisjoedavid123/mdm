<?php
/**
 * Created by PhpStorm.
 * User: Parul
 * Date: 27-02-2015
 * Time: 22:46
 */

function authUser($data)
{

    $username = '';
    $password = '';
    foreach ($data['info'] as $log) {
        if ($log['name'] == 'login_name') {
            $username = $log['value'];
        }
        if ($log['name'] == 'password') {
            $password = $log['value'];
        }
    }
    $conn=connect();

    // echo $username . " " . $password;
    if($conn==null){
        return json_decode('{"status":"db connection error.."}');
    }
    else {

            $sql = "select login_name from gst_employee_profile where login_name='" . $username . "' and password='" . $password . "'";
            $result = mysql_query($sql);
            if (mysql_num_rows($result) > 0) {
                echo '{"status":"success"}';
            } else {
                echo '{"status":"failed"}';
            }

    }


}
?>