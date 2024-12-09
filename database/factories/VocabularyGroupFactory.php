<?php

namespace Database\Factories;

use App\Models\Vocabulary;
use App\Models\VocabularyGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VocabularyGroup>
 */
class VocabularyGroupFactory extends Factory
{
    protected $model = VocabularyGroup::class;

    public function definition(): array
    {
        return [
            'vocabulary_id' => Vocabulary::first()->id, 
            'name' => $this->faker->unique('2000')->sentence(3),
        ];
    }
}
