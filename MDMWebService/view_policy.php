<?php
/**
 * Created by PhpStorm.
 * User: parul
 * Date: 18/3/15
 * Time: 9:31 PM
 */

function viewpolicy($data){
    $conn=connect();

    if($conn==null){
        return json_decode('{"status":"db connection error.."}');
    }
    else {

        $sql = "call get_profile_and_app_profile_list()";
        $result = mysql_query($sql);

        while($row = mysql_fetch_assoc($result))
        {
            echo '{';
            echo '"profile_master_id":"';echo $row['profile_master_id']; echo '",';
            echo '"profile_name":"';echo $row['profile_name']; echo '",';
            echo '"created_date":"';echo $row['created_date']; echo '",';
            echo '"type":"';echo $row['type']; echo '"';
            echo '}';
        }

    }
}

?>