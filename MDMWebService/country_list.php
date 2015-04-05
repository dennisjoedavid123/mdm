<?php

function viewcountry($data)
{
    $conn=connect();

    if($conn==null){
        return json_decode('{"status":"db connection error.."}');
    }
    else {

        $sql = "call get_country()";
        $result = mysql_query($sql);
        echo '[';
        while($row = mysql_fetch_assoc($result))
        {
            echo '{';
            echo '"country_id":"';echo $row['country_id']; echo '",';
            echo '"country_name":"';echo $row['country_name']; echo '",';
            echo '"country_code":"';echo $row['country_code']; echo '"';
            echo '},';
        }
        echo '{}]';
    }

}
?>