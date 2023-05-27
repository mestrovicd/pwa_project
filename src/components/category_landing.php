<?php
@include("./connect.php");
define('UPLPATH', 'img/');

$id = $_GET['id'];

$query = "SELECT * FROM articles WHERE arhiva = 0 AND kategorija = '$id' LIMIT 3";
$result = mysqli_query($dbc, $query);

$content = '';

while ($row = mysqli_fetch_array($result)) {
    $content .= '<article>';
    $content .= '<div class="article">';
    $content .= '<div class="sport_img">';
    $content .= '<img src="' . UPLPATH . $row['slika'] . '">';
    $content .= '</div>';
    $content .= '<div class="media_body">';
    $content .= '<h4 class="title">';
    $content .= '<a href="clanak.php?id=' . $row['id'] . '">';
    $content .= $row['naslov'];
    $content .= '</a></h4>';
    $content .= '</div></div>';
    $content .= '</article>';
}

echo $content;
