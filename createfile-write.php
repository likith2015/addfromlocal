<?php

// Connect to database
$conn = mysqli_connect("localhost", "root", "", "training");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="trains_export.csv"');

// Open output stream
$handle = fopen('php://output', 'w');

if (!$handle) {
    die("Could not open output stream.");
}

$query = "SELECT * FROM trains";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$fields = mysqli_fetch_fields($result);
$headers = [];
foreach ($fields as $field) {
    $headers[] = $field->name;
}
fwrite($handle, implode(",", $headers) . "\n");

while ($row = mysqli_fetch_assoc($result)) {
    $escaped = array_map(function($value) {
        $value = str_replace('"', '""', $value); 
        return '"' . $value . '"';               
    }, $row);

    fwrite($handle, implode(",", $escaped) . "\n");
}

fclose($handle);
exit;

?>
