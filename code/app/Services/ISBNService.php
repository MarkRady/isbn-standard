<?php

namespace App\Services;

use App\DTOS\BookDTO;
use App\Exceptions\ISBNNotFound;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class ISBNService
{

    const TTL = 600;

    private string $format = 'json';
    private string $baseUrl = "https://openlibrary.org";
    private string $endpoint = "api/books";

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws ISBNNotFound
     */
    public function getBookByISBN($isbn)
    {

        $bookKey = "ISBN:{$isbn}";

        $bookData = Cache::get($bookKey);

        if($bookData) return new BookDTO($bookData);


        $query = http_build_query([
            "bibkeys" => $bookKey,
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
        $bookData = $data[$bookKey] ?? null;

        if (!$bookData) {
            return throw new ISBNNotFound;
        }

        Cache::put($bookKey, $bookData, self::TTL);

        return new BookDTO($bookData);

    }

}
