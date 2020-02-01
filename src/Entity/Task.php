<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Task
{
    /**
     * @Assert\NotBlank;
     * @Assert\Length(max = 5);
     */
    protected $task;

    /**
     * @Assert\NotBlank;
     * @Assert\Length(max = 20);
     */
    protected $todo;


    /**
     * @Assert\NotBlank;
     * @Assert\Type("\DateTime")
     */
    protected $dueDate;

    protected $docFile;

    public function getTask()
    {
        return $this->task;
    }

    public function setTask($task)
    {
        $this->task = $task;
    }

    public function getTodo()
    {
        return $this->todo;
    }

    public function setTodo($todo)
    {
        $this->todo = $todo;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTime $dueDate = null)
    {
        $this->dueDate = $dueDate;
    }

    public function getDocFile()
    {
        return $this->docFile;
    }

    public function setDocFile($docFile)
    {
        $this->docFile = $docFile;
    }
}
