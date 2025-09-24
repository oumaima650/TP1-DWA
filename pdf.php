<?php
// Inclusion de la bibliothèque FPDF pour la génération de PDF
require("fpdf186/fpdf.php");

//1-verification de la methode et de l'action
/* 
Vérification que la requête provient d'un formulaire POST
verifier que le bouton action est bien cliqué
verifier que c'est bien l'action generate_pdf qui est demandée 
  -> pour empecher l'acces direct au script sans formulaire
  -> Le PDF se génère avec des valeurs vides si un utilisateur tape directement dans son navigateur :  http://monsite.com/pdf.php
*/
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === "generate_pdf") {

//2-Récupération et sécurisation des données POST du formulaire
    //htmlspecialchars : convertit les caractères spéciaux en entités HTML
    //Si $_POST['...'] n'existe pas, remplir le champ avec une chaîne vide
    $nom = htmlspecialchars($_POST['Nom'] ?? '');
    $prenom = htmlspecialchars($_POST['Prenom'] ?? '');
    $email = htmlspecialchars($_POST['Email'] ?? '');
    $age = htmlspecialchars($_POST['Age'] ?? '');
    $telephone = htmlspecialchars($_POST['telephone'] ?? '');
    
    // Gestion des données textuelles longues (avec conversion des retours à la ligne)
    //strip_tags : supprime les balises HTML et PHP d'une chaîne avec des retours à la ligne conservés
    $stages = isset($_POST['stages']) ? strip_tags($_POST['stages']) : 'Non renseigné';
    $projets = isset($_POST['projets']) ? strip_tags($_POST['projets']) : 'Non renseigné';
    $centre_interets = isset($_POST['centre_interet']) ? strip_tags($_POST['centre_interet']) : 'Non renseigné';
    
    // Gestion des tableaux (langues et modules)
    $langues = isset($_POST['langues']) ? $_POST['langues'] : [];
    $modules = isset($_POST['modules']) ? $_POST['modules'] : [];
    
    // Données académiques
    $filiere = htmlspecialchars($_POST['filiere'] ?? 'Non renseigné');
    $annee = htmlspecialchars($_POST['Annee'] ?? 'Non renseigné');
    $nb_projets = htmlspecialchars($_POST['nb_projets'] ?? 'Non renseigné');

    // Gestion de la photo
    $photoPath = null;
    if (isset($_POST['photo_path']) && !empty($_POST['photo_path']) && file_exists($_POST['photo_path'])) {
        $photoPath = $_POST['photo_path'];
    }

//3-Création d'une nouvelle instance FPDF
    // 'P' = Portrait, 'mm' = millimètres, 'A4' = format A4
    $pdf = new FPDF('P', 'mm', 'A4');
    
    // Ajout d'une nouvelle page au document
    $pdf->AddPage();

     // Saut de page automatique avec marge de 10mm en bas
    $pdf->SetAutoPageBreak(true, 10);

    // === EN-TETE DU CV avec photo ===
    
    // Vérification et ajout de la photo si elle existe
    if ($photoPath && file_exists($photoPath)) {
        try {
            // Redimensionner l'image si elle est trop grande
            list($width, $height) = getimagesize($photoPath);
            $ratio = $width / $height;
            $newWidth = 40;
            $newHeight = $newWidth / $ratio;
            
            if ($newHeight > 50) {
                $newHeight = 50;
                $newWidth = $newHeight * $ratio;
            }
            
            $pdf->Image($photoPath, 150, 10, $newWidth, $newHeight);
        } catch (Exception $e) {
            // En cas d'erreur, on continue sans photo
            error_log("Erreur image PDF: " . $e->getMessage());
        }
    }

    // Définition de la police pour le titre principal (Times, Gras, 20pt)
    $pdf->SetFont('Times', 'B', 20);
    // Définition de la couleur du texte (bleu foncé)
    $pdf->SetTextColor(44, 62, 80);

    if ($photoPath && file_exists($photoPath)) {
        $pdf->Cell(130, 10, utf8_decode($prenom . ' ' . $nom), 0, 1, 'L');
        // Espace après la photo
        $pdf->SetY(70);
    } else {
        $pdf->Cell(0, 10, utf8_decode($prenom . ' ' . $nom), 0, 1, 'L');
        $pdf->Ln(5);
    }
/*
    // Ajout du titre centré avec un saut de ligne automatique 
    $pdf->Cell(0, 15, utf8_decode($prenom . ' ' . $nom), 0, 1, 'L');
    // Ajout d'un espace vertical
    $pdf->Ln(5);
*/
    // === FONCTION POUR CRÉER UNE SECTION ===
    // on a cree une fonction pour éviter la répétition de code pour chaque section
    function ajouterSection($pdf, $titre, $contenu) {
        // Titre de section (fond coloré)
        $pdf->SetFillColor(44, 62, 80); 
        $pdf->SetTextColor(255, 255, 255); // Texte blanc
        $pdf->SetFont('Times', 'B', 12);
        // Cellule avec fond coloré, largeur complète
        $pdf->Cell(0, 8, utf8_decode($titre), 0, 1, 'L', true);
        $pdf->Ln(3);
        
        // Contenu de la section
        $pdf->SetTextColor(0, 0, 0); // Retour au texte noir
        $pdf->SetFont('Times', '', 10);
        
        // Si le contenu est un tableau (pour langues/modules)
        if (is_array($contenu)) {
            $texte = !empty($contenu) ? implode(', ', $contenu) : 'Non renseigné';
            $pdf->MultiCell(0, 5, utf8_decode($texte));
        } else {
            // Pour le texte long, utilisation de MultiCell qui gère les retours à la ligne
            $pdf->MultiCell(0, 5, utf8_decode($contenu));
        }
        $pdf->Ln(5);
    }

    // === INFORMATIONS PERSONNELLES ===
    
    $pdf->SetFillColor(44, 62, 80);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(0, 8, 'INFORMATIONS PERSONNELLES', 0, 1, 'L', true);
    $pdf->Ln(3);
    
    // Retour au texte noir pour le contenu
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Times', '', 10);
    
    // Création d'un tableau d'informations personnelles
    $infos_perso = [
        'Age' => $age . ' ans',
        'Téléphone' => $telephone,
        'Email' => $email
    ];
    
    // Affichage de chaque information sur une ligne
    foreach ($infos_perso as $label => $value) {
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(40, 6, utf8_decode($label . ' :'), 0, 0, 'L');
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(0, 6, utf8_decode($value), 0, 1, 'L');
    }
    $pdf->Ln(5);

    // === FORMATION ACADÉMIQUE ===
    
    ajouterSection($pdf, 'FORMATION ACADÉMIQUE', '');
    
    // Informations académiques structurées
    $pdf->SetFont('Times', 'B', 10);
    $pdf->Cell(40, 6, utf8_decode('Filière :'), 0, 0, 'L');
    $pdf->SetFont('Times', '', 10);
    $pdf->Cell(0, 6, utf8_decode($filiere), 0, 1, 'L');

    $pdf->SetFont('Times', 'B', 10);
    $pdf->Cell(40, 6, utf8_decode('Année :'), 0, 0, 'L');
    $pdf->SetFont('Times', '', 10);
    $pdf->Cell(0, 6, utf8_decode($annee . 'ème année'), 0, 1, 'L');
    $pdf->Ln(3);

    // === MODULES ÉTUDIÉS ===
    if (!empty($modules)) {
        ajouterSection($pdf, 'MODULES ÉTUDIÉS', $modules);
    }

    // === PROJETS ===
    if ($nb_projets !== 'Non renseigné') {
        $pdf->SetFillColor(44, 62, 80);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(0, 8, 'PROJETS', 0, 1, 'L', true);
        $pdf->Ln(3);
        
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(0, 6, utf8_decode('Nombre de projets réalisés : ' . $nb_projets), 0, 1, 'L');
        
        if ($projets !== 'Non renseigné') {
            $pdf->SetFont('Times', '', 10);
            $pdf->MultiCell(0, 5, utf8_decode('Détails : ' . $projets));
        }
        $pdf->Ln(5);
    }

    // === EXPÉRIENCES (STAGES) ===
    if ($stages !== 'Non renseigné') {
        ajouterSection($pdf, 'EXPÉRIENCES PROFESSIONNELLES', $stages);
    }

    // === CENTRES D'INTÉRÊT ===
    if ($centre_interets !== 'Non renseigné') {
        ajouterSection($pdf, 'CENTRES D\'INTÉRÊT', $centre_interets);
    }

    // === LANGUES ===
    if (!empty($langues)) {
        ajouterSection($pdf, 'LANGUES', $langues);
    }

    // === PIED DE PAGE ===
    
    // Position à 15mm du bas de la page
    $pdf->SetY(-20);
    // Ligne de séparation
    $pdf->SetDrawColor(200, 200, 200);
    $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
    $pdf->Ln(3);
    // Texte du pied de page
    $pdf->SetFont('Times', 'I', 8);
    $pdf->SetTextColor(128, 128, 128);
    $pdf->Cell(0, 5, utf8_decode('CV généré automatiquement - ' . date('d/m/Y')), 0, 1, 'C');

    // === GÉNÉRATION ET ENVOI DU PDF ===
    
    // Nettoyage du buffer de sortie pour éviter les erreurs
    ob_clean();
    
    // Configuration des headers HTTP pour le téléchargement
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="CV_' . $prenom . '_' . $nom . '.pdf"');
    header('Cache-Control: private, max-age=0, must-revalidate');
    header('Pragma: public');
    
    // Sortie du PDF vers le navigateur
    $pdf->Output('I'); // 'I' = affichage inline dans le navigateur
    exit;
    
} else {
    // Redirection si accès direct au fichier sans données POST
    header('Location: formulaire.php');
    exit;
}

?>