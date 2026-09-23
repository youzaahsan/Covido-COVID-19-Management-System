<?php
include('./connection.php');

// Search query
$search_query = '';
if (isset($_GET['query'])) {
    $search_query = mysqli_real_escape_string($conn, $_GET['query']);

    // SQL to search in hospital and patient tables
    $sql = "
        SELECT 'Hospital' AS type, name, email, phone, address FROM hospital
        WHERE name LIKE '%$search_query%' OR email LIKE '%$search_query%' OR phone LIKE '%$search_query%' OR address LIKE '%$search_query%'
        
        UNION

        SELECT 'Patient' AS type, name, email, phone, address FROM patient
        WHERE name LIKE '%$search_query%' OR email LIKE '%$search_query%' OR phone LIKE '%$search_query%' OR address LIKE '%$search_query%'
    ";

    $result = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Search Results for: <strong><?= htmlspecialchars($search_query) ?></strong></h2>

    <?php if (!empty($search_query)) { ?>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= $row['type'] ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['phone']) ?></td>
                            <td><?= htmlspecialchars($row['address']) ?></td>
                        </tr>
                <?php }
                } else {
                    echo "<tr><td colspan='5'>No results found.</td></tr>";
                } ?>
            </tbody>
        </table>
    <?php } ?>
</div>
</body>
</html>
