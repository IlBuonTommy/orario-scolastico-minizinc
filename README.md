# Timetabling problem with minizinc
Questo sistema web si pone l'obbiettivo di generare automaticamente l'orario settimanale di una classe di una scuola elementare usando Minizinc.
![Pagina 1](/assets/img/Pag1.png?raw=true)
### Installazione
Essendo un sistema web è necessario utilizzare un server web (come Apache) per poter navigare all'interno delle pagine, [Minizinc](https://github.com/MiniZinc/minizinc-js) verrà interrogato come API quindi non bisogna installare nessun'altra dipendenza.
Per i sistemi Windows si consiglia l'utilizzo di [XAMPP](https://www.apachefriends.org/it/) con il solo modulo di Apache.
### Esigenze e obbiettivi 
Una scuola elementare ha la necessitò di creare un orario scolastico che si possa adattare al meglio alle esigenze di tutti gli insegnanti. Il calendario generato deve essere riferito ad una classe e deve tener conto delle preferenze e del monte ore che i professori devono effettuare per contratto. L'interfaccia deve essere curata in modo che il sistema sia facilmente utilizzabile da tutti.
Gli obbiettivi del sistema sono stati dati direttamente dall'istituto comprensivo: una classe può essere seguita da più maestre che possono insegnare anche più materie diverse. La gestione temporale si dovrà basare su un degli slot di 2 ore, rispettivamente due al mattino e uno slot al pomeriggio, la pausa mensa dovrà essere sorvegliata da una professoressa.
### I Constraints
* Ci sono M MATERIE ognuna con N ore
* Ci sono X MAESTRE ognuna che fa une certo numero di ore da contratto
* Ogni maestra insegna ALMENO 1 MATERIA , ma può averne più di una
* OGNI MAESTRA con N ore (>18) deve fare ALMENO una pausa mensa a SETTIMANA
* La giornata è divisa in SLOT temporale di 2 ORE
* NON ci posso essere 4 ORE di fila della stessa materia 
* Se ha il venerdì POMERIGGIO LIBERO allora lunedì MATTINA LAVORA
* OGNI maestra con almeno 22 ore a contratto fa almeno 2 ore ogni giorno
* OGNI maestra ha 1 MATTINA LIBERA e 2 pomeriggi liberi (UNO DI QUESTI deve essere di MERCOLEDì o GIOVEDì)
* RELIGIONE da disponibilità solo per 2 giorni
* MOTORIA MUSICA IMMAGINE INGLESE meglio che siano di POMERIGGIO
### L'interfaccia
L'interfaccia consente all'utente di inserire tutti i dati necessari alla compilazione dell'orario in maniera corretta. Essa è implementata su 3 pagine, le prime due di inserimento e l'ultima di visualizzazione dell'orario generato.
1. L’utente inizialmente si ritroverà nella pagina index dove potrà aggiungere il nome della classe e la quantità di maestre che insegnano. Nel nostro esempio verranno aggiunte 5 maestre e 8 materie.
![Pagina 1](/assets/img/Pag1.png?raw=true)
Nella sezione di inserimento delle materie, oltre al monte ore settimanale della singola materia sulla specifica classe può essere aggiunta l’opzione di inserire la materia nello slot pomeridiano.
Premendo su procedi, l’utente verrà portato nella seconda pagina dove dovrà inserire i dati degli insegnanti.
![Pagina 1](/assets/img/Pag1.png?raw=true)
2. Per ogni maestra si potrà inserire il nome, il monte ore settimanale del contratto, la preferenza per il giorno libero, la facoltà della maestra di fare presenza durante le due ore della mensa.
![Pagina 1](/assets/img/Pag1.png?raw=true)
Inoltre se la maestra lavora tutti i giorni è possibile selezionare se desidera avere il mattino o il pomeriggio libero nel giorno che ha selezionato.
Una volta selezionate anche le materie che insegna ed aver compilato tutti i campi è possibile premere si procedi.
3. Arrivati all’ultima pagina, i dati verranno passati tramite PHP allo script in javascript di MiniZinc che cercherà la soluzione ottimale al problema proponendola graficamente. 
![Pagina 1](/assets/img/Pag1.png?raw=true)
Da questa schermata è possibile osservare sul lato destro l’orario con le materie della classe, sul lato sinistro invece l’orario con i nominativi delle maestre che dovranno sorvegliare i ragazzi durante la pausa mensa.
