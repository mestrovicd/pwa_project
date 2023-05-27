<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <link rel="stylesheet" href="../../styles/main.css">
</head>

<body class="admin">
    <?php
    include("../components/connect.php");
    include("../components/header.php");
    echo '<main id="content"><div class="container">';

    define('UPLPATH', '../../imgs/');

    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM articles WHERE id=$id";
        $result = mysqli_query($dbc, $query);
    }

    if (isset($_POST['update'])) {
        $picture = $_FILES['pphoto']['name'];
        $title = mysqli_real_escape_string($dbc, $_POST['title']);
        $about = mysqli_real_escape_string($dbc, $_POST['about']);
        $content = mysqli_real_escape_string($dbc, $_POST['content']);
        $category = $_POST['category'];
        $archive = isset($_POST['archive']) ? 1 : 0;

        if (!empty($picture)) {
            $target_dir = 'img/' . $picture;
            move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);
        } else {
            $picture = $_POST['old_picture'];
        }

        $id = $_POST['id'];
        $query = "UPDATE articles SET naslov='$title', sazetak='$about', tekst='$content', slika='$picture', kategorija='$category', arhiva='$archive' WHERE id=$id";
        $result = mysqli_query($dbc, $query);
    }

    $query = "SELECT * FROM articles";
    $result = mysqli_query($dbc, $query);

    while ($row = mysqli_fetch_array($result)) {
        if ($row['kategorija'] == 'news') {
            $before_color = "red-before";
            echo "<h2>News</h2>";
        } else if ($row['kategorija'] == 'sport') {
            $before_color = "yellow-before";
            echo "<h2>Sport</h2>";
        } else if ($row['kategorija'] == 'culture') {
            $before_color = "green-before";
            echo "<h2>Culture</h2>";
        }
        echo '<form class="' . $before_color . '" enctype="multipart/form-data" action="" method="POST">';
        echo '<h3>Članak: ' . $row['naslov'] . '</h3>';
        echo '<div class="admin-form-content">';
        echo '<div class="form-item">';
        echo '<label for="title">Naslov vjesti:</label>';
        echo '<br><div class="form-field">';
        echo '<input type="text" name="title" class="form-field-textual" value="' . $row['naslov'] . '">';
        echo '</div>';
        echo '</div>';
        echo '<div class="form-item">';
        echo '<label for="about">Kratki sadržaj vijesti (do 50 znakova):</label>';
        echo '<div class="form-field">';
        echo '<textarea name="about" cols="30" rows="10" class="form-field-textual">' . $row['sazetak'] . '</textarea>';
        echo '</div>';
        echo '</div>';
        echo '<div class="form-item">';
        echo '<label for="content">Sadržaj vijesti:</label>';
        echo '<div class="form-field">';
        echo '<textarea name="content" cols="30" rows="10" class="form-field-textual">' . $row['tekst'] . '</textarea>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="admin-form-content">';
        echo '<div class="form-item">';
        echo '<label for="pphoto">Slika:</label>';
        echo '<div class="form-field">';
        echo '<input type="file" class="input-text" id="pphoto" name="pphoto"/><br>';
        echo '<img src="' . UPLPATH . $row['slika'] . '"><br>';
        echo '<input type="hidden" name="old_picture" value="' . $row['slika'] . '">';
        echo '</div>';
        echo '</div>';
        echo '<div class="form-item">';
        echo '<label for="category">Kategorija vijesti:</label>';
        echo '<div class="form-field">';
        echo '<select name="category" class="form-field-textual">';
        echo '<option value="news"' . ($row['kategorija'] == 'news' ? ' selected' : '') . '>News</option>';
        echo '<option value="sport"' . ($row['kategorija'] == 'sport' ? ' selected' : '') . '>Sport</option>';
        echo '<option value="culture"' . ($row['kategorija'] == 'culture' ? ' selected' : '') . '>Culture</option>';
        echo '</select>';
        echo '</div>';
        echo '</div>';
        echo '<div class="form-item">';
        echo '<label>Save to archive?</label>';
        echo '<div class="form-field">';
        echo '<input type="checkbox" name="archive" id="archive" ' . ($row['arhiva'] == 1 ? 'checked' : '') . '/>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="form-item">';
        echo '<input type="hidden" name="id" class="form-field-textual" value="' . $row['id'] . '">';
        echo '<button type="reset">Reset</button>';
        echo '<button type="submit" name="delete">Delete</button>';
        echo '<button type="submit" name="update">Update</button>';
        echo '</div>';
        echo '</form>';
    }

    mysqli_close($dbc);
    ?>

    <?php
    echo '</div></main>';
    include("../components/footer.php");
    ?>
</body>

</html>