<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comic;

class ComicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datiFumetti = config('comics.arrayComics');
        foreach ($datiFumetti as $elem) {
            $newComic = new Comic();
            $newComic->title = $elem['title'];
            $newComic->description = $elem['description'];
            $newComic->thumb = $elem['thumb'];
            $newComic->price = $elem['price'];
            $newComic->series = $elem['series'];
            $newComic->sale_date = $elem['sale_date'];
            $newComic->type = $elem['type'];
            $newComic->save();
        }
    }
}