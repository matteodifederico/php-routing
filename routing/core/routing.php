<?php

class Routing
{
    public $resources;
    public bool $handled = false;
    public string $basePath;
    public array $protectedFolders = [];

    public function __construct($resources, $basePath, $protectedFolders)
    {
        $this->resources = $resources;
        $this->basePath = $basePath;
        $this->protectedFolders = $protectedFolders;
    }

    public function Route(string $method, string $endpoint, string $path)
    {
        if($_SERVER['REQUEST_METHOD'] != $method)
            return false;
        $server = $_SERVER['REQUEST_URI'];
        if(str_contains($server, '?'))
            $server = explode('?', $server)[0];
        if($server == $endpoint)
        {
            $this->handled = true;
            return include_once $this->basePath . $path;
        }
    }

    public function __destruct()
    {
        if(!$this->handled)
        {
            foreach ($this->protectedFolders as $protectedFolder)
            {
                if(str_contains($_SERVER['REQUEST_URI'], '/' . $protectedFolder))
                    return include_once $this->basePath . '401.php';
            }
            return include_once $this->basePath . '404.php';
        }
    }
}