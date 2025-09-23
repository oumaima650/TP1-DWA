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
</head>
<body>
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



         <!-- Bouton Valider -->
    <form method="post">
        <!-- On renvoie toutes les infos cachées -->
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
    </form>

    <!-- Bouton Modifier -->
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
    </form>



</body>

</html>