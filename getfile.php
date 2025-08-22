<?php

        $db_conn = mysqli_connect("localhost", "root", "", "training");
    if($db_conn){
        echo "db connected";
    }

    // get contents of a file into a string
    $filename = "Book1.csv";
    if(file_exists($filename)){
    //  echo 'file present <br>';
    }
    function query_to_csv($db_conn, $query, $filename, $attachment = false, $headers = true) {
        
        if($attachment) {
            // send response headers to the browser
            header( 'Content-Type: text/csv' );
            header( 'Content-Disposition: attachment;filename='.$filename);
            $fp = fopen('php://output', 'w');
        } else {
            $fp = fopen($filename, 'w');
        }
        
        $result = mysqli_query($db_conn,$query) or die( mysqli_error( $db_conn ) );
        
        if($headers) {
            // output header row (if at least one row exists)
            $row = mysqli_fetch_assoc($result);
            if($row) {
                fputcsv($fp, array_keys($row));
                // reset pointer back to beginning
                mysqli_data_seek($result, 0);
            }
        }
        
        while($row = mysqli_fetch_assoc($result)) {
            fputcsv($fp, $row);
        }
        
        fclose($fp);
    }

    // Using the function
    $sql = "SELECT * FROM trains";
    // $db_conn should be a valid db handle

    // output as an attachment
    query_to_csv($db_conn, $sql, "insertdata.csv", true);

    // output to file system
    query_to_csv($db_conn, $sql, "insertdata.csv", false);
?>