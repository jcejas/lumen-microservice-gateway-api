<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;

class AuthorService
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
        $this->baseUri = config('services.authors.base_uri');
        $this->secret = config('services.authors.secret');
    }

    /**
     * Obtain all authors or one author by ID
     *
     * @param integer $author
     * @return void
     */
    public function obtainAuthors(int $author = 0)
    {
        if (!empty($author)) {
            return $this->performRequest('GET', "/authors/{$author}");
        }

        return $this->performRequest('GET', '/authors');
    }

    /**
     * Create Author
     *
     * @param array $data
     * @return void
     */
    public function createAuthor(array $data)
    {
        return $this->performRequest('POST', '/authors', $data);
    }

    /**
     * Update Author by ID
     *
     * @param array $data
     * @param int $author
     * @return void
     */
    public function editAuthor(array $data, int $author)
    {
        return $this->performRequest('PUT', "/authors/{$author}", $data);
    }

    /**
     * Delete Author by ID
     *
     * @param integer $author
     * @return void
     */
    public function deleteAuthor(int $author)
    {
        return $this->performRequest('DELETE', "/authors/{$author}");
    }
}