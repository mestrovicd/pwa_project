<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to BBC.com</title>
    <meta name="description" content="Read about world news">
    <link rel="stylesheet" href="../../styles/main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php
    @include("../components/header.php");
    @include("../components/connect.php");
    ?>

    <main id="content">
        <div class="container">

            <section class="welcome">
                <h1>Welcome to BBC.com</h1>
                <?php echo '<p class="todays-date">' . date("l") . ". " . date("d M") . "</p>"; ?>
            </section>

            <section class="news">
                <?php
                define('UPLPATH', '../../imgs/');
                $query = "SELECT * FROM articles WHERE arhiva = 0 AND kategorija = 'news' LIMIT 3";
                $result = mysqli_query($dbc, $query);

                while ($row = mysqli_fetch_array($result)) {
                    echo '<article>';
                    echo '<div class="article">';
                    echo '<div class="sport_img">';
                    echo '<img src="' . UPLPATH . $row['slika'] . '">';
                    echo '</div>';
                    echo '<div class="media_body">';
                    echo '<h4 class="title">';
                    echo '<a href="clanak.php?id=' . $row['id'] . '">';
                    echo $row['naslov'];
                    echo '</a></h4>';
                    echo '<p class="summary">' . $row['sazetak'] . '</p>';
                    echo '</div></div>';
                    echo '</article>';
                }
                ?>
            </section>

            <section class="sport">
                <?php
                $query = "SELECT * FROM articles WHERE arhiva = 0 AND kategorija = 'sport' LIMIT 3";
                $result = mysqli_query($dbc, $query);

                while ($row = mysqli_fetch_array($result)) {
                    echo '<article>';
                    echo '<div class="article">';
                    echo '<div class="sport_img">';
                    echo '<img src="' . UPLPATH . $row['slika'] . '">';
                    echo '</div>';
                    echo '<div class="media_body">';
                    echo '<h4 class="title">';
                    echo '<a href="clanak.php?id=' . $row['id'] . '">';
                    echo $row['naslov'];
                    echo '</a></h4>';
                    echo '<p class="summary">' . $row['sazetak'] . '</p>';
                    echo '</div></div>';
                    echo '</article>';
                }
                ?>
            </section>

        </div>
    </main>

    <?php
    @include("../components/footer.php");
    ?>
</body>

</html>