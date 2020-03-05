<?php

namespace App\Exceptions;

use Exception;

class InvalidRequestException extends Exception
{

    public function report()
    {

    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof InvalidRequestException) {
            return response()->view('errors.default', compact('exception'));
        }
    }
}