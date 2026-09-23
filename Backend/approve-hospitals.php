


<?php
include './connection.php';
$query = "SELECT * FROM hospital WHERE status = 'Pending'";
$result = mysqli_query($conn, $query);
?>

<table border="1">
<tr>
    <th>ID</th><th>Name</th><th>Action</th>
</tr>
<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td>
        <a href="admin_approve_hospitals.php?id=<?php echo $row['id']; ?>&action=approve">Approve</a> |
        <a href="admin_approve_shospital.php?id=<?php echo $row['id']; ?>&action=reject">Reject</a>
    </td>
</tr>
<?php } ?>
</table>
<?php
include 'config.php';

$id = $_GET['id'];
$action = $_GET['action'];

if ($action == 'approve') {
    $sql = "UPDATE hospital SET status='Approved' WHERE id=$id";
} elseif ($action == 'reject') {
    $sql = "UPDATE hospital SET status='Rejected' WHERE id=$id";
}

mysqli_query($conn, $sql);
header("Location: approve-hospitals.php");
?>
<?php include('./footer.php')?>