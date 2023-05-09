<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta name="theme-color" content="#0E619C">
        <title>Inserimento</title>
        <meta name="author" content="Biolghini Paolo, Bianchin Tommaso">
        <meta content="orario, scuola, scolastico, orariofacile, timetable, lezioni" name="keywords">
        <meta content="L'intelligenza artificiale che ti aiuta a creare l'orario per la tua scuola" name="description">
        <link href="assets/img/favicon.png" rel="icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

        <link rel="stylesheet" href="mystyle.css">
</head>
<body>
    <form action="fase3.php" method="post">
    <?php
        if(isset($_POST['nomeClasse']) && is_numeric($_POST['numeroMaestre'])){
            session_start();
            $_SESSION=$_POST;
            for($j = 0; $j < $_POST['numeroMaestre']; $j++){
                echo '<input type="text" name="nomeMaestra'.$j.'" placeholder="nome maestra" required>';
                echo '<input type="number" name="oreMaestra'.$j.'" placeholder="ore settimanali" min="1" required>';
                echo '<label for="giornoLibero">Giorno libero:</label>
                        <select id="giornoLibero" name="giornoLibero">
                        <option value="1">Lunedì</option>
                        <option value="2">Martedì</option>
                        <option value="3">Mercoledì</option>
                        <option value="4">Giovedì</option>
                        <option value="5">Venerdì</option>
                        </select>';
                for($i = 0; $i < $_POST['numeroMaterie']; $i++){
                    echo $_POST['materia'.$i];
                    echo '<input type="checkbox" name="materia'.$i.'Maestra'.$j.'">';
                }
                echo '<br>';
            }
        }else{
            header("location: index.html");
        }
    ?>
    <input type="submit" value="Procedi">
    </form>
</body>
</html>