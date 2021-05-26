<?php

declare(strict_types=1);

namespace Sessionpreinscription\Model\Entity;

class SessionpreinscriptionEntity
{
    protected $idsessionpreinscription;
    protected $idformations;
    protected $idformulaire;
    protected $idniveauformation;
    protected $datedebut;
    protected $datefin;
    protected $nombredecandidats;
    protected $lieu;
    protected $description;
    protected $mailtype;
    protected $sujetmailtype;
    protected $dateselection;
    protected $dateentretient;
    protected $datedeffusionresultat;
    protected $datelisteattente;
    protected $activation;
    protected $semestre;
    protected $nbrcandidat;
    protected $periodesession;
    protected $nbrannee;
    protected $anneeuniv;
    protected $datedebutpay;
    protected $datefinpay;
    protected $idanneescolaire;
    protected $paiementdirect;
    protected $modelpaiement;
    protected $titresession;
    protected $sessioncybler;
    protected $listedescin;
    protected $listeemail;
    protected $predection;

    /**
     * Get the value of idsessionpreinscription
     */ 
    public function getIdsessionpreinscription()
    {
        return $this->idsessionpreinscription;
    }

    /**
     * Set the value of idsessionpreinscription
     *
     * @return  self
     */ 
    public function setIdsessionpreinscription($idsessionpreinscription)
    {
        $this->idsessionpreinscription = $idsessionpreinscription;

        return $this;
    }

    /**
     * Get the value of idformations
     */ 
    public function getIdformations()
    {
        return $this->idformations;
    }

    /**
     * Set the value of idformations
     *
     * @return  self
     */ 
    public function setIdformations($idformations)
    {
        $this->idformations = $idformations;

        return $this;
    }

    /**
     * Get the value of idformulaire
     */ 
    public function getIdformulaire()
    {
        return $this->idformulaire;
    }

    /**
     * Set the value of idformulaire
     *
     * @return  self
     */ 
    public function setIdformulaire($idformulaire)
    {
        $this->idformulaire = $idformulaire;

        return $this;
    }

    /**
     * Get the value of idniveauformation
     */ 
    public function getIdniveauformation()
    {
        return $this->idniveauformation;
    }

    /**
     * Set the value of idniveauformation
     *
     * @return  self
     */ 
    public function setIdniveauformation($idniveauformation)
    {
        $this->idniveauformation = $idniveauformation;

        return $this;
    }

    /**
     * Get the value of datedebut
     */ 
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set the value of datedebut
     *
     * @return  self
     */ 
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;

        return $this;
    }
}