<pre>
<?php


// get contents of a file into a string
$filename = "";
if(file_exists($filename)){
//  echo 'file present <br>';
}
$handle = fopen($filename, "r");
// $contents = fread($handle, filesize($filename));
// // print_r($contents);
// $normalizedContent = str_replace("\r\n", "\n", $contents);
// $rows = explode('\n',$normalizedContent);

// print_r($rows);

if ($handle) {
    $table_head = fgetcsv($handle);
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        // $data is an array representing a row in the CSV
        // Process $data here
        $table_rows[] = ($data);
    }
    fclose($handle);
}


// while($contents = fread($handle, filesize($filename))){

//     echo $contents;
//     echo '<br>';
// }

// fclose($handle);






$filename = "Train_details_22122017(in).csv";
$handle = fopen($filename, "r");
if ($handle) {
    $table_head = fgetcsv($handle);
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        // $data is an array representing a row in the CSV
        // Process $data here
        $table_rows[] = ($data);
    }
    fclose($handle);
}
?>

<table border="1" cellspacing="1" cellpadding=5 align="center">
    <tr>
        <?php foreach($table_head as $key => $head){ ?>
            <th><?php echo $head ?></th>

        <?php }?>
    </tr>
    
        <?php foreach($table_rows as $k => $val){  ?>
            <tr>
            <td><?php echo $val[0] ?></td>
            <td><?php echo $val[1] ?></td>
            <td><?php echo $val[2] ?></td>
            <td><?php echo $val[3] ?></td>
            <td><?php echo $val[4] ?></td>
            <td><?php echo $val[5] ?></td>
            <td><?php echo $val[6] ?></td>
            <td><?php echo $val[7] ?></td>
            <td><?php echo $val[8] ?></td>
            <td><?php echo $val[9] ?></td>
            <td><?php echo $val[10] ?></td>
            <td><?php echo $val[11] ?></td>
            </tr>
        <?php }?>
    
</table>
