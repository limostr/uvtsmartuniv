<?php

declare(strict_types=1);

namespace Contexte\Form\Contexte;

use Contexte\Model\Table\ContexteCategorieTable;
use Laminas\Form\Form;
use Laminas\Form\Element;
use Laminas\Db\Adapter\Adapter;


 //access_module_id, moduleroute, module_name, module_descrept, module_afficher, templateattruibute
class ContexteForm extends Form
{
 
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
		parent::__construct('new_Contexte');
		$this->setAttribute('method', 'post');
		$this->adapter=$adapter;  


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

       // idcontexte, idcontextecategorie, labelcontexte, context_module, context_action, context_controller, infocontexte
		$this->setAttribute('method', 'post'); 
		$this->add([
			'type' => Element\Text::class,
			'name' => 'labelcontexte',
			'options' => [
				'label' => 'Nom de contexte'
			],
			'attributes' => [
				'required' => true, 
				'maxlength' => 512, 
				'data-toggle' => 'tooltip',
				'class' => 'form-control',   # styling the text field
				'title' => 'Titre context',
				'placeholder' => 'Tapez le nom de contexte'
			]
		]); 
	# module input field
	$this->add([
		'type' => Element\Text::class,
		'name' => 'context_module',
		'options' => [
			'label' => 'Module'
		],
		'attributes' => [
			//'required' => true,
			'size' => 40,
			'maxlength' => 25,
			'pattern' => '^[a-zA-Z0-9À-ž\s._-]+$',  # enforcing what type of data we accept
			'data-toggle' => 'tooltip',
			'class' => 'form-control',   # styling the text field
			'title' => 'Module must consist of alphanumeric characters only',
			'placeholder' => 'Tapez votre module'
		]
	]);

	# controller input field
	$this->add([
		'type' => Element\Text::class,
		'name' => 'context_controller',
		'options' => [
			'label' => 'Controlleur'
		],
		'attributes' => [
			//'required' => true,
			'size' => 40,
			'maxlength' => 25,
			'pattern' => '^[a-zA-Z0-9À-ž\s._-]+$',  # enforcing what type of data we accept
			'data-toggle' => 'tooltip',
			'class' => 'form-control',   # styling the text field
			'title' => 'controlleur must consist of alphanumeric characters only',
			'placeholder' => 'Tapez votre controlleur'
		]
	]);

	# action input field
	$this->add([
		'type' => Element\Text::class,
		'name' => 'context_action',
		'options' => [
			'label' => 'Action'
		],
		'attributes' => [
			//'required' => true,
			'size' => 40,
			'maxlength' => 25,
			'pattern' => '^[a-zA-Z0-9À-ž\s._-]+$',  # enforcing what type of data we accept
			'data-toggle' => 'tooltip',
			'class' => 'form-control',   # styling the text field
			'title' => 'action must consist of alphanumeric characters only',
			'placeholder' => 'Tapez votre action'
		]
	]);  
	


	# add the comment textarea field
	$this->add([
		'type' => Element\Textarea::class,
		'name' => 'desccontexte',
		'options' => [
			'label' => 'Description'
		],
		'attributes' => [
			//'required' => true,
			'row' => 3,
			'maxlength' => 500,
			'title' => 'Description de contexte ',
			'class' => 'form-control',
			'placeholder' => 'description...'
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
	'name' => 'idcontexte'
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

