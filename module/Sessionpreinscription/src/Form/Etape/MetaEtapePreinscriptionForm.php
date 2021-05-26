<?php

declare(strict_types=1);

namespace Sessionpreinscription\Form\Etape;

 use Contexte\Model\Table\ContexteTable;
use Laminas\Form\Form;
use Laminas\Form\Element; 
use Laminas\Db\Adapter\Adapter;
use Sessionpreinscription\Model\Table\ContexteMetaetapeTable;

 
class MetaEtapePreinscriptionForm extends Form
{
    protected $adapter; 
	private function Context(): array
	{
		$ContextTable=new ContexteTable($this->adapter);
		$Contextrecord=$ContextTable->select();
		$ListeContexte=[];
		foreach($Contextrecord as $p){
			$ListeContexte[$p->idcontexte]=$p->labelcontexte;
		}
		return $ListeContexte;
	}  

	private function MetaContext(): array
	{
		$ContextTable=new ContexteMetaetapeTable($this->adapter);
		$Contextrecord=$ContextTable->select();
		$ListeContexte=[];
		foreach($Contextrecord as $p){
			$ListeContexte[$p->idcontextemetaetape]=$p->labelcontextemetaetape;
		}
		return $ListeContexte;
	}  
	public function __construct(Adapter $adapter,$name = null)
	{
		parent::__construct('idmetaetapepreinscription');
		$this->adapter=$adapter; 
		$this->add([
			'type' => Element\Text::class,
			'name' => 'idmetaetapepreinscription',
			'options' => [
				'label' => 'Titre etape'
			],
			'attributes' => [
				'required' => true, 
				'data-toggle' => 'tooltip',
				'class' => 'form-control input-large',   # styling the text field
				'title' => 'Titre etape',
				'placeholder' => 'Tapez le Titre etape'
			]
		]);

	   $this->add([
		   'type' => Element\Text::class,
		   'name' => 'labelmataetape',
		   'options' => [
			   'label' => 'Titre etape'
		   ],
		   'attributes' => [
			   'required' => true, 
			   'data-toggle' => 'tooltip',
			   'class' => 'form-control input-large',   # styling the text field
			   'title' => 'Titre etape',
			   'placeholder' => 'Tapez le Titre etape'
		   ]
	   ]);

	   $this->add([
		'type' => Element\Checkbox::class,
		'name' => 'obligatoire',
		'options' => [
			'label' => "Obligatoire",
			'label_attributes' => [
				'class' => 'custom-control-label'
			],
			'use_hidden_element' => true,
			'checked_value' => 1, 
			'unchecked_value' => 0,
		],
		'attributes' => [
			'value' => 0,
			'id' => 'obligatoire', 
			'class' => 'custom-control-input'
		]
	]);

 

	   $this->add([
		'type' => Element\Text::class,
		'name' => 'labelmetaorder',
		'options' => [
			'label' => 'ordre  etape'
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
			'name' => 'idcontexte',
			'options' => [
				'label' => 'Contexte',
				'empty_option' => 'Contexte...',
				'value_options' =>$this->Context() ,
			],
			'attributes' => [
				'required' => true,
				'class' => 'form-control', # styling
			]
		]);		


		$this->add([
			'type' => Element\Select::class,
			'name' => 'idcontextemetaetape',
			'options' => [
				'label' => 'Contexte Etape',
				'empty_option' => 'Contexte Etape...',
				'value_options' =>$this->MetaContext() ,
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
		   'name' => 'descreptionmetaetape',
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
	   $this->add([
		'type' => Element\Textarea::class,
		'name' => 'contenuspecific',
		'options' => [
			'label' => "Contenu spécifique"
		],
		'attributes' => [
			'required' => true,
			'row' => 12,
			'maxlength' => 500,
			'title' => "Contenue Spécifique",
			'class' => 'form-control',
			'placeholder' => "Contenu spécifique....."
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