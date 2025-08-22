<?php

$conn = mysqli_connect("localhost", "root", "", "training");
$sql = "SELECT * FROM trains";
$result = mysqli_query($conn, $sql);

// echo "CSV file '$filename' created successfully.";
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="data.csv"');

$handle = fopen('php://output', 'w');

$filename = "data.csv";   
$headersWritten = false;

while ($row = mysqli_fetch_assoc($result)) {
    if (!$headersWritten) {
        fputcsv($handle, array_keys($row)); // write headers from keys
        $headersWritten = true;
    }
    fputcsv($handle, $row); // write data
}
fclose($handle);
mysqli_close($conn);

?>