<?php
session_start();

try {
    $dbh = new PDO('mysql:host=localhost;dbname=Blood_bank;charset=utf8', 'root', '');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $uname = $_POST['Username'];
    $passwd = $_POST['password'];
    $stmt = $dbh->query("SELECT * FROM signin");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $k = 0;

    foreach ($results as $row) {
        $username = htmlentities($row['uname']);
        $password = htmlentities($row['password']);
        if ($username == $uname) {
            if ($password == $passwd) {
                header("Location: dashboard.html");
                $_SESSION["name"] = $uname;
                $_SESSION["id"] = 0;
                $_SESSION['status'] = "active";
                $k = 1;
                break;
            }
        }
    }

    if ($k == 0) {
        echo "<script>alert('Invalid Username or Password'); window.location.href='index.html';</script>";
    }
} catch (PDOException $e) {
    echo "Connection failed:" . $e->getMessage();
}
?>
