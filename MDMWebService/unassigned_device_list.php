<?php

function unassigned_device_list($data)
{
    $conn=connect();

    if($conn==null){
        return json_decode('{"status":"db connection error.."}');
    }
    else {

            $sql="call get_unassigned_devices()";

        $result = mysql_query($sql);
        echo '[';
        while($row = mysql_fetch_assoc($result))
        {
            echo '{';
            echo '"device_id":"';echo $row['device_id']; echo '",';
            echo '"imei":"';echo $row['imei']; echo '",';
            echo '"meid":"';echo $row['meid']; echo '",';
            echo '"wifi_mac":"';echo $row['wifi_mac']; echo '",';
            echo '"bluetooth_mac":"';echo $row['bluetooth_mac']; echo '",';
            echo '"device_name":"';echo $row['device_name']; echo '",';
            echo '"model_master_id":"';echo $row['model_master_id']; echo '",';
            echo '"model":"';echo $row['model']; echo '",';
            echo '"device_type_id":"';echo $row['device_type_id']; echo '",';
            echo '"device_type":"';echo $row['device_type']; echo '"';
            echo '},';
        }
        echo "{}]";
    }

}
?>
