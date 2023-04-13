<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        text-align: left;
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
</style>

<?php
include "config.php";

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Run the query to select all users
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Output sa table
    echo "<table>";
    echo "<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Password</th>
    <th>Role</th>
    <th>Status</th>
    <th>Update</th>
    <th>Delete</th>
    </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["pass"] . "</td>";
        echo "<td>" . $row["role"] . "</td>";
        echo "<td>" . $row["status"] . "</td>";
        echo "<td><a href='update_user.php?id=" . $row["id"] . "'><button>Update</button</a></td>";
        echo "<td><a href='php/check-delete.php?id=" . $row["id"] . "'><button>Delete</button></a></td>";

        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No users found";
}

mysqli_close($conn);
?>
