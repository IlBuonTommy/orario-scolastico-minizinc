<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta name="theme-color" content="#0E619C">
        <title>Calendario scolastico</title>
        <meta name="author" content="Biolghini Paolo, Bianchin Tommaso">
        <meta content="orario, scuola, scolastico, orariofacile, timetable, lezioni" name="keywords">
        <meta content="L'intelligenza artificiale che ti aiuta a creare l'orario per la tua scuola" name="description">
        <link href="assets/img/favicon.png" rel="icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

        <link rel="stylesheet" href="mystyle.css">
</head>
<body>
  <!-- Inserisci il nome della classe  -->
  <form action="fase2.php" method="post">
    <input type="text" name="classe" placeholder="nome classe">
    <!-- crea un bottone javascript che conta quante volte è stato premuto -->
    <input type="button" value="Aggiungi maestra" onclick="addMaestra()">
    <div id="inputs-container"></div>
    <script>
      function addMaestra() {
        const inputsContainer = document.getElementById('inputs-container');
        const newInput = document.createElement('input');
        newInput.type = 'text';
        inputsContainer.appendChild(newInput);
      }
    </script>
    <input type="submit" value="Procedi">
  </form>
</body>
</html>