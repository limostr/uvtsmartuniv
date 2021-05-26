<?php

declare(strict_types=1);

namespace Contexte\Model\Entity;

class ContexteEntity
{
    protected $idcontexte;
    protected $idcontextecategorie;
    protected $labelcontexte; 
    protected $context_module;
    protected $context_action;
    protected $context_controller; 
    protected $infocontexte;
    protected $desccontexte;
    protected $labelcontextecategorie;
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
     * Get the value of context_module
     */ 
    public function getContextmodule()
    {
        return $this->context_module;
    }

    /**
     * Set the value of context_module
     *
     * @return  self
     */ 
    public function setContextmodule($context_module)
    {
        $this->context_module = $context_module;

        return $this;
    }

    /**
     * Get the value of context_action
     */ 
    public function getContextaction()
    {
        return $this->context_action;
    }

    /**
     * Set the value of context_action
     *
     * @return  self
     */ 
    public function setContextaction($context_action)
    {
        $this->context_action = $context_action;

        return $this;
    }

    /**
     * Get the value of context_controller
     */ 
    public function getContextcontroller()
    {
        return $this->context_controller;
    }

    /**
     * Set the value of context_controller
     *
     * @return  self
     */ 
    public function setContextcontroller($context_controller)
    {
        $this->context_controller = $context_controller;

        return $this;
    }

    /**
     * Get the value of infocontexte
     */ 
    public function getInfocontexte()
    {
        return $this->infocontexte;
    }

    /**
     * Set the value of infocontexte
     *
     * @return  self
     */ 
    public function setInfocontexte($infocontexte)
    {
        $this->infocontexte = $infocontexte;

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

    /**
     * Get the value of desccontexte
     */ 
    public function getDesccontexte()
    {
        return $this->desccontexte;
    }

    /**
     * Set the value of desccontexte
     *
     * @return  self
     */ 
    public function setDesccontexte($desccontexte)
    {
        $this->desccontexte = $desccontexte;

        return $this;
    }
}