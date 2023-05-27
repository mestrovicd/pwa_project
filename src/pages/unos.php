<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unos</title>
    <link rel="stylesheet" href="../../styles/main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(document).ready(function() {

            $("form").validate({
                errorPlacement: function(error, element) {
                    error.insertBefore(element);
                },
                rules: {
                    title: {
                        required: true,
                        minlength: 5,
                        maxlength: 30
                    },
                    about: {
                        required: true,
                        minlength: 10,
                        maxlength: 100
                    },
                    content: {
                        required: true
                    },
                    pphoto: {
                        required: true,
                    },
                    category: {
                        required: true
                    }
                },
                messages: {
                    title: {
                        required: "Naslov mora biti unesen",
                        minlength: "Naslov mora imati između 5 i 30 znakova",
                        maxlength: "Naslov mora imati između 5 i 30 znakova"
                    },
                    about: {
                        required: "Kratki sadržaj mora biti unesen",
                        minlength: "Kratki sadržaj mora imati između 10 i 100 znakova",
                        maxlength: "Kratki sadržaj mora imati između 10 i 100 znakova"
                    },
                    content: {
                        required: "Sadržaj mora biti unesen"
                    },
                    pphoto: {
                        required: "Slika mora biti upload-ana",
                    },
                    category: {
                        required: "Kategorija mora biti odabrana"
                    }
                }
            });
        });
    </script>
</head>

<body>
    <?php
    @include("../components/header.php");
    @include("../components/connect.php");
    ?>
    <div class="form-container">

        <form action="unos.php" method="POST" enctype="multipart/form-data">
            <div class="form-item">
                <label for="title">Naslov vijesti</label>
                <div class="form-field">
                    <input type="text" name="title" class="form-field-textual">
                </div>
            </div>
            <div class="form-item">
                <label for="about">Kratki sadržaj vijesti (do 50 znakova)</label>
                <div class="form-field">
                    <textarea name="about" id="" cols="30" rows="10" class="form-field-textual"></textarea>
                </div>
            </div>
            <div class="form-item">
                <label for="content">Sadržaj vijesti</label>
                <div class="form-field">
                    <textarea name="content" id="" cols="30" rows="10" class="form-field-textual"></textarea>
                </div>
            </div>
            <div class="form-item">
                <label for="pphoto">Slika:</label>
                <div class="form-field">
                    <input type="file" accept="image/jpg,image/jpeg,image/gif" class="input-text" name="pphoto" />
                </div>
            </div>
            <div class="form-item">
                <label for="category">Kategorija vijesti</label>
                <div class="form-field">
                    <select name="category" id="" class="form-field-textual">
                        <option value="news">News</option>
                        <option value="sport">Sport</option>
                        <option value="culture">Culture</option>
                    </select>
                </div>
            </div>
            <div class="form-item">
                <label>Spremiti u arhivu:</label>
                <div class="form-field">
                    <input type="checkbox" name="archive">
                </div>
            </div>
            <div class="buttons">
                <button type="reset" value="Poništi">Poništi</button>
                <button type="submit" value="Prihvati">Prihvati</button>
            </div>
        </form>
    </div>

    <?php
    @include("../components/footer.php");


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_FILES['pphoto']) && $_FILES['pphoto']['error'] == 0) {
            $picture = $_FILES['pphoto']['name'];
            $tempFile = $_FILES['pphoto']['tmp_name'];
            $targetDir = 'img/';
            $targetFile = $targetDir . $picture;
        } else {
            $picture = '';
        }

        $title = mysqli_real_escape_string($dbc, $_POST['title']);
        $about = mysqli_real_escape_string($dbc, $_POST['about']);
        $content = mysqli_real_escape_string($dbc, $_POST['content']);
        $category = $_POST['category'];
        $date = date('d.m.Y.');

        $archive = isset($_POST['archive']) ? 1 : 0;

        $query = "INSERT INTO articles (datum, naslov, sazetak, tekst, slika, kategorija, arhiva ) VALUES ('$date', '$title', '$about', '$content', '$picture', '$category', '$archive')";

        $result = mysqli_query($dbc, $query) or die('Error querying database.');

        mysqli_close($dbc);

        header("Location: unos.php");
    }
    mysqli_close($dbc);
    ?>
</body>

</html>