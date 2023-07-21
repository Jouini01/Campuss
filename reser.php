
<!DOCTYPE html>
<html>
<head>
	<title>Formulaire de réservation</title>
</head>
<body>
    <style>
     h1 {
    background: linear-gradient(to right, rgb(7, 150, 245), rgb(255, 255, 255));
    color: rgb(7, 150, 245);
    text-align: center;
    font-size: 4em;
    margin-top: 0em;
    font-family: "Fantasy", chalkduster, sans-serif;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
h2 {
                color: rgb(231, 230, 229);
                
            }   

            body {
              background-color: #0a3491;
background-image:
radial-gradient(white, rgba(255,255,255,.2) 2px, transparent 40px),
radial-gradient(white, rgba(255,255,255,.15) 1px, transparent 30px),
radial-gradient(white, rgba(255,255,255,.1) 2px, transparent 40px),
radial-gradient(rgba(255,255,255,.4), rgba(255,255,255,.1) 2px, transparent 30px);
background-size: 550px 550px, 350px 350px, 250px 250px, 150px 150px;
background-position: 0 0, 40px 60px, 130px 270px, 70px 100px;
              

            }     
      img {
              margin: 0 auto;
              display: flex;
              flex-direction: column;
              align-items: center;
              
            }
    
      form {
        display: block;
        flex-direction: column;
        align-items: center;
        width: 300px;
        margin-left: 10px;
        min-height: 10em;
      }

label {
  display: block;
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
  color: #FFFFFF;
}

input[type="text"],
input[type="email"],
input[type="number"],
input[type="date"] ,
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        
              
      }

input[type="submit"] {
  background-color: #333;
  color: #fff;
  border: none;
  padding: 10px 20px;
  font-size: 18px;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
}

input[type="submit"]:hover {
  background-color: #555;
}
.pero {
  display: flex;
}
   ul {
                list-style: none;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 80px;
            }
         
            .reo {
                text-decoration: none;
                color: white;
                font-size: 1.2em;
                padding: 10px;
                border-radius: 5px;
                transition: background-color 0.3s ease;
                margin: 0 10px;

            
            }
            .reo:hover {
                background-color: rgba(255, 255, 255, 0.2);
            }


            .message-reservation {
    background-color: #eaf7ea;
    color: #267326;
    padding: 10px;
    margin-bottom: 10px;
    text-align: center;
    font-size: 2em;
}

.message-erreur {
    background-color: #f8e0e0;
    color: #7f0000;
    padding: 10px;
    margin-bottom: 10px;
}

</style>
	<?php

// Connexion à la base de données
$host = "localhost";
$username = "root";
$password = '';
$dbname = "campuss";

$conn = mysqli_connect($host, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Récupération des données du formulaire
  $nom = $_POST["nom"];
  $prenom = $_POST["prenom"];
  $adresse = $_POST["adresse"];
  $codePostal = $_POST["code_postal"];
  $ville = $_POST["ville"];
  $pays = $_POST["pays"];
  $email = $_POST["email"];
  $telephone = $_POST["telephone"];
  $portable = $_POST["portable"];
  $nbPersonne = $_POST["nb_personne"];
  $nuitee = $_POST["nuitee"];
  $dateDebutReservation = $_POST["date_debut"];
  $dateFinReservation = $_POST["date_fin"];

  // Insertion des données dans la table Client
  $sqlClient = "INSERT INTO Client (nom, prenom, adresse, codePostal, ville, pays, email, telephone, portable) VALUES ('$nom', '$prenom', '$adresse', '$codePostal', '$ville', '$pays', '$email', '$telephone', '$portable')";

  // Exécution de la requête d'insertion dans la table Client
  if ($conn->query($sqlClient) === TRUE) {
      // Récupération de l'ID du client ajouté
      $idClient = $conn->insert_id;

      // Insertion des données dans la table Demande
      $sqlDemande = "INSERT INTO Demande (idClient, nbPersonne, nuitee, dateDebutReservation, dateFinReservation) VALUES ('$idClient', '$nbPersonne', '$nuitee', '$dateDebutReservation', '$dateFinReservation')";

      // Exécution de la requête d'insertion dans la table Demande
      if ($conn->query($sqlDemande) === TRUE) {
        echo '<div class="message-reservation">Votre réservation a été bien enregistré avec succès.</div>';
    } else {
        echo '<div class="message-erreur">Erreur lors de l\'ajout de la réservation: ' . $sqlDemande . '<br>' . $conn->error . '</div>';
    }
    
  } else {
      echo "Erreur lors de l'ajout du client: " . $sqlClient . "<br>" . $conn->error;
  }

  // Fermeture de la connexion
  $conn->close();
}


?>
     <!-- Barre de navigation -->
     <ul>
     <li><a href="index.html" class="reo">Accueil </a></li>
            <li><a href="reser.php"class="reo">Réservation</a></li>
            <li><a href="dispo.html"class="reo">Disponibilité</a></li>
        </ul>
	<h1>Réservez vos places</h1>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h2>Information personnelles</h2>
    <div class ="pero">
		<input type="text" name="nom" placeholder="Nom" required><br><br>
		<input type="text" name="prenom" placeholder="Prenom"required><br><br>
</div>
		<input type="text" name="adresse" placeholder="Adresse"required><br><br>
    <div class="pero">
		<input type="text" name="code_postal" placeholder="Code postal" required><br><br>
		<input type="text" name="ville" placeholder="Ville"required><br><br>
		<input type="text" name="pays" placeholder="Pays"required><br><br>
</div>
		<input type="email" name="email" placeholder="Email"required><br><br>
    <div class ="pero">
		<input type="text" name="telephone" placeholder="Numero fix" required><br><br>
		<input type="text" name="portable" placeholder="Numero portable"required><br><br>
</div>
    <h2>Informations de reservation</h2>
		<input type="number" name="nb_personne" min="1" max="10" placeholder="Nombre des personnes"required><br><br>
		<input type="number" name="nuitee" min="1" max="7" placeholder="Nombre des nuits"required><br><br>
		<label for="date_debut">Date de début de réservation:</label>
		<input type="date" name="date_debut" required><br><br>
		<label for="date_fin">Date de fin de réservation:</label>
		<input type="date" name="date_fin" required><br><br>
		
		<input type="submit" value="Envoyer">
	</form>
 
</body>
</html>