<?php
/**
 * Created by PhpStorm.
 * User: parul
 * Date: 18/3/15
 * Time: 10:02 PM
 */


function viewpolicy_devicedetails($data)
{

    $policy_id=$policy_type = '';

    foreach ($data['info'] as $log) {
        if ($log['name'] == 'policy_id') {
            $policy_id = $log['value'];
        }
        if ($log['name'] == 'policy_type') {
            $policy_type = $log['value'];
        }
    }
    $conn=connect();

    if($conn==null){
        return json_decode('{"status":"db connection error.."}');
    }
    else {

        $sql = "call get_policy_on_device_details($policy_id,'".$policy_type."')";
        $result = mysql_query($sql);

        while($row = mysql_fetch_assoc($result))
        {
            echo '{';
            echo '"profile_name":"';echo $row['profile_name']; echo '",';
            echo '"created_date":"';echo $row['created_date']; echo '",';
            echo '"feature_type_id":"';echo $row['feature_type_id']; echo '",';
            echo '"feature_type":"';echo $row['feature_type']; echo '",';
            echo '"feature_status_id":"';echo $row['feature_status_id']; echo '",';
            echo '"feature_status":"';echo $row['feature_status']; echo '",';
            echo '"feature_list":"';echo $row['feature_list']; echo '"';
            echo '}';
        }

    }


}
?>
