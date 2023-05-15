<html>
    <head>
        <link rel="stylesheet" href="paper.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-Dp8jXa1z+KxSQezXp2NBBt5KfAvTvgJS6dpDvqodm8vwEGj4+2CE9QCH4OB8Nq6x" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
        <form action="fase3.php" method="post">
            <div class="paper">
                <div class="lines">
                <div class="text" contenteditable spellcheck="false">
                    <h2 class=" titolo1">Orario</h2>
                    <h2 class=" titolo2">Generator</h2>
                    
                    <div class="nomeClasseOut">
                        <b>Classe: <?php echo $_POST["nomeClasse"];?></b>
                    </div>
                    
                </div>
                </div>
                <div class="holes hole-top"></div>
                <div class="holes hole-middle"></div>
                <div class="holes hole-bottom"></div>
            </div>
            
            <div class="paper1">
                <div class="lines">
                <div class="text1" contenteditable spellcheck="false">
                    <b>Inserisci Le Materie</b> <br>
                    <div>
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
                    <input type="submit" class="next" value="Procedi">
                   </div>
                </div>
                <div class="holes1 hole-top"></div>
                <div class="holes1 hole-middle"></div>
                <div class="holes1 hole-bottom"></div>
            </div>

            
                
                
            
    
    
    </form>

            
        </div>

        
    </body>
</html>