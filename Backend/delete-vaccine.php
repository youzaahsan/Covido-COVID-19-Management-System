<?php
include('./connection.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Check if vaccine exists
    $check = mysqli_query($conn, "SELECT * FROM vaccine WHERE id=$id");
    if (mysqli_num_rows($check) > 0) {
        mysqli_query($conn, "DELETE FROM vaccine WHERE id=$id");
        echo "<script>alert('Vaccine deleted successfully'); window.location.href='admin_vaccine_list.php';</script>";
    } else {
        echo "<script>alert('Vaccine not found'); window.location.href='v';</script>";
    }
} else {
    echo "<script>alert('Invalid request'); window.location.href='admin_vaccine_list';</script>";
}
?>
cho "<script>alert('Vaccine deleted'); window.location.href='admin_vaccine_list';</script>";
