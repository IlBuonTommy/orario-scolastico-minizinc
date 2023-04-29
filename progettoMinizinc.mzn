% Use this editor as a MiniZinc scratch book
include "globals.mzn";

int: NUM_MAT=8;
int: MAX_NUM_ORE_MAT=30;

int: NUM_MAESTRE=5;
int: MAX_NUM_ORE_MAESTRA=30;

enum giorni={Lunedi , Martedi , Mercoledi, Giovedi ,Venerdi};

%%definizione del type MATERIA
enum listaMaterieNomi={Italiano, Matematica,Geografia ,Immagine,Religione,Inglese,Musica,Informatica,Empty};
array [1..NUM_MAT+1] of var 0..MAX_NUM_ORE_MAT:listaMaterieOre=[Italiano:6, Matematica:6,Geografia:4 ,Immagine:2,Religione:2,Inglese:4,Musica:2,Informatica:4,Empty:0];
array [1..NUM_MAT] of var 0..1:listaMateriePomePreff=[Italiano:0, Matematica:0,Geografia:0 ,Immagine:1,Religione:0,Inglese:0,Musica:1,Informatica:0];


%definzione del type MAESTRA
enum listaMaestreNomi={Maestra1,Maestra2,Maestra3,Maestra4,Maestra5};
array [1..NUM_MAESTRE] of var int:riferimentoMaestre=[Maestra1:1,Maestra2:2,Maestra3:3,Maestra4:4,Maestra5:5];
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
array [1..NUM_MAESTRE] of var int: listaMaestreOgniGiorno=[Maestra1:1,Maestra2:1,Maestra3:0,Maestra4:1,Maestra5:1];



array [1..3,1..5] of var listaMaterieNomi:OrarioLezioni;
array [1..3,1..5] of var listaMaestreNomi:OrarioLezioniMaestre;

array [1..5] of var listaMaestreNomi:MensaOrario;






%output[show(listaMaterieOre[AssegnazioneMaterieMaestra[1,1]]+listaMaterieOre[AssegnazioneMaterieMaestra[1,2]])];




%constraint sull'orario generale
constraint forall(l in listaMaterieNomi)( sum( j in 1..3 , i in 1..5)(if OrarioLezioni[j,i]==l then 2 else 0 endif)==listaMaterieOre[l] );

%constraint sulle preferenze il pomeriggio
constraint forall(l in listaMaterieNomi)(if listaMateriePomePreff[l]==1  then  sum( i in 1..5)(if OrarioLezioni[3,i]==l then 2 else 0 endif)==listaMaterieOre[l] endif );


%constraint per calcolare orario maestre solo lezioni
constraint forall(m in listaMaestreNomi)(oreMaestraSoloLezione[m]=listaMaterieOre[AssegnazioneMaterieMaestra[m,1]]+listaMaterieOre[AssegnazioneMaterieMaestra[m,2]]);

%constraint per calcolare la mensa delle maestre
constraint forall(m in listaMaestreNomi)( sum(  i in 1..5)(if MensaOrario[i]==m then 2 else 0 endif)==listaMaestreOre[m]-oreMaestraSoloLezione[m]);

%constraint per 
constraint forall(m in listaMaestreNomi)( forall(j in 1..3, i in 1..5)(if OrarioLezioni[j,i]==AssegnazioneMaterieMaestra[m,1] \/ OrarioLezioni[j,i]==AssegnazioneMaterieMaestra[m,2] then OrarioLezioniMaestre[j,i]=m endif ));

%controllo sul venerdì e lunedì
%constraint forall(l in lezioni)(l in sett[4,:]);



solve satisfy;