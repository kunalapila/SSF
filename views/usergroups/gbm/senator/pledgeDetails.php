<?php
echo '<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Kunal Kapila & Sanjari Srivastava">
<title>
SSF
</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="css/homepage.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</head>

<body>
<div class="container-fluid">
';
include "./redirect.php";
$servername = "127.0.0.1";
$username = "root";
$password = "l;'";
$dbname = "SSF";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo '<h1>';
echo "Form";
echo $_POST['FormID'];
echo '</h1>';

$query = sprintf("SELECT SenatorID, MoneyPledged, Date FROM PledgedMoney WHERE FormID = %d", $_POST['FormID']);

$result = mysqli_query($conn, $query);
echo "<table class='table table-striped' width='100%'>";
echo "<thead>";
while($field=mysqli_fetch_field($result))
{
        echo "<td class='heading'><b>";
        echo $field->name;
        echo "</b></td>";
}
// echo "<td class='heading'><b>";
// echo "Delete";
// echo "</b></td>";
echo "</thead>";
echo "<tbody>";
while ($row=mysqli_fetch_row($result))
{
    echo "<tr>";
    for($i=0; $i < mysqli_num_fields($result); $i++) {
        echo "<td>";
        echo $row[$i];
        echo "</td>";
    }

    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
echo '<form method="post" class="form-group">';
        echo '<button type="submit"  class="btn btn-default" formaction="addMoney.php">Go Back</button>';
    echo "</form>";
echo '</div>
    </body>
    </html>';
?>