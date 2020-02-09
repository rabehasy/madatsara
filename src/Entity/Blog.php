<?php

namespace App\Entity;

class Blog
{
    protected $title;

    public function __construct($title)
    {
        $this->title  = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }


}
