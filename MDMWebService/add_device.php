<?php
/**
 * Created by PhpStorm.
 * User: parul
 * Date: 3/3/15
 * Time: 12:01 AM
 */



include('util.php');

function adddevice($data) {
    $conn=connect();
//    mysql_select_db('mdm2_12nov2014');
    $device_id=$feature=$imei=$meid=$macwifi=$macblue=$devicename=$modelid=$model=$devicetypeid=$devicetype=$photo=$platform=$os=$osversion=$dispsize=$dispres=$dpi=$seedappv=$buildv='';

    foreach ($data['info'] as $log) {
        if ($log['name'] == 'imei') {
            $imei = $log['value'];
        }
        if ($log['name'] == 'meid') {
            $meid = $log['value'];
        }
        if ($log['name'] == 'mac_wifi') {
            $mac_wifi = $log['value'];
        }
        if ($log['name'] == 'mac_blue') {
            $mac_blue = $log['value'];
        }
        if ($log['name'] == 'device_name') {
            $device_name = $log['value'];
        }
        if ($log['name'] == 'modelid') {
            $modelid = $log['value'];
        }
        if ($log['name'] == 'model') {
            $model = $log['value'];
        }
        if ($log['name'] == 'devicetypeid') {
            $devicetypeid = $log['value'];
        }
        if ($log['name'] == 'devicetype') {
            $devicetype = $log['value'];
        }
        if ($log['name'] == 'photo') {
            $photo = $log['value'];
        }
        if ($log['name'] == 'platform') {
            $platform = $log['value'];
        }
        if ($log['name'] == 'os') {
            $os = $log['value'];
        }
        if ($log['name'] == 'osversion') {
            $osversion = $log['value'];
        }
        if ($log['name'] == 'dispsize') {
            $dispsize = $log['value'];
        }
        if ($log['name'] == 'dispres') {
            $dispres = $log['value'];
        }
        if ($log['name'] == 'dpi') {
            $dpi = $log['value'];
        }
        if ($log['name'] == 'seedappv') {
            $seedappv = $log['value'];
        }
        if ($log['name'] == 'buildv') {
            $buildv = $log['value'];
        }
        if($log['name']=='action_flag'){
            $action_flag = $log['value'];
        }
        if($log['name']=='employee_id'){
            $employee_id=$log['value'];
        }
        if($log['name']=='device_id'){
            $device_id=$log['value'];
        }
        if($log['name']=='features'){
            $feature = $log['value'];
        }
    }

    if($conn==null){
        echo 'connection null';
        return json_decode('{"status":"db connection error.."}');
    }
    else {
        $sql = "call gst_add_device(" . $action_flag . "," . $employee_id . ",".$device_id.",'".$model."','".$imei."','".$meid."','".$mac_wifi."','".$mac_blue."','".$platform."','".$device_name."','".$feature."',@st1,@st2)";
        echo $sql;
        $result = mysql_query($sql);
        if ($result) {
            echo '{"status":"success"}';
        } else {
            echo '{"status":"failed : '.mysql_error().'"}';
        }
    }



}
?>