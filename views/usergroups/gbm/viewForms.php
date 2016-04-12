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
<div class="container">

<?php
include "../../../controllers/redirect.php";
if($_SESSION["username"]=="chair_ss" || $_SESSION["username"]=="presidentsg" || $_SESSION["username"]=="culsecy" || $_SESSION["username"]=="fmcsecy" || $_SESSION["username"]=="sportsecy" || $_SESSION["username"]=="finance" || $_SESSION["username"]=="sntsecy") {
    echo "<script>
        alert('You do not have access rights!');
    window.location.href='../../../controllers/logout.php';
</script>";
}
$servername = "127.0.0.1";
$username = "root";
$password = "l;'";
$dbname = "SSF";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query = sprintf("select * from Senators where Username = '%s'", $_SESSION['username']);
//echo $query;
$result = mysqli_query($conn, $query);
$GLOBALS['isSenator'] = false;
if(mysqli_num_rows($result) > 0)
{
    $GLOBALS['isSenator'] = true;
}
?>
<?php
    include 'nav.php';
?>
<?php
$query = sprintf("select FormID as 'Form ID', Event, CreationDate as 'Date of Creation', ExpiryDate as 'Date of Expiry', TargetAmount as 'Target Amount (in Rs.)', S.State as 'Status', Remark as 'Remarks', ApprovalState as 'StatusID' from Forms inner join  StatesOfApproval S ON S.ID = Forms.ApprovalState where Username = '%s'", $_SESSION["username"]);
//echo $query;
$result = mysqli_query($conn, $query);
echo "<table class='table panel panel-default table-striped' width='100%' style='margin-top:80px;'>";
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
echo "Edit";
echo "</b></td>";
echo "<td class='heading'><b>";
echo "Delete";
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
    if($row[7]==1 || $row[7]==0 || $row[7]==11) {
        echo '<button type="submit" value="' . $row[0] . '" name="FormID" class="btn btn-default" formaction="./editForm.php">Edit</button>';
        echo '</td><td>';
        echo '<button type="submit" value="' . $row[0] . '" name="FormIDD" class="btn btn-default" formaction="./deleteForm.php">Delete</button>';
    }
    else {
        echo '<button type="submit" value="' . $row[0] . '" name="FormID" class="btn btn-default disabled">Edit</button>';
        echo '</td><td>';
        echo '<button type="submit" value="' . $row[0] . '" name="FormIDD" class="btn btn-default disabled">Delete</button>';
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
