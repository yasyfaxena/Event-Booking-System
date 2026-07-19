<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

include 'config.php';

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data tiket
$sql = "SELECT * FROM dftrtiket";
$result = $conn->query($sql);

if (!$result) {
    die("Query gagal: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket List</title>
    <link rel="stylesheet" href="ticketlist.css">
</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <img src="logo2.png" alt="Logo" />
        </div>
        <div class="menu">
            <ul>
                <li><a href="admin.php">Event list</a></li>
                <li class="active"><a href="ticketlist.php">Ticket List</a></li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <div class="header">
            <input type="text" class="search" placeholder="Cari Tiket" onkeyup="searchTicket()">
        </div>
        <div class="content" id="content">
            <div id="ticket-list-content">
                <h2>Ticket List :</h2>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Ticket</th>
                            <th>ID Event</th>
                            <th>Name</th>
                            <th>Date & Time</th>
                            <th>Capacity</th>
                            <th>Ticket Type</th>
                            <th>Total Payment</th>
                            <th>Payment Type</th>
                            <th id="action-header" style="display: none;"></th>
                        </tr>
                    </thead>
                    <tbody id="ticket-table-body">
                        <?php
                        if ($result->num_rows > 0) {
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $no . "</td>";
                                echo "<td>" . $row['idTiket'] . "</td>";
                                echo "<td>" . $row['idEvent'] . "</td>";
                                echo "<td>" . $row['namaPembeli'] . "</td>";
                                echo "<td>" . $row['tanggalEvt'] . "</td>";
                                echo "<td>" . $row['kapasitas'] . "</td>";
                                echo "<td>" . $row['jenisTiket'] . "</td>";
                                echo "<td>" . $row['TotalBayar'] . "</td>";
                                echo "<td>" . $row['jenisPembayaran'] . "</td>";
                                echo "<td class='action-cell' style='display: none;'>
                                        <button class='edit-button' style='display: none;'>Edit</button>
                                        <button class='delete-button' style='display: none;'>Delete</button>
                                        </td>";
                                echo "</tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td colspan='10'>Tidak ada tiket ditemukan</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="ticketlist.js"></script>
</body>

</html>

<?php
$conn->close();
?>