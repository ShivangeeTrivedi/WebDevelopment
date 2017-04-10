<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 20%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 1px;
}

th {text-align: left;}
</style>
</head>
<body>
<?php


echo "<br/><br/>";
$con = mysqli_connect('localhost','root','root','hw3');

if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$gender=$_REQUEST['q'];
$year=$_REQUEST['r'];
//echo $gender;
//echo $year;
if($gender==null){
	$sql = "SELECT name,rank,year,gender FROM babynames WHERE year=$year";
	//$result = mysqli_query($con,$sql);
}
else if($year==null){
	$sql = "SELECT name,rank,year,gender FROM babynames WHERE gender='$gender'";

  // $result = mysqli_query($con,$sql);
}
else if($year==null && $gender==null){
	$sql="select name,rank from babynames";
}
else{
$sql = "SELECT name,rank,year,gender FROM babynames WHERE gender='$gender' and year=$year";
//$result = mysqli_query($con,$sql);
}

$result = $con->query($sql);
if ($result->num_rows > 0) {
	echo "Here are the most popupular babynames along with thier ranks!";
echo "<table>
<tr>
<th>Name</th>
<th>Rank</th>
<th>Year</th>
<th>Gender</th>
</tr>";
while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['rank'] . "</td>";
	echo "<td>" . $row['year'] . "</td>";
	echo "<td>" . $row['gender'] . "</td>";
    echo "</tr>";
}
echo "</table>";
}
else{
	echo "Please select either year or gender, or both!";
}
mysqli_close();
?>
</body>
</html>
