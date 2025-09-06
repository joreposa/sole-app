<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

use App\Models\Publisher;
use App\Models\Author;
use App\Models\Book;
use App\Models\Profile;
use App\Models\Image;
use App\Models\Note;
use App\Models\Genre;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Limpia y crea el directorio de imágenes
        Storage::deleteDirectory('public/images');
        Storage::makeDirectory('public/images');
        
        // 2. Ejecuta los seeders principales y crea las dependencias primero
        $this->call(GenreSeeder::class);
        $this->call(UserSeeder::class); // Esto crea los usuarios
        Publisher::factory(5)->create(); // Esto crea los publishers
        Author::factory(10)->create(); // Esto crea los autores

        // 3. Crea registros con relaciones
        // Ahora, BookFactory puede encontrar publishers y genres existentes
        User::factory(10)
            ->hasAttached(
                Author::factory()->count(2), 
                ['number_star' => rand(1, 5)]
            )
            ->hasAttached(
                Book::factory()->count(2), 
                ['number_star' => rand(1, 5)]
            )
            ->create();

        // Asegúrate de que los autores y los libros tengan imágenes
        Author::factory(5)
            ->has(Book::factory()->count(2))
            ->has(Image::factory()->count(1))
            ->create();

        Profile::factory(4)->create();
        Note::factory(10)->create();
    }
}