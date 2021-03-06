<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Config_Yaml extends Config_Reader {

	// Configuration group name
	protected $_configuration_group;

	// Has the config group changed?
	protected $_configuration_modified = FALSE;

	public function __construct($directory = 'config')
	{
		// Set the configuration directory name
		$this->_directory = trim($directory, '/');

		// Load the empty array
		parent::__construct();
	}

	/**
	 * Load and merge all of the configuration files in this group.
	 *
	 *     $config->load($name);
	 *
	 * @param   string  configuration group name
	 * @param   array   configuration array
	 * @return  $this   clone of the current object
	 * @uses    Kohana::load
	 */
	public function load($group, array $config = NULL)
	{
		if ($files = Kohana::find_file($this->_directory, $group, 'yaml', TRUE))
		{
			// Initialize the config array
			$config = array();

			foreach ($files as $file)
			{
				// Merge each file to the configuration array
				$config = Arr::merge($config, yaml_parse_file($file));
			}
		}

		return parent::load($group, $config);
	}

} // End Kohana_Config_Yaml
