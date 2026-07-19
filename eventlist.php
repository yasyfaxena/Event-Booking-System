<?php
session_start();

// Cek apakah pengguna sudah login dan apakah peran pengguna adalah admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <img src="logo2.png" alt="Logo" />
        </div>
        <div class="menu">
            <ul>
                <a href="admin.php">
                    <li class="active">Event List</li>
                </a>
                <a href="ticketlist.php">
                    <li class="active">Ticket List</li>
                </a>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <div class="header">
            <input type="text" class="search" placeholder="Searching Event" onkeyup="searchEvent()">
            <div class="actions">
                <button onclick="window.location.href='insert.html'">Insert</button>
                <button onclick="toggleActionButtons('edit')">Edit</button>
                <button onclick="toggleActionButtons('delete')">Delete</button>
                <button onclick="window.location.href='logout.php'">Log Out</button>
            </div>
        </div>
        <div class="content" id="content">
            <div id="event-list-content">
                <h2>Event List : </h2>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Event</th>
                            <th>Event Name</th>
                            <th>Event Date</th>
                            <th>Event Description</th>
                            <th id="action-header" style="display: none;"></th>
                        </tr>
                    </thead>
                    <tbody id="event-list">
                        <tr>
                            <td>1</td>
                            <td>EV001</td>
                            <td>Sample Event</td>
                            <td>2024-05-21</td>
                            <td>This is a sample event description.</td>
                            <td class="action-cell" style="display: none;">
                                <button class="edit-button" style="display: none;" onclick="editEvent(this)">Edit</button>
                                <button class="delete-button" style="display: none;" onclick="deleteEvent(this)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="admin.js"></script>
</body>

</html>