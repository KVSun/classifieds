<?php
namespace KVSun\Classifieds;

class CSV extends \ArrayObject
{
	public function __construct($file)
	{
		if (! file_exists($file)) {
			throw new \InvalidArgumentException("File '{$file}' not found.");
		}
		parent::__construct();
		$this->_parse($file);
	}

	private function _parse($file)
	{
		$fhandle = fopen($file, 'r');
		flock($fhandle, \LOCK_EX);
		$headers = fgetcsv($fhandle);

		while ($row = @fgetcsv($fhandle)) {
			$this->append(array_combine($headers, $row));
		}

		flock($fhandle, \LOCK_UN);
		fclose($fhandle);
	}

	public function __toString()
	{
		return json_encode($this);
	}

	public function __debugInfo()
	{
		return $this->getArrayCopy();
	}
}
