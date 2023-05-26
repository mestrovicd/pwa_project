<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to BBC.com</title>
    <meta name="description" content="Read about world news">
    <link rel="stylesheet" href="styles/main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
</head>

<body>
    <?php
    @include("header.php");
    #@include("connect.php");
    ?>
    <main id="content">
        <div class="container">

            <section class="welcome">
                <h1>Welcome to BBC.com</h1>
                <?php echo '<p class="todays-date">' . date("l") . ". " . date("d M") . "</p>"; ?>
            </section>
            <section class="news">
                <?php #@include("category_landing.php?id=news") 
                ?>
            </section>
            <section class="news">
                <?php #@include("category_landing.php?id=sport") 
                ?>
            </section>
        </div>
    </main>



    <?php
    @include("footer.php");
    ?>
</body>

</html>