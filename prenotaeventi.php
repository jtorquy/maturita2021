<?php
//Dichiarazioni variabili utili per la connessione al db
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'my_torqua';

//Connessione al database
$conn = mysqli_connect($host, $user, $password)
or die ("Impossibile connettersi al database". mysqli_error($conn));

//Selezione del database
mysqli_select_db($conn, $database)
or die ("Impossibile connettersi al database $database" . mysqli_error($conn));

//Prende i record POST
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$email = $_POST['email'];
$numTel = $_POST['numTel'];
$ID_Evento = $_POST['evento'];

//Prepero la query per l'inserimento dei dati
$query = "INSERT INTO utenti (nome, cognome, email, numTel) 
VALUES ($nome, $cognome, $email, $numTel);"

//Eseguo la query
$res = mysqli_query($conn, $query);

//Controllo dell'esito
if(!$res){
	die("Errore nella query $query" . mysqli_error($conn));
}

//Prendo l'ID dell'utente che ha appena prenotato
$query2 = "SELECT u.ID_Utente FROM utente as u WHERE u.email = $email";
$res2 = mysqli_query($conn, $query2);
if(!$res2){
	die("Errore nella query $query2" . mysqli_error($conn));
}

//Lo inserisco nella variabile $id_utente
$id_utente = mysqli_result($conn, $query2);

//Preparo la query per inserire nella tabella prenotazionialloggi le informazioni dell'alloggio e chi lo ha prenotato
$query3 = "INSERT INTO prenotazionialloggi(ID_Evento, ID_Utente)
VALUES($ID_Alloggio, $dataInizio, $dataFine, $stanza, $id_utente)";

$res3 = mysqli_query($conn, $query3);
if(!$res3){
	die("Errore nella query $query3" . mysqli_error($conn));
}

//Chiudo la connessione al database
mysqli_close();
?>