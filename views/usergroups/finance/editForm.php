<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Kunal Kapila & Sanjari Srivastava">
        <title>
            Edit Form
        </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/homepage.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>

    <!--<body>-->
        <div id="body" class="col-lg-8">
            <!--<h1>Senator Seed Fund</h1>-->
            <form method="post" class="form-group">
<?php
include "../../../../controllers/redirect.php";
$servername = "127.0.0.1";
$username = "root";
$password = "l;'";
$dbname = "SSF";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = sprintf("select Name, RollNumber, Email, Phone, Event, TargetAmount, ExpiryDate, Council,Remark,ApprovalState from Forms where FormID = %d ", $_POST["FormID"]);

$result = mysqli_query($conn, $query);
$row=mysqli_fetch_row($result);

$query1 = sprintf("Select sum(MoneyPledged) from PledgedMoney where FormID = %d", $_POST["FormID"]);
$result1 = mysqli_query($conn, $query1);
$row1=mysqli_fetch_row($result1);

echo 'Name:<input type="TEXT" class="form-control" name="name" value= "'. $row[0].'" >' ;
echo 'Roll Number:<input type="Number" class="form-control" name="roll" value ="'. $row[1] .'">';
echo 'Phone Number:<input type="tel" class="form-control" name="phone" value ="'. $row[3] .'">';
echo 'Email ID:<input type="email" class="form-control" name="email" value="'. $row[2] .'">';
echo 'Event Details:<input type="url" class="form-control" name="event" value="'. $row[4] .'">';
echo 'Target Amount (in Rs.):<input type="number" step="any" class="form-control" name="amount" value ="'. $row[5] .'" disabled>';
echo 'Amount Reached (in Rs.):<input type="number" step="any" class="form-control" name="amount" value ="'. $row1[0] .'" disabled>';
echo 'Expiry Date:<input type="date" class="form-control" name="expiry" value="'. $row[6] .'" data-date-format="mm/dd/yyyy">';
echo 'Council:';
//echo $row[7];
echo '<select class="form-control" disabled><option value="culsecy" ';if($row[7]=='culsecy') echo 'selected'; echo '>Cultural Council</option><option value="sportsecy" ';if($row[7]=='sportsecy') echo 'selected';echo '>Games and Sports Council</option><option value="presidentsg" ';if($row[7]=='presidentsg') echo 'selected'; echo '>Presidential Council</option><option value="fmcsecy" ';if($row[7]=='fmcsecy') echo 'selected'; echo '>Films and Media Council</option><option value="sntsecy" ';if($row[7]=='sntsecy') echo 'selected'; echo '>Science and Technology Council</option></select>';
//echo '<input type="hidden" name="council" value="'.$row[7].'"';
echo 'Remarks:<input type="TEXT" class="form-control" name="remark" value="'.$row[8].'">';
if($row[9] != 8){
    echo 'State:';
    echo '<select class="form-control" name="state">
       <option value="4" ';if($row[9]==4 || $row[9]==5 || $row[9]==6 ) echo 'selected'; echo '>Unapproved</option> 
       <option value="7" ';if($row[9]==7) echo 'selected'; echo '>Approve</option> 
       <option value="10" '; echo '>Reject</option> 
       <option value="11" ';echo '>Send Back to '.$row[0].'</option>
        </select>';
    echo '<button type="submit" name="FormID" class="btn btn-default" value="'.$_POST['FormID'].'" formaction="./updateForm.php">Confirm</button>';
}
else{
    echo 'State:';
    echo '<select class="form-control" name="state" disable>
       <option value="8" ';if($row[9]==8) echo 'selected'; echo '>Rejected</option> 
        </select>';
    echo '<button type="submit" name="FormID" class="btn btn-default" value="'.$_POST['FormID'].'" disabled>Confirm</button>';
}

echo '</form></div></html>'; 
?>
