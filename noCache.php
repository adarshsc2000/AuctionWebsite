<?php
//Note: include/require this file for disabling caching

header("Cache-Control: no-cache, must-revalidate"); //for HTTP/1.1
header("Expires: Mon, 26 Jul 2008 05:00:00 GMT");  //any date in the past
?>
