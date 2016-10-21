<?php
namespace KVSun\Classifieds;

class ClassList
{
	const ALLOWED_TAGS = '<b><p><div><br><hr>';

	const CATEGORIES = array();

	const EXT = 'html';

	private $_dir = '';

	private $_classifieds = array();

	public function __construct($dir)
	{
		if (is_dir($dir)) {
			$this->_dir = $dir;
		}
	}

	private function _scan($dir, $ext = self::EXT)
	{
		return glob("*.{$ext}");
	}
}
