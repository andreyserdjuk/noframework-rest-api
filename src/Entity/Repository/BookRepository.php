<?php

namespace AndreySerdjuk\Entity\Repository;

use AndreySerdjuk\Entity\Book;

class BookRepository
{
    public function find(int $id): ?Book
    {
        return ($id > 0 && $id < 10)
            ? $this->fromId($id)
            : null
        ;
    }

    /**
     * @return Book[]
     */
    public function findAll(): array
    {
        $books = [];
        foreach(range(1, 10) as $id) {
            $books[] = $this->fromId($id);
        }

        return $books;
    }

    private function fromId($id)
    {
        return new Book(
            $id,
            'title-'.$id,
            'author-'.$id
        );
    }
}
