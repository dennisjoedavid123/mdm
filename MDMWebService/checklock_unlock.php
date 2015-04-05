<?php
/**
 * Created by PhpStorm.
 * User: parul
 * Date: 6/3/15
 * Time: 10:20 PM
 */


function checklock_unlock($data)
{

    $device_id = '';

    foreach ($data['info'] as $log) {
        if ($log['name'] == 'device_id') {
            $device_id = $log['value'];
        }
    }
    $conn=connect();
    if($conn==null){
        return json_decode('{"status":"db connection error.."}');
    }
    else {

        $sql = "select device_status from gst_device_master WHERE device_id=".$device_id;
        $result = mysql_query($sql);
        echo '[';
        while($row = mysql_fetch_assoc($result))
        {
            echo '{';
            echo '"device_status":"';echo $row['device_status']; echo '"';
            echo '},';
        }
        echo "{}]";

    }

}
?>