<?php
require 'config.php';

$result = $conn->query("SELECT * FROM registrations");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registered Participants</title>
    <style>
        table{
            border-collapse: collapse;
            width:100%;
        }
        th,td{
            border:1px solid black;
            padding:10px;
            text-align:center;
        }
        th{
            background:#f2f2f2;
        }
    </style>
</head>
<body>

<h2>Sports Meet Registrations</h2>

<table>
<tr>
    <th>ID</th>
    <th>Bib No</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Sport</th>
    <th>Participation</th>
    <th>Team</th>
</tr>

<?php
while($row = $result->fetch_assoc())
{
?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['bib']; ?></td>
    <td><?php echo $row['full_name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['phone']; ?></td>
    <td><?php echo $row['sport']; ?></td>
    <td><?php echo $row['participation']; ?></td>
    <td><?php echo $row['team_name']; ?></td>
</tr>
<?php
}
?>

</table>

</body>
</html>