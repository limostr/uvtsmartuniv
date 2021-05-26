<?php

declare(strict_types=1);

namespace Sessionpreinscription\Form\Etape;

use Contexte\Model\Table\ContexteCategorieTable;
use Laminas\Form\Form;
use Laminas\Form\Element; 
use Laminas\Db\Adapter\Adapter;
 

class MetaEtapeForm extends Form
{
    protected $adapter; 
	private function CategorieContext(): array
	{
		$ContextTable=new ContexteCategorieTable($this->adapter);
		$Contextrecord=$ContextTable->select();
		$ListeContexte=[];
		foreach($Contextrecord as $p){
			$ListeContexte[$p->idcontextecategorie]=$p->labelcontextecategorie;
		}
		return $ListeContexte;
	}  
	public function __construct(Adapter $adapter,$name = null)
	{
		parent::__construct('EtapeDeBas');
		$this->adapter=$adapter; 
	  

	   $this->add([
		   'type' => Element\Text::class,
		   'name' => 'idcontextemetaetape',
		   'options' => [
			   'label' => 'Code Contexte etape'
		   ],
		   'attributes' => [
			   'required' => true, 
			   'data-toggle' => 'tooltip',
			   'class' => 'form-control input-large',   # styling the text field
			   'title' => 'Code Contexte etape',
			   'placeholder' => 'Tapez le Code Contexte etape'
		   ]
	   ]);
	   #idaccessmodules		
		$this->add([
			'type' => Element\Select::class,
			'name' => 'idcontextecategorie',
			'options' => [
				'label' => 'Categorie',
				'empty_option' => 'Categorie...',
				'value_options' =>$this->CategorieContext() ,
			],
			'attributes' => [
				'required' => true,
				'class' => 'form-control', # styling
			]
		]);		
	   $this->add([
		   'type' => Element\Text::class,
		   'name' => 'labelcontextemetaetape',
		   'options' => [
			   'label' => 'Titre Contexte etape'
		   ],
		   'attributes' => [ 
			   'data-toggle' => 'tooltip',
			   'class' => 'form-control input-large',   # styling the text field
			   'title' => 'Titre Contexte etape',
			   'placeholder' => 'Tapez le Titre Contexte etape'
		   ]
	   ]); 

	   
	   $this->add([
		   'type' => Element\Textarea::class,
		   'name' => 'desccontextemetaetape',
		   'options' => [
			   'label' => "Description"
		   ],
		   'attributes' => [
			   'required' => true,
			   'row' => 12,
			   'maxlength' => 500,
			   'title' => "Description",
			   'class' => 'form-control',
			   'placeholder' => "Description....."
		   ]
	   ]);   
	  

	   # cross-site-request forgery (csrf) field
	   $this->add([
		   'type' => Element\Csrf::class,
		   'name' => 'csrf',
		   'options' => [
			   'csrf_options' => [
				   'timeout' => 600,  # 5 minutes
			   ]
		   ]
	   ]);


	   # submit button
	   $this->add([
		   'type' => Element\Submit::class,
		   'name' => 'create',
		   'attributes' => [
			   'value' => 'Enregistrer',
			   'class' => 'btn btn-success'
		   ]
	   ]);


   }
}