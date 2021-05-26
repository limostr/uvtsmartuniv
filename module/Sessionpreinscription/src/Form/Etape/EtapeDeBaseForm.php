<?php

declare(strict_types=1);

namespace Sessionpreinscription\Form\Etape;

use Contexte\Model\Table\ContexteTable;
use Laminas\Form\Form;
use Laminas\Form\Element; 
use Laminas\Db\Adapter\Adapter;
 
//idetapedebase,  ,  , ,  , , , idcontexte
class EtapeDeBaseForm extends Form
{
   protected $adapter; 
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
		parent::__construct('EtapeDeBas');
		$this->adapter=$adapter;

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
                 
                'class' => 'form-control', # styling
            ]
        ]);		
        $this->add([
			'type' => Element\Checkbox::class,
			'name' => 'dynamiqueetape',
			'options' => [
				'label' => "Etape dynamique",
				'label_attributes' => [
					'class' => 'custom-control-label'
				],
				'use_hidden_element' => true,
				'checked_value' => 1, 
				'unchecked_value' => 0,
			],
			'attributes' => [
				'value' => 0,
				'id' => 'dynamiqueetape', 
				'class' => 'custom-control-input'
			]
		]);


        $this->add([
			'type' => Element\Text::class,
			'name' => 'idetapedebase',
			'options' => [
				'label' => 'Code etape'
			],
			'attributes' => [
				'required' => true, 
				'data-toggle' => 'tooltip',
				'class' => 'form-control input-large',   # styling the text field
				'title' => 'Code etape',
				'placeholder' => 'Tapez le Code etape'
			]
		]);
        $this->add([
			'type' => Element\Text::class,
			'name' => 'linkstatic',
			'options' => [
				'label' => 'Lien statique'
			],
			'attributes' => [ 
				'data-toggle' => 'tooltip',
				'class' => 'form-control input-large',   # styling the text field
				'title' => 'Lien statique',
				'placeholder' => 'Tapez le Lien statique'
			]
		]);

        

        $this->add([
			'type' => Element\Text::class,
			'name' => 'labeletapebase',
			'options' => [
				'label' => "Titre de l'etape"
			],
			'attributes' => [
				'required' => true, 
				'data-toggle' => 'tooltip',
				'class' => 'form-control input-large',   # styling the text field
				'title' => "Titre de l'etape",
				'placeholder' =>  "Tapez le Titre de l'etape "
			]
		]);


        
        $this->add([
            'type' => Element\Textarea::class,
            'name' => 'contenueetape',
            'options' => [
                'label' => "Contenu de l'etape"
            ],
            'attributes' => [
                'required' => true,
                'row' => 12,
                'maxlength' => 500,
                'title' => "Contenu de l'etape",
                'class' => 'form-control',
                'placeholder' => "Contenu de l'etape....."
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
                'row' => 12,
                'maxlength' => 500,
                'title' => 'Description ',
                'class' => 'form-control',
                'placeholder' => 'Description...'
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