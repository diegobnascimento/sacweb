<?php

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "com.sacsystem.sacweb") {
    echo 'webview';
} else {
    echo 'browser';
}

?>
