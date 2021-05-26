<?php

declare(strict_types=1);

namespace Sessionpreinscription\Form\Session;

use Laminas\Form\Form;
use Laminas\Form\Element; 
use Laminas\Db\Adapter\Adapter;
 

class FormSessionpreinscript extends Form
{
   protected $adapter;        
	public function __construct(Adapter $adapter,$name = null)
	{
		parent::__construct('formsession');
		$this->adapter=$adapter;
 
 
		$this->add([
			'type' => Element\Text::class,
			'name' => 'titresession',
			'options' => [
				'label' => 'Titre'
			],
			'attributes' => [
				'required' => true, 
				'data-toggle' => 'tooltip',
				'class' => 'form-control input-large',   # styling the text field
				'title' => 'Titre de module',
				'placeholder' => 'Tapez le titre de module'
			]
		]);
   
			$this->add([
				'type' => Element\Select::class,
				'name' => 'semestre',
				'options' => [
					'label' => 'Période',
					'empty_option' => 'Période...',
					'value_options' => [
						""=>"", 
						"1ere semestre"=>"1ere semestre", 
						"2eme semestre"=>"2eme semestre", 
						"Annuelle"=>"Annuelle" ,
						"Périodique"=>"Périodique",
						],
				],
				'attributes' => [
					'required' => true,
					'class' => 'form-control', # styling
				]
			]);		
    
    	 

		$this->add([
			'type' => Element\Text::class,
			'name' => 'nbrcandidat',
			'options' => [
				'label' => 'Nbre candidats à accepter'
			],
			'attributes' => [
				'required' => true, 
				'data-toggle' => 'tooltip',
				'pattern' => '^[0-9]+$',
				'class' => 'form-control input-large',   # styling the text field
				'title' => 'Titre de module',
				'placeholder' => 'Tapez le titre de module'
			]
		]);
 
 
		$this->add([
			'type' => Element\Text::class,
			'name' => 'nbrannee',
			'options' => [
				'label' => "Nombre d'année d'etude minimum aprés le bac"
			],
			'attributes' => [
				'required' => true, 
				'data-toggle' => 'tooltip',
				'pattern' => '^[0-9]+$',
				'class' => 'form-control input-large',   # styling the text field
				'title' => "Nombre d'année d'etude minimum aprés le bac",
				'placeholder' => "Tapez le nombre d'année d'etude minimum aprés le bac" 
			]
		]);
	
 
    	 
		$this->add([
			'type' => Element\Text::class,
			'name' => 'lieu',
			'options' => [
				'label' => "Lieu de selection"
			],
			'attributes' => [
				'required' => true, 
				'data-toggle' => 'tooltip',
				'pattern' => '^[0-9]+$',
				'class' => 'form-control input-large',   # styling the text field
				'title' => 'Lieu de selection',
				'placeholder' => 'Tapez le Lieu de selection'
			]
		]);

	  
		$this->add([
			'type' => Element\Checkbox::class,
			'name' => 'activation',
			'options' => [
				'label' => "Activation de session",
				'label_attributes' => [
					'class' => 'custom-control-label'
				],
				'use_hidden_element' => true,
				'checked_value' => 1, 
				'unchecked_value' => 0,
			],
			'attributes' => [
				'value' => 0,
				'id' => 'activation', 
				'class' => 'custom-control-input'
			]
		]);
    	 
		$this->add([
			'type' => Element\Checkbox::class,
			'name' => 'sessioncybler',
			'options' => [
				'label' => "Session Ciblé",
				'label_attributes' => [
					'class' => 'custom-control-label'
				],
				'use_hidden_element' => true,
				'checked_value' => 1, 
				'unchecked_value' => 0,
			],
			'attributes' => [
				'value' => 0,
				'id' => 'sessioncybler', 
				'class' => 'custom-control-input'
			]
		]);
		 # birth day select field
		$this->add([
			'type' => Element\DateSelect::class,
			'name' => 'datedebut',
			'options' => [
				'label' => "Date de debut d'inscription",
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

	/*	$this->add([
			'type' => Element\Date::class,
			'name' => 'datedebut',
			'options' => [
				'label' => "Date de debut d'inscription",
			
			],
			'attributes' => [
				"required"=>"required",
				'format' => 'dd-mm-yyyy',
				"placeholder"=>"dd-mm-yyyy",
				'min' => '2012-01-01',
				'max' => '2022-01-01',
				//'step' => '1', // days; default step interval is 1 day
			],
		]);*/
     
		$this->add([
			'type' => Element\DateSelect::class,
			'name' => 'datefin',
			'options' => [
				'label' => "Date fin d'inscription",
				'format' =>  'd-m-Y',
			],
			'attributes' => [
				 "required"=>"required"
				/*'min' => '2012-01-01',
				'max' => '2020-01-01',*/
				//'step' => '1', // days; default step interval is 1 day
			],
		]); 

		$this->add([
			'type' => Element\DateSelect::class,
			'name' => 'dateselection',
			'options' => [
				'label' => "Date de selection des candidats",
				'format' => 'dd-mm-yyyy',
			],
			'attributes' => [
				"class"=>"datepicker"
				,"required"=>"required"
				/*'min' => '2012-01-01',
				'max' => '2020-01-01',*/
				//'step' => '1', // days; default step interval is 1 day
			],
		]); 
  
	# add the descreption textarea field
	$this->add([
		'type' => Element\Textarea::class,
		'name' => 'listedescin',
		'options' => [
			'label' => 'Liste des CIN'
		],
		'attributes' => [
			'required' => true,
			'row' => 3,
			//'maxlength' => 1048,
			'title' => 'Liste des CIN ',
			'class' => 'form-control',
			'placeholder' => 'Liste des CIN...'
		]
	]);

	$this->add([
		'type' => Element\Textarea::class,
		'name' => 'listeemail',
		'options' => [
			'label' => 'Liste des CIN'
		],
		'attributes' => [
			'required' => true,
			'row' => 3,
			//'maxlength' => 1048,
			'title' => 'Liste des email ',
			'class' => 'form-control',
			'placeholder' => 'Liste des email...'
		]
	]);
     
    $this->add([
		'type' => Element\Textarea::class,
		'name' => 'description',
		'options' => [
			'label' => 'Description'
		],
		'attributes' => [
			'required' => true,
			'row' => 3,
			'maxlength' => 500,
			'title' => 'Description ',
			'class' => 'form-control',
			'placeholder' => 'Description...'
		]
	]);  
    $this->add([
		'type' => Element\Textarea::class,
		'name' => 'sujetmail',
		'options' => [
			'label' => 'Sujet'
		],
		'attributes' => [
			'required' => true,
			'row' => 3,
			'maxlength' => 500,
			'title' => 'Mail ',
			'class' => 'form-control',
			'placeholder' => 'Mail...'
		]
	]);  
    		
	$this->add([
		'type' => Element\Textarea::class,
		'name' => 'Mailtype',
		'options' => [
			'label' => 'Sujet'
		],
		'attributes' => [
			'required' => true,
			'row' => 12,
			'maxlength' => 500,
			'title' => 'Mail ',
			'class' => 'form-control',
			'placeholder' => 'Mail...'
		]
	]);  
    		
    	
   # add the user_id hidden field
        $this->add([
            'type' => Element\Hidden::class,
            'name' => 'idsessionpreinscription'
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
			'name' => 'enregistrer',
			'attributes' => [
				'value' => 'Enregistrer',
				'class' => 'btn btn-success'
			]
		]);
     
     
		$this->add([
			'type' => Element\Checkbox::class,
			'name' => 'paiementdirect',
			'options' => [
				'label' => "Paiement direct ",
				'label_attributes' => [
					'class' => 'custom-control-label'
				],
				'use_hidden_element' => true,
				'checked_value' => 1, 
				'unchecked_value' => 0,
			],
			'attributes' => [
				'value' => 0,
				'id' => 'paiementdirect', 
				'class' => 'custom-control-input'
			]
		]);
		 
    	  
		
     
		
		$Profiles=new  \Sessionpreinscription\Model\Table\ListeCibleTable($this->adapter);
		$tmpProfiles= $Profiles->select();

	 

		$listecible=[];
		foreach ($tmpProfiles as   $value){
			$listecible [$value->labelcible]=$value->idlistecible ; 
		}
 
		$this->add([
			'type' => Element\MultiCheckbox::class,
			'name' => 'profiles',
			'options' => [
				'label' => 'Cible ?',
				'value_options' => $listecible,
			],
		]);
    	
    }
}