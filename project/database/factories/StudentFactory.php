<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Student::class;

    public function definition()
    {
        return [
            'serial_student' => $this->faker->regexify('S_[0-9]{5}'),
			'email' => $this->faker->unique()->safeEmail(),
            'name_sei' => $this->faker->lastName(),
            'name_mei'=> $this->faker->firstName(),
            'name_sei_kana'=> $this->faker->lastKanaName(),
            'name_mei_kana'=> $this->faker->firstKanaName(),
            'gender'=> $this->faker->randomElement(['男', '女']),
            'protector'=> $this->faker->Name(),
            'postal'=> $this->faker->postcode(),
            'address_region'=> $this->faker->prefecture(),
            'address_locality'=> $this->faker->city(),
            'address_banti'=> $this->faker->streetAddress(),
            'phone'=> $this->faker->phoneNumber(),
            'grade'=> $this->faker->randomElement(['小1', '小2', '小3', '小4', '小5', '小6', '中1', '中2', '中3', '高1', '高2', '高3']),
        ];
    }
}
