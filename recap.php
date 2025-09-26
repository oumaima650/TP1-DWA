<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $Nom = htmlspecialchars($_POST['Nom']);
    $prenom = htmlspecialchars($_POST['Prenom']);
    $email = htmlspecialchars($_POST['Email']);
    $age = htmlspecialchars($_POST['Age']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $linkedin = htmlspecialchars($_POST['LinkedIn'] ?? '');

    $stage = isset($_POST['stages']) ? nl2br(htmlspecialchars($_POST['stages'])) : 'Non';
    $projets = isset($_POST['projets']) ? nl2br(htmlspecialchars($_POST['projets'])) : 'Non';
    $centre_interets = isset($_POST['centre_interet']) ? nl2br(htmlspecialchars($_POST['centre_interet'])) : 'Non';
    $competences = isset($_POST['competences']) ? nl2br(htmlspecialchars($_POST['competences'])) : 'Non renseigné';
    $langues = isset($_POST['langues']) ? $_POST['langues'] : [];
    $remarques = isset($_POST['remarques']) ? nl2br(htmlspecialchars($_POST['remarques'])) : 'Non renseigné';

    // Gestion du fichier joint
    $fichierURL = $_POST['fichier_path'] ?? null;

    if (isset($_FILES['fichier_joint']) && $_FILES['fichier_joint']['error'] === 0 && $_FILES['fichier_joint']['size'] > 0) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = basename($_FILES['fichier_joint']['name']);
        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['fichier_joint']['tmp_name'], $filePath)) {
            $fichierURL = $filePath; 
        }
    }

    // Gestion de l'image
    $photoURL = $_POST['photo_path'] ?? null; // Conserver la photo existante par défaut

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0 && $_FILES['photo']['size'] > 0) {
        // Nouvelle photo uploadée
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = basename($_FILES['photo']['name']);
        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $filePath)) {
            $photoURL = $filePath; 
        }
    }
    // Si aucune nouvelle photo n'est uploadée, $photoURL conserve l'ancienne valeur
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
    $contenu .= "LinkedIn : " . (!empty($linkedin) ? $linkedin : "Non renseigné") . "\n";
    $contenu .= "Filière : $filiere\n";
    $contenu .= "Année : $annee\n";
    $contenu .= "Modules : " . (!empty($modules) ? implode(", ", $modules) : "Aucun") . "\n";
    $contenu .= "Nombre de projets : $nb_projets\n";
    $contenu .= "Projets réalisés : " . (!empty($projets) ? strip_tags($projets) : "Non renseigné") . "\n";
    $contenu .= "Stages réalisés : " . (!empty($stage) ? strip_tags($stage) : "Non renseigné") . "\n";
    $contenu .= "Centres d'intérêt : " . (!empty($centre_interets) ? strip_tags($centre_interets) : "Non renseigné") . "\n";
    $contenu .= "Compétences : " . (!empty($competences) ? strip_tags($competences) : "Non renseigné") . "\n";
    $contenu .= "Langues : " . (!empty($langues) ? implode(", ", $langues) : "Aucune") . "\n";
    $contenu .= "Remarques : " . (!empty($remarques) ? strip_tags($remarques) : "Non renseigné") . "\n";
    $contenu .= "Fichier joint : " . (!empty($fichierURL) ? basename($fichierURL) : "Aucun") . "\n";

    // Forcer le téléchargement
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="informations.txt"');
    header('Content-Length: ' . strlen($contenu));

    echo $contenu;
    exit;
}

// ======= Début : insertion en BDD (AJOUTE ÇA ICI) =======
require_once 'db.php'; // inclure la connexion PDO (fichier créé précédemment)

// Normaliser / préparer les valeurs (les mêmes que dans le TXT)
$nom = $_POST['Nom'] ?? '';
$prenom = $_POST['Prenom'] ?? '';
$email = $_POST['Email'] ?? '';
$age = $_POST['Age'] ?? null;
$telephone = $_POST['telephone'] ?? '';
$filiere = $_POST['filiere'] ?? '';
$annee = $_POST['Annee'] ?? '';
$nb_projets = $_POST['nb_projets'] ?? '';
$projets_raw = $_POST['projets'] ?? '';
$stages_raw = $_POST['stages'] ?? '';
$centre_interet_raw = $_POST['centre_interet'] ?? '';
$modules = !empty($_POST['modules']) ? (array)$_POST['modules'] : [];
$langues = !empty($_POST['langues']) ? (array)$_POST['langues'] : [];
$competences = $_POST['competences'] ?? '';
$remarques = $_POST['remarques'] ?? '';
$fichier_for_db = $fichierURL ?? ($_POST['fichier_path'] ?? null);
$photo_for_db = $photoURL ?? ($_POST['photo_path'] ?? null);

// Convertir tableaux en CSV (pour stockage simple)
$modules_csv = !empty($modules) ? implode(',', $modules) : '';
$langues_csv = !empty($langues) ? implode(',', $langues) : '';

