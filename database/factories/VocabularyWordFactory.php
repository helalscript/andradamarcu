<?php

namespace Database\Factories;

use App\Models\VocabularyGroup;
use App\Models\VocabularyWord;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VocabularyWord>
 */
class VocabularyWordFactory extends Factory
{
    protected $model = VocabularyWord::class;

    public function definition(): array
    {
        return [
            'vocabulary_group_id' => VocabularyGroup::inRandomOrder()->first()->id,
            'word' => $this->faker->unique('2000')->word(),
            'definition' => $this->faker->sentence(),
        ];
    }
}
