<?php

namespace App\Exceptions;

use App\Traits\ApiResponder;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponder;

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        /**
         * HTTP Exception:
         * - code
         * - message respective to the code
         */
        if ($exception instanceof HttpException) {
            $statusCode = $exception->getCode();
            $statusMessage = Response::$statusTexts[$statusCode];

            return $this->responseError($statusMessage, $statusCode);
        }

        /**
         * Model Not Found Exception:
         * - model name
         * - HTTP_NOT_FOUND
         *
         * This is used to handle when `::findOrFail()` throws an error.
         */
        if ($exception instanceof ModelNotFoundException) {
            $model = $exception->getModel();
            $stringModel = strtolower(class_basename($model));

            return $this->responseError(
                "The {$stringModel} you're looking for is not found!",
                Response::HTTP_NOT_FOUND
            );
        }

        /**
         * Authorization Exception:
         * - message
         * - HTTP_FORBIDDEN
         */
        if ($exception instanceof AuthorizationException) {
            return $this->responseError(
                $exception->getMessage(),
                Response::HTTP_FORBIDDEN
            );
        }

        /**
         * Authentication Exception:
         * - message
         * - HTTP_UNAUTHORIZED
         */
        if ($exception instanceof AuthenticationException) {
            return $this->responseError(
                $exception->getMessage(),
                Response::HTTP_UNAUTHORIZED
            );
        }

        /**
         * Validation Exception:
         * - messages of invalidated keys
         * - HTTP_UNPROCESSABLE_ENTITY
         *
         * This is used to handle when `Controller::validate()` throws an error.
         */
        if ($exception instanceof ValidationException) {
            $errors = $exception->validator->errors()->getMessages();

            return $this->responseError($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /**
         * Fallback for all exceptions.
         * It will be vary depending the application debug mode.
         *
         * If it _is_ in debug mode, we should verbose the exception.
         *  Otherwise, just a message.
         */
        $isDebug = env("APP_DEBUG", false);

        return $isDebug
            ? parent::render($request, $exception)
            : $this->responseError("Something went wrong. Try again.", Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
