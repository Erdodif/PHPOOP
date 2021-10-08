<?php
require "fajlkezelo.php";
require "autok.php";
$ujnev = htmlspecialchars($_POST["auto_nev"]??"",ENT_QUOTES);
$ujhengerSzam = htmlspecialchars($_POST["auto_hengerSzam"]??"",ENT_QUOTES);
$ujhengerTerfogat = htmlspecialchars($_POST["auto_hengerTerfogat"]??"",ENT_QUOTES);
$ujteljesitmeny = htmlspecialchars($_POST["auto_teljesitmeny"]??"",ENT_QUOTES);
$ujmaxSebesseg = htmlspecialchars($_POST["auto_maxSebesseg"]??"",ENT_QUOTES);
$ujfogyasztas = htmlspecialchars($_POST["auto_fogyasztas"]??"",ENT_QUOTES);
$ujkep = isset($_POST["submit"])?faljkezelo():"";
$utvonal = "./feltoltesek/".$ujkep;
$feltoltesrendben = true;
var_dump($ujkep);/*
if (isset($_POST["submit"])&&isset($_FILES["auto_kep"])&&!file_exists($utvonal)){
    move_uploaded_file($_FILES["auto_kep"]["name"],$utvonal);
    $felhasznaloiAutok = file_get_contents("feltoltesek/autok.json");
    $templista = json_decode($felhasznaloiAutok);
    $autoka = new Auto(
        $ujnev,$ujhengerSzam,
        $ujhengerTerfogat,$ujteljesitmeny,
        $ujmaxSebesseg,$ujteljesitmeny,$utvonal
    );
    array_push($templista,$autoka);
    var_dump($templista);
    var_dump($autoka);
    file_put_contents("feltoltesek/autok.json",json_encode($templista));
}*/
require "form.php";