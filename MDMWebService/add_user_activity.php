<?php
/**
 * Created by PhpStorm.
 * User: parul
 * Date: 10/3/15
 * Time: 11:18 PM
 */

include('util.php');
function adduseractivity($data) {
    $conn=connect();

    $employee_id=$user_activity='';

    foreach ($data['info'] as $log) {
        if ($log['name'] == 'employee_id') {
            $employee_id = $log['1'];
        }
        if ($log['name'] == 'user_activity') {
            $user_activity = $log['value'];
        }


    }
    if($conn==null){
        echo 'connection null';
        return json_decode('{"status":"db connection error.."}');
    }
    else {

        $sql = "call set_user_activity($employee_id,$user_activity)";
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