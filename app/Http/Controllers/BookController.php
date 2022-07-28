<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Services\BookService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class BookController extends Controller
{
    use ApiResponser;

    public $bookService;
    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }

    /**
     * Get All Books
     *
     * @return void
     */
    public function index()
    {
        return $this->successResponse($this->bookService->obtainBooks());
    }

    /**
     * Create Book
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //Author exist validate
        $this->authorService->obtainAuthors((int)$request->author_id);

        return $this->successResponse($this->bookService->createBook($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Get Book by ID
     *
     * @param integer $book
     * @return void
     */
    public function show(int $book)
    {
        return $this->successResponse($this->bookService->obtainBooks($book));
    }

    /**
     * Update Book by ID
     *
     * @param Request $request
     * @param integer $book
     * @return void
     */
    public function update(Request $request, int $book)
    {
        return $this->successResponse($this->bookService->editBook($request->all(), $book));
    }

    /**
     * Delete Book by ID
     *
     * @param integer $book
     * @return void
     */
    public function destroy(int $book)
    {
        return $this->successResponse($this->bookService->deleteBook($book));
    }
}
