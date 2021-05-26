<?php

declare(strict_types=1);

namespace User\Form\Profile;

use Laminas\Form\Element;
use Laminas\Form\Form;

class InfoArForm extends Form
{
	public function __construct($name = null)
	{
		parent::__construct('Profile_FR');
		$this->setAttribute('method', 'post');

				# Nom input field
				$this->add([
					'type' => Element\Text::class,
					'name' => 'nom',
					'options' => [
						'label' => 'الإسم',
					],
					'attributes' => [
						'required' => true,
						'size' => 40,
						'maxlength' => 128, 
						'autocomplete' => false,
						'data-toggle' => 'tooltip',
						'class' => 'form-control',
						'title' => 'الإسم',
						'placeholder' => 'الإسم',
					],
				]);
			# Nom input field
			$this->add([
				'type' => Element\Text::class,
				'name' => 'prenom',
				'options' => [
					'label' => 'اللقب',
				],
				'attributes' => [
					'required' => true,
					'size' => 40,
					'maxlength' => 128, 
					'autocomplete' => false,
					'data-toggle' => 'tooltip',
					'class' => 'form-control',
					'title' => 'اللقب',
					'placeholder' => 'اللقب',
				],
			]);
		# Nom input field
		$this->add([
			'type' => Element\Text::class,
			'name' => 'lieudenaissance',
			'options' => [
				'label' => 'مكان الولادة',
			],
			'attributes' => [
				'required' => true,
				'size' => 40,
				'maxlength' => 128, 
				'autocomplete' => false,
				'data-toggle' => 'tooltip',
				'class' => 'form-control',
				'title' => 'مكان الولادة',
				'placeholder' => 'مكان الولادة',
			],
		]);
		
			# add the comment textarea field
			$this->add([
				'type' => Element\Textarea::class,
				'name' => 'adress',
				'options' => [
					'label' => 'العنوان '
				],
				'attributes' => [
					//'required' => true,
					'row' => 3,
					'maxlength' => 500,
					'title' => "العنوان" ,
					'class' => 'العنوان',
					'placeholder' => 'العنوان...'
				],
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

		# submit button
		$this->add([
			'type' => Element\Submit::class,
			'name' => 'enregistrer',
			'attributes' => [
				'value' => 'تسجل',
				'class' => 'btn btn-flat btn-info text-white'
			]
		]);
	}
}



