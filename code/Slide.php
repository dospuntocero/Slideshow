<?php

class Slide extends DataObject {
	public static $db = array(
		'Title' => 'Varchar',
		"SortOrder" => "Int",
		"GoToURL" => "Text",
		"Archived" => "Boolean",
	);
	public static $has_one = array(
		'Image' => 'Image',
		"Page" => "Page"
	);

	static $default_sort = 'SortOrder';
	
	static $field_labels = array(
		'Title' => 'Alternate text'	
	);
	
	static $summary_fields = array(
		'Thumbnail',
		'Title'
	);
	
	function getThumbnail() {
		if (((int) $this->ImageID > 0) && (is_a($this->Image(),'Image')))  {
	   return $this->Image()->SetWidth(50); 
		} else {
			return _t('Slide.NOTHUMBNAILSAVAILABLE',"No thumbnails available") ;
		}
	}
	
	function ArchivedReadable(){
		if($this->Archived == 1) return _t('GridField.Archived', 'Archived');
		return _t('GridField.Live', 'Live');
	}
	
	
	
	public function getCMSFields(){
		$fields = parent::getCMSFields();
		
		//remove unused fields
		$fields->removeByName('Image'); //this is added manually later
		$fields->removeByName('SortOrder');
		$fields->removeByName('PageID');
		$fields->removeByName('Archived');
		
		//replace existing fields with own versions
		$fields->replaceField('Title', new TextField('Title',_t('Slide.TITLE',"Title")));
		$fields->replaceField('GoToURL', new TextField('GoToURL',_t('Slide.GOTOURL',"url to redirect the user when clicks on the slide")));
		
		$fields->addFieldToTab('Root.Main', $group = new CompositeField(
			$label = new LabelField("LabelArchive","Archive this carousel item?"),
			new CheckboxField('Archived', '')
		));
		
		$UploadField = new UploadField('Image', _t('Slide.MainImage',"Image"));
		$UploadField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
		$UploadField->setConfig('allowedMaxFileNumber', 1);
		$UploadField->setFolderName("Slides");
	
		$fields->push($UploadField);
		
		//allow extending this object with another 
		$this->extend('updateCMSFields', $fields);
		
		return $fields;
	}
}
