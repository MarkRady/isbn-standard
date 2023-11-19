<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ISBNNotFound extends Exception
{
    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request): Response
    {
        return response(['message' => 'Your booking not found'], 404);
    }
}
