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
    <form action="index.php" method="POST" enctype="multipart/form-data">
        <div>
            <label for="auto_nev">Autó neve: </label>
            <input type="text" id="auto_nev" name="auto_nev" value="<?php echo $ujnev;?>">
        </div>
        <div>
            <label for="auto_hengerSzam">Hengerek Száma:</label>
            <input type="text" id="auto_hengerSzam" name="auto_hengerSzam" value="<?php echo $ujhengerSzam;?>">
        </div>
        <div>
            <label for="auto_hengerTerfogat">Hegerek Térfogata:</label>
            <input type="text" id="auto_hengerTerfogat" name="auto_hengerTerfogat" value="<?php echo $ujhengerTerfogat;?>">
        </div>
        <div>
            <label for="auto_teljesitmeny">Teljesítmény:</label>
            <input type="text" id="auto_teljesitmeny" name="auto_teljesitmeny" value="<?php echo $ujteljesitmeny;?>">
        </div>
        <div>
            <label for="auto_maxSebesseg">Maximális Sebesség:</label>
            <input type="text" id="auto_maxSebesseg" name="auto_maxSebesseg" value="<?php echo $ujmaxSebesseg;?>">
        </div>
        <div>
            <label for="auto_fogyasztas">Átlag fogyasztás:</label>
            <input type="text" id="auto_fogyasztas" name="auto_fogyasztas" value="<?php echo $ujfogyasztas;?>">
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