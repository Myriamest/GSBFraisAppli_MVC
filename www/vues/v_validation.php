<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>

 <form action="index.php?uc=validfrais&action=corrigerFraisForfait" 
              method="post" role="form">
<div class="row">
    <div class="col-md-4">
        <h3>Sélectionner un mois : </h3>
        <h3>Sélectionner un Visiteur : </h3>
    </div>
    <div class="col-md-4">
             
            <div class="form-group">
                <label for="lstMois" accesskey="n">Mois : </label>
                <select id="lstMois" name="lstMois" class="form-control">
                    <?php
                    foreach ($lesMois as $unMois) {
                        $mois = $unMois['mois'];
                        $numAnnee = $unMois['numAnnee'];
                        $numMois = $unMois['numMois'];
                        if ($mois == $moisASelectionner) {
                            ?>
                            <option selected value="<?php echo $mois ?>">
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $mois ?>">
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                            <?php
                        }
                    }
                    ?>  
                            

                </select>
                <label for="lstVisiteur" accesskey="n">Visiteur : </label>
                 <select id="lstMois" name="lstVisiteur" class="form-control">
                    <?php
                    foreach ($Visiteurs as $unVisiteur) {
                        $id = $unVisiteur['id'];
                        $nom = $unVisiteur['nom'];
                        $prenom = $unVisiteur['prenom'];
                        if ($id == $visiteurASelectionner) {
                            ?>
                            <option selected value="<?php echo $id ?>">
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $id ?>">
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        }
                    }
                    ?>    

                </select>
            </div>
    </div>
</div>

     <div class="panel-heading" style="color:orange"><h2> Valider la fiche de frais</h2>  </div>
<h3>Elements forfaitisés</h3>
<div class="row"> 
    <div class="col-md-4">
        
            <fieldset>       
                <?php
                foreach ($lesFraisForfait as $unFrais) {
                    $idFrais = $unFrais['idfrais'];
                    $libelle = htmlspecialchars($unFrais['libelle']);
                    $quantite = $unFrais['quantite']; ?>
                    <div class="form-group">
                        <label for="idFrais"><?php echo $libelle ?></label>
                        <input type="text" id="idFrais" 
                               name="lesFrais[<?php echo $idFrais ?>]"
                               size="10" maxlength="5" 
                               value="<?php echo $quantite ?>" 
                               class="form-control">
                    </div>
                    <?php
                }
                ?>
                
    

                <button class="btn btn-success" type="submit">Corriger</button>
                <button class="btn btn-danger" type="reset">Réinitialiser</button>
            </fieldset>
    </div>
</div>
</form>
        
        <hr>
        <form action="index.php?uc=validfrais&action=corrigerFraisHorsForfait" role="form" method="post" >
            
            <input name="lstVisiteur" type="hidden" value="<?php echo $visiteurASelectionner?>">
            <input name="lstMois" type="hidden" value="<?php echo $moisASelectionner?>"> 
<div class="row">
    <div class="panel panel-info">
        <div class="panel-heading" style="background-color:orange; color:white">Descriptif des éléments hors forfait</div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th class="date">Date </th>
                    <div class style=border-color:orange>
                    <th class="libelle">Libellé</th>  
                    <th class="montant">Montant</th>  
                    <th class="action">&nbsp;</th> 
                </tr>
            </thead>  
            <tbody>
            <?php
            foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                $date = $unFraisHorsForfait['date'];
                $montant = $unFraisHorsForfait['montant'];
                $id = $unFraisHorsForfait['id']; ?>           
                <tr>
                    <td><input type='hidden' name='idFrais' value='<?php echo $id ?>'><!-- comment -->
                        <input type='text' name='Date' value='<?php echo $date ?>'></td>
                    <td><input type='text' name='Libelle' value='<?php echo $libelle ?>'></td>
                    <td><input type='text' name='Montant' value='<?php echo $montant ?>'></td>
                    <td> <input class="btn btn-success" type="submit"  value="Corriger" name="corriger" id="corriger">
                    <input class="btn btn-danger" type="submit" value="Reporter" name="Reporter" id="Reporter"input>
                     <input class="btn btn-danger" type="submit" value="Supprimer" name="Supprimer" id="Supprimer"input></td>
                </tr>
                <?php
            }
            ?>
            </tbody>  
        </table>
    </div>
</div>
    </form>
     <form action="index.php?uc=validfrais&action=mettreVA" 
              method="post" role="form">   
            <input name="lstVisiteur" type="hidden" value="<?php echo $visiteurASelectionner?>">
            <input name="lstMois" type="hidden" value="<?php echo $moisASelectionner?>"> 
         <button class="btn btn-success" type="submit">Valider</button>
     </form>  
    
    