enum giorni={Lunedi , Martedi , Mercoledi, Giovedi ,Venerdi};

type Materia={name:string, Nore:int , pomePreferr:int};

type Maestra = {name: string, Nore: int , MaterieInsegnate: set of Materia, PreferenzeOrario: set of int ,Mensa:int};






enum giorni={Lunedi , Martedi , Mercoledi, Giovedi ,Venerdi};
enum nomeMaterie={}

type Materia={name:string, Nore:int , pomePreferr:int};

type Maestra = {name: string, Nore: int , MaterieInsegnate: set of Materia, PreferenzeOrario: set of int ,Mensa:int};

array[1..8] of Materia: listaMaterie = [
    {name: "Italiano",Nore:6 , pomePreferr:0},
    {name: "Matematica",Nore:6 , pomePreferr:0},
    {name: "Geografia",Nore:4 , pomePreferr:0},
    {name: "Immagine",Nore:2 , pomePreferr:1},
    {name: "Religione",Nore:2 , pomePreferr:0},
    {name: "Inglese",Nore:4 , pomePreferr:0},
    {name: "Musica",Nore:2 , pomePreferr:1},
    {name: "Informatica",Nore:4 , pomePreferr:0}
];

array[1..8] of Maestra: listaMaestre = [
    {name: "Maestra1", Nore: "12" , MaterieInsegnate: {1,3}, PreferenzeOrario: {},Mensa:1},
    {name: "Maestra2", Nore: "8" , MaterieInsegnate: {2}, PreferenzeOrario: {},Mensa:1},
    {name: "Maestra3", Nore: "2" , MaterieInsegnate: {5}, PreferenzeOrario: {},Mensa:0},
    {name: "Maestra4", Nore: "12" , MaterieInsegnate: {4,6,7}, PreferenzeOrario: {},Mensa:1},
    {name: "Maestra5", Nore: "6" , MaterieInsegnate: {8}, PreferenzeOrario: {},Mensa:1}
];

array [1..3,1..5] of var Materia:OrarioLezioni;
array [1..5] of var Maestra:OrarioMensa;

%controllo sulla somma delle ore
constraint forall(lm in listaMaterie)( sum( j in 1..3 , i in 1..5)(if OrarioLezioni[j,i].name==lm.name then 2 else 0 endif)==lm.Nore );


%controllo sul venerdì e lunedì
%constraint forall(l in lezioni)(l in sett[4,:]);



solve satisfy;


