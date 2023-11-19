Laravel-based Book Query API using OpenLibrary and Docker
=========================================================

Introduction
------------

This project is a Laravel  API designed for querying book information by ISBN numbers using the OpenLibrary API. It is containerized using Docker for easy setup and deployment, with Nginx and PHP-FPM as the main components.

Tech Stack
----------

*   **Laravel v10.x**: PHP web application framework for building the API.
*   **OpenLibrary API**: Provides book information, accessed using ISBN numbers.
*   **Docker**: Containerization of the application.
*   **Nginx**: High-performance HTTP server and reverse proxy.
*   **PHP-FPM v8.1**: FastCGI Process Manager for PHP.

Docker Containers Details
----------------------

The `docker-compose.yml` file configures the following services:

*   **nginx**: Serves the Laravel application for port 8080 on host machine.
*   **php**: PHP-FPM service for PHP requests.

Each service's Dockerfile specifies its environment, dependencies, and configurations.

Setup and Installation
----------------------

### Prerequisites

*   Docker and Docker Compose installed on your machine.
*   port 8080 available on your machine

### Steps

1.  **Clone the Repository**
    
    ```bash
    git clone git@github.com:MarkRady/isbn-standard.git
    ```
    
2.  **Navigate to Project Directory**
    ```bash
    cd isbn-standard
    ```
3.  **Build and Run Containers**
    ```bash
    `docker-compose up --build`
    ```

Running the Application
-----------------------

The application is accessible via `http://localhost:8080` once the containers are up and running.

### Testing the API

Use the following `curl` command to test the book query functionality:
```bash
`curl --location 'http://localhost:8080/api/book/9780712676090' \ --header 'Accept: application/json'`
```

This requests the book information for the specified ISBN number.

### Sample Response

1.  **Success Response with (HTTP CODE 200)**
```json
{
    "book": {
        "title": "Good to Great",
        "url": "https://openlibrary.org/books/OL7794753M/Good_to_Great"
    }
}
```
2.  **Invalid ISBN Response with (HTTP CODE 400)**
```json
{
    "message": "Invalid ISBN number"
}
```
3.  **Not found book Response with (HTTP CODE 404)**
```json
{
    "message": "Your booking not found"
}
```


This format should be suitable for inclusion in a GitHub repository or similar version control system.