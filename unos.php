<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unos</title>
    <link rel="stylesheet" href="styles/main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
</head>

<body>
    <?php
    @include("header.php");
    @include("connect.php");
    ?>
    <div class="form-container">

        <form action="skripta.php" method="POST">
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
                    <input type="file" accept="image/jpg,image/gif" class="input-text" name="pphoto" />
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
    @include("footer.php");
    ?>
</body>

</html>