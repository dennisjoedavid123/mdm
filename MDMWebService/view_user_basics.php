<?php
/**
 * Created by PhpStorm.
 * User: parul
 * Date: 13/3/15
 * Time: 9:45 PM
 */

function view_user_basics($data)
{
    $conn=connect();

    if($conn==null){
        return json_decode('{"status":"db connection error.."}');
    }
    else {

        $sql = "call get_user_basics()";
        $resultsets = getResultSet($sql);
        $dept_detail=$resultsets['DepartmentDetail'];

        print_r($dept_detail);
//        while($row = mysql_fetch_assoc($result))
//        {
//            echo '{';
//            echo '"department_id":"';echo $row['department_id']; echo '",';
//            echo '"department_name":"';echo $row['department_name']; echo '",';
//            echo '"gender_id":"';echo $row['gender_id']; echo '",';
//            echo '"gender":"';echo $row['gender']; echo '",';
//            echo '"marital_status_id":"';echo $row['marital_status_id']; echo '",';
//            echo '"marital_status":"';echo $row['marital_status']; echo '",';
//            echo '"country_id":"';echo $row['country_id']; echo '",';
//            echo '"country_name":"';echo $row['country_name']; echo '"';
//            echo '}';
//        }

    }

}

function getResultSet($sql){

    $conn= connect();
    if ($conn->multi_query($sql)) {
        $show_results = true;
        $rs = array();

        $i = 0;

        do {
            // Lets work with the first result set

            if ($result = $conn->use_result()) {
                // Loop the first result set, reading it into an array


                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    if (!isset($row['table_name']))
                        $row['table_name'] = 'default';
                    $rs[$row['table_name']][] =$row;

                }



                // Close the result set
                $result->close();
            }

            $i++;

        } while ($conn->next_result());

    } else {
        $this->errorMsg = sprintf('MySQL Server connection failed: %', mysqli_connect_error());
        //die(printf('MySQL Server connection failed: %s', mysqli_connect_error()));
        return false;
    }
    $conn->close();
    return $rs;
}

?>