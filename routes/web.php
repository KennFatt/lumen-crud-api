<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


/**
 * Retrieve all authors data.
 *
 * @access GET /authors
 */
$router->get("/authors", "AuthorController@index");

/**
 * Retrieve one author data.
 *
 * @access GET /authors/{authorId: int}
 */
$router->get("/authors/{authorId}", "AuthorController@show");


/**
 * Store new author data.
 *
 * @access POST /authors
 */
$router->post("/authors", "AuthorController@store");


/**
 * Update existing author data.
 *
 * NOTE: For now both routes will act like PATCH (partial update is allowed).
 *
 * @access PUT /authors/{authorId: int}
 * @access PATCH /authors/{authorId: int}
 */
$router->put("/authors/{authorId}", "AuthorController@update");
$router->patch("/authors/{authorId}", "AuthorController@update");

/**
 * Delete one author data.
 *
 * @access DELETE /authors/{authorId: int}
 */
$router->delete("/authors/{authorId}", "AuthorController@destroy");
