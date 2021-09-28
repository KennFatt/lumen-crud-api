<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    public function index(): ?JsonResponse
    {
        $authors = Author::all()->toArray();

        return $this->responseSucceed($authors);
    }

    public function show(int $authorId): ?JsonResponse
    {
        return null;
    }

    public function store(Request $req): ?JsonResponse
    {
        return null;
    }

    public function update(Request $req, int $authorId): ?JsonResponse
    {
        return null;
    }

    public function destroy(int $authorId): ?JsonResponse
    {
        return null;
    }
}
