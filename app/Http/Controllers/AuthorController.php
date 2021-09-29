<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    use ApiResponder;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Retrieve all authors record.
     *
     * @access GET /authors
     */
    public function index(): ?JsonResponse
    {
        $authors = Author::all()->toArray();

        return $this->responseSucceed($authors);
    }

    /**
     * Retrieve one author record.
     *
     * @access GET /authors/{authorId}
     */
    public function show(int $authorId): ?JsonResponse
    {
        $author = Author::findOrFail($authorId);

        return $this->responseSucceed([$author]);
    }

    /**
     * Create new author record.
     * The request header field `Content-Type: multipart/form-data`
     *
     * For more information about `form-data` vs. `x-www-form-urlencoded` please read this
     *  answer: https://stackoverflow.com/a/4073451/6569706
     *
     * @access POST /authors
     */
    public function store(Request $req): ?JsonResponse
    {
        $rules = [
            "name" => "required|max:255",
            "gender" => "required|max:255|in:male,female",
            "country" => "required|max:255"
        ];

        $this->validate($req, $rules);

        $author = Author::create($req->all());

        return $this->responseSucceed([$author], Response::HTTP_CREATED);
    }

    /**
     * Update existing record with the new one.
     * The request header field `Content-Type: application/x-www-form-urlencoded`
     *
     * For more information about `form-data` vs. `x-www-form-urlencoded` please read this
     *  answer: https://stackoverflow.com/a/4073451/6569706
     *
     * @access PATCH /authors/{authorId}
     * @access PUT /authors/{authorId}
     */
    public function update(Request $req, int $authorId): ?JsonResponse
    {
        $rules = [
            "name" => "max:255",
            "gender" => "max:255|in:male,female",
            "country" => "max:255"
        ];

        $this->validate($req, $rules);

        $author = Author::findOrFail($authorId);
        $author->fill($req->all());
        if ($author->isClean()) {
            return $this->responseError(
                "Nothing changes. Please try again.",
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        $author->save();

        return $this->responseSucceed([$author]);
    }

    /**
     * Delete an author record.
     *
     * @access DELETE /authors/{authorId}
     */
    public function destroy(int $authorId): ?JsonResponse
    {
        $author = Author::findOrFail($authorId);
        $author->delete();

        return $this->responseSucceed([$author]);
    }
}
