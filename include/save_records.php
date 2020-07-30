<?php
/* 
========================================== 
Insert Script
========================================== 
*/
error_reporting(E_ALL);
$keys   = '';

if ( isset($_POST['firstname'], $_POST['lastname'], $_POST['phone_number']) ) {
    require_once('MYSQLDB.php');
    
    $firstname      = $db_connection->escape_value(preg_replace('#[^a-z]#i', '', $_POST['firstname']));
    $lastname       = $db_connection->escape_value(preg_replace('#[^a-z]#i', '', $_POST['lastname']));
    $phone_number   = $db_connection->escape_value(preg_replace('#[^0-9]#i', '', str_replace('+27', '0', $_POST['phone_number'])));
    
    if ( empty($firstname) ) {
        echo 'Firstname Field Must Contain Data.';
        exit();
        
    } elseif ( empty($lastname) ) {
        echo 'Lastname Field Must Contain Data.';
        exit();
        
    } elseif ( empty($phone_number) ) {
        echo 'Phone Number Field Must Contain Data.';
        exit();
        
    } elseif (!is_numeric($phone_number)) {
        echo 'Phone Number Field Must Contain Numbers.';
        exit();
    
    } else {
        
        $value_array = array('firstname','lastname','number','created', 'updated');
        
        $keys .= '(' .join(',', $value_array). ')';
        
        #Check to see if the phone number already exists
        $sql_search_num = $db_connection->sql_query("SELECT * FROM ".$db_connection->NUMTABLE." WHERE number ='".$phone_number."' LIMIT 1");
        
        if ( !$sql_search_num ) {
            /*trigger_error( $db_connection->sql_error($db_connection->connection), E_USER_NOTICE );*/
            echo 'An Error Occured Getting Your Number, It Might Have Already Been Used.';
            exit();
            
        } else {
            #Run through the DB to check the availability of the users number
            if ( $db_connection->sql_numRow($sql_search_num) > 1 ) {
                echo 'Mobile NUmber Has Been Taken, Try Another One.';
                exit();
            }
        }
        
        #Save record(s) to the DB
        $sql_save_records = $db_connection->sql_query('INSERT INTO '.$db_connection->NUMTABLE.$keys. ' VALUES (
        "'.$firstname.'", "'.$lastname.'", "'.$phone_number.'", NOW(), NOW())');
        
        if ( !$sql_save_records ) {
            /*trigger_error( $db_connection->sql_error($db_connection->connection), E_USER_NOTICE );*/
            echo 'An Error Occured Saving Your Contacts, It Might Have Already Been Used.';
            exit();
            
        } else {
            echo 'Your Record Has Been Successfully Saved.';
            exit();
        }
    }
}
?>