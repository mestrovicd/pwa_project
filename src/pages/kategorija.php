<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBC category page</title>
    <link rel="stylesheet" href="../../styles/main.css">
</head>

<body>
    <?php
    @include("../components/connect.php");
    @include("../components/header.php");
    echo '<main id="content">';

    define('UPLPATH', '../../imgs/');

    $category = $_GET['id'] ?? '';

    if (!empty($category)) {
        $query = "SELECT * FROM articles WHERE arhiva = 0 AND kategorija = '$category'";
        $result = mysqli_query($dbc, $query);

        echo '<div class="category__bg ' . $category . '"><div class="container"><h2>' . $category . '</h2></div></div>';
        echo '<div class="container">';
        echo '<section class="' . $category . '">';
        echo '<div class="articles__container">';

        while ($row = mysqli_fetch_array($result)) {
            echo '<article>';
            echo '<a href="clanak.php?id=' . $row['id'] . '">';
            echo '<div class="article">';
            echo '<div class="article_img">';
            echo '<img src="' . UPLPATH . $row['slika'] . '">';
            echo '</div>';
            echo '<div class="media_body">';
            echo '<h4 class="title">';
            echo $row['naslov'];
            echo '</h4>';
            echo '<p class="summary">' . $row['sazetak'] . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
            echo '</article>';
        }
        echo '</div></section>';
    }
    echo '</div></main>';
    @include("../components/footer.php");
    ?>
</body>

</html>