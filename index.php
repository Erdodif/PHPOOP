<?php
require "fajlkezelo.php";
require "autok.php";
$ujnev = htmlspecialchars($_POST["auto_nev"]??"",ENT_QUOTES);
$ujhengerSzam = htmlspecialchars($_POST["auto_hengerSzam"]??"",ENT_QUOTES);
$ujhengerTerfogat = htmlspecialchars($_POST["auto_hengerTerfogat"]??"",ENT_QUOTES);
$ujteljesitmeny = htmlspecialchars($_POST["auto_teljesitmeny"]??"",ENT_QUOTES);
$ujmaxSebesseg = htmlspecialchars($_POST["auto_maxSebesseg"]??"",ENT_QUOTES);
$ujfogyasztas = htmlspecialchars($_POST["auto_fogyasztas"]??"",ENT_QUOTES);
$ujkep = faljkezelo();
if (isset($_POST["submit"]) && $ujkep!==null){
    $felhasznaloiAutok = file_get_contents("feltoltesek/autok.json");
    $templista = json_decode($felhasznaloiAutok);
    $autoka = new Auto(
        $ujnev,$ujhengerSzam,
        $ujhengerTerfogat,$ujteljesitmeny,
        $ujmaxSebesseg,$ujteljesitmeny,$ujkep
    );
    array_push($templista,$autoka);
    file_put_contents("feltoltesek/autok.json",json_encode($templista));
}
require "form.php";