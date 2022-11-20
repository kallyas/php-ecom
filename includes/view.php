<?php

class View
{
    private $template;
    private $data;

    public function __construct($template, $data)
    {
        $this->template = $template;
        $this->data = $data;
    }

    public function render()
    {
        $template = $this->template;
        $data = $this->data;
        include 'templates/' . $template . '.php';
    }
}