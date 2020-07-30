<?php
error_reporting(E_ALL);

if( isset($_REQUEST['id'], $_REQUEST['name'], $_REQUEST['surname'], $_REQUEST['number']) ) {
    require_once('MYSQLDB.php');
    
    $user_id        = $db_connection->escape_value($_REQUEST['id']);
    $user_name      = preg_replace('#[^a-z]#i', '',$_REQUEST['name']);
    $user_surname   = preg_replace('#[^a-z]#i', '',$_REQUEST['surname']);
    $user_number    = $db_connection->escape_value($_REQUEST['number']);
    var_dump($user_id);
    $sql_search_record = $db_connection->sql_query("SELECT * FROM ".$db_connection->NUMTABLE." WHERE id ='".$user_id."' LIMIT 1");
    
    if (!$sql_search_record) {
        trigger_error( $db_connection->sql_error($db_connection->connection), E_USER_NOTICE );
        exit();
    }
    
    $sql_update = $db_connection->sql_query("UPDATE ".$db_connection->NUMTABLE." SET firstname= '".$user_name."', lastname ='".$user_surname."', number ='".$user_number."', updated =NOW() WHERE id =" .$user_id);
    
    if (!$sql_update) {
        trigger_error( $db_connection->sql_error($db_connection->connection), E_USER_NOTICE );
        exit();
    }
}
?>