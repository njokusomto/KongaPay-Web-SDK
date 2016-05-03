<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Response to KongaPay Transaction</title>
</head>
<body>
<h2>KongaPay Response</h2>
<?php
$i = 1;
foreach ($_GET as $key => $value) {
    echo "<hr />" .$i . ". Key: " .$key . " <br /> value: " . $value;
}
?>
</body>
</html>
