<?php
/**
 * Created by PhpStorm.
 * User: parul
 * Date: 12/3/15
 * Time: 11:29 PM
 */

function getrole($data)
{
    $deptid = '';

    foreach ($data['info'] as $log) {
        if ($log['name'] == 'deptid') {
            $deptid = $log['value'];
        }
    }
    $conn=connect();

    if($conn==null){
        return json_decode('{"status":"db connection error.."}');
    }
    else {

        $sql = "select hierarchy_id , hierarchy_name from gst_department_hierarchy where department_id = $deptid";
        $result = mysql_query($sql);
        echo '[';
        while($row = mysql_fetch_assoc($result))
        {
            echo '{';
            echo '"hierarchy_id":"';echo $row['hierarchy_id']; echo '",';
            echo '"hierarchy_name":"';echo $row['hierarchy_name']; echo '"';
            echo '},';
        }
        echo "{}]";

    }

}
?>