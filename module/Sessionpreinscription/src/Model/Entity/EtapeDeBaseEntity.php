<?php

declare(strict_types=1);

namespace Sessionpreinscription\Model\Entity;

class EtapeDeBaseEntity
{
    protected $idetapedebase; 
    protected $labeletapebase; 
    protected $labeletapebasear; 
    protected $description; 
    protected $contenueetape; 
    protected $dynamiqueetape; 
    protected $linkstatic; 
    protected $idcontexte;
    protected $labelcontexte;



    /**
     * Get the value of idetapedebase
     */ 
    public function getIdetapedebase()
    {
        return $this->idetapedebase;
    }

    /**
     * Set the value of idetapedebase
     *
     * @return  self
     */ 
    public function setIdetapedebase($idetapedebase)
    {
        $this->idetapedebase = $idetapedebase;

        return $this;
    }

    /**
     * Get the value of labeletapebase
     */ 
    public function getLabeletapebase()
    {
        return $this->labeletapebase;
    }

    /**
     * Set the value of labeletapebase
     *
     * @return  self
     */ 
    public function setLabeletapebase($labeletapebase)
    {
        $this->labeletapebase = $labeletapebase;

        return $this;
    }

    /**
     * Get the value of labeletapebasear
     */ 
    public function getLabeletapebasear()
    {
        return $this->labeletapebasear;
    }

    /**
     * Set the value of labeletapebasear
     *
     * @return  self
     */ 
    public function setLabeletapebasear($labeletapebasear)
    {
        $this->labeletapebasear = $labeletapebasear;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of contenueetape
     */ 
    public function getContenueetape()
    {
        return $this->contenueetape;
    }

    /**
     * Set the value of contenueetape
     *
     * @return  self
     */ 
    public function setContenueetape($contenueetape)
    {
        $this->contenueetape = $contenueetape;

        return $this;
    }

    /**
     * Get the value of dynamiqueetape
     */ 
    public function getDynamiqueetape()
    {
        return $this->dynamiqueetape;
    }

    /**
     * Set the value of dynamiqueetape
     *
     * @return  self
     */ 
    public function setDynamiqueetape($dynamiqueetape)
    {
        $this->dynamiqueetape = $dynamiqueetape;

        return $this;
    }

    /**
     * Get the value of linkstatic
     */ 
    public function getLinkstatic()
    {
        return $this->linkstatic;
    }

    /**
     * Set the value of linkstatic
     *
     * @return  self
     */ 
    public function setLinkstatic($linkstatic)
    {
        $this->linkstatic = $linkstatic;

        return $this;
    }

    /**
     * Get the value of idcontexte
     */ 
    public function getIdcontexte()
    {
        return $this->idcontexte;
    }

    /**
     * Set the value of idcontexte
     *
     * @return  self
     */ 
    public function setIdcontexte($idcontexte)
    {
        $this->idcontexte = $idcontexte;

        return $this;
    }

    /**
     * Get the value of labelcontexte
     */ 
    public function getLabelcontexte()
    {
        return $this->labelcontexte;
    }

    /**
     * Set the value of labelcontexte
     *
     * @return  self
     */ 
    public function setLabelcontexte($labelcontexte)
    {
        $this->labelcontexte = $labelcontexte;

        return $this;
    }
}