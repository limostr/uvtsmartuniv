<?php

declare(strict_types=1);

namespace Sessionpreinscription\Model\Entity;

class ContexteMetaetapeEntity
{
    protected $idcontextemetaetape;  
    protected $labelcontextemetaetape; 
    protected $desccontextemetaetape;
    protected $idcontextecategorie;
    protected $labelcontextecategorie;
    /**
     * Get the value of idcontextemetaetape
     */ 
    public function getIdcontextemetaetape()
    {
        return $this->idcontextemetaetape;
    }

    /**
     * Set the value of idcontextemetaetape
     *
     * @return  self
     */ 
    public function setIdcontextemetaetape($idcontextemetaetape)
    {
        $this->idcontextemetaetape = $idcontextemetaetape;

        return $this;
    }

    /**
     * Get the value of labelcontextemetaetape
     */ 
    public function getLabelcontextemetaetape()
    {
        return $this->labelcontextemetaetape;
    }

    /**
     * Set the value of labelcontextemetaetape
     *
     * @return  self
     */ 
    public function setLabelcontextemetaetape($labelcontextemetaetape)
    {
        $this->labelcontextemetaetape = $labelcontextemetaetape;

        return $this;
    }

    /**
     * Get the value of desccontextemetaetape
     */ 
    public function getDesccontextemetaetape()
    {
        return $this->desccontextemetaetape;
    }

    /**
     * Set the value of desccontextemetaetape
     *
     * @return  self
     */ 
    public function setDesccontextemetaetape($desccontextemetaetape)
    {
        $this->desccontextemetaetape = $desccontextemetaetape;

        return $this;
    }

    /**
     * Get the value of idcontextecategorie
     */ 
    public function getIdcontextecategorie()
    {
        return $this->idcontextecategorie;
    }

    /**
     * Set the value of idcontextecategorie
     *
     * @return  self
     */ 
    public function setIdcontextecategorie($idcontextecategorie)
    {
        $this->idcontextecategorie = $idcontextecategorie;

        return $this;
    }

    /**
     * Get the value of labelcontextecategorie
     */ 
    public function getLabelcontextecategorie()
    {
        return $this->labelcontextecategorie;
    }

    /**
     * Set the value of labelcontextecategorie
     *
     * @return  self
     */ 
    public function setLabelcontextecategorie($labelcontextecategorie)
    {
        $this->labelcontextecategorie = $labelcontextecategorie;

        return $this;
    }
}