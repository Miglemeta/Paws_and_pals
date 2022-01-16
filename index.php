<?php
require_once "./connection.php";
$salons = get('salon_data');
include_once "./helpers.php";

function getSalonHtml($salons)
{
  $salonHtml = '';
  foreach ($salons as $salon) {
    $singleHtml = "
                <article>
                <a href=\"salon_info.php?id={$salon['id']}\">
                <header>{$salon['title']}</header>
                <div>{$salon['address']}</div>
                <div>{$salon['phone']}</div>
                <div>{$salon['email']}</div>
                <div>{$salon['open_hours']}</div>
                <div>{$salon['animals']}</div>
                <img src ='{$salon['img_url']}'>
                </a>
                </article>";

    $salonHtml .= $singleHtml;
  };
  return $salonHtml;
};

$mainClass = 'listPage';
$content = getSalonHtml($salons);
require_once('salon_app.php');
