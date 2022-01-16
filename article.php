<?php
require_once "./connection.php";
$article = get('articles', $_GET['id']);


$mainClass = 'articlePage';


$content =      "<article>
                <header>{$article['title']}</header>
                <p>{$article['content']}</p>
                </article>";
require_once('salon_app.php');
