<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $id_event = $_POST['id_event'];
    $waktu = $_POST['waktu'];
    $tanggal = $_POST['tanggal'];
    $kapasitas = $_POST['kapasitas'];
    $jenis_tiket = $_POST['jenis_tiket'];
    $total_bayar = $_POST['total_bayar'];
    $jenis_pembayaran = $_POST['jenis_pembayaran'];

    $tanggalEvt = $tanggal . ' ' . $waktu . ':00';

    $stmt = $conn->prepare("INSERT INTO dftrtiket (namaPembeli, idEvent, waktu, tanggalEvt, kapasitas, jenisTiket, TotalBayar, jenisPembayaran) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissssds", $nama, $id_event, $waktu, $tanggalEvt, $kapasitas, $jenis_tiket, $total_bayar, $jenis_pembayaran);

    if ($stmt->execute() === TRUE) {
        echo "<script>
                alert('Ticket has been booked successfully');
                window.location.href = 'home2.html';
                </script>";
    } else {
        echo "<script>
                alert('Error booking ticket');
                window.location.href = 'ticketing.php';
                </script>";
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ticketing</title>
    <link rel="stylesheet" href="ticketing.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2-beta3/css/all.min.css" />
</head>

<body>
    <div class="container">
        <aside>
            <i class="fas fa-bars" id="toggle-sidebar"></i>
            <div class="logo">
                <img src="logo22.png" alt="Logo" />
            </div>
            <nav class="nav">
                <ul>
                    <li><a href="home2.html">Home</a></li>
                    <li><a href="profile2.html">Profile</a></li>
                    <li class="divider"></li>
                    <li>Ticketing</li>
                </ul>
            </nav>
        </aside>
        <main>
            <section class="ticketing">
                <h2 class="judul">TICKETING</h2>
                <h3>Halo!</h3>
                <p>Silahkan lakukan pengisian data untuk melakukan pemesanan tiket</p>
                <p class="divider"></p>
                <form id="ticketing-form" action="ticketing.php" method="POST">
                    <table>
                        <tr>
                            <td><label for="nama">Nama</label></td>
                            <td colspan="2"><input type="text" id="nama" name="nama" required /></td>
                        </tr>
                        <tr>
                            <td><label for="id_event">Id Event</label></td>
                            <td colspan="2">
                                <input type="text" id="id_event" name="id_event" required />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="waktu_tanggal">Waktu / Tanggal</label></td>
                            <td colspan="2">
                                <select id="waktu" name="waktu" required>
                                    <option value="09:00">09:00</option>
                                    <option value="09:15">09:15</option>
                                    <option value="09:30">09:30</option>
                                    <option value="09:45">09:45</option>
                                    <option value="10:00">10:00</option>
                                    <option value="10:15">10:15</option>
                                    <option value="10:30">10:30</option>
                                    <option value="10:45">10:45</option>
                                    <option value="11:00">11:00</option>
                                    <option value="11:15">11:15</option>
                                    <option value="11:30">11:30</option>
                                    <option value="11:45">11:45</option>
                                    <option value="12:00">12:00</option>
                                    <option value="12:15">12:15</option>
                                    <option value="12:30">12:30</option>
                                    <option value="12:45">12:45</option>
                                    <option value="13:00">13:00</option>
                                    <option value="13:15">13:15</option>
                                    <option value="13:30">13:30</option>
                                    <option value="13:45">13:45</option>
                                    <option value="14:00">14:00</option>
                                    <option value="14:15">14:15</option>
                                    <option value="14:30">14:30</option>
                                    <option value="14:45">14:45</option>
                                    <option value="15:00">15:00</option>
                                    <option value="15:15">15:15</option>
                                    <option value="15:30">15:30</option>
                                    <option value="15:45">15:45</option>
                                    <option value="16:00">16:00</option>
                                    <option value="16:15">16:15</option>
                                    <option value="16:30">16:30</option>
                                    <option value="16:45">16:45</option>
                                    <option value="17:00">17:00</option>
                                    <option value="17:15">17:15</option>
                                    <option value="17:30">17:30</option>
                                    <option value="17:45">17:45</option>
                                    <option value="18:00">18:00</option>
                                    <option value="18:15">18:15</option>
                                    <option value="18:30">18:30</option>
                                    <option value="18:45">18:45</option>
                                    <option value="19:00">19:00</option>
                                    <option value="19:15">19:15</option>
                                    <option value="19:30">19:30</option>
                                    <option value="19:45">19:45</option>
                                    <option value="20:00">20:00</option>
                                    <option value="20:15">20:15</option>
                                    <option value="20:30">20:30</option>
                                    <option value="20:45">20:45</option>
                                    <option value="21:00">21:00</option>
                                    <option value="21:15">21:15</option>
                                    <option value="21:30">21:30</option>
                                    <option value="21:45">21:45</option>
                                    <option value="22:00">22:00</option>
                                </select>
                                <input type="date" id="tanggal" name="tanggal" required />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="kapasitas">Kapasitas</label></td>
                            <td colspan="2">
                                <input type="radio" id="kapasitas1" name="kapasitas" value="Dewasa" required />
                                Dewasa <br />
                                <input type="radio" id="kapasitas2" name="kapasitas" value="Anak-Anak" />
                                Anak-Anak
                            </td>
                        </tr>
                        <tr>
                            <td><label for="jenis_tiket">Jenis Tiket</label></td>
                            <td colspan="2">
                                <input type="radio" id="jenis_tiket1" name="jenis_tiket" value="gold" required />
                                Gold
                                <input type="radio" id="jenis_tiket2" name="jenis_tiket" value="Medal" />
                                Medal <br />
                                <input type="radio" id="jenis_tiket3" name="jenis_tiket" value="Silver" />
                                Silver <br />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="total_bayar">Total Bayar</label></td>
                            <td colspan="2">
                                <div id="total_bayar_box" class="total-box"></div>
                                <input type="hidden" id="total_bayar" name="total_bayar" />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="jenis_pembayaran">Jenis Pembayaran</label></td>
                            <td colspan="2">
                                <input type="radio" id="jenis_pembayaran1" name="jenis_pembayaran" value="tunai" required />
                                Tunai <br />
                                <input type="radio" id="jenis_pembayaran2" name="jenis_pembayaran" value="Transfer Bank" />
                                Transfer Bank
                                <input type="radio" id="jenis_pembayaran3" name="jenis_pembayaran" value="E-Wallet" />
                                E-Wallet
                            </td>
                        </tr>
                    </table>
                    <div class="wrap-btn">
                        <div class="buttons">
                            <button type="submit">Confirm</button>
                            <button type="reset">Cancel</button>
                        </div>
                    </div>
                </form>
            </section>
        </main>
    </div>
    <script src="ticketing.js"></script>
</body>

</html>