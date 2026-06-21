<?php
require 'config.php';

$result = $conn->query("SELECT * FROM inquiries ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Inquiries</title>
    <style>
        table{
            border-collapse: collapse;
            width:100%;
        }
        th,td{
            border:1px solid black;
            padding:10px;
            text-align:left;
        }
        th{
            background:#f2f2f2;
        }
    </style>
</head>
<body>

<h2>Sports Meet — Contact Inquiries</h2>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Subject</th>
    <th>Message</th>
    <th>Received</th>
</tr>

<?php
while($row = $result->fetch_assoc())
{
?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo htmlspecialchars($row['name']); ?></td>
    <td><?php echo htmlspecialchars($row['email']); ?></td>
    <td><?php echo htmlspecialchars($row['phone']); ?></td>
    <td><?php echo htmlspecialchars($row['subject']); ?></td>
    <td><?php echo htmlspecialchars($row['message']); ?></td>
    <td><?php echo $row['created_at']; ?></td>
</tr>
<?php
}
?>

</table>

</body>
</html>
