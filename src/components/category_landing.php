<?php
define('UPLPATH', 'img/');

$id = $_GET['id'];

$query = "SELECT * FROM sport WHERE archive=0 AND category='$id' LIMIT 3";
$result = mysqli_query($dbc, $query);

$i = 0;
while ($row = mysqli_fetch_array($result)) {
    echo '<article>';
    echo '<div class="article">';
    echo '<div class="sport_img">';
    echo '<img src="' . UPLPATH . $row['slika'] . '"';
    echo '</div>';
    echo '<div class="media_body">';
    echo '<h4 class="title">';
    echo '<a href="clanak.php?id=' . $row['id'] . '">';
    echo $row['naslov'];
    echo '</a></h4>';
    echo '</div></div>';
    echo '</article>';
}
