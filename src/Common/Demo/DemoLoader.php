<?php
/**
 * Loads Demos metadata
 */

namespace Little\Common\Demo;

class DemoLoader
{
    private $demosFolder;
    private $data;
    private $source;

    public function __construct($demosFolder)
    {
        $this->demosFolder = $demosFolder;
    }

    public function load($file)
    {
        $this->source = file_get_contents($file);

        $comments = $this->getMetaData();

        foreach ($comments as $comment) {
            $comment = str_replace("/*", "", $comment);
            $comment = str_replace("*/", "", $comment);
            $split = explode(':', $comment, 2);
            $key = trim($split[0]);

            $this->data[$key] = $split[1];
        }

        $content = preg_replace('!/\*.*\n?\*/!s', '', $this->source);

        $this->data['file'] = $file;
        $this->data['slug'] = str_replace('.php', '', basename($file));
        $this->data['script'] = basename($file);
        $this->data['code'] = $content;

        return $this->data;
    }

    public function getMetaData()
    {
        $tokens = token_get_all($this->source);
        $comment = [
            T_COMMENT
        ];

        $comments = [];

        foreach ($tokens as $token) {
            if(!in_array($token[0], $comment))
                continue;

            $comments[] = $token[1];
        }

        return $comments;
    }

    public function getDemosMetaData()
    {
        $demos = [];

        foreach (glob($this->demosFolder . '/*.php') as $script) {
            $demos[] = $this->load($script);
        }

        return $demos;
    }
}
