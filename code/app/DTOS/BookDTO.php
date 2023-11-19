<?php

namespace App\DTOS;

class BookDTO
{
    public string $title;
    public string $url;

    public function __construct(array $bookData)
    {
        $this->title = $bookData['title'];
        $this->url = $bookData['url'];
    }

}
