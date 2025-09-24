<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $Nom = htmlspecialchars($_POST['Nom']);
    $prenom = htmlspecialchars($_POST['Prenom']);
    $email = htmlspecialchars($_POST['Email']);
    $age = htmlspecialchars($_POST['Age']);
    $telephone = htmlspecialchars($_POST['telephone']);


    $stage = isset($_POST['stages']) ? nl2br(htmlspecialchars($_POST['stages'])) : 'Non';
    $projets = isset($_POST['projets']) ? nl2br(htmlspecialchars($_POST['projets'])) : 'Non';
    $centre_interets = isset($_POST['centre_interet']) ? nl2br(htmlspecialchars($_POST['centre_interet'])) : 'Non';
    $langues = isset($_POST['langues']) ? $_POST['langues'] : [];

    // Gestion de l'image
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = basename($_FILES['photo']['name']);
        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $filePath)) {
            $photoURL = $filePath; 
        } else {
            $photoURL = null;
        }
    } else {
        $photoURL = null;
    }
}


    // Radios
    $filiere = isset($_POST['filiere']) ? htmlspecialchars($_POST['filiere']) : "Non renseigné";
    $annee   = isset($_POST['Annee']) ? htmlspecialchars($_POST['Annee']) : "Non renseigné";

    // Checkboxes (tableau)
    $modules = isset($_POST['modules']) ? $_POST['modules'] : [];

    // Liste déroulante
    $nb_projets = isset($_POST['nb_projets']) ? htmlspecialchars($_POST['nb_projets']) : "Non renseigné";





  if (isset($_POST['action']) && $_POST['action'] === "valider") {
    $contenu = "Nom : $Nom\n";
    $contenu .= "Prénom : $prenom\n";
    $contenu .= "Email : $email\n";
    $contenu .= "Âge : $age\n";
    $contenu .= "Téléphone : $telephone\n";
    $contenu .= "Filière : $filiere\n";
    $contenu .= "Année : $annee\n";
    $contenu .= "Modules : " . (!empty($modules) ? implode(", ", $modules) : "Aucun") . "\n";
    $contenu .= "Nombre de projets : $nb_projets\n";
    $contenu .= "Projets réalisés : " . (!empty($projets) ? $projets : "Non renseigné") . "\n";
    $contenu .= "Stages réalisés : " . (!empty($stage) ? $stage : "Non renseigné") . "\n";
    $contenu .= "Centres d'intérêt : " . (!empty($centre_interets) ? $centre_interets : "Non renseigné") . "\n";
    $contenu .= "Langues : " . (!empty($langues) ? implode(", ", $langues) : "Aucune") . "\n";

    // Forcer le téléchargement
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="informations.txt"');
    header('Content-Length: ' . strlen($contenu));

    echo $contenu;
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Récapitulatif</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f5f5f5;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 30px;
        }

        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #ecf0f1;
        }

        h3 {
            color: #34495e;
            margin: 25px 0 15px 0;
            font-size: 1.2em;
        }

        .section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid #3498db;
        }

        .info-row {
            display: flex;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #ecf0f1;
        }

        .info-label {
            font-weight: bold;
            width: 200px;
            color: #2c3e50;
        }

        .info-value {
            flex: 1;
            color: #555;
        }

        .photo-container {
            text-align: center;
            margin: 20px 0;
        }

        .photo-container img {
            border: 3px solid #bdc3c7;
            border-radius: 6px;
            max-width: 200px;
        }

        .buttons-container {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            justify-content: center;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-valider {
            background-color: #27ae60;
            color: white;
        }

        .btn-valider:hover {
            background-color: #219a52;
        }

        .btn-modifier {
            background-color: #f39c12;
            color: white;
        }

        .btn-modifier:hover {
            background-color: #e67e22;
        }

        .btn-pdf {
            background-color: #e74c3c;
            color: white;
        }

        .btn-pdf:hover {
            background-color: #c0392b;
        }

        .tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 5px;
        }

        .tag {
            background: #3498db;
            color: white;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.9em;
        }

        .no-data {
            color: #7f8c8d;
            font-style: italic;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
            
            .info-row {
                flex-direction: column;
            }
            
            .info-label {
                width: 100%;
                margin-bottom: 5px;
            }
            
            .buttons-container {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
        }
    </style>

</head>
<body>
    
    <div class="container">
        <h2>Récapitulatif des informations</h2>
        
        <!-- Photo -->
        <div class="photo-container">
            <h3>Photo</h3>
            <?php if (!empty($photoURL)): ?>
                <img src="<?= htmlspecialchars($photoURL) ?>" alt="Photo">
            <?php else: ?>
                <p class="no-data">Aucune photo téléchargée</p>
            <?php endif; ?>
        </div>

        <!-- Informations Personnelles -->
        <div class="section">
            <h3>Informations Personnelles</h3>
            <div class="info-row">
                <div class="info-label">Nom :</div>
                <div class="info-value"><?= $Nom ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Prénom :</div>
                <div class="info-value"><?= $prenom ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Email :</div>
                <div class="info-value"><?= $email ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Âge :</div>
                <div class="info-value"><?= $age ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Téléphone :</div>
                <div class="info-value"><?= $telephone ?></div>
            </div>
        </div>

        <!-- Informations Académiques -->
        <div class="section">
            <h3>Informations Académiques</h3>
            <div class="info-row">
                <div class="info-label">Filière :</div>
                <div class="info-value"><?= $filiere ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Année :</div>
                <div class="info-value"><?= $annee ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Modules suivis :</div>
                <div class="info-value">
                    <?php if (!empty($modules)): ?>
                        <div class="tags-container">
                            <?php foreach ($modules as $m): ?>
                                <span class="tag"><?= htmlspecialchars($m) ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <span class="no-data">Aucun module sélectionné</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="info-row">
                <div class="info-label">Nombre de projets :</div>
                <div class="info-value"><?= $nb_projets ?></div>
            </div>
        </div>

        <!-- Expériences -->
        <div class="section">
            <h3>Expériences et Compétences</h3>
            <div class="info-row">
                <div class="info-label">Stages :</div>
                <div class="info-value"><?= $stage ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Projets :</div>
                <div class="info-value"><?= $projets ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Centres d'intérêt :</div>
                <div class="info-value"><?= $centre_interets ?></div>
            </div>
            <div class="info-row">
                <div class="info-label">Langues :</div>
                <div class="info-value">
                    <?php if (!empty($langues)): ?>
                        <div class="tags-container">
                            <?php foreach ($langues as $l): ?>
                                <span class="tag"><?= htmlspecialchars($l) ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <span class="no-data">Aucune langue sélectionnée</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Boutons -->
        <div class="buttons-container">
            <!-- Bouton Valider -->
            <form method="post" style="flex: 1;">
                <input type="hidden" name="Nom" value="<?= $Nom ?>">
                <input type="hidden" name="Prenom" value="<?= $prenom ?>">
                <input type="hidden" name="Email" value="<?= $email ?>">
                <input type="hidden" name="Age" value="<?= $age ?>">
                <input type="hidden" name="telephone" value="<?= $telephone ?>">
                <input type="hidden" name="filiere" value="<?= $filiere ?>">
                <input type="hidden" name="Annee" value="<?= $annee ?>">
                <input type="hidden" name="nb_projets" value="<?= $nb_projets ?>">
                <input type="hidden" name="projets" value="<?= htmlspecialchars($_POST['projets'] ?? '') ?>">
                <input type="hidden" name="stages" value="<?= htmlspecialchars($_POST['stages'] ?? '') ?>">
                <input type="hidden" name="centre_interet" value="<?= htmlspecialchars($_POST['centre_interet'] ?? '') ?>">

                <?php foreach ($modules as $m): ?>
                    <input type="hidden" name="modules[]" value="<?= htmlspecialchars($m) ?>">
                <?php endforeach; ?>

                <?php foreach ($langues as $l): ?>
                    <input type="hidden" name="langues[]" value="<?= htmlspecialchars($l) ?>">
                <?php endforeach; ?>

                <button type="submit" name="action" value="valider" class="btn btn-valider" >Valider</button>
            </form><br>

            <!-- Bouton Modifier -->
            <form method="post" action="formulaire.php" style="flex: 1;">
                <input type="hidden" name="Nom" value="<?= $Nom ?>">
                <input type="hidden" name="Prenom" value="<?= $prenom ?>">
                <input type="hidden" name="Email" value="<?= $email ?>">
                <input type="hidden" name="Age" value="<?= $age ?>">
                <input type="hidden" name="telephone" value="<?= $telephone ?>">
                <input type="hidden" name="filiere" value="<?= $filiere ?>">
                <input type="hidden" name="Annee" value="<?= $annee ?>">
                <input type="hidden" name="nb_projets" value="<?= $nb_projets ?>">
                <input type="hidden" name="projets" value="<?= htmlspecialchars($_POST['projets'] ?? '') ?>">
                <input type="hidden" name="stages" value="<?= htmlspecialchars($_POST['stages'] ?? '') ?>">
                <input type="hidden" name="centre_interet" value="<?= htmlspecialchars($_POST['centre_interet'] ?? '') ?>">
                <input type="hidden" name="photo_path" value="<?= $photoURL ?? '' ?>">    

                <?php foreach ($modules as $m): ?>
                    <input type="hidden" name="modules[]" value="<?= htmlspecialchars($m) ?>">
                <?php endforeach; ?>
                
                <?php foreach ($langues as $l): ?>
                    <input type="hidden" name="langues[]" value="<?= htmlspecialchars($l) ?>">
                <?php endforeach; ?>

                <button type="submit" class="btn btn-modifier" >Modifier</button>
            </form><br>

            <!-- Bouton Générer PDF -->
            <form action="pdf.php" method="post" style="flex: 1;">
                <!-- Transmission de toutes les données vers pdf.php -->
                <input type="hidden" name="Nom" value="<?= htmlspecialchars($Nom) ?>">
                <input type="hidden" name="Prenom" value="<?= htmlspecialchars($prenom) ?>">
                <input type="hidden" name="Email" value="<?= htmlspecialchars($email) ?>">
                <input type="hidden" name="Age" value="<?= htmlspecialchars($age) ?>">
                <input type="hidden" name="telephone" value="<?= htmlspecialchars($telephone) ?>">
                <input type="hidden" name="filiere" value="<?= htmlspecialchars($filiere) ?>">
                <input type="hidden" name="Annee" value="<?= htmlspecialchars($annee) ?>">
                <input type="hidden" name="nb_projets" value="<?= htmlspecialchars($nb_projets) ?>">
                <input type="hidden" name="projets" value="<?= htmlspecialchars($_POST['projets'] ?? '') ?>">
                <input type="hidden" name="stages" value="<?= htmlspecialchars($_POST['stages'] ?? '') ?>">
                <input type="hidden" name="centre_interet" value="<?= htmlspecialchars($_POST['centre_interet'] ?? '') ?>">
                <input type="hidden" name="photo_path" value="<?= $photoURL ?? '' ?>">
                
                <!-- Transmission des tableaux (modules et langues) -->
                <?php if (!empty($modules)): ?>
                    <?php foreach ($modules as $m): ?>
                        <input type="hidden" name="modules[]" value="<?= htmlspecialchars($m) ?>">
                    <?php endforeach; ?>
                <?php endif; ?>
                
                <?php if (!empty($langues)): ?>
                    <?php foreach ($langues as $l): ?>
                        <input type="hidden" name="langues[]" value="<?= htmlspecialchars($l) ?>">
                    <?php endforeach; ?>
                <?php endif; ?>
                
                <button type="submit" name="action" value="generate_pdf" class="btn btn-pdf">Générer PDF</button>
            </form>
        </div>
    </div>
<!--
    <h2>Récapitulatif des informations :</h2>
    
    
    <h3>Photo :</h3>
    <?php if (!empty($photoURL)): ?>
        <img src="<?= htmlspecialchars($photoURL) ?>" alt="Photo" style="max-width:200px;">
    <?php else: ?>
        <p>Aucune photo téléchargée</p>
    <?php endif; ?>


    <p><strong>Nom :</strong> <?= $Nom ?></p>
    <p><strong>Prénom :</strong> <?= $prenom ?></p>
    <p><strong>Email :</strong> <?= $email ?></p>
    <p><strong>Âge :</strong> <?= $age ?></p>
    <p><strong>Telephone :</strong> <?= $telephone ?></p>
    <p><strong>Stage :</strong> <?= $stage ?></p>
    <p><strong>Projets :</strong> <?= $projets ?></p>
    <p><strong>Centre d'intérêts :</strong> <?= $centre_interets ?></p>
    <p><strong>Langues :</strong> 
    <?php 
        if (!empty($langues)) {
            echo implode(", ", array_map('htmlspecialchars', $langues));
        } else {
            echo "Aucune langue sélectionnée";
        }
    ?>

    <p><strong>Filière :</strong> <?= $filiere ?></p>
    <p><strong>Année :</strong> <?= $annee ?></p>

    <p><strong>Modules suivis :</strong> 
    <?php 
        if (!empty($modules)) {
            echo implode(", ", array_map('htmlspecialchars', $modules));
        } else {
            echo "Aucun module sélectionné";
        }
        ?>
  </p>
        

    <p><strong>Nombre de projets :</strong> <?= $nb_projets ?></p>

    -->

         <!-- Bouton Valider 
    <form method="post">
        <input type="hidden" name="Nom" value="<?= $Nom ?>">
        <input type="hidden" name="Prenom" value="<?= $prenom ?>">
        <input type="hidden" name="Email" value="<?= $email ?>">
        <input type="hidden" name="Age" value="<?= $age ?>">
        <input type="hidden" name="telephone" value="<?= $telephone ?>">
        <input type="hidden" name="filiere" value="<?= $filiere ?>">
        <input type="hidden" name="Annee" value="<?= $annee ?>">
        <input type="hidden" name="nb_projets" value="<?= $nb_projets ?>">
        <input type="hidden" name="projets" value="<?= htmlspecialchars($_POST['projets'] ?? '') ?>">
        <input type="hidden" name="stages" value="<?= htmlspecialchars($_POST['stages'] ?? '') ?>">
        <input type="hidden" name="centre_interet" value="<?= htmlspecialchars($_POST['centre_interet'] ?? '') ?>">

        <?php foreach ($modules as $m): ?>
            <input type="hidden" name="modules[]" value="<?= htmlspecialchars($m) ?>">
        <?php endforeach; ?>

        <?php foreach ($langues as $l): ?>
            <input type="hidden" name="langues[]" value="<?= htmlspecialchars($l) ?>">
        <?php endforeach; ?>

        <button type="submit" name="action" value="valider">Valider</button>
    </form><br>
        -->
    <!-- Bouton Modifier -->
     <!--
    <form method="post" action="formulaire.php">
        <input type="hidden" name="Nom" value="<?= $Nom ?>">
        <input type="hidden" name="Prenom" value="<?= $prenom ?>">
        <input type="hidden" name="Email" value="<?= $email ?>">
        <input type="hidden" name="Age" value="<?= $age ?>">
        <input type="hidden" name="telephone" value="<?= $telephone ?>">
        <input type="hidden" name="filiere" value="<?= $filiere ?>">
        <input type="hidden" name="Annee" value="<?= $annee ?>">
        <input type="hidden" name="nb_projets" value="<?= $nb_projets ?>">
        <input type="hidden" name="projets" value="<?= htmlspecialchars($_POST['projets'] ?? '') ?>">
        <input type="hidden" name="stages" value="<?= htmlspecialchars($_POST['stages'] ?? '') ?>">
        <input type="hidden" name="centre_interet" value="<?= htmlspecialchars($_POST['centre_interet'] ?? '') ?>">

        <?php foreach ($modules as $m): ?>
            <input type="hidden" name="modules[]" value="<?= htmlspecialchars($m) ?>">
        <?php endforeach; ?>
        
        <?php foreach ($langues as $l): ?>
            <input type="hidden" name="langues[]" value="<?= htmlspecialchars($l) ?>">
        <?php endforeach; ?>


        <button type="submit">Modifier</button>
    </form><br>
        -->
    <!-- Bouton Générer PDF 
    <form action="pdf.php" method="post">
        <button type="submit" name="action" value="generate_pdf">Générer PDF</button>
    </form>
        -->
        

</body>

</html>