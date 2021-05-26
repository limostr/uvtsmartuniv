<?php

declare(strict_types=1);

namespace Contexte\Form\Structure;
 
use Contexte\Model\Table\ContexteTable;
use Laminas\Form\Form;
use Laminas\Form\Element;
use Laminas\Db\Adapter\Adapter;

 class ContexteStructureForm extends Form
{
 
	private function ContextListe(): array
	{
		$ContextTable=new ContexteTable($this->adapter);
		$Contextrecord=$ContextTable->select();
		$ListeContexte=[];
		foreach($Contextrecord as $p){
			$ListeContexte[$p->idcontexte]=$p->labelcontexte;
		}
		return $ListeContexte;
	}
	public function __construct(Adapter $adapter,$name = null)
	{
		parent::__construct('new_Structure');
		$this->setAttribute('method', 'post');
		$this->adapter=$adapter;  
		//idstructure, metastructure, idcontexte, formstructur, labelstructurecontexte

		#idaccessmodules		
		$this->add([
			'type' => Element\Select::class,
			'name' => 'idcontexte',
			'options' => [
				'label' => 'Contexte',
				'empty_option' => 'Contexte...',
				'value_options' =>$this->ContextListe() ,
			],
			'attributes' => [
				'required' => true,
				'class' => 'form-control', # styling
			]
		]);		

       // idcontexte, idcontextecategorie, labelcontexte, context_module, context_action, context_controller, infocontexte
		$this->setAttribute('method', 'post'); 
		$this->add([
			'type' => Element\Text::class,
			'name' => 'labelstructurecontexte',
			'options' => [
				'label' => 'Nom de Structure'
			],
			'attributes' => [
				'required' => true, 
				'maxlength' => 512, 
				'data-toggle' => 'tooltip',
				'class' => 'form-control',   # styling the text field
				'title' => 'Titre context',
				'placeholder' => 'Tapez le nom de Structure'
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
   # add the idcontexte hidden field
   $this->add([
	'type' => Element\Hidden::class,
	'name' => 'idstructure'
	]);  
	$this->add([
		'type' => Element\Hidden::class,
		'name' => 'formstructur'
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

