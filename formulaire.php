<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fiche de Renseignement</title>
  <style>
    body{
      display : flex;
      justify-content : center;
      align-items: center;
      margin: 0;
      padding: 0;
    }
    h2{
      text-align : center;
      margin-top: 20px; 
    }
    form{
      width: 500px;
      margin-top: 20px auto;
    }
    fieldset{
      margin-bottom: 15 px;
      padding: 15px;
    }
    legend{
      text-align: center;
    }
    h2{
      text-align : center;
      margin-top: 20px; 
    }
    .form-group {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .form-group label {
      width: 150px; 
      font-weight: bold;
    }

    .form-group input {
      flex: 1;
      padding: 5px;
    }
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

    fieldset {
      background: #f8f9fa;
      padding: 20px;
      border-radius: 6px;
      margin-bottom: 20px;
      border-left: 4px solid #3498db;
      border: 1px solid #ddd;
    }

    legend {
      color: #2c3e50;
      font-weight: bold;
      padding: 0 10px;
      font-size: 1.1em;
    }

    .form-group {
      display: flex;
      align-items: flex-start;
      margin-bottom: 15px;
      padding: 10px 0;
    }

    .form-group label {
      width: 200px;
      font-weight: bold;
      color: #2c3e50;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="tel"],
    .form-group input[type="url"],
    .form-group input[type="file"],
    .form-group select,
    .form-group textarea {
      flex: 1;
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 14px;
    }
    .checkbox-item {
    display: flex;
    align-items: center;
    gap: 5px;
    margin: 5px 0;
    }

    .form-group textarea {
      height: 100px;
      resize: vertical;
    }

    .checkbox-group {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      margin: 10px 0;
    }

    .checkbox-item {
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .radio-group {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      margin: 10px 0;
    }

    .radio-item {
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .photo-preview {
      text-align: center;
      margin: 10px 0;
    }

    .photo-preview img {
      border: 3px solid #bdc3c7;
      border-radius: 6px;
      max-width: 150px;
    }

    .file-preview {
      margin: 10px 0;
      padding: 10px;
      background: #ecf0f1;
      border-radius: 4px;
    }

    .submit-btn {
      background-color: #3498db;
      color: white;
      padding: 12px 30px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
      display: block;
      margin: 30px auto 0;
      width: 200px;
    }

    .submit-btn:hover {
      background-color: #2980b9;
    }

    .section-title {
      color: #34495e;
      margin: 20px 0 10px 0;
      font-size: 1.1em;
      border-left: 4px solid #3498db;
      padding-left: 10px;
    }

    @media (max-width: 768px) {
      .container {
        padding: 20px;
      }
      
      .form-group {
        flex-direction: column;
        align-items: flex-start;
      }
      
      .form-group label {
        width: 100%;
        margin-bottom: 5px;
      }
      
      .checkbox-group,
      .radio-group {
        flex-direction: column;
        gap: 10px;
      }
      
      .submit-btn {
        width: 100%;
      }
    }
  </style>

  <script>
  function updateModules() {
      const filiere = document.querySelector('input[name="filiere"]:checked')?.value;
      const annee = document.querySelector('input[name="Annee"]:checked')?.value;
      
      // Masquer tous les modules d'abord
      const allModules = document.querySelectorAll('input[name="modules[]"]');
      allModules.forEach(module => {
          module.parentElement.style.display = 'none';
      });
      
      // Afficher les modules selon la filière et l'année
      if (filiere && annee) {
          let modulesToShow = [];
          
          if (filiere === '2AP') {
              if (annee === '1') {
                  modulesToShow = ['analyse 1', 'algebre 1', 'Mecanique1', 'phsyique 1', 'info 1'];
              } else if (annee === '2') {
                  modulesToShow = [ 'analyse 2','algebre 2','Mecanique 2','phsyique 2','info 2'];
              }

          } else if (filiere === 'gstr') {
              if (annee === '1') {
                  modulesToShow = ['Base de données relationnelle', 'Electronique numérique ', 'Réseaux informatiques 1' , 'Machine learning' , 'Traitement de signal'];
              } else if (annee === '2') {
                  modulesToShow = ['Reseau informatique avance', 'Traitement Numerqiue', 'Administration des BD', 'Technologie de Reseau mobile', 'Apprentissage Profond'];
              } else if (annee === '3') {
                  modulesToShow = [ 'Réseaux mobile et sans fils','Sécurité réseaux','Systèmes Embarqués et Java mobile','Ingénieurie spacial','Système de communication numérique'];
              }

          } else if (filiere === 'gi') {
              if (annee === '1') {
                  modulesToShow = ['Java','MOO','Web','architecture des ordinateurs','Théorie des graphes'];
              } else if (annee === '2') {
                  modulesToShow = ['Réseaux informatiques','.NET','Génie logiciel','Développement Web','Administration des BD'];
              } else if (annee === '3') {
                  modulesToShow = ['Programmation des Systèmes',
                    'Système d\'intégration et progiciel',
                    'Technologie d\'Entreprise',
                    'Système d\'Information Urba et Audit',
                    'Business Intelligence'];
              }

          } else if (filiere === 'scm') {
              if (annee === '1') {
                  modulesToShow = ['Théorie des graphes', 'Statistiques', 'Gestion de la production' , 'Base de données relationnelle' , 'Théorie des organisations et IT management'];
              } else if (annee === '2') {
                  modulesToShow = ['Gestion de la mainteanance', 'Ordonnancement de la production', 'Management de la chaine logistique', 'Entreposage et gestion des stocks', 'Simulation des systeme Industriels'];
              } else if (annee === '3') {
                  modulesToShow = ['LDT',
                    'Logistique Pfa',
                    'Exellence industrielle',
                    'SI en SCM',
                    'Management'];
              }

          } else if (filiere === 'gc') {
              if (annee === '1') {
                  modulesToShow = ['RDM1', 'Sciences des matériaux', 'Mécanique des solides déformable', 'Methodes numériques pour le gc', 'Lecture des plans'];
              } else if (annee === '2') {
                  modulesToShow = ['Routes', 'RDM', 'Materiaux de construction', 'Hydrologie', 'Mecanique du sols'];
              } else if (annee === '3') {
                  modulesToShow = ['Thermiques et acoustique des bâtiments',
                    'Bèton précontraint',
                    'Conduite de projet BTP',
                    'Dynamique des structures',
                    'Construction durable'];
              }

          } else if (filiere === 'gm') {
              if (annee === '1') {
                  modulesToShow = ['Traitement du signal' , 'Réseaux électroniques et informatiques', 'Statistiques', 'Electronique analogique et numérique', 'Base de données relationnelle'];
              } else if (annee === '2') {
                  modulesToShow = ['Système Automatique et Électronique', 'Productique et CFAO', 'Électrotechnique', 'Théorie de mécanisme et Robotique', 'Maths et méthodes Numériques'];
              } else if (annee === '3') {
                  modulesToShow = ['Outils pour gestion de la Production',
                    'Supervision et Réseaux',
                    'Qualité et maintenance',
                    'Systèmes Mécatroniques',
                    'Systèmes Embarqués et prototypages'];
              }
          }
          
          // Afficher les modules correspondants
          modulesToShow.forEach(moduleName => {
              const moduleInput = document.querySelector(`input[name="modules[]"][value="${moduleName}"]`);
              if (moduleInput) {
                  moduleInput.parentElement.style.display = 'flex';
              }
          });
      }
  }

  // Écouter les changements sur les boutons radio
  document.addEventListener('DOMContentLoaded', function() {
      const filiereRadios = document.querySelectorAll('input[name="filiere"]');
      const anneeRadios = document.querySelectorAll('input[name="Annee"]');
      
      filiereRadios.forEach(radio => {
          radio.addEventListener('change', updateModules);
      });
      
      anneeRadios.forEach(radio => {
          radio.addEventListener('change', updateModules);
      });
      
      // Mettre à jour au chargement si des valeurs sont déjà sélectionnées
      updateModules();
  });
  </script>
</head>

<body>


<form action="recap.php" method="post" enctype="multipart/form-data">

<h2>Fiche de Renseignements</h2>
<br>

<fieldset>
  <legend> Renseignements Personnels</legend>

  
  <!-- Photo -->
  <div class="form-group">

    <label>Photo :</label>
    <div style="flex: 1;">
        <?php
        $photoActuelle = $_POST['photo_path'] ?? '';
        if (!empty($photoActuelle) && file_exists($photoActuelle)) {
            echo '<div style="margin-bottom: 10px;">';
            echo '<img src="' . htmlspecialchars($photoActuelle) . '" alt="Photo actuelle" style="max-width: 100px; border: 1px solid #ccc;">';
            echo '<br><small>Photo actuelle : ' . basename($photoActuelle) . '</small>';
            echo '</div>';
        }
        ?>
        <input type="file" name="photo" accept="image/*">
        <input type="hidden" name="photo_path" value="<?= htmlspecialchars($photoActuelle) ?>">
    </div>
  </div>
  <br>

  <div class="form-group">
  <label for="Nom">Nom :</label>
  <input type="text" name="Nom" id="Nom" placeholder="Nom" value="<?= isset($_POST['Nom']) ? htmlspecialchars($_POST['Nom']) : '' ?>">
  </div>
  <br>

  <div class="form-group">
  <label for="Prénom">Prénom :</label>
  <input type="text" name="Prenom" id="Prénom" placeholder="Prénom" value="<?= isset($_POST['Prenom']) ? htmlspecialchars($_POST['Prenom']) : '' ?>">
  </div>
  <br>

  <div class="form-group">
  <label for="Age">Age :</label>
  <input type="text" name="Age" id="Age" placeholder="Age" value="<?= isset($_POST['Age']) ? htmlspecialchars($_POST['Age']) : '' ?>">
  </div>
  <br>

  <div class="form-group">
  <label for="Numéro Téléphone :">Numéro Téléphone :</label>
  <input type="tel" name="telephone" id="telephone" placeholder="Numéro Téléphone" value="<?= isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : '' ?>">
  </div>

  <br>
  <div class="form-group">
  <label for="Email">Email :</label>
  <input type="Email" name="Email" id="Email" placeholder="Email" value="<?= isset($_POST['Email']) ? htmlspecialchars($_POST['Email']) : '' ?>">
  </div>
   <br>

  <div class="form-group">
  <label for="LinkedIn">LinkedIn :</label>
  <input type="text" name="LinkedIn" id="LinkedIn" placeholder="LinkedIn" value="<?= isset($_POST['LinkedIn']) ? htmlspecialchars($_POST['LinkedIn']) : '' ?>">
  </div>

</fieldset>
<br><br>


<fieldset>
<legend>Renseignements Acadimique</legend>

<label for="Filiere"> Vous etes en :</label>
<br><br>


<label for="2ap"> 2AP: </label>
<input type="radio" id="2ap" name="filiere" value="2AP" <?= (isset($_POST['filiere']) && $_POST['filiere']=="2AP") ? 'checked' : '' ?>>



<label for="gstr"> | GSTR: </label>
<input type="radio" id="gstr" name="filiere" value="gstr" <?= (isset($_POST['filiere']) && $_POST['filiere']=="gstr") ? 'checked' : '' ?> >



<label for="gi"> | GI: </label>
<input type="radio" id="gi" name="filiere" value="gi" <?= (isset($_POST['filiere']) && $_POST['filiere']=="gi") ? 'checked' : '' ?>>



<label for="scm"> | SCM: </label>
<input type="radio" id="scm" name="filiere" value="scm" <?= (isset($_POST['filiere']) && $_POST['filiere']=="scm") ? 'checked' : '' ?>>



<label for="gc"> | GC: </label>
<input type="radio" id="gc" name="filiere" value="gc" <?= (isset($_POST['filiere']) && $_POST['filiere']=="gc") ? 'checked' : '' ?>>



<label for="gm"> | GM: </label>
<input type="radio" id="gm" name="filiere" value="gm" <?= (isset($_POST['filiere']) && $_POST['filiere']=="gm") ? 'checked' : '' ?>>


<br><br>

<label for="1er"> 1er annee: </label>
<input type="radio" id="1er" name="Annee" value="1" <?= (isset($_POST['Annee']) && $_POST['Annee']=="1") ? 'checked' : '' ?>>

<label for="2eme"> | 2eme annees: </label>
<input type="radio" id="2eme" name="Annee" value="2" <?= (isset($_POST['Annee']) && $_POST['Annee']=="2") ? 'checked' : '' ?>>

<label for="3eme"> | 3eme annees: </label>
<input type="radio" id="3eme" name="Annee" value="3" <?= (isset($_POST['Annee']) && $_POST['Annee']=="3") ? 'checked' : '' ?>>

<br><br>

<label>Modules suivis cette année :</label>
<br>

<div id="modules-container" class="checkbox-group">
    <!-- Modules pour 2AP -->
    <div class="checkbox-item">
        <input type="checkbox" id="analyse 1" name="modules[]" value="analyse 1" <?= (isset($_POST['modules']) && in_array("analyse 1", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="analyse 1">Analyse 1</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="algebre 1" name="modules[]" value="algebre 1" <?= (isset($_POST['modules']) && in_array("algebre 1", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="algebre 1">Algèbre 1</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Mecanique1" name="modules[]" value="Mecanique1" <?= (isset($_POST['modules']) && in_array("Mecanique1", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Mecanique1">Mécanique 1</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="phsyique 1" name="modules[]" value="phsyique 1" <?= (isset($_POST['modules']) && in_array("phsyique 1", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="phsyique 1">Physique 1</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="info 1" name="modules[]" value="info 1" <?= (isset($_POST['modules']) && in_array("info 1", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="info 1">Info 1</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="analyse 2" name="modules[]" value="analyse 2" <?= (isset($_POST['modules']) && in_array("analyse 2", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="analyse 2">Analyse 2</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="algebre 2" name="modules[]" value="algebre 2" <?= (isset($_POST['modules']) && in_array("algebre 2", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="algebre 2">Algèbre 2</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Mecanique 2" name="modules[]" value="Mecanique 2" <?= (isset($_POST['modules']) && in_array("Mecanique 2", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Mecanique 2">Mécanique 2</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="phsyique 2" name="modules[]" value="phsyique 2" <?= (isset($_POST['modules']) && in_array("phsyique 2", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="phsyique 2">Physique 2</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="info 2" name="modules[]" value="info 2" <?= (isset($_POST['modules']) && in_array("info 2", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="info 2">Info 2</label>
    </div>

    <!-- Modules pour GSTR -->
    <div class="checkbox-item">
        <input type="checkbox" id="Base de données relationnelle" name="modules[]" value="Base de données relationnelle" <?= (isset($_POST['modules']) && in_array("Base de données relationnelle", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Base de données relationnelle">Base de données relationnelle</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Electronique numérique" name="modules[]" value="Electronique numérique" <?= (isset($_POST['modules']) && in_array("Electronique numérique", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Electronique numérique">Électronique numérique</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Réseaux informatiques 1" name="modules[]" value="Réseaux informatiques 1" <?= (isset($_POST['modules']) && in_array("Réseaux informatiques 1", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Réseaux informatiques 1">Réseaux informatiques 1</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Machine learning" name="modules[]" value="Machine learning" <?= (isset($_POST['modules']) && in_array("Machine learning", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Machine learning">Machine Learning</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Traitement de signal" name="modules[]" value="Traitement de signal" <?= (isset($_POST['modules']) && in_array("Traitement de signal", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Traitement de signal">Traitement de signal</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Reseau informatique avance" name="modules[]" value="Reseau informatique avance" <?= (isset($_POST['modules']) && in_array("Reseau informatique avance", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Reseau informatique avance">Réseau informatique avancé</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Traitement Numerique" name="modules[]" value="Traitement Numerique" <?= (isset($_POST['modules']) && in_array("Traitement Numerique", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Traitement Numerique">Traitement Numérique</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Administration des BD" name="modules[]" value="Administration des BD" <?= (isset($_POST['modules']) && in_array("Administration des BD", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Administration des BD">Administration des BD</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Technologie de Reseau mobile" name="modules[]" value="Technologie de Reseau mobile" <?= (isset($_POST['modules']) && in_array("Technologie de Reseau mobile", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Technologie de Reseau mobile">Technologie de Réseau mobile</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Apprentissage Profond" name="modules[]" value="Apprentissage Profond" <?= (isset($_POST['modules']) && in_array("Apprentissage Profond", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Apprentissage Profond">Apprentissage Profond</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Réseaux mobile et sans fils" name="modules[]" value="Réseaux mobile et sans fils" <?= (isset($_POST['modules']) && in_array("Réseaux mobile et sans fils", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Réseaux mobile et sans fils">Réseaux mobile et sans fils</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Sécurité réseaux" name="modules[]" value="Sécurité réseaux" <?= (isset($_POST['modules']) && in_array("Sécurité réseaux", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Sécurité réseaux">Sécurité réseaux</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Systèmes Embarqués et Java mobile" name="modules[]" value="Systèmes Embarqués et Java mobile" <?= (isset($_POST['modules']) && in_array("Systèmes Embarqués et Java mobile", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Systèmes Embarqués et Java mobile">Systèmes Embarqués et Java mobile</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Ingénieurie spacial" name="modules[]" value="Ingénieurie spacial" <?= (isset($_POST['modules']) && in_array("Ingénieurie spacial", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Ingénieurie spacial">Ingénierie spatiale</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Système de communication numérique" name="modules[]" value="Système de communication numérique" <?= (isset($_POST['modules']) && in_array("Système de communication numérique", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Système de communication numérique">Système de communication numérique</label>
    </div>

    <!-- Modules pour GI -->
    <div class="checkbox-item">
        <input type="checkbox" id="Java" name="modules[]" value="Java" <?= (isset($_POST['modules']) && in_array("Java", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Java">Java</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="MOO" name="modules[]" value="MOO" <?= (isset($_POST['modules']) && in_array("MOO", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="MOO">MOO</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Web" name="modules[]" value="Web" <?= (isset($_POST['modules']) && in_array("Web", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Web">Web</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="architecture des ordinateurs" name="modules[]" value="architecture des ordinateurs" <?= (isset($_POST['modules']) && in_array("architecture des ordinateurs", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="architecture des ordinateurs">Architecture des ordinateurs</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Théorie des graphes" name="modules[]" value="Théorie des graphes" <?= (isset($_POST['modules']) && in_array("Théorie des graphes", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Théorie des graphes">Théorie des graphes</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Réseaux informatiques" name="modules[]" value="Réseaux informatiques" <?= (isset($_POST['modules']) && in_array("Réseaux informatiques", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Réseaux informatiques">Réseaux informatiques</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id=".NET" name="modules[]" value=".NET" <?= (isset($_POST['modules']) && in_array(".NET", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for=".NET">.NET</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Génie logiciel" name="modules[]" value="Génie logiciel" <?= (isset($_POST['modules']) && in_array("Génie logiciel", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Génie logiciel">Génie logiciel</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Développement Web" name="modules[]" value="Développement Web" <?= (isset($_POST['modules']) && in_array("Développement Web", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Développement Web">Développement Web</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Programmation des Systèmes" name="modules[]" value="Programmation des Systèmes" <?= (isset($_POST['modules']) && in_array("Programmation des Systèmes", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Programmation des Systèmes">Programmation des Systèmes</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Système d'intégration et progiciel" name="modules[]" value="Système d'intégration et progiciel" <?= (isset($_POST['modules']) && in_array("Système d'intégration et progiciel", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Système d'intégration et progiciel">Système d'intégration et progiciel</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Technologie d'Entreprise" name="modules[]" value="Technologie d'Entreprise" <?= (isset($_POST['modules']) && in_array("Technologie d'Entreprise", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Technologie d'Entreprise">Technologie d'Entreprise</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Système d'Information Urba et Audit" name="modules[]" value="Système d'Information Urba et Audit" <?= (isset($_POST['modules']) && in_array("Système d'Information Urba et Audit", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Système d'Information Urba et Audit">Système d'Information Urba et Audit</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Business Intelligence" name="modules[]" value="Business Intelligence" <?= (isset($_POST['modules']) && in_array("Business Intelligence", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Business Intelligence">Business Intelligence</label>
    </div>

    <!-- Modules pour SCM -->
    <div class="checkbox-item">
        <input type="checkbox" id="Statistiques" name="modules[]" value="Statistiques" <?= (isset($_POST['modules']) && in_array("Statistiques", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Statistiques">Statistiques</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Gestion de la production" name="modules[]" value="Gestion de la production" <?= (isset($_POST['modules']) && in_array("Gestion de la production", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Gestion de la production">Gestion de la production</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Théorie des organisations et IT management" name="modules[]" value="Théorie des organisations et IT management" <?= (isset($_POST['modules']) && in_array("Théorie des organisations et IT management", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Théorie des organisations et IT management">Théorie des organisations et IT management</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Gestion de la mainteanance" name="modules[]" value="Gestion de la mainteanance" <?= (isset($_POST['modules']) && in_array("Gestion de la mainteanance", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Gestion de la mainteanance">Gestion de la maintenance</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Ordonnancement de la production" name="modules[]" value="Ordonnancement de la production" <?= (isset($_POST['modules']) && in_array("Ordonnancement de la production", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Ordonnancement de la production">Ordonnancement de la production</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Management de la chaine logistique" name="modules[]" value="Management de la chaine logistique" <?= (isset($_POST['modules']) && in_array("Management de la chaine logistique", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Management de la chaine logistique">Management de la chaine logistique</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Entreposage et gestion des stocks" name="modules[]" value="Entreposage et gestion des stocks" <?= (isset($_POST['modules']) && in_array("Entreposage et gestion des stocks", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Entreposage et gestion des stocks">Entreposage et gestion des stocks</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Simulation des systeme Industriels" name="modules[]" value="Simulation des systeme Industriels" <?= (isset($_POST['modules']) && in_array("Simulation des systeme Industriels", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Simulation des systeme Industriels">Simulation des systèmes Industriels</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="LDT" name="modules[]" value="LDT" <?= (isset($_POST['modules']) && in_array("LDT", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="LDT">LDT</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Logistique Pfa" name="modules[]" value="Logistique Pfa" <?= (isset($_POST['modules']) && in_array("Logistique Pfa", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Logistique Pfa">Logistique Pfa</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Exellence industrielle" name="modules[]" value="Exellence industrielle" <?= (isset($_POST['modules']) && in_array("Exellence industrielle", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Exellence industrielle">Excellence industrielle</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="SI en SCM" name="modules[]" value="SI en SCM" <?= (isset($_POST['modules']) && in_array("SI en SCM", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="SI en SCM">SI en SCM</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Management" name="modules[]" value="Management" <?= (isset($_POST['modules']) && in_array("Management", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Management">Management</label>
    </div>

    <!-- Modules pour GC -->
    <div class="checkbox-item">
        <input type="checkbox" id="RDM1" name="modules[]" value="RDM1" <?= (isset($_POST['modules']) && in_array("RDM1", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="RDM1">RDM1</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Sciences des matériaux" name="modules[]" value="Sciences des matériaux" <?= (isset($_POST['modules']) && in_array("Sciences des matériaux", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Sciences des matériaux">Sciences des matériaux</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Mécanique des solides déformable" name="modules[]" value="Mécanique des solides déformable" <?= (isset($_POST['modules']) && in_array("Mécanique des solides déformable", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Mécanique des solides déformable">Mécanique des solides déformable</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Methodes numériques pour le gc" name="modules[]" value="Methodes numériques pour le gc" <?= (isset($_POST['modules']) && in_array("Methodes numériques pour le gc", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Methodes numériques pour le gc">Méthodes numériques pour le GC</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Lecture des plans" name="modules[]" value="Lecture des plans" <?= (isset($_POST['modules']) && in_array("Lecture des plans", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Lecture des plans">Lecture des plans</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Routes" name="modules[]" value="Routes" <?= (isset($_POST['modules']) && in_array("Routes", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Routes">Routes</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="RDM" name="modules[]" value="RDM" <?= (isset($_POST['modules']) && in_array("RDM", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="RDM">RDM</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Materiaux de construction" name="modules[]" value="Materiaux de construction" <?= (isset($_POST['modules']) && in_array("Materiaux de construction", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Materiaux de construction">Matériaux de construction</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Hydrologie" name="modules[]" value="Hydrologie" <?= (isset($_POST['modules']) && in_array("Hydrologie", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Hydrologie">Hydrologie</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Mecanique du sols" name="modules[]" value="Mecanique du sols" <?= (isset($_POST['modules']) && in_array("Mecanique du sols", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Mecanique du sols">Mécanique des sols</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Thermiques et acoustique des bâtiments" name="modules[]" value="Thermiques et acoustique des bâtiments" <?= (isset($_POST['modules']) && in_array("Thermiques et acoustique des bâtiments", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Thermiques et acoustique des bâtiments">Thermiques et acoustique des bâtiments</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Bèton précontraint" name="modules[]" value="Bèton précontraint" <?= (isset($_POST['modules']) && in_array("Bèton précontraint", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Bèton précontraint">Béton précontraint</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Conduite de projet BTP" name="modules[]" value="Conduite de projet BTP" <?= (isset($_POST['modules']) && in_array("Conduite de projet BTP", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Conduite de projet BTP">Conduite de projet BTP</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Dynamique des structures" name="modules[]" value="Dynamique des structures" <?= (isset($_POST['modules']) && in_array("Dynamique des structures", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Dynamique des structures">Dynamique des structures</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Construction durable" name="modules[]" value="Construction durable" <?= (isset($_POST['modules']) && in_array("Construction durable", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Construction durable">Construction durable</label>
    </div>

    <!-- Modules pour GM -->
    <div class="checkbox-item">
        <input type="checkbox" id="Traitement du signal" name="modules[]" value="Traitement du signal" <?= (isset($_POST['modules']) && in_array("Traitement du signal", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Traitement du signal">Traitement du signal</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Réseaux électroniques et informatiques" name="modules[]" value="Réseaux électroniques et informatiques" <?= (isset($_POST['modules']) && in_array("Réseaux électroniques et informatiques", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Réseaux électroniques et informatiques">Réseaux électroniques et informatiques</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Electronique analogique et numérique" name="modules[]" value="Electronique analogique et numérique" <?= (isset($_POST['modules']) && in_array("Electronique analogique et numérique", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Electronique analogique et numérique">Électronique analogique et numérique</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Système Automatique et Électronique" name="modules[]" value="Système Automatique et Électronique" <?= (isset($_POST['modules']) && in_array("Système Automatique et Électronique", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Système Automatique et Électronique">Système Automatique et Électronique</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Productique et CFAO" name="modules[]" value="Productique et CFAO" <?= (isset($_POST['modules']) && in_array("Productique et CFAO", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Productique et CFAO">Productique et CFAO</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Électrotechnique" name="modules[]" value="Électrotechnique" <?= (isset($_POST['modules']) && in_array("Électrotechnique", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Électrotechnique">Électrotechnique</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Théorie de mécanisme et Robotique" name="modules[]" value="Théorie de mécanisme et Robotique" <?= (isset($_POST['modules']) && in_array("Théorie de mécanisme et Robotique", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Théorie de mécanisme et Robotique">Théorie de mécanisme et Robotique</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Maths et méthodes Numériques" name="modules[]" value="Maths et méthodes Numériques" <?= (isset($_POST['modules']) && in_array("Maths et méthodes Numériques", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Maths et méthodes Numériques">Maths et méthodes Numériques</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Outils pour gestion de la Production" name="modules[]" value="Outils pour gestion de la Production" <?= (isset($_POST['modules']) && in_array("Outils pour gestion de la Production", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Outils pour gestion de la Production">Outils pour gestion de la Production</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Supervision et Réseaux" name="modules[]" value="Supervision et Réseaux" <?= (isset($_POST['modules']) && in_array("Supervision et Réseaux", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Supervision et Réseaux">Supervision et Réseaux</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Qualité et maintenance" name="modules[]" value="Qualité et maintenance" <?= (isset($_POST['modules']) && in_array("Qualité et maintenance", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Qualité et maintenance">Qualité et maintenance</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Systèmes Mécatroniques" name="modules[]" value="Systèmes Mécatroniques" <?= (isset($_POST['modules']) && in_array("Systèmes Mécatroniques", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Systèmes Mécatroniques">Systèmes Mécatroniques</label>
    </div>
    <div class="checkbox-item">
        <input type="checkbox" id="Systèmes Embarqués et prototypages" name="modules[]" value="Systèmes Embarqués et prototypages" <?= (isset($_POST['modules']) && in_array("Systèmes Embarqués et prototypages", $_POST['modules'])) ? 'checked' : '' ?>>
        <label for="Systèmes Embarqués et prototypages">Systèmes Embarqués et prototypages</label>
    </div>
</div>

<br>

  <label for="nb_projets">Nombre de projets réalisés cette année: </label>
  <select id="nb_projets" name="nb_projets">
  <option value="">--</option>
  <option value="1" <?= (isset($_POST['nb_projets']) && $_POST['nb_projets']=="1") ? 'selected' : '' ?>>1</option>
  <option value="2" <?= (isset($_POST['nb_projets']) && $_POST['nb_projets']=="2") ? 'selected' : '' ?>>2</option>
  <option value="3" <?= (isset($_POST['nb_projets']) && $_POST['nb_projets']=="3") ? 'selected' : '' ?>>3</option>
  <option value="4" <?= (isset($_POST['nb_projets']) && $_POST['nb_projets']=="4") ? 'selected' : '' ?>>4</option>
  <option value="5" <?= (isset($_POST['nb_projets']) && $_POST['nb_projets']=="5") ? 'selected' : '' ?>>5</option>
  <option value="6" <?= (isset($_POST['nb_projets']) && $_POST['nb_projets']=="6") ? 'selected' : '' ?>>6</option>
  <option value="7" <?= (isset($_POST['nb_projets']) && $_POST['nb_projets']=="7") ? 'selected' : '' ?>>7</option>
  <option value="8" <?= (isset($_POST['nb_projets']) && $_POST['nb_projets']=="8") ? 'selected' : '' ?>>8</option>
  <option value="9" <?= (isset($_POST['nb_projets']) && $_POST['nb_projets']=="9") ? 'selected' : '' ?>>9</option>
  <option value="10" <?= (isset($_POST['nb_projets']) && $_POST['nb_projets']=="10") ? 'selected' : '' ?>>10+</option>
  </select>

</fieldset>

<br><br>

<fieldset>
    <legend>Expérience et Compétences :</legend>

    <div class="form-group">
      <label for="projets">Projets réalisés :</label><br>
      <textarea id="projets" name="projets" rows="5" cols="50" placeholder="Listez vos projets ici..."><?= isset($_POST['projets']) ? htmlspecialchars($_POST['projets']) : '' ?></textarea>
    </div>
    <br>

    <div class="form-group">
      <label for="stages">Stages réalisés :</label><br>
      <textarea id="stages" name="stages" rows="5" cols="50" placeholder="Listez vos stages ici..."><?= isset($_POST['stages']) ? htmlspecialchars($_POST['stages']) : '' ?></textarea>
    </div>
    <br>

    <div class="form-group">
      <label for="centre_interet">Centre d'intérêt :</label><br>
      <textarea id="centre_interet" name="centre_interet" rows="5" cols="50" placeholder="Listez vos centres d'intérêt ici..."><?= isset($_POST['centre_interet']) ? htmlspecialchars($_POST['centre_interet']) : '' ?></textarea>
    </div>
    <br>

    <div class="form-group">
      <label for="Competences">Compétences :</label><br>
      <textarea id="competences" name="competences" rows="5" cols="50" placeholder="Listez vos compétences ici..."><?= isset($_POST['competences']) ? htmlspecialchars($_POST['competences']) : '' ?></textarea>
    </div>
    <br>

    <label>Langues :</label><br>
    <br>
    <div class="checkbox-group">
        <div class="checkbox-item">
            <input type="checkbox" name="langues[]" value="Francais" <?= (isset($_POST['langues']) && in_array("Francais", $_POST['langues'])) ? 'checked' : '' ?>> 
            <label>Francais |</label>
        </div>
        <div class="checkbox-item">
            <input type="checkbox" name="langues[]" value="Anglais" <?= (isset($_POST['langues']) && in_array("Anglais", $_POST['langues'])) ? 'checked' : '' ?>> 
            <label>Anglais |</label>
        </div>
        <div class="checkbox-item">
            <input type="checkbox" name="langues[]" value="Espagnol" <?= (isset($_POST['langues']) && in_array("Espagnol", $_POST['langues'])) ? 'checked' : '' ?>> 
            <label>Espagnol |</label>
        </div>
        <div class="checkbox-item">
            <input type="checkbox" name="langues[]" value="Allemand" <?= (isset($_POST['langues']) && in_array("Allemand", $_POST['langues'])) ? 'checked' : '' ?>> 
            <label>Allemand |</label>
        </div>
        <div class="checkbox-item">
            <input type="checkbox" name="langues[]" value="Arabe" <?= (isset($_POST['langues']) && in_array("Arabe", $_POST['langues'])) ? 'checked' : '' ?>> 
            <label>Arabe |</label>
        </div>
    </div>

</fieldset>

<br><br>

<fieldset>
    <legend>Vos remarques</legend>
      <div class="form-group">
          <label for="fichier_joint">Fichier joint :</label>
              <div style="flex: 1;">
                  <?php
                  $fichierActuel = $_POST['fichier_path'] ?? '';
                  if (!empty($fichierActuel) && file_exists($fichierActuel)) {
                      echo '<div class="file-preview">';
                      echo '<strong>Fichier actuel :</strong> ' . basename($fichierActuel);
                      echo ' <small>(' . round(filesize($fichierActuel) / 1024, 2) . ' KB)</small>';
                      echo '</div>';
                  }
                  ?>
                  <input type="file" name="fichier_joint" id="fichier_joint">
                  <input type="hidden" name="fichier_path" value="<?= htmlspecialchars($fichierActuel) ?>">
                  <small>Formats acceptés : PDF, DOC, DOCX, TXT (Max: 5MB)</small>
                </div>
              </div>

              <div class="form-group">
                <label for="remarques">Vos remarques :</label>
                <textarea id="remarques" name="remarques" placeholder="Vos remarques ici..."><?= isset($_POST['remarques']) ? htmlspecialchars($_POST['remarques']) : '' ?></textarea>
              </div>
</fieldset>   
    
    <br><br>


  <button type = "submit" class="submit-btn"> Submit </button><br><br>

</form>


<br><br>

</body>
</html>