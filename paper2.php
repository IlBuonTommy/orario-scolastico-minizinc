<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="theme-color" content="#0E619C">
  <title>Fase 2</title>
  <meta name="author" content="Biolghini Paolo, Bianchin Tommaso">
  <meta content="orario, scuola, scolastico, orariofacile, timetable, lezioni" name="keywords">
  <meta content="L'intelligenza artificiale che ti aiuta a creare l'orario per la tua scuola" name="description">
  <link href="assets/img/favicon.png" rel="icon">
  <link rel="stylesheet" href="assets/css/draw.css">
  <link rel="stylesheet" href="assets/css/paper.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <form action="paper3.php" method="POST">
      <input name="passaggioSicuroFase3" id="passaggioSicuroFase3" type="hidden" value="2">
      <div class="paper">
        <div class="lines">
          <div class="text" spellcheck="false">
            <h2 class=" titolo1">Orario</h2>
            <h2 class=" titolo2">Generator</h2>

            <div class="nomeClasseOut">
              <b>Classe: <?php echo $_POST["nomeClasse"]; ?></b>
            </div>

          </div>
        </div>
        <div class="holes hole-top"></div>
        <div class="holes hole-middle"></div>
        <div class="holes hole-bottom"></div>
      </div>

      <div class="paper1">
        <div class="lines">
          <div class="text1" spellcheck="false">
            <b>Inserisci Le Maestre</b> <br>
            <div>
              <?php
              if (isset($_POST['nomeClasse']) && is_numeric($_POST['numeroMaestre'])) {
                session_start();
                $_SESSION = $_POST;
                for ($j = 0; $j < $_POST['numeroMaestre']; $j++) {
                  echo '<input type="text" class="nomeMaestraIn" name="nomeMaestra' . $j . '" class="nomeMaestra" placeholder="nome maestra" required>';
                  echo '<input type="number" class="oreSettimanaliIn" name="oreMaestra' . $j . '" placeholder="ore settimanali" min="1" required>';
                  echo '<div class="gLibero">';
                  echo '<label for="giornoLibero">Giorno libero:</label>
                        <select id="giornoLibero" class="selectGiornoLibero" name="giornoLibero' . $j . '">
                        <option value="1">Lunedì</option>
                        <option value="2">Martedì</option>
                        <option value="3">Mercoledì</option>
                        <option value="4">Giovedì</option>
                        <option value="5">Venerdì</option>
                        </select>';

                  echo ("Mensa");
                  echo '<input type="checkbox" class="mensaChoice" name="Mensa' . $j . '">';

                  echo ("Tutti i Giorni");
                  echo '<input type="checkbox" class="tuttiIGiorni" name="TuttiGiorni' . $j . '" onclick="tuttiGiorniClicked(this)" checked>';

                  echo ("<div id='divMattPom" . $j . "'>");
                  echo ("Mat");
                  echo '<input type="checkbox" class="matt" name="matt' . $j . '">';
                  echo ("Pom");
                  echo '<input type="checkbox" class="pome" name="pome' . $j . '">';
                  echo ("</div> ");
                  echo '</div>';

                  echo '<div class="checkboxMateria">';
                  echo ("<b> Materie Insegnate</b><br>");
                  for ($i = 0; $i < $_POST['numeroMaterie']; $i++) {
                    echo $_POST['materia' . $i];
                    echo '<input type="checkbox" name="materia' . $i . 'Maestra' . $j . '">';
                  }
                  echo '</div>';

                  echo '<br>';
                }
              } else {
                header("location: index.html");
              }
              ?>
            </div>
            <input type="submit" class="next" value="Procedi">
          </div>
        </div>
        <div class="holes1 hole-top"></div>
        <div class="holes1 hole-middle"></div>
        <div class="holes1 hole-bottom"></div>
      </div>







    </form>

    <div class="pa diary hover">
      <div class="main">
        <div class="cover">
          <div class="pa less"></div>
        </div>
      </div>
    </div>

    <div class="pa pencil hover">
      <div class="pa pencil-bottom"></div>
      <div class="pencil-nip">
        <div class="pencil-tip"></div>
      </div>
    </div>

    <div class="pa mug hover">
      <div class="pr mug_head">
        <div class="pa coffee"></div>
        <div class="pa ear"></div>
      </div>
    </div>

    <div class="pa notes hover">
      <div class="note pr"></div>
    </div>

    <div class="pa pen hover">
      <div class="pen-nip">
        <div class="pen-tip"></div>
      </div>
      <div class="pa pen-bottom"></div>
    </div>

    <div class="pa handwatch hover">
      <div class="pr">
        <div class="belt"></div>
        <div class="pa dial">
          <div class="pa sun-hand"></div>
          <div class="pa hand1"></div>
          <div class="pa hand2"></div>
          <div class="pa button1"></div>
          <div class="pa button2"></div>
        </div>
      </div>
    </div>

  </div>

  <script>
    function tuttiGiorniClicked(obj) {
      /*var element = document.getElementById("myElement");
      
      if (event.target.checked) {
          element.classList.add("hidden");
      } else {
          element.classList.remove("hidden");
      }*/

      var nome = obj.name;
      console.log(nome)
      var ultimoCarattere = nome.charAt(nome.length - 1);
      console.log(ultimoCarattere);
      var element = document.getElementById("divMattPom" + ultimoCarattere);
      element.classList.toggle("hidden");
    }
  </script>

</body>

</html>