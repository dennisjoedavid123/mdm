<?php
/**
 * Created by PhpStorm.
 * User: parul
 * Date: 18/3/15
 * Time: 10:41 PM
 */


function viewpolicytype($data){
    $conn=connect();

    if($conn==null){
        return json_decode('{"status":"db connection error.."}');
    }
    else {

        $sql = "select * from gst_profile_type";
        $result = mysql_query($sql);

        while($row = mysql_fetch_assoc($result))
        {
            echo '{';
            echo '"profile_type_id":"';echo $row['profile_type_id']; echo '",';
            echo '"profile_type":"';echo $row['profile_type']; echo '"';
            echo '}';
        }

    }
}

?>
