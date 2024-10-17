<?php
include "database.php"; // Ensure this file establishes a database connection
?>
<!doctype html>
<html lang="en">
<head>
    <title>Gestion des Dettes</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
        #message {
            width: 1100px;
            height: 100px;
            border-radius: 5px;
            margin-top: 50px;
            color: green;
            background-color: lightgreen;
            text-align: center;
            justify-content: center;
            align-items: center;
            padding-top: 40px;
            position: relative;
            transform: translateY(-100%);
            display: none;
            opacity: 0;
            transition: transform 0.5s ease, opacity 0.5s ease;
        }
    </style>
</head>
<body>
<header class="bg-primary text-white text-center py-3">
    <h1 class="display-4">Gestion des Dettes</h1>
</header>
<main class="container">
    <div id="message"></div>
    <section>
        <form id="detteForm" class="p-4 rounded my-5 shadow-sm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div style="font-size: 25px;">
                <label>Enregistrer un emprunt</label>
                <div id="error1" style="color: red; font-size: 20px; text-align: center;"></div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control" required />
                        <small class="text-muted">Help text</small>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prenom</label>
                        <input type="text" id="prenom" name="prenom" class="form-control" required />
                        <small class="text-muted">Help text</small>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="mb-3">
                        <label for="nin" class="form-label">NIN Client</label>
                        <input type="text" id="nin" name="nin" class="form-control" required />
                        <small class="text-muted">NIN du client</small>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="mb-3">
                        <label for="tel" class="form-label">Telephone</label>
                        <input type="text" id="tel" name="tel" class="form-control" required />
                        <small class="text-muted">Exemple: '774541212'</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="mb-3">
                        <label for="montant" class="form-label">Montant</label>
                        <input type="text" id="montant" name="montant" class="form-control" required />
                        <small class="text-muted">Montant de l'emprunt</small>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" name="adresse" id="adresse" class="form-control" required />
                        <small class="text-muted">Exemple: 'Londres, Angleterre'</small>
                    </div>
                </div>
            </div>
            <input type="submit" id="submitBtn" name="submit" value="Enregistrer" class="btn btn-primary" />
        </form>
    </section>
</main>
<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_SPECIAL_CHARS);
    $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_SPECIAL_CHARS);
    $nin = filter_input(INPUT_POST, "nin", FILTER_SANITIZE_SPECIAL_CHARS);
    $tel = filter_input(INPUT_POST, "tel", FILTER_SANITIZE_SPECIAL_CHARS);
    $montant = filter_input(INPUT_POST, "montant", FILTER_SANITIZE_SPECIAL_CHARS);
    $adresse = filter_input(INPUT_POST, "adresse", FILTER_SANITIZE_SPECIAL_CHARS);

    // Check for empty fields
    if (empty($nom) || empty($prenom) || empty($tel) || empty($montant) || empty($adresse) || empty($nin)) {
        echo "<script>alert('Tous les champs sont obligatoires.');</script>";
    } else {
        // Insert data into the database
        $query = "INSERT INTO datacol (NIN_client, Nom_client, Prenom_client, Telephone_client, Montant, Adresse_client) 
                      VALUES ('$nin', '$nom', '$prenom', '$tel', '$montant', '$adresse')";

        mysqli_query($conn, $query);
        echo "<script>alert('Vous avez effectué un emprunt avec succès.');</script>";
    }
}

// Close the connection
mysqli_close($conn);
?>

</body>
</html>

