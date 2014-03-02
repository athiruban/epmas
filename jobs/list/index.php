<?php
session_start();
require('../../lib/dbutils.php');
//if no session go to login
if(!isset($_SESSION['emp_design'])){
    echo "Authorizatin required!";
    sleep(3);
    header("Location: ".FULLPATH.""); 
}
if($_SESSION['emp_design']!='M'){
    echo 'Invalid Call. You dont have access to create new job.';
    header("Location: ".FULLPATH."/home");
}
$USER_TYPE =$_SESSION['emp_design'];
$USER_ID   =$_SESSION['emp_id'];
$USER_PASS =$_SESSION['emp_password'];
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>EPM and AS - My to do list</title>
        <link rel="stylesheet" href="../../css/foundation.css" />
        <link rel="stylesheet" type="text/css" href="../../css/tcal.css" />
        <link rel="stylesheet" href="../../css/table.css" />
        <script src="../../js/tcal.js"></script>
        <script src="../../js/modernizr.js"></script>
    </head>
    <body>
        <?php
        //displaymenu();
        require(FULLPATH.'/header.php');
        $token = connectToDBServer();
        $result = connectToDB($token);
        if($result==false) {
            echo "Database is currently down";
            exit(0); 
        }
        ?>
        <div class="row">
        <?php
        require(FULLPATH.'/menu-bar.php?emp_design='.$USER_TYPE);
        ?>
            <div class="large-9 medium-9 columns">
                <div class="panel">
                    <p>List of jobs assigned to you.</p>
                    <?php
                    populateJobLst($token, $USER_ID);    
                    ?>
                </div> <!-- End of Panel -->
            </div>     
        </div> <!--End of row -->
        <div class="row">
            <div class="large-12 medium-12 columns">
                <center> <span style="font-size:9px">&copy; Copyrights 2014. Some rights reserved.</span></center>
            </div>
        </div>
        <script src="../../js/jquery.js"></script>
        <script src="../../js/foundation.min.js"></script>
        <script src="../../js/athi.js"> </script>
        <script src="../../js/tablesorter.js"> </script>
        <script>
            $(document).foundation();
            $(document).ready(function() 
            { 
                $("#myTable").tablesorter(); 
            } 
); 
        
        </script>
    </body>
</html>
