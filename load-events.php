<?php
// Connexion à la base de données
$host = "10.194.175.202";
$username = "root";
$password = 'Prj.2023';
$dbname = "campusaccess";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Récupérer les réservations de la table "Reservation"
$sql = "SELECT idChambre, dateDebutReservation, dateFinReservation FROM Reservation";
$result = $conn->query($sql);

// Créer un tableau d'événements
$events = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $event = array(
            'id' => $row['idChambre'],
            'title' => 'Chambre ' . $row['idChambre'],
            'start' => $row['dateDebutReservation'],
            'end' => $row['dateFinReservation']
        );
        $events[] = $event;
    }
}

// Fermer la connexion à la base de données

// ...

// Renvoyer les événements au format JSON
echo json_encode($events);
?>