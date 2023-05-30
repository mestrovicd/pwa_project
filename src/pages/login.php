<?php
session_start();
include("../components/connect.php");
include("../components/header.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
    <link rel="stylesheet" href="../../styles/main.css">
</head>

<body class="login">
    <main id="main">
        <h1>Za pristup administraciji stranice, potrebno je ulogirati se </h1>
        <div class="container">
            <br>
            <form action="" method="POST" class="forma">
                <div class="form-item">
                    <label for="about">Korisničko ime:</label>
                    <div class="form-field">
                        <input type="text" name="username" id="username">
                        <p class="error" id="usernameError"></p>
                    </div>
                </div>

                <div class="form-item">
                    <label for="about">Lozinka:</label>
                    <div class="form-field">
                        <input type="password" name="pass" id="pass">
                        <p class="error" id="passError"></p>
                    </div>
                </div>

                <div class="form-item">
                    <button type="submit" name="login" id="login" value="Prijava">Prijava</button><br>
                    <a href="registracija.php">Registracija</a>
                </div>
            </form>
        </div>
    </main>

    <script type="text/javascript">
        document.getElementById('login').onclick = function(event) {
            submit = true;

            if (document.getElementById('username').value.length == 0) {
                submit = false;
                document.getElementById('username').style.borderColor = "red";
                document.getElementById('usernameError').innerHTML = "Korisničko ime mora biti uneseno!";
            }

            if (document.getElementById('pass').value.length == 0) {
                submit = false;
                document.getElementById('pass').style.borderColor = "red";
                document.getElementById('passError').innerHTML = "Lozinka mora biti unesena!";
            }

            if (!submit) {
                event.preventDefault();
            }
        }
    </script>

    <?php
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $pass = $_POST['pass'];

        $stmt = $dbc->prepare("SELECT username, password, level FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $username, $pass1, $level);
        mysqli_stmt_fetch($stmt);

        if (password_verify($pass, $pass1) && mysqli_stmt_num_rows($stmt) > 0) {
            if ($level == 1) {
                $admin = true;
            } else {
                $admin = false;
            }

            $_SESSION['username'] = $username;
            $_SESSION['level'] = $level;

            header('Location: admin.php');
            exit();
        } else {
            echo "<script type=\"text/javascript\">document.getElementById('passError').innerHTML = \"Netočna lozinka ili korisničko ime!\";</script>";
        }
    }

    include("../components/footer.php");
    ?>
</body>

</html>