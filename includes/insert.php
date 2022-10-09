<?php

    include 'session.php';

    $sql = $_POST['sql'];    

    if($sql){

        $stid = oci_parse($conn, $sql);

        oci_execute($stid);

        oci_free_statement($stid);

        oci_close($conn);

    }