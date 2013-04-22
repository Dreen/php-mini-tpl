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
		if (!file_exists($this->tplFile))
			throw new Exception('Template "'.$this->tplFile.'" not found.');
		$this->symbols = array();
	}
	
	/**
	 * Add replace symbol(s).
	 */
	function add ($name, $value='')
	{
		if (is_array($name))
		{
			foreach ($name as $subName => $value)
			{
				$this->add($subName, $value);
			}
		}
		else
		{
			$this->symbols[$name] = $value;
		}
		
		return $this;
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

function tpl($tplName)
{
	return new tpl($tplName);
}

?>
