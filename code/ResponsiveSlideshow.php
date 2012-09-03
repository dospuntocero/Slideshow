<?php

class ResponsiveSlideshow extends DataExtension {
	public static $has_many = array('ResponsiveSlides' => 'ResponsiveSlide', );

	public function updateCMSFields(FieldList $f) {

		$config = GridFieldConfig::create();
		$config->addComponent(new GridFieldToolbarHeader());
		$config->addComponent(new GridFieldAddNewButton('toolbar-header-right'));
		$config->addComponent(new GridFieldDataColumns());
		$config->addComponent(new GridFieldEditButton());
		$config->addComponent(new GridFieldDeleteAction());
		$config->addComponent(new GridFieldDetailForm());

		$gridField = new GridField('ResponsiveSlides', _t('Project.TEASERIMAGE', 'Project Image'), $this->owner->ResponsiveSlides(), $config);

		$gridField->getConfig()->getComponentByType('GridFieldDataColumns')->setFieldFormatting(array('Image' => function($val, $obj) {
				if ($obj->hasMethod('Image')) {
					return $obj->owner->ResponsiveSlide()->CMSThumbnail()->getTag();
				} else {
					return $val;
				}
			}
		));

		$f->addFieldToTab('Root', new Tab('Slideshow', _t('ResponsiveSlideshow.SlideshowTab', 'Slideshow')));
		$f->addFieldToTab('Root.Slideshow', $gridField);
		return $f;
	}
	public static function add_to($className) {
		Object::add_extension($className, $this->owner->class);
	}
	public static function remove_from($className) {
		Object::remove_extension($className, $this->owner->class);
	}
}