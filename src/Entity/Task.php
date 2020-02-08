<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as MyAssert;
use Symfony\Component\Validator\Constraints\GroupSequence;
use Symfony\Component\Validator\GroupSequenceProviderInterface;

/**
 * @Assert\GroupSequence({"Task", "Strict"})
 */
class Task implements GroupSequenceProviderInterface
{
    /**
     * @Assert\NotBlank;
     * @Assert\Length(max = 5);
     * @MyAssert\ContainsAlphanumeric
     */
    protected $task;

    /**
     * @Assert\NotBlank(payload={"security"="error"});
     * @Assert\Length(max = 20);
     */
    protected $todo;


    /**
     * @Assert\NotBlank;
     * @Assert\Type("\DateTime", groups={"Special"})
     */
    protected $dueDate;

    protected $docFile;

    protected $tags;

    protected $tags2;

    protected $tags3;

    protected $issue;

    /**
     * @Assert\Type(type="App\Entity\Category")
     * @Assert\Valid
     */
    protected $category;


    public function __construct()
    {
        $this->tags3 = new ArrayCollection();
    }

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

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
    }
    public function getTags2()
    {
        return $this->tags2;
    }

    public function setTags2($tags2)
    {
        $this->tags2 = $tags2;
    }

    public function getIssue()
    {
        return $this->issue;
    }

    public function setIssue($issue)
    {
        $this->issue = $issue;
    }


    /**
     * @Assert\IsTrue(message="isTodoTaskSame(): Task and Todo must be different", groups={"Strict"})
     */
    public function isTodoTaskSame()
    {
        return ($this->task === $this->todo);
    }

    /**
     * Returns which validation groups should be used for a certain state
     * of the object.
     *
     * @return string[]|string[][]|GroupSequence An array of validation groups
     */
    public function getGroupSequence()
    {
        return ['Task', 'Special'];
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getTags3()
    {
        return $this->tags3;
    }

    public function addTag3(Tag3 $tag3)
    {
        $this->tags3->add($tag3);
    }

    public function removeTag3(Tag3 $tag3)
    {
        //
    }
}
