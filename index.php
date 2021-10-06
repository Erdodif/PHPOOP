<?php
$adatok = require "autok.json";
class Auto{
    private $nev;
    private $hengerSzam;
    private $hengerTerfogat;
    private $teljesitmeny;
    private $maxSebesseg;
    private $fogyasztas;
    private $kepEleres;
    public function __construct($nev,$hengerSzam=null,$hengerTerfogat=null,$teljesitmeny=null,$maxSebesseg=null,$fogyasztas=null,$kepEleres=null){
        if($hengerSzam ===null){
            foreach($i as $nev){
                $this->nev = $nev[0];
                $this->hengerSzam = $hengerSzam[1];
                $this->hengerTerfogat = $hengerTerfogat[2];
                $this->teljesitmeny = $teljesitmeny[3];
                $this->maxSebesseg = $maxSebesseg[4];
                $this->fogyasztas = $fogyasztas[5];
                $this->kepEleres = $kepEleres[6];
            }
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
    static public function mehet(){
        if ($this->autok===null){
            $this->autok = json_decode($adatok);
        }
        $lista = [];
        foreach ($i as $autok){
            $lista->array_push(new Auto($i));
        }
        return $lista;
    } 
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php echo $adatok;?>
</body>
</html>