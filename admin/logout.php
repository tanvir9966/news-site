<?php

session_start();

unset($_SESSION['username']);
unset($_SESSION['user_id']);
unset($_SESSION['role']);

?>

<script>
    location.replace("../admin");
</script>
