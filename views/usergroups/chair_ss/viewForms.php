<?php
include "../../../controllers/redirect.php";
if($_SESSION["username"]!="chair_ss") {
    echo "<script>
        alert('You do not have access rights!');
    window.location.href='../../../controllers/logout.php';
</script>";
}
?>
<html>
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
<?php
$servername = "127.0.0.1";
$username = "root";
$password = "l;'";
$dbname = "SSF";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query = sprintf("select FormID as 'Form ID', Event, CreationDate as 'Date of Creation', ExpiryDate as 'Date of Expiry', TargetAmount as 'Target Amount (in Rs.)', S.State as 'Status', Remark as 'Remarks', ApprovalState as 'StatusID' from Forms inner join  StatesOfApproval S ON S.ID = Forms.ApprovalState where Council = '%s' and Forms.ApprovalState not in(0,1,8)", $_SESSION["username"]);
//echo $query;
$result = mysqli_query($conn, $query);
echo "<table class='table table-striped' width='100%'>";
echo "<thead>";
while($field=mysqli_fetch_field($result))
{
    if($field->name!="StatusID"){
        echo "<td class='heading'><b>";
        echo $field->name;
        echo "</b></td>";
    }
}
echo "<td class='heading'><b>";
echo "View";
echo "</b></td>";
echo "<td class='heading'><b>";
echo "Edit";
echo "</b></td>";
echo "</thead>";
echo "<tbody>";
while ($row=mysqli_fetch_row($result))
{
    echo "<tr>";
    for($i=0; $i < mysqli_num_fields($result)-1; $i++) {
        echo "<td>";
        echo $row[$i];
        echo "</td>";
    }
    echo "<td>";
    echo '<form method="post" class="form-group">';
    echo '<button type="submit" value="' . $row[0] . '" name="FormID" class="btn btn-default" formaction="./viewForm.php">View</button>';
    echo '</td><td>';
    if($row[7]==2 || $row[7]==3 || $row[7]==9) {
        echo '<button type="submit" value="' . $row[0] . '" name="FormID" class="btn btn-default" formaction="../../../controllers/usergroups/executive/editForm.php">Edit</button>';
    }
    else {
        echo '<button type="submit" value="' . $row[0] . '" name="FormID" class="btn btn-default disabled">Edit</button>';
    }
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
echo '</div>
    </body>
    </html>';
?>
