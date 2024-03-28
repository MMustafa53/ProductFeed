<?php

namespace src;

/**
 *
 */
class Request
{
    /**
     * @var string
     */
    protected string $controllerPath = '\src\adapter\\';
    /**
     * @var string
     */
    public string $adapter;
    /**
     * @var string|mixed
     */
    public string $format;
    /**
     * @var Response
     */
    public Response $response;

    /**
     *
     */
    public function __construct()
    {
        $this->response = new Response();
        // Welcome message
        $uri = $_SERVER['REQUEST_URI'];
        if ($uri == '/') {
            echo 'Welcome to the API';
            exit(0);
        }
        // Get the source from the URL
        $adapter = ucfirst(explode('?', substr_replace($uri, '', 0, 1))[0]);

        // Make source path string
        $this->adapter = $this->controllerPath . $adapter . 'Adapter';
        // Get the format from the URL
        $this->format = $_GET['format'] ?? 'json';

    }
}