<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
    <link rel="stylesheet" href="../../styles/main.css">
</head>

<body class="article__detail">
    <?php
    include("../components/connect.php");
    include("../components/header.php");

    $articleId = $_GET['id'] ?? '';
    define('UPLPATH', '../../imgs/');

    echo '<main id="content">';

    if (!empty($articleId)) {
        $query = "SELECT * FROM articles WHERE id = '$articleId'";
        $result = mysqli_query($dbc, $query);

        while ($row = mysqli_fetch_array($result)) {
            $category = $row['kategorija'];
            echo '<div class="category__bg ' . $category . '"><div class="container"><h2>' . $category . '</h2></div></div>';

            echo '<div class="container">';
            echo '<h1 class="title">' . $row['naslov'] . '</h1><br>';
            echo '<img src="' . UPLPATH . $row['slika'] . '">';
            echo '<div class="media_body">';
            echo '<p class="content">' . $row['tekst'] . '</p>';
            echo '</div></div>';
        }
    }

    echo '</main>';
    include("../components/footer.php");
    ?>
</body>

</html>