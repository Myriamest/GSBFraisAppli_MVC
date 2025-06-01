
<?php

/**
 * Gestion de la connexion
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
if (!$uc) {
    $uc = 'demandeconnexion';
}

switch ($action) {
    case'choisir':
        $Visiteurs = $pdo->getVisiteur();
        $lesCles = array_keys($Visiteurs);
        $VisiteurASelectionner = $lesCles[0];
        $mois = getMois(date('d/m/Y'));
        $lesMois = LesdouzesderniersMois($mois);
        $lesCles2 = array_keys($lesMois);
        $moisASelectionner = $lesCles2[0];
        // $lesCles = array_keys($lesMois);
        // $moisASelectionner = $lesCles[0];
        include 'vues/v_choisir.php';
        break;
    case'choisir2':


        $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_SPECIAL_CHARS);
        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteur', FILTER_SANITIZE_SPECIAL_CHARS);
        //var_dump($mois,$idVisiteur);
        //$Comptable = $pdo->getComptable();
        $Visiteurs = $pdo->getVisiteur();
        $visiteurASelectionner = $idVisiteur;
        $mois2 = getMois(date('d/m/Y'));
        $lesMois = LesdouzesderniersMois($mois2);
        $moisASelectionner = $mois;
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
        //var_dump($lesFraisForfait);
        if (empty($lesFraisForfait) && empty($lesFraisHorsForfait)) {

            ajouterErreur('Pas de fiche de frais pour ce visiteur et ce mois');
            include 'vues/v_erreurs.php';
            include 'vues/v_choisir.php';
        } else {
            include'vues/v_validation.php';
        }



        break;
    case'corrigerFraisForfait':
        $FraisForfait = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteur', FILTER_SANITIZE_SPECIAL_CHARS);
        $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_SPECIAL_CHARS);

        $pdo->majFraisForfait($idVisiteur, $mois, $FraisForfait);

        $Visiteurs = $pdo->getVisiteur();
        $visiteurASelectionner = $idVisiteur;
        $mois2 = getMois(date('d/m/Y'));
        $lesMois = LesdouzesderniersMois($mois2);
        $moisASelectionner = $mois;
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
        include'vues/v_validation.php';
        break;
        if ($pdo->estPremierFraisMois($idVisiteur, $mois)) {
            $pdo->creeNouvellesLignesFrais($idVisiteur, $mois);
        }
        $pdo->creeNouveauFraisHorsForfait;
    case 'corrigerFraisHorsForfait':
        if (isset($_POST['corriger'])) {
            $idVisiteur = filter_input(INPUT_POST, 'lstVisiteur', FILTER_SANITIZE_SPECIAL_CHARS);
            $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_SPECIAL_CHARS);
            $date = filter_input(INPUT_POST, 'Date', FILTER_SANITIZE_SPECIAL_CHARS);
            $libelle = filter_input(INPUT_POST, 'Libelle', FILTER_SANITIZE_SPECIAL_CHARS);
            $montant = filter_input(INPUT_POST, 'Montant', FILTER_VALIDATE_FLOAT);
            $pdo->majFraisHorsForfait($idVisiteur, $mois, $libelle, $date, $montant);

            $Visiteurs = $pdo->getVisiteur();
            $visiteurASelectionner = $idVisiteur;
            $mois2 = getMois(date('d/m/Y'));
            $lesMois = LesdouzesderniersMois($mois2);
            $moisASelectionner = $mois;
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);

            include'vues/v_validation.php';
        } elseif (isset($_POST['Reporter'])) {
            $idVisiteur = filter_input(INPUT_POST, 'lstVisiteur', FILTER_SANITIZE_SPECIAL_CHARS);
            //var_dump($idVisiteur);
            $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_SPECIAL_CHARS);
            //var_dump($mois);
            $date = filter_input(INPUT_POST, 'Date', FILTER_SANITIZE_SPECIAL_CHARS);
            //var_dump($date);
            $libelle = filter_input(INPUT_POST, 'Libelle', FILTER_SANITIZE_SPECIAL_CHARS);
            //var_dump($libelle);
            $montant = filter_input(INPUT_POST, 'Montant', FILTER_VALIDATE_FLOAT);
            //var_dump($montant);

            $libelle = 'refuser' . $libelle;
            $pdo->majFraisHorsForfait($idVisiteur, $mois, $libelle, $date, $montant);

            $Visiteurs = $pdo->getVisiteur();
            $visiteurASelectionner = $idVisiteur;
            $mois2 = getMois(date('d/m/Y'));
            $lesMois = LesdouzesderniersMois($mois2);
            $moisASelectionner = $mois;
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
            include 'vues/v_validation.php';

            //vue vali 
            //$nom='salut'.$nom;
            //concaténer libellde
            //appel de la fonction creenouveaufraishorsforfait
            //mois lui ajouter 1
            //if ($pdo->estPremierFraisMois($idVisiteur, $mois)) {
            //$pdo->creeNouvellesLignesFrais($idVisiteur, $mois);
            //} a mettre avant l'appel de la fonction'
        } elseif (isset($_POST['Supprimer'])) {
            $idVisiteur = filter_input(INPUT_POST, 'lstVisiteur', FILTER_SANITIZE_SPECIAL_CHARS);
            //var_dump($idVisiteur);
            $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_SPECIAL_CHARS);
            //var_dump($mois);
            $date = filter_input(INPUT_POST, 'Date', FILTER_SANITIZE_SPECIAL_CHARS);
            //var_dump($date);
            $libelle = filter_input(INPUT_POST, 'Libelle', FILTER_SANITIZE_SPECIAL_CHARS);
            //var_dump($libelle);
            $montant = filter_input(INPUT_POST, 'Montant', FILTER_VALIDATE_FLOAT);
            //var_dump($montant);

            $idFrais = filter_input(INPUT_POST, 'idFrais', FILTER_SANITIZE_SPECIAL_CHARS);
            $pdo->supprimerFraisHorsForfait($idFrais);
            $Visiteurs = $pdo->getVisiteur();
            $visiteurASelectionner = $idVisiteur;
            $mois2 = getMois(date('d/m/Y'));
            $lesMois = LesdouzesderniersMois($mois2);
            $moisASelectionner = $mois;
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);

            include 'vues/v_validation.php';
        }
        //rappel des données
        break;
    case 'mettreVA':
        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteur', FILTER_SANITIZE_SPECIAL_CHARS);
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_SPECIAL_CHARS);
        $nbJustificatifs = filter_input(INPUT_POST, 'nbJust', FILTER_SANITIZE_SPECIAL_CHARS);
        $etat='VA';
        $pdo->majEtatFicheFrais($idVisiteur, $leMois, $etat);
        $sommeHF=$pdo->montantHF($idVisiteur,$leMois);
        //var_dump($sommeHF, $idVisiteur, $leMois);
        $totalHF=$sommeHF[0][0];
        $sommeFF=$pdo->montantFF($idVisiteur,$leMois);
        //var_dump($sommeFF);
        $totalFF=$sommeFF[0][0];
        $montantTotal=$totalHF+$totalFF;
        //var_dump($montantTotal);
        $pdo->total($idVisiteur,$leMois,$montantTotal);
        include 'vues/v_retourAccueil.php';
        break;

}  
                    
    
    
