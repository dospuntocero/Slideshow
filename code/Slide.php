<?php

class Slide extends DataObject {
	public static $db = array(
		'Title' => 'Varchar',
		"SortOrder" => "Int",
		"GoToURL" => "Text",
	);
	public static $has_one = array(
		'Image' => 'Image',
		"Page" => "Page"
	);
	
	static $summary_fields = array(
		'Thumbnail' => 'Thumbnail',
		'Title' => 'Alternate text'
	);
	
	function getThumbnail() {
		if (((int) $this->ImageID > 0) && (is_a($this->Image(),'Image')))  {
			return $this->Image()->CMSThumbnail();
		} else {
			return _t('Slide.NOTHUMBNAILSAVAILABLE',"No thumbnails available") ;
		}
	}
	
	public function getCMSFields(){
		$fields = parent::getCMSFields();
		
		//remove unused fields
		$fields->removeByName('Image'); //this is added manually later
		$fields->removeByName('SortOrder');
		$fields->removeByName('PageID');
		
		//replace existing fields with own versions
		$fields->replaceField('Title', new TextField('Title',_t('Slide.TITLE',"Title")));
		$fields->replaceField('GoToURL', new TextField('GoToURL',_t('Slide.GOTOURL',"url to redirect the user when clicks on the slide")));
		
		//adding upload field - if slide has already been saved
		if ($this->ID) {
			$UploadField = new UploadField('Image', _t('Slide.MainImage',"Image"));
			$UploadField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
			$UploadField->setConfig('allowedMaxFileNumber', 1);
			$fields->push($UploadField);
		} else {
			$fields->push(new LiteralField('SaveFirst',_t('Slide.YOUNEEDTOSAVEFIRST',"You will be able to add the image once you save for the first time")));
		}
		
		return $fields;
	}
}
