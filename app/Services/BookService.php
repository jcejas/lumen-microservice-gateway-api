<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;

class BookService
{
    use ConsumesExternalServices;

    /**
     * @var string
     */
    public $baseUri;

    /**
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.books.base_uri');
        $this->secret = config('services.books.secret');
    }

    /**
     * Obtain all books or one book by ID
     *
     * @param integer $book
     * @return void
     */
    public function obtainBooks(int $book = 0)
    {
        if (!empty($book)) {
            return $this->performRequest('GET', "/books/{$book}");
        }

        return $this->performRequest('GET', '/books');
    }

    /**
     * Create book
     *
     * @param array $data
     * @return void
     */
    public function createBook(array $data)
    {
        return $this->performRequest('POST', '/books', $data);
    }

    /**
     * Update book by ID
     *
     * @param array $data
     * @param int $book
     * @return void
     */
    public function editBook(array $data, int $book)
    {
        return $this->performRequest('PUT', "/books/{$book}", $data);
    }

    /**
     * Delete book by ID
     *
     * @param integer $book
     * @return void
     */
    public function deleteBook(int $book)
    {
        return $this->performRequest('DELETE', "/books/{$book}");
    }
}