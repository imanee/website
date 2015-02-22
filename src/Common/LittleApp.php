<?php
/**
 * LittleApp
 */

namespace Little\Common;

use Little\Common\Demo\DemoLoader;
use Silex\Application;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\Yaml\Parser;

class LittleApp extends Application
{
    protected $configFile;

    public function __construct($configFile, $parameters = [])
    {
        parent::__construct($parameters);

        if (!is_file($configFile)) {
            throw new FileNotFoundException('The config file was not found.');
        }

        $this->configFile = $configFile;
        $this->loadConfig($this->configFile);

        $this['root'] = __DIR__ . '/../../';
    }

    public function loadConfig($configFile)
    {
        $parser = new Parser();

        $this['config'] = $parser->parse(file_get_contents($configFile));
    }
}
