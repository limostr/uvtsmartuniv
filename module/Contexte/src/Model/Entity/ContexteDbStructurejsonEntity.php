<?php

declare(strict_types=1);

namespace Contexte\Model\Entity;

class ContexteDbStructurejsonEntity
{
    protected $idstructure;  
    protected $metastructure; 
    protected $idcontexte;
    protected $formstructur;
    protected $labelstructurecontext;
    protected $labelcontexte;

    /**
     * Get the value of idstructure
     */ 
    public function getIdstructure()
    {
        return $this->idstructure;
    }

    /**
     * Set the value of idstructure
     *
     * @return  self
     */ 
    public function setIdstructure($idstructure)
    {
        $this->idstructure = $idstructure;

        return $this;
    }

    /**
     * Get the value of metastructure
     */ 
    public function getMetastructure()
    {
        return $this->metastructure;
    }

    /**
     * Set the value of metastructure
     *
     * @return  self
     */ 
    public function setMetastructure($metastructure)
    {
        $this->metastructure = $metastructure;

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
     * Get the value of formstructur
     */ 
    public function getFormstructur()
    {
        return $this->formstructur;
    }

    /**
     * Set the value of formstructur
     *
     * @return  self
     */ 
    public function setFormstructur($formstructur)
    {
        $this->formstructur = $formstructur;

        return $this;
    }

    /**
     * Get the value of labelstructurecontext
     */ 
    public function getLabelstructurecontext()
    {
        return $this->labelstructurecontext;
    }

    /**
     * Set the value of labelstructurecontext
     *
     * @return  self
     */ 
    public function setLabelstructurecontext($labelstructurecontext)
    {
        $this->labelstructurecontext = $labelstructurecontext;

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