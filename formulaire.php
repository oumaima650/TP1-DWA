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
  </style>
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
  <br><br>


  <div class="form-group">
  <label for="Nom">Nom :</label>
  <input type="text" name="Nom" id="Nom" placeholder="Nom" value="<?= isset($_POST['Nom']) ? htmlspecialchars($_POST['Nom']) : '' ?>">
  </div>

  <br><br>

  <div class="form-group">
  <label for="Prénom">Prénom :</label>
  <input type="text" name="Prenom" id="Prénom" placeholder="Prénom" value="<?= isset($_POST['Prenom']) ? htmlspecialchars($_POST['Prenom']) : '' ?>">
  </div>

  <br><br>
  <div class="form-group">
  <label for="Age">Age :</label>
  <input type="text" name="Age" id="Age" placeholder="Age" value="<?= isset($_POST['Age']) ? htmlspecialchars($_POST['Age']) : '' ?>">
  </div>

  <br><br>

  <div class="form-group">
  <label for="Numéro Téléphone :">Numéro Téléphone :</label>
  <input type="tel" name="telephone" id="telephone" placeholder="Numéro Téléphone" value="<?= isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : '' ?>">
  </div>

  <br><br>
  <div class="form-group">
  <label for="Email">Email :</label>
  <input type="Email" name="Email" id="Email" placeholder="Email" value="<?= isset($_POST['Email']) ? htmlspecialchars($_POST['Email']) : '' ?>">
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



<label for="ms"> | MS: </label>
<input type="radio" id="ms" name="filiere" value="ms" <?= (isset($_POST['filiere']) && $_POST['filiere']=="ms") ? 'checked' : '' ?>>


<br><br>

<label for="1er"> 1er annee: </label>
<input type="radio" id="1er" name="Annee" value="1" <?= (isset($_POST['Annee']) && $_POST['Annee']=="1") ? 'checked' : '' ?>>

<label for="2eme"> | 2eme annees: </label>
<input type="radio" id="2eme" name="Annee" value="2" <?= (isset($_POST['Annee']) && $_POST['Annee']=="2") ? 'checked' : '' ?>>

<label for="3eme"> | 3eme annees: </label>
<input type="radio" id="3eme" name="Annee" value="3" <?= (isset($_POST['Annee']) && $_POST['Annee']=="3") ? 'checked' : '' ?>>

<br><br>

<label > Modules suivies cette annee :</label>

<br><br>

<label for="PRO AV">Pro Av : </label>
<input type="checkbox" id="PRO AV" name="modules[]" value="PRO AV" <?= (isset($_POST['modules']) && in_array("PRO AV", $_POST['modules'])) ? 'checked' : '' ?>>

<label for="Compilation"> | Compilation : </label>
<input type="checkbox" id="Compilation" name="modules[]" value="Compilation" <?= (isset($_POST['modules']) && in_array("Compilation", $_POST['modules'])) ? 'checked' : '' ?>>

<label for="reseaux Av"> | reseaux Av : </label>
<input type="checkbox" id="reseaux Av" name="modules[]" value="reseaux Av" <?= (isset($_POST['modules']) && in_array("reseaux Av", $_POST['modules'])) ? 'checked' : '' ?>>

<label for="POO"> | POO : </label>
<input type="checkbox" id="POO" name="modules[]" value="POO" <?= (isset($_POST['modules']) && in_array("POO", $_POST['modules'])) ? 'checked' : '' ?>>

<label for="BD"> | BD : </label>
<input type="checkbox" id="BD" name="modules[]" value="BD" <?= (isset($_POST['modules']) && in_array("BD", $_POST['modules'])) ? 'checked' : '' ?>>

<br><br>

  <label for id="NbrProject">Nombre de projets realises cette annee: </label>
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
<fieldset>
    <legend>Experience et Competence :</legend>
    <div class="form-group">
      <label for="projets">Projets réalisés :</label><br>
      <textarea id="projets" name="projets" rows="5" cols="50" placeholder="Listez vos projets ici..."><?= isset($_POST['projets']) ? htmlspecialchars($_POST['projets']) : '' ?></textarea>
    </div>

    <br><br>

    <div class="form-group">
      <label for="stages">Stages réalisés :</label><br>
      <textarea id="stages" name="stages" rows="5" cols="50" placeholder="Listez vos stages ici..."><?= isset($_POST['stages']) ? htmlspecialchars($_POST['stages']) : '' ?></textarea>
    </div>
     <div class="form-group">
      <label for="centre_interet">Centre d'intérêt :</label><br>
      <textarea id="centre_interet" name="centre_interet" rows="5" cols="50" placeholder="Listez vos centres d'intérêt ici..."><?= isset($_POST['centre_interet']) ? htmlspecialchars($_POST['centre_interet']) : '' ?></textarea>
    </div>
    <label>Langues parlées :</label><br>
    <input type="checkbox" name="langues[]" value="francais" <?= (isset($_POST['langues']) && in_array("francais", $_POST['langues'])) ? 'checked' : '' ?>> francais
    <input type="checkbox" name="langues[]" value="Anglais" <?= (isset($_POST['langues']) && in_array("Anglais", $_POST['langues'])) ? 'checked' : '' ?>> Anglais
    <input type="checkbox" name="langues[]" value="Espagnol" <?= (isset($_POST['langues']) && in_array("Espagnol", $_POST['langues'])) ? 'checked' : '' ?>> Espagnol
    <input type="checkbox" name="langues[]" value="Allemand" <?= (isset($_POST['langues']) && in_array("Allemand", $_POST['langues'])) ? 'checked' : '' ?>> Allemand
    <input type="checkbox" name="langues[]" value="Arabe" <?= (isset($_POST['langues']) && in_array("Arabe", $_POST['langues'])) ? 'checked' : '' ?>> Arabe


</fieldset>

    
    
    <br><br>


  <button type = "submit"> Submit </button>

</form>


<br><br>



</body>
</html>