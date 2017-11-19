<?php

namespace AndreySerdjuk\Entity;

class Book
{
    /** @var  int */
    protected $id;

    /** @var  string */
    protected $title;

    /** @var  string */
    protected $author;

    public function __construct(int $id, string $title, string $author)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }
}
