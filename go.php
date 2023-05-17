<?php 
    $con = mysqli_connect("localhost","root","","short"); 

    if(!$con) {
        echo "<script>alert('Database not connected ! ')</script>";
    }

 
    if(isset($_GET['id'])) {
        $short = $_GET['id'];
 
            $q = mysqli_query($con,"SELECT * FROM `links` WHERE `short`='$short'"); 
            if(mysqli_num_rows($q)>0) {
                echo "<script>location.href='https://devsecit.com/rand/$short'</script>";
            } else {
                header("location:404");
            }
    }

?>