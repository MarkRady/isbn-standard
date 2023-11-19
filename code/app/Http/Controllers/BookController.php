<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidISBNNumber;
use App\Services\ISBNService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private ISBNService $ISBN_service;

    /**
     * @param ISBNService $ISBN_service
     */
    public function __construct(ISBNService $ISBN_service)
    {
        $this->ISBN_service = $ISBN_service;
    }

    public function index($isbn)
    {
        if (!preg_match('/^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$/', $isbn)) {
            throw new InvalidISBNNumber;
        }

        return response([
            'book' => $this->ISBN_service->getBookByISBN($isbn)
        ], 200);
    }
}
