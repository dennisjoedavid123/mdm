<?php
/**
 * Created by PhpStorm.
 * User: parul
 * Date: 22/3/15
 * Time: 2:53 PM
 */

function assigndevice($data)
{
    $employee_id = '';

    foreach ($data['info'] as $log) {
        if ($log['name'] == 'employee_id') {
            $employee_id = $log['value'];
        }
    }
    $conn=connect();

    if($conn==null){
        return json_decode('{"status":"db connection error.."}');
    }
    else {

        $sql = "update gst_employee_profile set device_id=".$devid." where employee_id=".$employee_id)";
        $result = mysql_query($sql);
        if($result>0){
            $updatesql = "update gst_employee_profile set device_id="null" where employee_id=".$employee_id;
            $updateresult = mysql_query($updatesql);
            if($updateresult>0){
                echo "{status:success}";
            }
            else{
                echo "{status:failed}";
            }
        }

    }

}
?>