<?php
session_start();
if (isset($_SESSION["userid"])) {
    echo "1";
} else {
    echo "2";
}
