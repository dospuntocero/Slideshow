<?php

class ResponsiveSlide extends DataObject {
	public static $db = array(
		'Title' => 'Varchar',
		'Content' => 'HTMLText',
	);
	public static $has_one = array(
		'Image' => 'Image',
		'Parent' => 'SiteTree',
	);
}
