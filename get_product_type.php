<?php 
    include "dbConnect.php";
    //$title = $_POST['title'];
    $title = 'Afc Champions Kansas City Chiefs Are All In Super Bowl Lviii Hoodie – Black';

    $title = strtolower($title);
	if (strpos($title, 'jersey') !== false) {
        echo 'jersey';
    } elseif (strpos($title, 'cap') !== false || strpos($title, 'caps') !== false) {
        echo 'cap';
    } elseif (strpos($title, 'hoodie') !== false) {
        echo 'hoodie';
    } elseif (strpos($title, 'sweatshirt') !== false || strpos($title, ' sweater') !== false) {
        echo 'sweatshirt';
    } elseif (strpos($title, 'tumbler') !== false) {
        echo 'tumbler';
    } elseif (strpos($title, ' crocs') !== false) {
        echo 'crocs';
    } elseif (strpos($title, ' hawaiian shirt') !== false || strpos($title, ' hawaiians shirt') !== false || strpos($title, ' button shirt') !== false || strpos($title, ' aloha shirt') !== false) {
        echo 'hawaiian shirt';
    } elseif (strpos($title, ' blanket') !== false) {
        echo 'blanket';
    } elseif (strpos($title, ' mugs') !== false) {
        echo 'mug';
    } elseif (strpos($title, ' legging') !== false) {
        echo 'legging';
    } elseif (strpos($title, ' polo') !== false) {
        echo 'polo';
    } elseif (strpos($title, ' jacket') !== false) {
        echo 'jacket';
    } elseif (strpos($title, ' poster') !== false) {
        echo 'poster';
    } elseif (strpos($title, ' phone case') !== false) {
        echo 'phone case';
    } elseif (strpos($title, ' ornament') !== false) {
        echo 'ornaments';
    } elseif (strpos($title, ' flag') !== false) {
        echo 'flag';
    } elseif (strpos($title, ' shoe') !== false || strpos($title, ' jordan 1') !== false || strpos($title, ' sneaker') !== false) {
        echo 'shoes';
    } elseif (strpos($title, ' shirt') !== false) {
        echo 'shirt';
    }

    else {
        echo 'chung';
    }

?>