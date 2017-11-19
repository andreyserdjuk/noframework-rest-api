<?php

use AndreySerdjuk\Entity\Book;
use AndreySerdjuk\HttpFoundation\JsonReponse;
use AndreySerdjuk\HttpFoundation\Request;
use AndreySerdjuk\HttpFoundation\RequestInterface;
use AndreySerdjuk\HttpKernel\Kernel;

require_once __DIR__.'/../autoload/psr4.php';

$app = new \AndreySerdjuk\App();

$app
    ->on(
        RequestInterface::METHOD_GET,
        '/^\/books\/(\d+)$/',
        function(RequestInterface $request, $args, Kernel $kernel) {
            $book = $kernel->getBookRepository()->find($args[1]);
            $normalized = [];
            if ($book instanceof Book) {
                $normalized['id'] = $book->getId();
                $normalized['author'] = $book->getAuthor();
                $normalized['title'] = $book->getTitle();
            }
            return new JsonReponse($normalized, JsonReponse::HTTP_OK, [], JSON_PRETTY_PRINT);
        }
    )
    ->on(
        RequestInterface::METHOD_GET,
        '/^\/books\/?$/',
        function(RequestInterface $request, $args, Kernel $kernel) {
            $books = $kernel->getBookRepository()->findAll();
            $normalized = [];
            foreach ($books as $book) {
                $normalized[] = [
                    'id' => $book->getId(),
                    'author' => $book->getAuthor(),
                    'title' => $book->getTitle(),
                ];
            }
            return new JsonReponse(['books' => $normalized], JsonReponse::HTTP_OK, [], JSON_PRETTY_PRINT);
        }
    )
;

$request = Request::fromGlobals();
$response = $app->handle($request);
$response->send();
