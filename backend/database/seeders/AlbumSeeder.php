<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Album;
use Log;

class AlbumSeeder extends Seeder
{ 
    private $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $albumsData = [
            [
                "title" => "Nandhaka Pieris",
                "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                "img" => "albums/landscape1.jpg",
                "date" => "2015-05-01",
                "featured" => true
            ],
            [
                "title" => "New West Calgary",
                "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                "img" => "albums/landscape2.jpg",
                "date" => "2016-05-01",
                "featured" => false
            ],
            [
                "title" => "Australian Landscape",
                "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                "img" => "albums/landscape3.jpg",
                "date" => "2015-02-02",
                "featured" => false
            ],
            [
                "title" => "Halvergate Marsh",
                "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                "img" => "albums/landscape4.jpg",
                "date" => "2014-04-01",
                "featured" => true
            ],
            [
                "title" => "Rikkis Landscape",
                "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                "img" => "albums/landscape5.jpg",
                "date" => "2010-09-01",
                "featured" => false
            ],
            [
                "title" => "Kiddi Kristjans Iceland",
                "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                "img" => "albums/landscape6.jpg",
                "date" => "2015-07-21",
                "featured" => true
            ]
        ];

        foreach ($albumsData as $album) {
            
            Album::create([
                'user_id' => $this->userId,
                'title' => $album['title'],
                'description' => $album['description'],
                'img' => $album['img'],
                'date' => $album['date'],
                'featured' => $album['featured'],
            ]);
        }
    }
}
