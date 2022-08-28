<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Database</title>
    </head>
        <?php
            $conn = new mysqli('localhost', 'root', '', 'mydb');
            $stmt = $conn->prepare("INSERT INTO `myguests` (firstname, lastname, email) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $firstname, $lastname, $email);
            $firstname = htmlspecialchars($_POST['name']);
            $lastname = htmlspecialchars($_POST['last_name']);
            $email = htmlspecialchars($_POST['email']);
            $stmt->execute();
            $last_id = $conn->insert_id;
            
            $query = "SELECT * FROM `myguests` WHERE id = $last_id";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<h3>" . $row['firstname'] . ' ' . $row['lastname'] . ' ' . $row['email'] . '<br>' . "</h3>";
                }
            }
        ?>
    </body>
</html>