<?php
class Client
{
  private $identifiant;
  private $nom;
  private $motDePasse;

  private $identifiantTemporaire;
  private $nomTemporaire;
  private $motDePasseTemporaire;

  private $listeMessageErreur = [
    'id-long' => 'L\'identifiant ne doit pas excéder 30 caractères.',
    'id-vide' => 'L\'identifiant ne doit pas être vide.',
    'nom-vide' => 'Le nom ne doit pas être vide.',
    'nom-long' => 'Le nom ne doit pas excéder 50 caractères.',
  ];
  private $listeMessageErreurActif = [];

  public function __construct(){

  }

  public function construireSecuritairement($identifiant, $nom, $motDePasse) {
    $this->identifiant = $identifiant ;
    $this->nom = $nom ;
    $this->motDePasse = $motDePasse ;
  }

  // Liste des getters
  public function getId()
  {
    return $this->identifiant;
  }

  public function getNom()
  {
    return $this->nom;
  }

  public function getMotDePasse()
  {
    return $this->motDePasse;
  }

  // Liste des setters
  public function setId($identifiant)
  {
    $identifiantTemporaire = filter_var($identifiant, FILTER_SANITIZE_STRING);
    if (empty($identifiantTemporaire)) {
      $this->listeMessageErreurActif['id'][] = $this->listeMessageErreur['id-vide'];
    }
    else {
      if (strlen($identifiantTemporaire) > 30) {
        $this->listeMessageErreurActif['id'][] = $this->listeMessageErreur['id-long'];
      }
      else {
        $this->identifiant = $identifiant;
      }
    }
  }

  public function setNom($nom)
  {
    $nomTemporaire = filter_var($nom, FILTER_SANITIZE_STRING);
    if (empty($nomTemporaire)) {
      $this->listeMessageErreurActif['nom'][] = $this->listeMessageErreur['nom-vide'];
    }
    else {
      if (strlen($nomTemporaire) > 50) {
        $this->listeMessageErreurActif['nom'][] = $this->listeMessageErreur['nom-long'];
      }
      else {
        $this->nom = $nomTemporaire;
      }
    }
  }

  public function setMotDePasse($motdepasse)
  {
    $motdepasseTemporaire = filter_var($motdepasse, FILTER_SANITIZE_STRING);
    if (empty($motdepasseTemporaire)) {
    }
    $this->motDePasse = $motdepasseTemporaire;
  }

  public function getListeErreurActivePourChamp($champ){
    $listeErreurActivePourChamp = array();
    foreach ($this->listeMessageErreurActif as $nomChamp=>$messageErreur) {
      if ($nomChamp==$champ) {
        $listeErreurActivePourChamp [] = $messageErreur;
      }
    }
    return $listeErreurActivePourChamp;
  }
}
?>
