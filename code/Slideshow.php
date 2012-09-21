<?php

class Slideshow extends DataExtension {
	public static $has_many = array('Slides' => 'Slide');

	public function updateCMSFields(FieldList $fields) {
		$config = GridFieldConfig::create();
		$config->addComponent(new GridFieldToolbarHeader());
		$config->addComponent(new GridFieldAddNewButton('toolbar-header-right'));
		$config->addComponent(new GridFieldDataColumns());
		$config->addComponent(new GridFieldEditButton());
		$config->addComponent(new GridFieldDeleteAction());
		$config->addComponent(new GridFieldDetailForm());
		$config->addComponent(new GridFieldSortableHeader());
		$config->addComponent(new GridFieldSortableRows('SortOrder'));


		$gridField = new GridField('Slides', _t('Slideshow.PROMOTIONS', 'Promotions'), $this->owner->Slides(), $config);
		$fields->addFieldToTab('Root', new Tab('Slideshow', _t('Slideshow.SLIDESHOWTAB', 'Slideshow')));
		$fields->addFieldToTab('Root.Slideshow', $gridField);
		return $fields;
	}
}

class Slideshow_Controller extends SiteTreeExtension { 

	public function contentcontrollerInit($controller) {
		if ($this->owner->Slides()) {
			Requirements::javascript(THIRDPARTY_DIR."/jquery/jquery.min.js");
			Requirements::javascript("Slideshow/thirdparty/jquery.cycle.js");
			Requirements::javascript("Slideshow/js/core.js");
			Requirements::css("Slideshow/css/Slideshow.css");
		}
		
	}
}