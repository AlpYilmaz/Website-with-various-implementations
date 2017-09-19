<?php 
/**
 * Allows one to view all tables and their data in a database
 *
 * To use this script ensure you have filled in your TWA username and database password
 */

$conn=mysqli_connect("localhost", "twa108", "twa108fh", "westernhotel108");
if ( !$conn ) {
	die("Connection failed: " . mysqli_connect_error());
}

$sql = "SHOW TABLES";
$tables = mysqli_query($conn, $sql);

$tablesAndTheirData = array();
while($tableName = $tables->fetch_array()) {
	$sql = "SELECT * FROM $tableName[0]";
	$data = mysqli_query($conn, $sql);
    array_push($tablesAndTheirData, array(
        'name' => $tableName[0], 
        'fields' => $data->fetch_fields(),
        'data' => $data
    ));
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Database Tables</title>
        <style type="text/css">
            td { border: 1px solid #ccc; padding:10px;}
        </style>
    </head>
    <body>
        <?php foreach($tablesAndTheirData as $table): ?>
        <p><strong><code><?php echo $table['name'];?></code> Table</strong>
            <?php if(count($table['data'])):?>
                <table>
                    <thead>
                        <tr style="font-weight:bold">
                        <?php foreach($table['fields'] as $field): ?>
                            
                            <td><?php echo $field->name;?></td>

                        <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                <?php while($row = $table['data']->fetch_assoc()): ?>
                    <tr>
                        <?php foreach($row as $key => $value):?>
                            <td><?php echo $value; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endwhile;?>
                    </tbody>
                </table>
            <?php else:?>
                <p>Table does not have any data</p>
            <?php endif;?>
        <?php endforeach;?>
    </body>
</html>