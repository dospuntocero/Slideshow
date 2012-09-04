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

		$UploadField = new UploadField('Image', _t('Slide.MainImage',"Image"));
		$UploadField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
		$UploadField->setConfig('allowedMaxFileNumber', 1);

		
		if ($this->ID) {
			return new FieldList(
				new TextField('Title',_t('Slide.TITLE',"Title")),
				new TextField('GoToURL',_t('Slide.GOTOURL',"url to redirect the user when clicks on the slide")),
				$UploadField
			);
		}
		else{
			return new FieldList(
				new TextField('Title',_t('Slide.TITLE',"Title")),
				new TextField('GoToURL',_t('Slide.GOTOURL',"url to redirect the user when clicks on the slide")),
				new LiteralField('SaveFirst',_t('Slide.YOUNEEDTOSAVEFIRST',"You will be able to add the image once you save for the first time"))
			);
		}
		
	}
}
