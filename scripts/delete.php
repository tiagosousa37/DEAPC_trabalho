<?php
        //include our connection
        include 'dbconfig.php';
 
        //delete the row of selected id
        $sql = "DELETE FROM members WHERE rowid = '".$_GET['id']."'";
        $db->query($sql);
 
        header('location: registo.php');
?>
