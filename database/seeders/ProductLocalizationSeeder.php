<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


//call this seeder only after seeding products table
class ProductLocalizationSeeder extends Seeder
{
    private Generator $faker;
    private Collection $products;


    public function __construct()
    {
        $this->faker = $this->withFaker();
        $this->products = Product::all();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $localizationsList = $this->getLocalizationsList();
        DB::table('product_localizations')->insert($localizationsList);
    }

    private function withFaker(): Generator
    {
        return Container::getInstance()->make(Generator::class);
    }

    private function getlocalizationsList(): array
    {
        $localizationsList = [];

        foreach ($this->products as $product) {
            $localizationsList[] = [
                'product_id' => $product->id,
                'locale' => 'en',
                'name' => 'Product ' . $product->name ,
                'description' =>"English description of product $product->name",
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $localizationsList[] = [
                'product_id' => $product->id,
                'locale' => 'ua',
                'name' => 'Продукт ' . $product->name,
                'description' =>"Детальный опыс продукту $product->name українською мовою соловїною та співучою",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        return $localizationsList;
    }
}
