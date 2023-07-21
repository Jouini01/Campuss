<?php

// Connexion à la base de données
$host = "10.194.175.202";
$username = "root";
$password = 'Prj.2023';
$dbname = "campusacces";
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}

// Requête pour récupérer les chambres disponibles
$sql = "SELECT * FROM chambres WHERE Etat= 'Disponible'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
// Affichage des chambres disponibles
echo "<h2>Chambres disponibles :</h2>";
echo "<table>";
echo "<tr><th>ID</th><th>Numéro de chambre</th><th>Bâtiment</th><th>Étage</th><th>Etat</tr>";

while($row = mysqli_fetch_assoc($result)) {
echo "<tr><td>" . $row["id"] . "</td><td>" . $row["id_chambre"] . "</td><td>" . $row["batiment"] . "</td><td>" . $row["etage"] . "</td><tr>". $row["Etat"] . "</td></tr>";
}

// Parcours de la table reservations
$sql_res = "SELECT * FROM reservations";
$result_res = mysqli_query($conn, $sql_res);

while($row_res = mysqli_fetch_assoc($result_res)) {
$id_chambre_res = $row_res["id_chambre"];
$sql_chambre = "SELECT * FROM chambres WHERE id_chambre = '$id_chambre_res'";
$result_chambre = mysqli_query($conn, $sql_chambre);
}

echo "</table>";
} else {
echo "Aucune chambre disponible.";
}

// Fermeture de la connexion à la base de données
mysqli_close($conn);
?>
