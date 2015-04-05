<?php
/**
 * Created by PhpStorm.
 * User: Parul
 * Date: 3/9/2015
 * Time: 2:58 PM
 */

function viewfeaturedetails($data)
{

    $conn=connect();

    if($conn==null){
        return json_decode('{"status":"db connection error.."}');
    }
    else {

        $sql = "call get_feature_details()";
        $result = mysql_query($sql);
        echo '[';
        while($row = mysql_fetch_assoc($result))
        {
            echo '{';
            echo '"feature_list_id":"';echo $row['feature_list_id']; echo '",';
            echo '"feature_list":"';echo $row['feature_list']; echo '",';
            echo '"feature_type_id":"';echo $row['feature_type_id']; echo '",';
            echo '"feature_type":"';echo $row['feature_type']; echo '",';
            echo '"feature_status_id":"';echo $row['feature_status_id']; echo '",';
            echo '"feature_status":"';echo $row['feature_status']; echo '",';
            echo '"feature_id":"';echo $row['feature_id']; echo '"';
            echo '},';
        }
        echo "{}]";
    }

}
?>