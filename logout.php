<?php
require_once __DIR__ . '/vendor/autoload.php';

setcookie('X-PZN-SESSION', 'LOGOUT');

echo "<script>window.location.href='index.php';</script>";