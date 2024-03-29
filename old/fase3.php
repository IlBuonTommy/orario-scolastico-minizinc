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
  <div id="titolo">
    <h1 class="titoloOrario1">Orario </h1>
    <h1 class="titoloOrario2">Generator </h1>
  </div>

  <div id="primo">

    <div class="border">

      <div class="frame">

        <div class="image">
          <div class="inserimentoTesto"> </div>
        </div>
      </div>
    </div>
    <div class="testoQuadro">
      <h2 class="titoloOrarioLezioni">OrarioLezioni</h2>
      <table class="tableorari">
        <tr>
          <th class=" vuoto"></th>
          <th class="giorni">Lunedì</th>
          <th class="giorni">Martedì</th>
          <th class="giorni">Mercoledi</th>
          <th class="giorni">Giovedi</th>
          <th class="giorni">Venerdi</th>
        </tr>
        <tr>
          <td class="orari">8:30-10:30</td>
          <td id="lezioni1-1">Italiano</td>
          <td id="lezioni1-2">Matematica</td>
          <td id="lezioni1-3">Storia</td>
          <td id="lezioni1-4">Italiano</td>
          <td id="lezioni1-5"></td>
        </tr>
        <tr>
          <td class="orari">10:30-12:30</td>
          <td id="lezioni2-1"></td>
          <td id="lezioni2-2"></td>
          <td id="lezioni2-3"></td>
          <td id="lezioni2-4"></td>
          <td id="lezioni2-5"></td>
        </tr>
        <tr>
          <td class="orari">14:30-16:30</td>
          <td id="lezioni3-1"></td>
          <td id="lezioni3-2"></td>
          <td id="lezioni3-3"></td>
          <td id="lezioni3-4">Immagine</td>
          <td id="lezioni3-5"></td>
        </tr>
      </table>
    </div>
  </div>

  <div id="secondo">

    <div class="border1">

      <div class="frame1">

        <div class="image">

        </div>
      </div>
    </div>
    <div class="testoQuadro1">
      <h2 class="titoloOrarioMensa">OrarioMensa</h2>
      <table class="tablemensa">
        <tr>
          <th>Lunedì</th>
          <th>Martedì</th>
          <th>Mercoledi</th>
          <th>Giovedi</th>
          <th>Venerdi</th>
        </tr>
        <tr>
          <td id="mensa1">Profe1</td>
          <td id="mensa2">Profe2</td>
          <td id="mensa3">Profe3</td>
          <td id="mensa4">Profe4</td>
          <td id="mensa5">Profe5</td>
        </tr>
      </table>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/minizinc/dist/minizinc.js"></script>

  <script>
    var modelCode = `
        int: NUM_MAT=8;
        int: MAX_NUM_ORE_MAT=30;

        int: NUM_MAESTRE=5;
        int: MAX_NUM_ORE_MAESTRA=30;

        int: contatorePreferenza=0;

        enum giorni={Lunedi , Martedi , Mercoledi, Giovedi ,Venerdi};

        %%definizione del type MATERIA
        enum listaMaterieNomi={Italiano, Matematica,Geografia ,Immagine,Religione,Inglese,Musica,Informatica,Empty};
        array [1..NUM_MAT+1] of var 0..MAX_NUM_ORE_MAT:listaMaterieOre=[Italiano:6, Matematica:6,Geografia:4 ,Immagine:2,Religione:2,Inglese:4,Musica:2,Informatica:4,Empty:0];
        array [1..NUM_MAT+1] of var 0..1:listaMateriePomePreff=[Italiano:0, Matematica:0,Geografia:0 ,Immagine:1,Religione:0,Inglese:0,Musica:1,Informatica:0,Empty:0];


        %definzione del type MAESTRA
        enum listaMaestreNomi={Maestra1,Maestra2,Maestra3,Maestra4,Maestra5};

        array [1..NUM_MAESTRE] of var int:listaMaestreOre=[Maestra1:12,Maestra2:8,Maestra3:2,Maestra4:10,Maestra5:8];

        array [1..NUM_MAESTRE] of var int:oreMaestraSoloLezione;
                                                            
                                                            
        array [1..NUM_MAESTRE,1..5] of var listaMaterieNomi:AssegnazioneMaterieMaestra=    array2d(1..NUM_MAESTRE,1..5,
                      [
                            Italiano,Geografia,Empty,Empty,Empty,
                            Matematica,Empty,Empty,Empty,Empty,
                            Religione,Empty,Empty,Empty,Empty,
                            Immagine,Inglese,Empty,Empty,Empty,
                            Informatica,Musica,Empty,Empty,Empty,
                      ]);

        array [1..NUM_MAESTRE] of var int: listaMaestreMensa=[Maestra1:1,Maestra2:1,Maestra3:0,Maestra4:1,Maestra5:1];
        array [1..NUM_MAESTRE] of var int: listaMaestreOgniGiorno=[Maestra1:1,Maestra2:0,Maestra3:0,Maestra4:1,Maestra5:0];
        array [1..NUM_MAESTRE] of var int: listaMaestreGiornoCasa=[Maestra1:2,Maestra2:1,Maestra3:2,Maestra4:2,Maestra5:5];
        array [1..NUM_MAESTRE] of var 0..3: listaMaestreMattinaOPomeriggioCasa=[Maestra1:1,Maestra2:0,Maestra3:0,Maestra4:3,Maestra5:0];



        array [1..3,1..5] of var listaMaterieNomi:OrarioLezioni;
        array [1..3,1..5] of var listaMaestreNomi:OrarioLezioniMaestre;

        array [1..5] of var listaMaestreNomi:MensaOrario;




        %output[show(listaMaterieOre[AssegnazioneMaterieMaestra[1,1]]+listaMaterieOre[AssegnazioneMaterieMaestra[1,2]])];



        %constraint sull'orario generale
        constraint forall(l in listaMaterieNomi)( sum( j in 1..3 , i in 1..5)(if OrarioLezioni[j,i]==l then 2 else 0 endif)==listaMaterieOre[l] );

        %constraint sulle preferenze il pomeriggio
        constraint forall(l in listaMaterieNomi)(if listaMateriePomePreff[l]=1  then  sum( i in 1..5)(if OrarioLezioni[3,i]=l then 2 else 0 endif)=listaMaterieOre[l] endif );


        %constraint per calcolare orario maestre solo lezioni
        constraint forall(m in listaMaestreNomi)(oreMaestraSoloLezione[m]=listaMaterieOre[AssegnazioneMaterieMaestra[m,1]]+listaMaterieOre[AssegnazioneMaterieMaestra[m,2]]+listaMaterieOre[AssegnazioneMaterieMaestra[m,3]]+listaMaterieOre[AssegnazioneMaterieMaestra[m,5]]+listaMaterieOre[AssegnazioneMaterieMaestra[m,5]]);

        %constraint per calcolare la mensa delle maestre
        constraint forall(m in listaMaestreNomi)( sum(  i in 1..5)(if MensaOrario[i]==m then 2 else 0 endif)==listaMaestreOre[m]-oreMaestraSoloLezione[m]);

        %constraint per orario con Meastre
        constraint forall(m in listaMaestreNomi)( forall(j in 1..3, i in 1..5)(if OrarioLezioni[j,i]==AssegnazioneMaterieMaestra[m,1] \\/ OrarioLezioni[j,i]==AssegnazioneMaterieMaestra[m,2] \\/ OrarioLezioni[j,i]==AssegnazioneMaterieMaestra[m,3] \\/ OrarioLezioni[j,i]==AssegnazioneMaterieMaestra[m,4] \\/ OrarioLezioni[j,i]==AssegnazioneMaterieMaestra[m,5] then OrarioLezioniMaestre[j,i]=m endif ));

        %constraint per controllare che alcune ci siano tutti i giorni
        constraint forall(m in listaMaestreNomi)(if listaMaestreOgniGiorno[m]==1 then  sum(  i in 1..5)(if OrarioLezioniMaestre[1,i]==m \\/ OrarioLezioniMaestre[2,i]==m \\/ OrarioLezioniMaestre[3,i]==m \\/ MensaOrario[i]==m  then 1 else 0 endif)==5 endif);

        %constraint per fare i riposi di almeno una mattina e 2 pome
        %CHIEDERE A MIA SORELLA SE MENSA CONTA
        constraint forall(m in listaMaestreNomi)(sum(  i in 1..5)(if OrarioLezioniMaestre[1,i]==m \\/ OrarioLezioniMaestre[2,i]==m  \\/ MensaOrario[i]==m  then 1 else 0 endif)<5);

        %constraint per i pomeriggi liberi
        constraint forall(m in listaMaestreNomi)(sum(  i in 1..5)(if OrarioLezioniMaestre[3,i]==m   \\/ MensaOrario[i]==m  then 1 else 0 endif)<4);

        %constraint pomeriggio libero giovedì o mercoledì
        constraint forall(m in listaMaestreNomi)(sum(  i in 3..4)(if OrarioLezioniMaestre[3,i]==m   \\/ MensaOrario[i]==m  then 1 else 0 endif)<2);

        %constraint di non aver libero sia venerdì pomeriggio che lunedì mattina
        constraint forall(m in listaMaestreNomi)(if MensaOrario[5]!=m /\\ OrarioLezioniMaestre[3,5]!=m then OrarioLezioniMaestre[1,1]==m \\/ OrarioLezioniMaestre[2,1]==m \\/ MensaOrario[1]==m endif );

        %incrementa la variabile contatore se la maestra in quel gionro libero va a scuola !!SOLO PER CHI NON TUTTI I GIORNI
        constraint forall(m in listaMaestreNomi)(if listaMaestreOgniGiorno[m]==0 then forall(j in 1..3 )(if OrarioLezioniMaestre[j,listaMaestreGiornoCasa[m]]==m then contatorePreferenza=contatorePreferenza+1  endif) endif);

        %controllo mensa
        constraint forall(m in listaMaestreNomi)( if MensaOrario[listaMaestreGiornoCasa[m]]=m then contatorePreferenza=contatorePreferenza+1 endif);

        %incremento la variabile per chi va tutti i giorni MATTINA
        constraint forall(m in listaMaestreNomi)(if listaMaestreOgniGiorno[m]==1 /\\ listaMaestreMattinaOPomeriggioCasa[m]==1   then forall(j in 1..2 )(if OrarioLezioniMaestre[j,listaMaestreGiornoCasa[m]]==m then contatorePreferenza=contatorePreferenza+1  endif) endif);

        constraint forall(m in listaMaestreNomi)(if listaMaestreOgniGiorno[m]==1 /\\ listaMaestreMattinaOPomeriggioCasa[m]==3   then forall(j in 3..3 )(if OrarioLezioniMaestre[j,listaMaestreGiornoCasa[m]]==m then contatorePreferenza=contatorePreferenza+1  endif) endif);


        %controllo sul venerdì e lunedì
        %constraint forall(l in lezioni)(l in sett[4,:]);




        solve minimize contatorePreferenza;
        `;

    const model = new MiniZinc.Model("myModel", modelCode);

    model.addFile('test.mzn', modelCode);
    const solve = model.solve({
      options: {
        solver: 'gecode',
        'all-solutions': true
      }
    });
    solve.on('solution', solution => {

      //console.log(solution.output.json);
      console.log(solution.output.json.OrarioLezioni[0][0].e);
      //setto valori mensa
      document.getElementById("mensa1").innerHTML = solution.output.json.MensaOrario[0].e;
      document.getElementById("mensa2").innerHTML = solution.output.json.MensaOrario[1].e;
      document.getElementById("mensa3").innerHTML = solution.output.json.MensaOrario[2].e;
      document.getElementById("mensa4").innerHTML = solution.output.json.MensaOrario[3].e;
      document.getElementById("mensa5").innerHTML = solution.output.json.MensaOrario[4].e;

      //setto valori Lezioni
      //riga 1
      document.getElementById("lezioni1-1").innerHTML = solution.output.json.OrarioLezioni[0][0].e;
      document.getElementById("lezioni1-2").innerHTML = solution.output.json.OrarioLezioni[0][1].e;
      document.getElementById("lezioni1-3").innerHTML = solution.output.json.OrarioLezioni[0][2].e;
      document.getElementById("lezioni1-4").innerHTML = solution.output.json.OrarioLezioni[0][3].e;
      document.getElementById("lezioni1-5").innerHTML = solution.output.json.OrarioLezioni[0][4].e;
      //riga 2
      document.getElementById("lezioni2-1").innerHTML = solution.output.json.OrarioLezioni[1][0].e;
      document.getElementById("lezioni2-2").innerHTML = solution.output.json.OrarioLezioni[1][1].e;
      document.getElementById("lezioni2-3").innerHTML = solution.output.json.OrarioLezioni[1][2].e;
      document.getElementById("lezioni2-4").innerHTML = solution.output.json.OrarioLezioni[1][3].e;
      document.getElementById("lezioni2-5").innerHTML = solution.output.json.OrarioLezioni[1][4].e;
      //riga 3
      document.getElementById("lezioni3-1").innerHTML = solution.output.json.OrarioLezioni[2][0].e;
      document.getElementById("lezioni3-2").innerHTML = solution.output.json.OrarioLezioni[2][1].e;
      document.getElementById("lezioni3-3").innerHTML = solution.output.json.OrarioLezioni[2][2].e;
      document.getElementById("lezioni3-4").innerHTML = solution.output.json.OrarioLezioni[2][3].e;
      document.getElementById("lezioni3-5").innerHTML = solution.output.json.OrarioLezioni[2][4].e;

      //setto valori Lezioni Maestra
      //riga 1
      /*
      document.getElementById("lezionimaestra1-1").innerHTML=solution.output.json.OrarioLezioniMaestre[0][0].e;
      document.getElementById("lezionimaestra1-2").innerHTML=solution.output.json.OrarioLezioniMaestre[0][1].e;
      document.getElementById("lezionimaestra1-3").innerHTML=solution.output.json.OrarioLezioniMaestre[0][2].e;
      document.getElementById("lezionimaestra1-4").innerHTML=solution.output.json.OrarioLezioniMaestre[0][3].e;
      document.getElementById("lezionimaestra1-5").innerHTML=solution.output.json.OrarioLezioniMaestre[0][4].e;
      //riga 2
      document.getElementById("lezionimaestra2-1").innerHTML=solution.output.json.OrarioLezioniMaestre[1][0].e;
      document.getElementById("lezionimaestra2-2").innerHTML=solution.output.json.OrarioLezioniMaestre[1][1].e;
      document.getElementById("lezionimaestra2-3").innerHTML=solution.output.json.OrarioLezioniMaestre[1][2].e;
      document.getElementById("lezionimaestra2-4").innerHTML=solution.output.json.OrarioLezioniMaestre[1][3].e;
      document.getElementById("lezionimaestra2-5").innerHTML=solution.output.json.OrarioLezioniMaestre[1][4].e;
      //riga 3
      document.getElementById("lezionimaestra3-1").innerHTML=solution.output.json.OrarioLezioniMaestre[2][0].e;
      document.getElementById("lezionimaestra3-2").innerHTML=solution.output.json.OrarioLezioniMaestre[2][1].e;
      document.getElementById("lezionimaestra3-3").innerHTML=solution.output.json.OrarioLezioniMaestre[2][2].e;
      document.getElementById("lezionimaestra3-4").innerHTML=solution.output.json.OrarioLezioniMaestre[2][3].e;
      document.getElementById("lezionimaestra3-5").innerHTML=solution.output.json.OrarioLezioniMaestre[2][4].e;
      */
    });
    solve.then(result => {
      console.log(result.status);
    });
  </script>



</body>

</html>