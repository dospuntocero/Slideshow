<?php

class ResponsiveSlide extends DataObject {
	public static $db = array(
		'Title' => 'Varchar',
		"SortOrder" => "Int",
	);
	public static $has_one = array(
		'Image' => 'Image',
		'RelatedTo' => 'DOArticle',
	);
}
