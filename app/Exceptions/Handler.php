<?php

namespace App\Exceptions;

use App\Http\Controllers\ControllerBase;

use App\Http\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


    /*public function report(Throwable $e)
    {

    }*/

//    public function render($request, Throwable $e)
//    {
//        return Response::json($e->getMessage(), $e->getCode());
//    }
}
