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
                                                    
                                                    
array [1..NUM_MAESTRE,1..2] of var listaMaterieNomi:AssegnazioneMaterieMaestra=    array2d(1..NUM_MAESTRE,1..2,
               [
                    Italiano,Geografia,
                     Matematica,Empty,
                     Religione,Empty,
                    Immagine,Inglese,
                    Informatica,Musica,
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
constraint forall(m in listaMaestreNomi)(oreMaestraSoloLezione[m]=listaMaterieOre[AssegnazioneMaterieMaestra[m,1]]+listaMaterieOre[AssegnazioneMaterieMaestra[m,2]]);

%constraint per calcolare la mensa delle maestre
constraint forall(m in listaMaestreNomi)( sum(  i in 1..5)(if MensaOrario[i]==m then 2 else 0 endif)==listaMaestreOre[m]-oreMaestraSoloLezione[m]);

%constraint per orario con Meastre
constraint forall(m in listaMaestreNomi)( forall(j in 1..3, i in 1..5)(if OrarioLezioni[j,i]==AssegnazioneMaterieMaestra[m,1] \/ OrarioLezioni[j,i]==AssegnazioneMaterieMaestra[m,2] then OrarioLezioniMaestre[j,i]=m endif ));

%constraint per controllare che alcune ci siano tutti i giorni
constraint forall(m in listaMaestreNomi)(if listaMaestreOgniGiorno[m]==1 then  sum(  i in 1..5)(if OrarioLezioniMaestre[1,i]==m \/ OrarioLezioniMaestre[2,i]==m \/ OrarioLezioniMaestre[3,i]==m \/ MensaOrario[i]==m  then 1 else 0 endif)==5 endif);

%constraint per fare i riposi di almeno una mattina e 2 pome
%CHIEDERE A MIA SORELLA SE MENSA CONTA
constraint forall(m in listaMaestreNomi)(sum(  i in 1..5)(if OrarioLezioniMaestre[1,i]==m \/ OrarioLezioniMaestre[2,i]==m  \/ MensaOrario[i]==m  then 1 else 0 endif)<5);

%constraint per i pomeriggi liberi
constraint forall(m in listaMaestreNomi)(sum(  i in 1..5)(if OrarioLezioniMaestre[3,i]==m   \/ MensaOrario[i]==m  then 1 else 0 endif)<4);

%constraint pomeriggio libero giovedì o mercoledì
constraint forall(m in listaMaestreNomi)(sum(  i in 3..4)(if OrarioLezioniMaestre[3,i]==m   \/ MensaOrario[i]==m  then 1 else 0 endif)<2);

%constraint di non aver libero sia venerdì pomeriggio che lunedì mattina
constraint forall(m in listaMaestreNomi)(if MensaOrario[5]!=m /\ OrarioLezioniMaestre[3,5]!=m then OrarioLezioniMaestre[1,1]==m \/ OrarioLezioniMaestre[2,1]==m \/ MensaOrario[1]==m endif );

%incrementa la variabile contatore se la maestra in quel gionro libero va a scuola !!SOLO PER CHI NON TUTTI I GIORNI
constraint forall(m in listaMaestreNomi)(if listaMaestreOgniGiorno[m]==0 then forall(j in 1..3 )(if OrarioLezioniMaestre[j,listaMaestreGiornoCasa[m]]==m then contatorePreferenza=contatorePreferenza+1  endif) endif);

%controllo mensa
constraint forall(m in listaMaestreNomi)( if MensaOrario[listaMaestreGiornoCasa[m]]=m then contatorePreferenza=contatorePreferenza+1 endif);

%incremento la variabile per chi va tutti i giorni MATTINA
constraint forall(m in listaMaestreNomi)(if listaMaestreOgniGiorno[m]==1 /\ listaMaestreMattinaOPomeriggioCasa[m]==1   then forall(j in 1..2 )(if OrarioLezioniMaestre[j,listaMaestreGiornoCasa[m]]==m then contatorePreferenza=contatorePreferenza+1  endif) endif);

constraint forall(m in listaMaestreNomi)(if listaMaestreOgniGiorno[m]==1 /\ listaMaestreMattinaOPomeriggioCasa[m]==3   then forall(j in 3..3 )(if OrarioLezioniMaestre[j,listaMaestreGiornoCasa[m]]==m then contatorePreferenza=contatorePreferenza+1  endif) endif);


%controllo sul venerdì e lunedì
%constraint forall(l in lezioni)(l in sett[4,:]);




solve minimize contatorePreferenza;