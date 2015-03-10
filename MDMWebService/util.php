
<?php


/**
 * Created by PhpStorm.
 * User: parul
 * Date: 28/2/15
 * Time: 12:00 PM
 */

//include('dbconnect.php');
//convertValuesID("gst_marital_status","marital_status_id","marital_status","married");
function convertValuesID($table_name,$result_type,$input_type,$value)
{
    $conn = connect();
//    mysql_select_db('mdm2_12nov2014');
    if ($conn) {

        $sql = "select " . $result_type . " from " . $table_name . " where upper(" . $input_type . ")='" . strtoupper($value) . "'";
        $result = mysql_query($sql);
        if(!$result){
            echo "not result found";

        }
        else {
            while ($row = mysql_fetch_assoc($result)) {
                return $row[ $result_type ];
            }

        }
    }
}
?>