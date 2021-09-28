<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory as FactoriesFactory;

class AuthorFactory extends FactoriesFactory
{
    protected $model = Author::class;

    public function definition()
    {
        return [
            "gender" => $gender = $this->faker->randomElement(["male", "female"]),
            "name" => $this->faker->name($gender),
            "country" => $this->faker->country()
        ];
    }
}
