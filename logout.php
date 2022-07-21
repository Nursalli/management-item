<?php
require('vendor/autoload.php');

setcookie('X-PZN-SESSION', 'LOGOUT');

echo "<script>window.location.href='index.php';</script>";