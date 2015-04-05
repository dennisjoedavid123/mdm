<?php
/**
 * Created by PhpStorm.
 * User: parul
 * Date: 3/4/15
 * Time: 2:10 PM
 */



function writeProxyFile($data){
    $proxylist='';
    $foldername='';
    foreach ($data['info'] as $log) {
        if($log["name"]=="proxylist"){
            $proxylist=$log["value"];
        }
        if($log["name"]=="foldername"){
            $foldername=$log["value"];
        }
    }
    $res=file_put_contents($foldername.'/mdm22_whitelist', $proxylist);
    if($res!=false || $res!=0){
        echo true;

    }
}
function restartProxy(){
    $pid=shell_exec('pidof squid3');
    $cmd = 'sudo /usr/sbin/service squid3 restart';

    exec($cmd, $output, $exitCode);
    if ($exitCode != 0) {
        trigger_error("Command \"$cmd\" failed with exit code $exitCode: " .
            join("\n", $output), E_USER_ERROR);}

    $pid1=shell_exec('pidof squid3');
    if($pid!=$pid1)
    {echo 'proxy restarted';

    }

    else{
        echo 'not restarted';
    }
}
function writeUserProxy($data){
    $userlist='';
    $foldername1='';

    foreach ($data['info'] as $log) {
        if($log["name"]=="userlist"){
            $userlist=$log["value"];
        }
        if($log["name"]=="foldername"){
            $foldername1=$log["value"];
        }
    }

    $res=file_put_contents($foldername1.'/mdm22_user', $userlist);
    $cmd='sh '.\yii::app()->params['proxypath'].'addingpasswd.sh';
    var_dump($cmd);
    exec($cmd,$op);
    var_dump($op);
    if($op!=NULL)echo "<pre></pre>";
    else echo 'problem';


    if($res!=false){
        echo true;
    }

}

function readProxy(){
    $foldername=$_REQUEST['foldername'];
    $file=file($foldername.'/mdm22_whitelist');
    $filedata='';
    foreach ($file as $text){
        $filedata.=$text;
    }
    echo $filedata;

}
?>