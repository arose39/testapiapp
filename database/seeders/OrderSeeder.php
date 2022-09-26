<?php

namespace Database\Seeders;

use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

//call this seeder only after seeding users and products tables
class OrderSeeder extends Seeder
{
    private Generator $faker;
    private const NUMBER_OF_ORDERS = 200;
    private int $numberOfUsers;
    private int $numberOfProducts;


    public function __construct()
    {
        $this->faker = $this->withFaker();
        $this->numberOfUsers = DB::table('users')->count();
        $this->numberOfProducts = DB::table('products')->count();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ordersList = $this->getOrdersList();
        DB::table('orders')->insert($ordersList);
    }

    private function withFaker(): Generator
    {
        return Container::getInstance()->make(Generator::class);
    }

    private function getOrdersList(): array
    {
        $ordersList = [];
        for ($i = 1; $i <= self::NUMBER_OF_ORDERS; $i++) {
            $ordersList[] = [
                'user_id' => $this->faker->numberBetween(1, $this->numberOfUsers),
                'product_id' => $this->faker->numberBetween(1, $this->numberOfProducts),
                'created_at' => now()->addSecond($i),
                'updated_at' => now()->addSecond($i),
            ];
        }

        return $ordersList;
    }
}
