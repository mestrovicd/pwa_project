<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
    <link rel="stylesheet" href="../../styles/main.css">
</head>

<body class="registracija">
    <?php
    include("../components/connect.php");
    include("../components/header.php");
    $msg = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['pass'];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $level = 0;
        $registriranKorisnik = '';
        $sql = "SELECT username FROM users WHERE username = ?";
        $stmt = mysqli_stmt_init($dbc);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $msg = 'Korisničko ime već postoji!';
        } else {
            $sql = "INSERT INTO users (username, password, level) VALUES (?, ?, ?)";
            $stmt = mysqli_stmt_init($dbc);

            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, 'ssd', $username, $hashed_password, $level);
                mysqli_stmt_execute($stmt);
                $registriranKorisnik = true;
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($dbc);
    }

    include("../components/header.php");
    ?>

    <main id="content">
        <h1>Registriraj se!</h1>
        <div class="container">
            <form enctype="multipart/form-data" action="" method="POST">
                <div class="form-item">
                    <span id="porukaUsername" class="bojaPoruke"></span>
                    <label for="content">Korisničko ime:</label>
                    <?php echo '<br><span style="color:red">' . $msg . '</span>'; ?>
                    <div class="form-field">
                        <input type="text" name="username" id="username" class="form-field-textual">
                    </div>
                </div>
                <div class="form-item">
                    <span id="porukaPass" class="bojaPoruke"></span>
                    <label for="pphoto">Lozinka: </label>
                    <div class="form-field">
                        <input type="password" name="pass" id="pass" class="form-field-textual">
                    </div>
                </div>
                <div class="form-item">
                    <span id="porukaPassRep" class="bojaPoruke"></span>
                    <label for="pphoto">Ponovljena lozinka: </label>
                    <div class="form-field">
                        <input type="password" name="passRep" id="passRep" class="form-field-textual">
                    </div>
                </div>
                <div class="form-item">
                    <button type="submit" value="Prijava" id="prijava">Registriraj se</button>
                </div>
            </form>
        </div>
    </main>

    <script type="text/javascript">
        document.getElementById("prijava").onclick = function(event) {
            var slanjeForme = true;

            var poljeUsername = document.getElementById("username");
            var username = document.getElementById("username").value;

            if (username.length == 0) {
                slanjeForme = false;
                poljeUsername.style.border = "1px solid red";
                document.getElementById("porukaUsername").innerHTML = "<br>Unesite korisničko ime!<br>";
            } else {
                document.getElementById("porukaUsername").innerHTML = "";
            }

            var poljePass = document.getElementById("pass");
            var pass = document.getElementById("pass").value;
            var poljePassRep = document.getElementById("passRep");
            var passRep = document.getElementById("passRep").value;

            if (pass.length == 0 || passRep.length == 0 || pass != passRep) {
                slanjeForme = false;
                poljePass.style.border = "1px solid red";
                poljePassRep.style.border = "1px solid red";
                document.getElementById("porukaPass").innerHTML = "<br>Lozinke nisu iste!<br>";
                document.getElementById("porukaPassRep").innerHTML = "<br>Lozinke nisu iste!<br>";
            } else {
                document.getElementById("porukaPass").innerHTML = "";
                document.getElementById("porukaPassRep").innerHTML = "";
            }

            if (slanjeForme != true) {
                event.preventDefault();
            }
        };
    </script>

    <?php
    include("../components/footer.php");
    ?>

</body>

</html>