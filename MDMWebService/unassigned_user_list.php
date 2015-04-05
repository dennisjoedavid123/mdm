<?php

function unassigned_user_list($data)
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

        if($employee_id==0)
        {
            $sql="select *from gst_unassigned_user_view";
        }
        else
        {
            $sql="select *from gst_unassigned_user_view where employee_id=$employee_id";
        }

        $result = mysql_query($sql);
        echo '[';
        while($row = mysql_fetch_assoc($result))
        {
            echo '{';
            echo '"employee_id":"';echo $row['employee_id']; echo '",';
            echo '"first_name":"';echo $row['first_name']; echo '",';
            echo '"middle_name":"';echo $row['middle_name']; echo '",';
            echo '"last_name":"';echo $row['last_name']; echo '"';
            echo '},';
        }
        echo "{}]";
    }

}
?>
