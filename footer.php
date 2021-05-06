<?php

include "dbconn.php";

$qry= "SELECT * FROM `settings`";
$run= mysqli_query($con, $qry);
$data= mysqli_fetch_assoc($run);

?>

<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span><?php echo $data['footerDesc']; ?></span>
            </div>
        </div>
    </div>
</div>
</body>
</html>
