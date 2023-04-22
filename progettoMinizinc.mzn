% Use this editor as a MiniZinc scratch book
array [1..9] of var 1..100:a;
enum lezioni={Arte, Italiano,Matematica ,Storia,Scienze};
enum giorni={Lunedi , Martedi , Mercoledi, Giovedi ,Venerdi};
enum maestre={Maestra1,Maestra2,Maestra3,Maestra4,Maestra5};

%array [1..5] of lezioni :listalezioni=[lezioni.Arte,lezioni.Italiano,lezioni.Matematica, lezioni.Storia , lezioni.scienze];

array [1..5] of var 1..8:s=[Arte:6, Italiano:2,Matematica:3,Storia:3,Scienze:6];

array [1..3,1..5] of var lezioni:Materie;

%controllo sulla somma delle ore
constraint forall(l in lezioni)( sum( j in 1..4 , i in 1..5)(if sett[j,i]==l then 1 else 0 endif)==s[l] );


%controllo sul venerdì e lunedì
%constraint forall(l in lezioni)(l in sett[4,:]);



solve satisfy;