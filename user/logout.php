<?php
session_start();
$_SESSION['ulogin'] == "";
session_unset();
// session_destroy();
$_SESSION['errmsg'] = "You have successfully logout";
?>
<script language="javascript">
    document.location = "login.php";
</script>