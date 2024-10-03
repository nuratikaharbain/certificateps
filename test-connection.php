<?php
require("connection2.php");
$status = 0;
$query = "SELECT * FROM historydownload";
$result = queryDb($query);
if(mysqli_num_rows($result) > 0)
{
    $status=1;
}
echo $status;

function debugFunction() {
    // Debugging output
    echo "Function has been called\n";
    return "Debug data";
}

$result = debugFunction();
echo "<br />Result: " . $result;

?>