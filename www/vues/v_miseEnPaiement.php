<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

?>
<form method="post" 
              action="index.php?uc=suivrePaiement&action=paiement" 
              role="form">
    <input name="lstMois" type="hidden" id="lstMois" class="form-control" value="<?php echo $moisASelectionner ?>">
    <input name="lstVisiteurs" type="hidden" id="lstVisiteurs" class="form-control" value="<?php echo $visiteurASelectionner ?>">
    <input id="ok" type="submit" value="Mise en paiement" class="btn btn-success" 
            role="button">
</form>




