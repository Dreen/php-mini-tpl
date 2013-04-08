<?php
/**
 * minimalistic template class. no fuss. no bells. no whistles.
 * tags: {tag}
 * @url https://github.com/Dreen/php-mini-tpl
 * @author Grzegorz Balaga <dreen1@gmail.com>
 */
class tpl
{
	/**
	 * The Only Setting: default template directory
	 */
	var $tplDir = 'tpl';
	
	/**
	 * Array of replace symbols (dictionary)
	 */
	var $symbols;
	
	/**
	 * Path to template file
	 */
	private $tplFile;
	
	/**
	 * Constructor
	 * @param $tplName Name of template file. If ends in ".tpl" then used as path to template file. Otherwise path constructed as "$tplDir/$tplName.tpl"
	 */
	function tpl ($tplName = 'main')
	{
		$this->tplFile = (substr($tplName, -4) == '.tpl') ? $tplName : $this->tplDir . '/' . $tplName . '.tpl';
		$this->symbols = array();
	}
	
	/**
	 * Add a replace symbol. The parameters are self-explanatory.
	 */
	function add ($name, $value='')
	{
		$this->symbols[$name] = $value;
	}
	
	/**
	 * Build the template file, apply known symbols, return result
	 * @return The result
	 */
	function build ()
	{
		if (!is_readable($this->tplFile))
			return false;
		else
			$tpl = file_get_contents ($this->tplFile);
		
		foreach ($this->symbols as $name => $value)
		{
			$tpl = str_replace('{' . $name . '}',$value,$tpl);
		}
		
		return $tpl;
	}
}

?>
