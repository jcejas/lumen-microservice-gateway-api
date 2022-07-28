<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    use ApiResponser;

    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Get All Authors
     *
     * @return void
     */
    public function index()
    {
        return $this->successResponse($this->authorService->obtainAuthors());
    }

    /**
     * Create Author
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->authorService->createAuthor($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Get Author by ID
     *
     * @param integer $author
     * @return void
     */
    public function show(int $author)
    {
        return $this->successResponse($this->authorService->obtainAuthors($author));
    }

    /**
     * Update Author by ID
     *
     * @param Request $request
     * @param integer $author
     * @return void
     */
    public function update(Request $request, int $author)
    {
        return $this->successResponse($this->authorService->editAuthor($request->all(), $author));
    }

    /**
     * Delete Author by ID
     *
     * @param integer $author
     * @return void
     */
    public function destroy(int $author)
    {
        return $this->successResponse($this->authorService->deleteAuthor($author));
    }
}
