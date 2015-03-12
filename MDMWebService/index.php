<?php
header('Access-Control-Allow-Origin: *');
include('dbconnect.php');
$post_json = $_POST;
$data = json_encode($post_json);
$data_decode = json_decode($data, true);
$method = '';
$params = '';
$key = '';
  //$database = "edetailing_7feb2014";
//echo "data1 ".$data;
foreach ($data_decode['methodinfo'] as $dat) {
    //echo $dat['method'].' params='.$dat['noofparams'];
    $method=$dat['method'];
    $params=$dat['noofparams'];
    $key= $dat['publickey'];

}


if(checkParam($method,$params,$key)==1){
//    echo 'check'.$method;
    switch($method){

        case 'login':
        {
            include('authuser.php');
            authUser($data_decode);
            break;
        }
        case 'adduser':
        {
            include('add_user.php');
            adduser($data_decode);
            break;
        }
        case 'updateuser' :
        {
            include('update_user.php');
            updateuser($data_decode);
            break;
        }
        case 'adddevice':
        {
            include('add_device.php');
            adddevice($data_decode);
            break;
        }
        case 'viewuser':
        {
             include('view_user.php');
             viewuser($data_decode);
             break;
        }
        case "countrylist" :
        {
            include('country_list.php');
            viewcountry($data_decode);
            break;
        }
        case "deviceinfo":
        {
            include('device_info.php');
            viewdevice($data_decode);
            break;
        }
        case "featurelist":
        {
            include('get_feature_details.php');
            viewfeaturedetails($data_decode);
            break;
        }

    }

}
else{
   echo '{"status":"failed"}';
}

function checkParam($methodname, $parameter, $publickey) {
  // echo 'checkParam called';
    $conn=connect();
//    mysql_select_db('mdm2_12nov2014');
    if ($conn==null) {
        echo "Not  connected...";
    } else {
        $result = mysql_query("select * from request_param_table where method='".$methodname."' and no_of_param=".$parameter);
        if (!$result) {
            die("Database query failed: " . mysql_error());
        } else {
            $res=mysql_query("select * from authtokentable where publickey='".$publickey."'");
            if($res){
//                echo 'success';
               return 1;
            }
            else {
//                echo 'not success';
                return 0;
            }

        }
    }

}






?>