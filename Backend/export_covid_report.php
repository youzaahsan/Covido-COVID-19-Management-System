<?php
include('../connection.php');

header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=covid_report.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>Patient Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Hospital</th>
        <th>Test Date</th>
        <th>Test Result</th>
    </tr>";

$query = "SELECT p.name, p.email, p.phone,
                 h.name AS hospital_name,
                 c.date AS test_date,
                 c.result AS test_result
          FROM covid_report c
          JOIN patient p ON c.patient_id = p.id
          JOIN hospital h ON c.hospital_id = h.id";

$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>".htmlspecialchars($row['name'])."</td>
            <td>".htmlspecialchars($row['email'])."</td>
            <td>".htmlspecialchars($row['phone'])."</td>
            <td>".htmlspecialchars($row['hospital_name'])."</td>
            <td>".htmlspecialchars($row['test_date'])."</td>
            <td>".htmlspecialchars($row['test_result'])."</td>
          </tr>";
}

echo "</table>";
?>
