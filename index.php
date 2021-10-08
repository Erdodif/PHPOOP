<?php
$ujnev = htmlspecialchars($_POST["auto_nev"]??"",ENT_QUOTES);
$ujhengerSzam = htmlspecialchars($_POST["auto_hengerSzam"]??"",ENT_QUOTES);
$ujhengerTerfogat = htmlspecialchars($_POST["auto_hengerTerfogat"]??"",ENT_QUOTES);
$ujteljesitmeny = htmlspecialchars($_POST["auto_teljesitmeny"]??"",ENT_QUOTES);
$ujmaxSebesseg = htmlspecialchars($_POST["auto_maxSebesseg"]??"",ENT_QUOTES);
$ujfogyasztas = htmlspecialchars($_POST["auto_fogyasztas"]??"",ENT_QUOTES);
$ujkep = $_FILES["auto_kep"]["name"]?? "";
$utvonal = "./feltoltesek/".$ujkep;
$feltoltesrendben = true;
var_dump($ujkep);
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
}
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
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autós kártyák</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>
        Autós Kártyák
    </h1>
    <form method="POST">
        <div>
            <label for="auto_nev">Autó neve: </label>
            <input type="text" id="auto_nev" name="auto_nev" value="<?php echo $nev;?>">
        </div>
        <div>
            <label for="auto_hengerSzam">Hengerek Száma:</label>
            <input type="text" id="auto_hengerSzam" name="auto_hengerSzam" value="<?php echo $hengerSzam;?>">
        </div>
        <div>
            <label for="auto_hengerTerfogat">Hegerek Térfogata:</label>
            <input type="text" id="auto_hengerTerfogat" name="auto_hengerTerfogat" value="<?php echo $hengerTerfogat;?>">
        </div>
        <div>
            <label for="auto_teljesitmeny">Teljesítmény:</label>
            <input type="text" id="auto_teljesitmeny" name="auto_teljesitmeny" value="<?php echo $teljesitmeny;?>">
        </div>
        <div>
            <label for="auto_maxSebesseg">Maximális Sebesség:</label>
            <input type="text" id="auto_maxSebesseg" name="auto_maxSebesseg" value="<?php echo $maxSebesseg;?>">
        </div>
        <div>
            <label for="auto_fogyasztas">Átlag fogyasztás:</label>
            <input type="text" id="auto_fogyasztas" name="auto_fogyasztas" value="<?php echo $fogyasztas;?>">
        </div>
        <div>
            <label for="auto_kep">Kép:</label>
            <input type="file" name="auto_kep" id="auto_kep">
        </div>
        <input type="submit" value="Hozzáad" name="submit">
    </form>
    <h2>Kártyáim</h2>
    <div class="pakli">
        <?php echo Autok::getAutok("./autok.json"); ?>
    </div>
    <?php echo $ujkep;?>
</body>
</html>