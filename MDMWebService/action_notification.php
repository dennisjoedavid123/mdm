<?php

function send_action($data){
    require_once 'mdm/phpMQTT.php';
}

    $actionid=$profileid='';

    foreach ($data['info'] as $log) {
        if ($log['name'] == 'actionid') {
            $imei = $log['value'];
        }
        if ($log['name'] == 'profileid') {
            $meid = $log['value'];
        }

    }

if($conn==null){
    echo 'connection null';
    return json_decode('{"status":"db connection error.."}');
}
else {
    $sql = "select action_id from gst_features where
				feature_id in(select feature_id from gst_profile_feature_view
				where profile_master_id=$profileid) and action_id is not null";
    echo $sql;
    $result = mysql_query($sql);
    if ($result) {
        echo '{"status":"success"}';
    } else {
        echo '{"status":"failed : '.mysql_error().'"}';
    }
}

$MQTT_HOST=yii::app()->params['mqtt_host'];
$MQTT_PORT=yii::app()->params['mqtt_port'];
$connection=Yii::app()->db;

$userInfo =yii::app()->session->get("userInfo");
$topic=$userInfo['topic'];

/*
$command=$connection->createCommand("select action_id from gst_features where
				feature_id in(select feature_id from gst_profile_feature_view
				where profile_master_id=$profileid) and action_id is not null;");
*/
$dataReader=$command->query();
$actions=$dataReader->ReadAll();


$message = "";
$resText = "";

$fromIP = $_SERVER['REMOTE_ADDR'];

//$featureidlist=$_REQUEST['list_feature_id'];
//$applicationList = $_REQUEST['app'];

//var_dump($actionstr);die;

if(count($actions)>0){

    try{
        $conn = new phpMQTT($MQTT_HOST,$MQTT_PORT, "PHP MQTT Client");
        $conn->connect(false, NULL, NULL, NULL);
    }catch (Exception $e){}
    //var_dump($conn->connect(false, NULL, NULL, NULL))die;


    $message = "";


    $i=0;
    foreach ($actions as $commandName)
    {
        $message = "";
        $random = rand(1, 100);
        $random1 = rand(1,100);
        $message_id = time() . $random1;
        $notificationID = $deviceid . '-' . time() . $random.$i;
        $message.= "2~1~";
        $message.= "<notification>\n<id>" . $notificationID . "</id>\n<from>" . $fromIP . "</from>\n<to>" . $deviceid . "</to>\n<message_id>" . $message_id . "</message_id>\n";

        $message .= "<action>\n<action_type>profile</action_type>\n";

        $actionquery = "select * from gst_mdm_action_type where action_id=".$commandName['action_id'];

        $command=$connection->createCommand($actionquery);
        $dataReader=$command->query();
        $actionvalue=$dataReader->ReadAll();



        $message .= "<action_name>" . $actionvalue[0]['action_package'] . "</action_name>\n";

        $queryToGetParamsList ="select * from gst_mdm_action_params where action_id=".$commandName['action_id'];


        $command=$connection->createCommand($queryToGetParamsList);
        $dataReader=$command->query();
        $paramsListResponse=$dataReader->ReadAll();




        if (count($paramsListResponse[0]) > 0) {
            $message .= "<params>";
            foreach ($paramsListResponse as $key => $value) {
                $message .= "<" . strtolower(trim($value['param_name'])) . ">" . trim($value['param_value']) . "</" . strtolower(trim($value['param_name'])) . ">\n";
            }
            $message .= "</params>\n";
        }
        $message .= "</action>\n";


        $message .= "</notification>";
    }
    //$conn->publish("mdm_test/".$deviceid,$message,1,0,$notificationID);
    $conn->publish($topic.'/'.$deviceid,$message,1,0,$notificationID);
}


return true;

}