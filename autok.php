<?php
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
    static private $autok = [];
    static public function getAutok($eleres){
        if ($eleres !==""){
            $string = file_get_contents($eleres);
            $tartalom = json_decode($string,true);
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