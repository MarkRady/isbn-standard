<?php

namespace App\Services;

use App\DTOS\BookDTO;
use App\Exceptions\ISBNNotFound;
use GuzzleHttp\Client;

class ISBNService
{
    private string $format = 'json';
    private string $baseUrl = "https://openlibrary.org";
    private string $endpoint = "api/books";

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws ISBNNotFound
     */
    public function getBookByISBN($isbn)
    {

        $query = http_build_query([
            "bibkeys" => "ISBN:{$isbn}",
            "format"  => $this->format,
            "jscmd"   => "data"
        ]);

        $client = new Client();
        $response = $client->request('GET', "{$this->baseUrl}/{$this->endpoint}?{$query}");

        if ($response->getStatusCode() != 200) {
            return throw new ISBNNotFound;
        }

        $data = json_decode($response->getBody(), true);

        // Extract book information from response
        /** @var array $bookData */
        $bookData = $data["ISBN:$isbn"] ?? null;

        if (!$bookData) {
            return throw new ISBNNotFound;
        }

        return new BookDTO($bookData);

    }

}
