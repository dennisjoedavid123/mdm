<?php
/**
 * Created by PhpStorm.
 * User: parul
 * Date: 3/3/15
 * Time: 9:05 PM
 */

include('util.php');

function addpolicy($data) {
    $conn=connect();
//    mysql_select_db('mdm2_12nov2014');
    $policyname=$date=$ptypeval=$profile_type_relation_id=$user_id=$flist_status='';
    $profile_id=1;
    foreach ($data['info'] as $log) {
        if ($log['name'] == 'policyname') {
            $policyname = $log['value'];
        }
        if ($log['name'] == 'date') {
            $date = $log['value'];
        }
        if ($log['name'] == 'ptypeval') {
            $ptypeval = $log['value'];
        }
        if ($log['name'] == 'profile_type_relation_id') {
            $profile_type_relation_id = $log['value'];
        }
        if ($log['name'] == 'user_id') {
            $user_id = $log['value'];
        }

        if($log['name']=='action_flag'){
            $action_flag = $log['value'];
        }
        if($log['name']=='flist_status'){
            $flist_status = $log['value'];
        }

    }

    if($conn==null){
        echo 'connection null';
        return json_decode('{"status":"db connection error.."}');
    }
    else {

        $sql = "call create_new_profile_v1(" . $action_flag . ",'" . $policyname . "','" .$ptypeval. "'," .$user_id. ",'".$flist_status."', @status1 , @status2)";
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