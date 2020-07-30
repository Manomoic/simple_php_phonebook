<?php
/* 
========================================== 
Display Contents
========================================== 
*/
error_reporting(E_ALL);

require_once('MYSQLDB.php');
$output     = '';

$sql_search = $db_connection->sql_query("SELECT * FROM ".$db_connection->NUMTABLE." ORDER BY created");

if ( !$sql_search ) {
    trigger_error( $db_connection->sql_error($db_connection->connection), E_USER_NOTICE );
    exit();
}

if ( $db_connection->sql_numRow($sql_search) > 0 ) {
    
    $output .= '<div class="table-responsive my-3">';
    $output .= '<table class="table table-md table-hover table-bordered table-data mt-1">';
    $output .= '<thead>
                    <th width="25%">Mobile Number</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Action</th>
                </thead>';
    while( $row = $db_connection->sql_fetch($sql_search)) {
        $output .= '<tbody>';
        $output .= '<tr>';
        $output .= '<td>'.$row['number'].'</td>';
        $output .= '<td>'.$row['firstname'].'</td>';
        $output .= '<td>'.$row['lastname'].'</td>';
        
        $output .= '<td>
            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-outline-danger" name="btn_note_delete" onclick="btn_note_delete('.$row['id'].')" >Delete</button>
                
                <button class="btn btn-outline-secondary" type="button" id="'.$row['id'].'" onclick="update_record_link('.$row['id'].')">Edit</button>
            </div>
        </td>';

        
        $output .= '</tr>';
        $output .= '</tbody>';
    }
    
    $output .= '</table>';
    $output .= '</div>';
    
} else {
    $output .= '<p class="lead"> No Available Contacts. Please Click The *Add* Button. </p>';
    
}

echo $output;
?>