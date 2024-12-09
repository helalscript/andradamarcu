<?php

namespace Database\Seeders;

use App\Models\VocabularyGroup;
use App\Models\VocabularyWord;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VocabularyGroupSeeder extends Seeder
{
    public function run(): void
    {
        VocabularyGroup::factory(20)->create()->each(function ($group) {
            VocabularyWord::factory(20)->create([
                'vocabulary_group_id' => $group->id,
            ]);
        });
    }
}
