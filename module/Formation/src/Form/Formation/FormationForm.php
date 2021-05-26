<?php

declare(strict_types=1);

namespace Formation\Form\Formation;

use Formation\Model\Table\FormationTable;
use Formation\Model\Table\TypeFormationTable;
use Laminas\Form\Form;
use Laminas\Form\Element; 
use Laminas\Db\Adapter\Adapter;
 
//idetapedebase,  ,  , ,  , , , idcontexte
class FormationForm extends Form
{
   protected $adapter; 
   private function FormationListe(): array
	{
		$FormationTable=new FormationTable($this->adapter);
		$FormationRecord=$FormationTable->select();
		$ListeFormation=[];
		foreach($FormationRecord as $p){
			$ListeFormation[$p->idformations]=$p->label;
		}
		return $ListeFormation;
	}       
    private function TypeFormationListe(): array
	{
		$TypeFormationTable=new TypeFormationTable($this->adapter);
		$TypeFormationRecord=$TypeFormationTable->select();
		$TypeListeFormation=[];
		foreach($TypeFormationRecord as $p){
			$TypeListeFormation[$p->idtypeformation]=$p->label;
		}
		return $TypeListeFormation;
	}       
	public function __construct(Adapter $adapter,$name = null)
	{
		parent::__construct('FormationForm');
		$this->adapter=$adapter;

        #Affilié à		
        $this->add([
            'type' => Element\Select::class,
            'name' => 'idperformations',
            'options' => [
                'label' => 'Affilié à ',
                'empty_option' => 'Affilié à...',
                'value_options' =>$this->FormationListe() ,
            ],
            'attributes' => [
                 
                'class' => 'form-control', # styling
            ]
        ]);		
        $this->add([
            'type' => Element\Select::class,
            'name' => 'idtypeformation',
            'options' => [
                'label' => 'Type',
                'empty_option' => 'Type...',
                'value_options' =>$this->TypeFormationListe() ,
            ],
            'attributes' => [
                 
                'class' => 'form-control', # styling
            ]
        ]);		
         


        $this->add([
			'type' => Element\Text::class,
			'name' => 'Label',
			'options' => [
				'label' => 'Intitulé '
			],
			'attributes' => [
				'required' => true, 
				'data-toggle' => 'tooltip',
				'class' => 'form-control input-large',   # styling the text field
				'title' => "Tapez l'intitulé",
				'placeholder' => "Tapez l'intitulé"
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