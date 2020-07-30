<?php
error_reporting(E_ALL);
require_once('MYSQLDB.php');

$edit_user_id   = '';
$edit_firstname = '';
$edit_lastname  = '';
$edit_number    = '';
$record_id      = '';

if ( isset($_POST['get_id']) ) {
    $record_id .= preg_replace('#[^0-9]#i', '', $_POST['get_id']);
    
    $sql_search_record = $db_connection->sql_query("SELECT * FROM ".$db_connection->NUMTABLE." WHERE id ='".$record_id."' LIMIT 1");
    
    if (!$sql_search_record) {
        trigger_error( $db_connection->sql_error($db_connection->connection), E_USER_NOTICE );
        exit();
    }
    
    if ( $db_connection->sql_numRow($sql_search_record) > 0 ) {
        foreach( $sql_search_record as $data ) {
            $edit_user_id        .= $data['id'];
            $edit_firstname      .= $data['firstname'];
            $edit_lastname       .= $data['lastname'];
            $edit_number         .= $data['number'];
            ?>
<!-- Update Form Goes Hear -->
<div class="card border-0 shadow mt-4 mx-auto" style='Width: 60%'>
   
    <div class="card-header">
        <a class="btn btn-outline-info btn-sm" onclick="enable_contents()">View</a>
    </div>
   
    <div class="card-text lead text-center mt-2" id="update_records"></div>
    
    <div class="card-body">
        <form class="text-muted" onsubmit="return false;">
            <div class="form-group">
                <input type="type" name="editfirstname" id="editfirstname" class="form-control" placeholder="Firstname" value="<?php echo htmlspecialchars($edit_firstname)?>" disabled="disabled"/> 
            </div>
            <div class="form-group">
                <input type="type" name="editlastname" id="editlastname" class="form-control" placeholder="Lastname" value="<?php echo htmlspecialchars($edit_lastname)?>" disabled="disabled"/> 
            </div>
            <div class="form-group">
                <input type="type" name="editphone_number" id="editphone_number" class="form-control" placeholder="Contact Number" maxlength="10" value="<?php echo htmlspecialchars($edit_number)?>" disabled="disabled"/> 
            </div>
        </form>
        
        <div class="card-text lead text-center mt-2" id="editable_results"></div>
    </div>
    
    <div class="card-footer">
       <div class="btn-group btn-group-sm float-right" role="group">
           <button class="btn btn-outline-success" type="button" onclick="btn_update_record(<?php echo htmlspecialchars($edit_user_id)?>)" id="btn_update_contents" disabled=""> Update</button>
           
           <button class="btn btn-outline-danger" onclick="btn_close_update()" type="button"> Close </button>
       </div>
    </div>
</div>
            <?php
        }   
    }
}
?>