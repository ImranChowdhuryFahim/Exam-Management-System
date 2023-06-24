<?php

$conn = oci_connect("halltracker_admin", "1234", "//localhost:/orcldb");

if (!$conn) {
    echo "Connection failed ";
}

?> 