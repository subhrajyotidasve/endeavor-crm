<?php
session_start();
unset($_session['isLoggedIn']);
header ("Location: /");
?>