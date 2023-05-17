<?php 
    $con = mysqli_connect("localhost","root","","short"); 

    if(!$con) {
        echo "<script>alert('Database not connected ! ')</script>";
    }


   
   


    if(isset($_GET['u'])) {
        $link = $_GET['u'];

        makerand: 
            function incrementalHash($len = 3){
                $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
                $base = strlen($charset);
                $result = '';
            
                $now = explode(' ', microtime())[1];
                while ($now >= $base){
                $i = $now % $base;
                $result = $charset[$i] . $result;
                $now /= $base;
                }
                return substr($result, -3);
            }
            $short = incrementalHash();
            
            $p =  mysqli_query($con,"SELECT * FROM `links` WHERE `link`='$link'");
            $old = mysqli_fetch_array($p);
            if(strlen($old['link'])>0) {
                echo "https://s.devsecit.com/go/".$old['short'];
                exit;
            }


            $q = mysqli_query($con,"SELECT * FROM `links` WHERE `short`='$short'"); 
            if(mysqli_num_rows($q)>0) {
                goto makerand;
            } else {
                $q = mysqli_query($con,"INSERT INTO `links` SET `link`='$link',`short`='$short',`status`='Live'  ");
                echo "https://s.devsecit.com/go/".$short;
            }
    }

?>