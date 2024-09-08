
# Map.ir Full-Text Search Implementation

This project demonstrates the implementation of **Full-Text Search** in a PostgreSQL database using PostgreSQL extensions, avoiding the use of `LIKE` queries for textual search. The project has been dockerized for easy setup and usage.

## Features

- **Full-Text Search**: Implemented using PostgreSQL extensions for efficient and scalable search functionality.
- **PostgreSQL Extensions**: Relevant extensions have been installed to support full-text search.
- **Dockerized Environment**: The project is fully containerized using Docker, making it easy to set up and run locally.
- **Data Seeders**: Pre-populated test data to demonstrate search functionality.

## Installation

### Prerequisites

- [Docker](https://www.docker.com/) installed on your system.
- [Docker Compose](https://docs.docker.com/compose/) installed.

### Setup

1. Clone the repository:

   ```bash
   git clone https://github.com/amirhoseinTaghizadeh/map.ir.git
   cd map.ir
   ```

2. Build and run the Docker containers:

   ```bash
   docker compose build && docker compose up
   ```

3. Run the database seeders to populate the test data:

   ```bash
   docker compose exec -it map-laravel-app php artisan db:seed
   ```

   This will seed the database with test data required for the full-text search functionality.

## PostgreSQL Extensions

To enable full-text search, the following PostgreSQL extensions have been installed:

- **pg_trgm**: Provides text similarity search operators and functions.
- **tsvector**: Used for full-text search indexing and querying.

These extensions are used to implement full-text search across your database tables efficiently, avoiding the performance issues commonly associated with `LIKE` queries.

## Usage

Once the Docker containers are up and the database is seeded, you can test the full-text search functionality via the provided API routes or directly within your application.

## Commands

To bring up the project and run the seeders:

```bash
docker compose build && docker compose up
docker compose exec -it map-laravel-app php artisan db:seed
```

These commands will build and start the project in a Docker environment and populate the database with test data for the full-text search.

