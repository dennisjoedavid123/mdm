<?php
/**
 * Created by PhpStorm.
 * User: parul
 * Date: 3/4/15
 * Time: 3:10 PM
 */

function send_actions_to_device($data){

    $actionidlist='';
    $deviceidlist='';
    foreach ($data['info'] as $log) {
        if($log["name"]=="actionidlist"){
            $actionidlist=$log["value"];
        }
        if($log["name"]=="deviceidlist"){
            $deviceidlist=$log["value"];
        }
    }

    //this line of code need to be change based on the host configuration....

    require_once 'phpMQTT.php';
    $MQTT_HOST=yii::app()->params['mqtt_host'];
    $MQTT_PORT=yii::app()->params['mqtt_port'];
    $connection=Yii::app()->db;

    //var_dump('action to device');
//taking tpic from session and pass it to publish method of mosquitto by tushar on 26 aug 2014
    $userInfo =yii::app()->session->get("userInfo");
    $topic=$userInfo['topic'];
    //var_dump($topic);


    $message = "";
    $resText = "";

    $fromIP = $_SERVER['REMOTE_ADDR'];

    //$featureidlist=$_REQUEST['list_feature_id'];
    //$applicationList = $_REQUEST['app'];

    //var_dump($actionstr);die;

    if(isset($actionidlist)){

        try{
            $conn = new phpMQTT($MQTT_HOST,$MQTT_PORT, "PHP MQTT Client");
            //$conn->connect(false, NULL, NULL, NULL);
            //var_dump($conn->connect(false, NULL, NULL, NULL))die;

        }catch(Exception $e){}



        //var_dump($actionidlist);
        foreach ($deviceidlist as $deviceid)
        {$conn->connect(false, NULL, NULL, NULL);
            $message = "";
            $i=0;
            $random = rand(1, 100);
            $message_id = time() . $random;
            $notificationID = $deviceid . '-' . time() . $random;
            $message.= "<notification>\n<id>" . $notificationID . "</id>\n<from>" . $fromIP . "</from>\n<to>" . $deviceid . "</to>\n<message_id>" . $message_id . "</message_id>\n";

            foreach ($actionidlist as $commandName)
            {

                //$message.= "2~1~";

                $message .= "<action>\n<action_type>notification</action_type>\n";

                $actionquery = "select * from gst_mdm_action_type where action_id=".$commandName;

                $command=$connection->createCommand($actionquery);
                $dataReader=$command->query();
                $actionvalue=$dataReader->ReadAll();



                $message .= "<action_name>" . $actionvalue[0]['action_package'] . "</action_name>\n";

                $queryToGetParamsList ="select * from gst_mdm_action_params where action_id=".$commandName;


                $command=$connection->createCommand($queryToGetParamsList);
                $dataReader=$command->query();
                $paramsListResponse=$dataReader->ReadAll();




                if (isset($paramsListResponse)) {
                    $message .= "<params>";
                    foreach ($paramsListResponse as $key => $value) {
                        $message .= "<" . strtolower(trim($value['param_name'])) . ">" . trim($value['param_value']) . "</" . strtolower(trim($value['param_name'])) . ">\n";
                    }
                    $message .= "</params>\n";
                }
                $message .= "</action>\n";




                $command=$connection->createCommand("call set_mdm_request_response_history(1,'$notificationID','$fromIP',$deviceid,$commandName,'','Pending','',@st)");
                try{
                    $command->execute();
                }catch(Exception $e){}

                $i++;


                $command=$connection->createCommand("call set_comm_history('3','$message_id','0','','$deviceid','$message',@st)");
                try{
                    $command->execute();
                }catch(Exception $e){}
            }
            $message .= "</notification>";
            //try{
            //var_dump('hi'.$topic.'/'.$deviceid);
            $conn->publish($topic.'/'.$deviceid,$message,1,0,$notificationID);
            //}catch(Exception $e){}
        }
    }

//var_dump('ok');
    //error_log($commandName);
    error_log($message);
    if($commandName==16)
    {

        $command=$connection->createCommand("update gst_device_master set device_status=2 where device_id=".$deviceid);
        //try{
        $command->execute();
    }elseif($commandName==13)
    {
        $command=$connection->createCommand("update gst_device_master set device_status=3 where device_id=".$deviceid);
        //try{
        $command->execute();
    }


echo "success";
}