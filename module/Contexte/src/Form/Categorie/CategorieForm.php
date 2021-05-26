<?php

declare(strict_types=1);

namespace Contexte\Form\Categorie;

use Laminas\Form\Form;
use Laminas\Form\Element;
 

 //access_module_id, moduleroute, module_name, module_descrept, module_afficher, templateattruibute
class CategorieForm extends Form
{
 
	 
	public function __construct($name = null)
	{
		parent::__construct('new_Categorie');

       // idcontextecategorie, labelcontextegrouoe, desccontextecateg
		$this->setAttribute('method', 'post'); 
		$this->add([
			'type' => Element\Text::class,
			'name' => 'idcontextecategorie',
			'options' => [
				'label' => 'Code catégorie'
			],
			'attributes' => [
				'required' => true,
				'size' => 55,
				'maxlength' => 55,
				'pattern' => '^[a-zA-Z0-9.-]+$',  # enforcing what type of data we accept
				'data-toggle' => 'tooltip',
				'class' => 'form-control',   # styling the text field
				'title' => 'Code catégorie',
				'placeholder' => 'Tapez le code unique de catégorie'
			]
		]);
		# action input field
		$this->add([
			'type' => Element\Text::class,
			'name' => 'labelcontextecategorie',
			'options' => [
				'label' => 'Titre de catégorie'
			],
			'attributes' => [
				'required' => true,
				//'size' => 40,
				'maxlength' => 512,
				//'pattern' => '^[a-zA-Z0-9.-]+$',  # enforcing what type of data we accept
				'data-toggle' => 'tooltip',
				'class' => 'form-control',   # styling the text field
				'title' => 'Titre de catégorie',
				'placeholder' => 'Tapez le Titre de catégorie'
			]
		]);
		  


		 

		# add the descreption textarea field
        $this->add([
            'type' => Element\Textarea::class,
            'name' => 'desccontextecategorie',
            'options' => [
                'label' => 'Description'
            ],
            'attributes' => [
                'required' => true,
                'row' => 3,
                'maxlength' => 1048,
                'title' => 'Description de catégorie ',
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

