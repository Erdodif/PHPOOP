<?php
require "fajlkezelo.php";
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
class Auto{
    public $nev;
    public $hengerSzam;
    public $hengerTerfogat;
    public $teljesitmeny;
    public $maxSebesseg;
    public $fogyasztas;
    public $kepEleres;
    public function __construct($nev,$hengerSzam=null,$hengerTerfogat=null,$teljesitmeny=null,
                                $maxSebesseg=null,$fogyasztas=null,$kepEleres=null){
        if($hengerSzam === null){
            $this->nev = $nev["nev"];
            $this->hengerSzam = $nev["hengerSzam"];
            $this->hengerTerfogat = $nev["hengerTerfogat"];
            $this->teljesitmeny = $nev["teljesitmeny"];
            $this->maxSebesseg = $nev["maxSebesseg"];
            $this->fogyasztas = $nev["fogyasztas"];
            $this->kepEleres = $nev["kepEleres"];
        }
        else {
            $this->nev = $nev;
            $this->hengerSzam = $hengerSzam;
            $this->hengerTerfogat = $hengerTerfogat;
            $this->teljesitmeny = $teljesitmeny;
            $this->maxSebesseg = $maxSebesseg;
            $this->fogyasztas = $fogyasztas;
            $this->kepEleres = $kepEleres;
        }
    }
}
class Autok{
    static private $autok = null;
    static public function getAutok($eleres){
        if (self::$autok === null){
            $string = file_get_contents($eleres);
            $tartalom = json_decode($string,true);
            self::$autok = [];
            foreach ($tartalom as &$value){
                array_push(self::$autok,new Auto($value));
            }
        }
        $ki = "";
        foreach (self::$autok as $auto){
            $ki .= self::autoKartya($auto);
        }
        return $ki;
    } 
    static private function toHTML($element,$content,$classes=null,$id=null){
        if ($classes === null){
            $classes = "";
        }
        else
        {
            $classes = " class='$classes'";
        }
        if ($id === null){
            $id = "";
        }
        else
        {
            $id = " id='$id'";
        }
        return "<".$element.$classes.$id.">".$content."</".$element.">";
    }
    static public function elem_IMG($src,$alt,$classes=null,$id=null){
        if ($classes === null){
            $classes = "";
        }
        else
        {
            $classes = " class='$classes'";
        }
        if ($id === null){
            $id = "";
        }
        else
        {
            $id = " id='$id'";
        }
        return "<img ".$classes.$id."src='$src' alt='$alt'>";
    }
    static public function elem_P($content,$classes=null,$id=null){
        return self::toHTML("p",$content,$classes,$id);
    }
    static public function elem_DIV($content,$classes=null,$id=null){
        return self::toHTML("div",$content,$classes,$id);
    }
    static public function autoKartya(Auto $auto,$id=null,$extraclass=null){
        return self::elem_DIV(
            self::elem_P(
                $auto->nev
            ,"kartyafej").
            self::elem_IMG(
                $auto->kepEleres,
                $auto->nev
            ).
            self::elem_DIV(
                self::elem_P(
                    "Hengerszám: "
                ,"kulcs").
                self::elem_P(
                    $auto->hengerSzam
                ,"ertek").
                self::elem_P(
                    "Henger Térfogat: "
                ,"kulcs").
                self::elem_P(
                    $auto->hengerTerfogat." cm<sup>3</sup>"
                ,"ertek").
                self::elem_P(
                    "Teljesítmény: "
                ,"kulcs").
                self::elem_P(
                    $auto->teljesitmeny." LE"
                ,"ertek").
                self::elem_P(
                    "Maximális sebesség: "
                ,"kulcs").
                self::elem_P(
                    $auto->maxSebesseg." km/h"
                ,"ertek").
                self::elem_P(
                    "Átlag fogyasztás:"
                ,"kulcs").
                self::elem_P(
                    $auto->fogyasztas." l"
                ,"ertek")
            ,"kartyatest")
        ,"kartya".$extraclass,$id);
    }
}
require "form.php";