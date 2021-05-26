<?php

declare(strict_types=1);

namespace User\Form\Profile;

use Laminas\Form\Element;
use Laminas\Form\Form;
use User\Model\Table\PaysTable;
use Laminas\Db\Adapter\Adapter;

class InfoFrForm extends Form
{
	private $adapter;
	private function Pays(): array
	{
		$Pays=new PaysTable($this->adapter);
		$PaysRecord=$Pays->select();
		$ListePay=[];
		foreach($PaysRecord as $p){
			$ListePay[$p->cpays]=$p->label;
		}
		return $ListePay;
	}
	public function __construct(Adapter $adapter,$name = null)
	{
		parent::__construct('new_account');
		$this->setAttribute('method', 'post');
		$this->adapter=$adapter;

		# Nom input field
		$this->add([
			'type' => Element\Text::class,
			'name' => 'nom',
			'options' => [
				'label' => 'Nom',
			],
			'attributes' => [
				'required' => true,
				'size' => 40,
				'maxlength' => 128, 
				'autocomplete' => false,
				'data-toggle' => 'tooltip',
				'class' => 'form-control',
				'title' => 'Tapez votre Nom',
				'placeholder' => 'Tapez votre Nom',
			],
		]);
	# Nom input field
	$this->add([
		'type' => Element\Text::class,
		'name' => 'prenom',
		'options' => [
			'label' => 'Prénom',
		],
		'attributes' => [
			'required' => true,
			'size' => 40,
			'maxlength' => 128, 
			'autocomplete' => false,
			'data-toggle' => 'tooltip',
			'class' => 'form-control',
			'title' => 'Tapez votre Prénom',
			'placeholder' => 'Tapez votre Prénom',
		],
	]);
# Nom input field
$this->add([
	'type' => Element\Text::class,
	'name' => 'lieudenaissance',
	'options' => [
		'label' => 'Lieu de naissance',
	],
	'attributes' => [
		'required' => true,
		'size' => 40,
		'maxlength' => 128, 
		'autocomplete' => false,
		'data-toggle' => 'tooltip',
		'class' => 'form-control',
		'title' => 'Tapez le Lieu de naissance',
		'placeholder' => 'Tapez le Lieu de naissance',
	],
]);

	# add the comment textarea field
	$this->add([
		'type' => Element\Textarea::class,
		'name' => 'adress',
		'options' => [
			'label' => 'Adress'
		],
		'attributes' => [
			//'required' => true,
			'row' => 3,
			'maxlength' => 500,
			'title' => "Description de l'adress" ,
			'class' => 'form-control',
			'placeholder' => 'Aress...'
		]
	]);
	   
	# birth day select field
	$this->add([
		'type' => Element\DateSelect::class,
		'name' => 'birthday',
		'options' => [
			'label' => 'Date de naissance',
			'create_empty_option' => true,
			'max_year' => date('Y') - 18, # here we want users over the age of 13 only
			'render_delimiters' => false,
			'year_attributes' => [
				'class' => 'custom-select w-30'
			],
			'month_attributes' => [
				'class' => 'custom-select w-30'
			],
			'day_attributes' => [
				'class' => 'custom-select w-30',
				'id' => 'day'
			],
		],
		'attributes' => [
			'required' => true
		]
	]);
		# csrf hidden field
		$this->add([
			'type' => Element\Csrf::class,
			'name' => 'csrf',
			'options' => [
				'csrf_options' => [
					'timeout' => 600,   # 10 minutes
				]
			],
		]);
	# gender select field
	$this->add([
		'type' => Element\Select::class,
		'name' => 'gender',
		'options' => [
			'label' => 'Gender',
			'empty_option' => 'Votre sexe...',
			'value_options' => [
				'F' => 'Femme',
				'H' => 'Homme' 
			],
		],
		'attributes' => [
			'required' => true,
			'class' => 'form-control', # styling
		]
	]);


	$this->add([
		'type' => Element\Text::class,
		'name' => 'tel1',
		'options' => [
			'label' => 'Téléphone 1',
		],
		'attributes' => [
			'required' => true,
			'size' => 40,
			'maxlength' => 128, 
			'autocomplete' => false,
			'data-toggle' => 'tooltip',
			'class' => 'form-control',
			'title' => 'Tapez votre Téléphone ',
			'placeholder' => 'Tapez votre Téléphone',
		],
	]);
	$this->add([
		'type' => Element\Text::class,
		'name' => 'tel2',
		'options' => [
			'label' => 'Téléphone 2',
		],
		'attributes' => [
			'required' => true,
			'size' => 40,
			'maxlength' => 128, 
			'autocomplete' => false,
			'data-toggle' => 'tooltip',
			'class' => 'form-control',
			'title' => 'Tapez votre Téléphone ',
			'placeholder' => 'Tapez votre Téléphone',
		],
	]);

	$this->add([
		'type' => Element\Text::class,
		'name' => 'tel3',
		'options' => [
			'label' => 'Téléphone 3',
		],
		'attributes' => [
			'required' => true,
			'size' => 40,
			'maxlength' => 128, 
			'autocomplete' => false,
			'data-toggle' => 'tooltip',
			'class' => 'form-control',
			'title' => 'Tapez votre Téléphone ',
			'placeholder' => 'Tapez votre Téléphone',
		],
	]);

	$this->add([
		'type' => Element\Select::class,
		'name' => 'nationaliter',
		'options' => [
			'label' => 'Nationalité',
			'empty_option' => 'Nationalité...',
			'value_options' =>$this->Pays() ,
			'value'=>'TN',
		],
		'attributes' => [
			'required' => true,
			'class' => 'form-control', # styling
		]
	]);		

		# submit button
		$this->add([
			'type' => Element\Submit::class,
			'name' => 'enregistrer',
			'attributes' => [
				'value' => 'Enregistrer',
				'class' => 'btn btn-flat btn-info text-white'
			]
		]);
	}
}



