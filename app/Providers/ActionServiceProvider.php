<?php

namespace App\Providers;

use App\Actions\Admin\Order\CreateOrderAction;
use App\Actions\Admin\Order\UpdateOrderAction;
use App\Actions\Admin\Product\CreateProductAction;
use App\Actions\Admin\Product\CreateProductGroupAction;
use App\Actions\Admin\Product\CreateProductLocalizationsAction;
use App\Actions\Admin\Product\UpdateProductAction;
use App\Actions\Admin\Product\UpdateProductGroupAction;
use App\Actions\Admin\Product\UpdateProductLocalizationsAction;
use App\Actions\Admin\User\CreateUserAction;
use App\Actions\Admin\User\UpdateUserAction;
use App\Contracts\Admin\Order\CreateOrderActionContract;
use App\Contracts\Admin\Order\UpdateOrderActionContract;
use App\Contracts\Admin\Product\CreateProductActionContract;
use App\Contracts\Admin\Product\CreateProductGroupActionContract;
use App\Contracts\Admin\Product\CreateProductLocalizationsActionContract;
use App\Contracts\Admin\Product\UpdateProductActionContract;
use App\Contracts\Admin\Product\UpdateProductGroupActionContract;
use App\Contracts\Admin\Product\UpdateProductLocalizationsActionContract;
use App\Contracts\Admin\User\CreateUserActionContract;
use App\Contracts\Admin\User\UpdateUserActionContract;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public array $bindings = [
        CreateOrderActionContract::class => CreateOrderAction::class,
        UpdateOrderActionContract::class => UpdateOrderAction::class,
        CreateProductActionContract::class => CreateProductAction::class,
        CreateProductLocalizationsActionContract::class => CreateProductLocalizationsAction::class,
        CreateProductGroupActionContract::class => CreateProductGroupAction::class,
        UpdateProductActionContract::class => UpdateProductAction::class,
        UpdateProductLocalizationsActionContract::class => UpdateProductLocalizationsAction::class,
        UpdateProductGroupActionContract::class =>UpdateProductGroupAction::class,
        CreateUserActionContract::class => CreateUserAction::class,
        UpdateUserActionContract::class => UpdateUserAction::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
