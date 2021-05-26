<?php

declare(strict_types=1);

namespace Contexte\Model\Entity;

class ContexteCategorieEntity
{
    protected $idcontextecategorie;  
    protected $labelcontextecategorie; 
    protected $desccontextecategorie;

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
     * Get the value of desccontextecategorie
     */ 
    public function getDesccontextecategorie()
    {
        return $this->desccontextecategorie;
    }

    /**
     * Set the value of desccontextecategorie
     *
     * @return  self
     */ 
    public function setDesccontextecategorie($desccontextecategorie)
    {
        $this->desccontextecategorie = $desccontextecategorie;

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