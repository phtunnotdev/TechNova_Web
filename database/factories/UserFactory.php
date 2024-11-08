<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $showPassword = Str::random(8);

        //Faker
        $userCode = "UR-".Str::random(5);
        while(User::where('user_code', $userCode)->exists()){
            $userCode = "UR-".Str::random(5);
        }
        $email = fake()->unique()->userName() . '@gmail.com';
        return [
            'user_code' => $userCode,
            'name' => $this->sanitizeName(fake()->name()),
            'email' => $email,
            'phone' => '0' . fake()->numberBetween(100000000, 999999999),
            'address' => fake()->address(),
            'show_password' => $showPassword,
            'role' => 3,
            'email_verified_at' => now(),
            'password' => Hash::make($showPassword),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    protected function sanitizeName($name)
    {
        // Danh sách các từ cần loại bỏ
        $unwantedWords = ['Ông. ', 'Chú. ', 'Cô. ', 'Cụ. ', 'Bác. ', 'Bà. ', 'Chị. ', 'Anh. ', 'Em. '];

        // Kiểm tra xem có bất kỳ từ nào trong danh sách không mong muốn trong tên
        foreach ($unwantedWords as $word) {
            if (strpos($name, $word) === 0) { // Kiểm tra nếu từ không mong muốn ở đầu tên
                return trim(str_replace($word, '', $name)); // Loại bỏ và trả về tên đã được xử lý
            }
        }

        return $name; // Trả về tên nguyên bản nếu không có từ nào cần loại bỏ
    }
}