<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>User List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>City</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Connect to the database using PDO
                $dsn = "mysql:host=localhost;dbname=user_information";
                $username = "root";
                $password = "";

                try {
                    $db = new PDO($dsn, $username, $password);
                } catch (PDOException $e) {
                    die("Connection failed: " . $e->getMessage());
                }

                $sql = "SELECT * FROM users";
                $stmt = $db->query($sql);

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["gender"] . "</td>";
                    echo "<td>" . $row["city"] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
