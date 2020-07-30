<?php
error_reporting(E_ALL);

if ( isset($_POST['id']) ) {
    require_once('MYSQLDB.php');
    
    $record_id = preg_replace('#[^0-9]#i', '', $_POST['id']);
    
    if ( $record_id ) {
        $sql_delete = $db_connection->sql_query("DELETE FROM ".$db_connection->NUMTABLE." WHERE id =". $record_id);
        
        if (!$sql_delete) {
            trigger_error( $db_connection->sql_error($db_connection->connection), E_USER_NOTICE );
            exit();
            
        } else {
            /*echo 'Your Record Has Been Successfully Removed.';
            exit();*/
        }
    }
}
?>