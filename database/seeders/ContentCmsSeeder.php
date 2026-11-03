<?php

namespace Database\Seeders;

use App\Models\ContentCMS;
use Illuminate\Database\Seeder;

class ContentCmsSeeder extends Seeder
{
    public function run()
    {
        // Seeding for "privacy_policy"
        ContentCMS::insert([
            ['type' => 'privacy_policy','position' =>1,'content' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'],
            ['type' => 'privacy_policy','position' =>2,'content' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'],
            ['type' => 'privacy_policy','position' =>3,'content' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'],
            ['type' => 'privacy_policy','position' =>4,'content' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'],
            ['type' => 'privacy_policy','position' =>5,'content' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'],
        ]);

        // Seeding for "how_to_use"
        ContentCMS::insert([
            ['type' => 'how_to_use','position' =>1,'content' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'],
            ['type' => 'how_to_use','position' =>2,'content' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'],
            ['type' => 'how_to_use','position' =>3,'content' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'],
            ['type' => 'how_to_use','position' =>4,'content' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'],
            ['type' => 'how_to_use','position' =>5,'content' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'],
        ]);

    }
}
