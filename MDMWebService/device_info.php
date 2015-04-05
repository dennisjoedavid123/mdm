<?php
/**
 * Created by PhpStorm.
 * User: parul
 * Date: 6/3/15
 * Time: 10:20 PM
 */


function viewdevice($data)
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

        $sql = "call get_device_detail($device_id)";
        $result = mysql_query($sql);
        echo '[';
        while($row = mysql_fetch_assoc($result))
        {
            echo '{';
            echo '"imei":"';echo $row['IMEI']; echo '",';
            echo '"meid":"';echo $row['MEID']; echo '",';
            echo '"wifi_mac":"';echo $row['MAC_WIFI']; echo '",';
            echo '"bluetooth_mac":"';echo $row['MAC_BLUETOOTH']; echo '",';
            echo '"device_name":"';echo $row['device_name']; echo '",';
            echo '"model":"';echo $row['model']; echo '"';
            echo '},';
        }
        echo "{}]";

    }

}
?>