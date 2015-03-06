<?php

function viewuser($data)
{

    $empid = '';

    foreach ($data['info'] as $log) {
        if ($log['name'] == 'emp_id') {
            $empid = $log['value'];
        }
    }
    $conn=connect();
    //ect_db('edetailing_7feb2014');
    // echo $username . " " . $password;
    if($conn==null){
        return json_decode('{"status":"db connection error.."}');
    }
    else {

        $sql = "call get_employee_v2($empid)";
        $result = mysql_query($sql);

        while($row = mysql_fetch_assoc($result))
        {
          echo '{';
            echo '"first_name":"';echo $row['first_name']; echo '",';
            echo '"middle_name":"';echo $row['middle_name']; echo '",';
            echo '"last_name":"';echo $row['last_name']; echo '",';
            echo '"department":"';echo $row['Department']; echo '",';
            echo '"gender":"';echo $row['gender']; echo '",';
            echo '"country":"';echo $row['country_name']; echo '",';
            echo '"device_id":"';echo $row['device_id']; echo '",';
            echo '"department_id":"';echo $row['department_id']; echo '",';
            echo '"hierarchy_id":"';echo $row['hierarchy_id']; echo '",';
            echo '"country_id":"';echo $row['country_id']; echo '",';
            echo '"gender_id":"';echo $row['gender_id']; echo '",';
            echo '"marital_status_id":"';echo $row['marital_status_id']; echo '",';
            echo '"photo":"';echo $row['photo']; echo '",';
            echo '"Role":"';echo $row['Role']; echo '",';
            echo '"employee_code":"';echo $row['employee_code']; echo '",';
            echo '"address":"';echo $row['address']; echo '",';
            echo '"city":"';echo $row['city']; echo '",';
            echo '"state":"';echo $row['state']; echo '",';
            echo '"pincode":"';echo $row['pincode']; echo '",';
            echo '"email":"';echo $row['email']; echo '",';
            echo '"landline":"';echo $row['landline']; echo '",';
            echo '"dob":"';echo $row['dob']; echo '",';
            echo '"marital_status":"';echo $row['marital_status']; echo '",';
            echo '"login_name":"';echo $row['login_name']; echo '",';
            echo '"password":"';echo $row['password']; echo '"';
            echo '}';
       }

    }


}
?>