try {
    $sql = "INSERT INTO students
      (nom, prenom, age, telephone, email, filiere, annee, modules, nb_projets, projets, stages, centre_interet, langues, photo, fichier, competences, remarques)
      VALUES
      (:nom,:prenom,:age,:telephone,:email,:filiere,:annee,:modules,:nb_projets,:projets,:stages,:centre_interet,:langues,:photo,:fichier,:competences,:remarques)
      ON DUPLICATE KEY UPDATE
        nom=VALUES(nom), prenom=VALUES(prenom), age=VALUES(age),
        telephone=VALUES(telephone), filiere=VALUES(filiere),
        annee=VALUES(annee), modules=VALUES(modules),
        nb_projets=VALUES(nb_projets), projets=VALUES(projets),
        stages=VALUES(stages), centre_interet=VALUES(centre_interet),
        langues=VALUES(langues), photo=VALUES(photo),
        fichier=VALUES(fichier), competences=VALUES(competences),
        remarques=VALUES(remarques), updated_at=NOW()";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':age' => ($age !== '' ? (int)$age : null),
        ':telephone' => $telephone,
        ':email' => $email,
        ':filiere' => $filiere,
        ':annee' => $annee,
        ':modules' => $modules_csv,
        ':nb_projets' => $nb_projets,
        ':projets' => $projets_raw,
        ':stages' => $stages_raw,
        ':centre_interet' => $centre_interet_raw,
        ':langues' => $langues_csv,
        ':photo' => $photo_for_db,
        ':fichier' => $fichier_for_db,
        ':competences' => $competences,
        ':remarques' => $remarques
    ]);

} catch (Exception $e) {
    // En cas d'erreur, tu peux logger ou afficher (en dev)
    // file_put_contents('error_log.txt', $e->getMessage(), FILE_APPEND);
    // Ne pas bloquer l'utilisateur si la BDD échoue — on continue et on donne le .txt
}
// ======= Fin insertion en BDD =======
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
            <div>
                <div class="info-row">
                    <div class="info-label">LinkedIn :</div>
                    <div class="info-value">
                        <?php if (!empty($linkedin)): ?>
                            <?= htmlspecialchars($linkedin) ?>
                        <?php else: ?>
                            <span class="no-data">Non renseigné</span>
                        <?php endif; ?>
                    </div>
                </div>
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
                <div class="info-label">Compétences :</div>
                <div class="info-value"><?= $competences ?></div>
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
        <!-- Remarques -->
         <div class="section">
            <h3>Fichier joint et Remarques</h3>
            
            <div class="info-row">
                <div class="info-label">Fichier joint :</div>
                <div class="info-value">
                    <?php if (!empty($fichierURL)): ?>
                        <a href="<?= htmlspecialchars($fichierURL) ?>" target="_blank" class="tag">
                            📎 <?= basename($fichierURL) ?> 
                            (<?= round(filesize($fichierURL) / 1024, 2) ?> KB)
                        </a>
                    <?php else: ?>
                        <span class="no-data">Aucun fichier joint</span>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Remarques :</div>
                <div class="info-value"><?= $remarques ?></div>
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
                <input type="hidden" name="LinkedIn" value="<?= htmlspecialchars($linkedin) ?>">
                <input type="hidden" name="filiere" value="<?= $filiere ?>">
                <input type="hidden" name="Annee" value="<?= $annee ?>">
                <input type="hidden" name="nb_projets" value="<?= $nb_projets ?>">
                <input type="hidden" name="projets" value="<?= htmlspecialchars($_POST['projets'] ?? '') ?>">
                <input type="hidden" name="stages" value="<?= htmlspecialchars($_POST['stages'] ?? '') ?>">
                <input type="hidden" name="centre_interet" value="<?= htmlspecialchars($_POST['centre_interet'] ?? '') ?>">
                <input type="hidden" name="competences" value="<?= htmlspecialchars($_POST['competences'] ?? '') ?>">
                <input type="hidden" name="remarques" value="<?= htmlspecialchars($_POST['remarques'] ?? '') ?>">
                <input type="hidden" name="fichier_path" value="<?= $fichierURL ?? '' ?>">

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
                <input type="hidden" name="LinkedIn" value="<?= htmlspecialchars($linkedin) ?>">
                <input type="hidden" name="filiere" value="<?= $filiere ?>">
                <input type="hidden" name="Annee" value="<?= $annee ?>">
                <input type="hidden" name="nb_projets" value="<?= $nb_projets ?>">
                <input type="hidden" name="projets" value="<?= htmlspecialchars($_POST['projets'] ?? '') ?>">
                <input type="hidden" name="stages" value="<?= htmlspecialchars($_POST['stages'] ?? '') ?>">
                <input type="hidden" name="centre_interet" value="<?= htmlspecialchars($_POST['centre_interet'] ?? '') ?>">
                <input type="hidden" name="photo_path" value="<?= $photoURL ?? '' ?>"> 
                <input type="hidden" name="competences" value="<?= htmlspecialchars($_POST['competences'] ?? '') ?>">
                <input type="hidden" name="remarques" value="<?= htmlspecialchars($_POST['remarques'] ?? '') ?>">
                <input type="hidden" name="fichier_path" value="<?= $fichierURL ?? '' ?>">   

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
                <input type="hidden" name="LinkedIn" value="<?= htmlspecialchars($linkedin) ?>">
                <input type="hidden" name="filiere" value="<?= htmlspecialchars($filiere) ?>">
                <input type="hidden" name="Annee" value="<?= htmlspecialchars($annee) ?>">
                <input type="hidden" name="nb_projets" value="<?= htmlspecialchars($nb_projets) ?>">
                <input type="hidden" name="projets" value="<?= htmlspecialchars($_POST['projets'] ?? '') ?>">
                <input type="hidden" name="stages" value="<?= htmlspecialchars($_POST['stages'] ?? '') ?>">
                <input type="hidden" name="centre_interet" value="<?= htmlspecialchars($_POST['centre_interet'] ?? '') ?>">
                <input type="hidden" name="photo_path" value="<?= $photoURL ?? '' ?>">
                <input type="hidden" name="competences" value="<?= htmlspecialchars($_POST['competences'] ?? '') ?>">
                <input type="hidden" name="remarques" value="<?= htmlspecialchars($_POST['remarques'] ?? '') ?>">
                <input type="hidden" name="fichier_path" value="<?= $fichierURL ?? '' ?>">
                
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
        

</body>

</html>