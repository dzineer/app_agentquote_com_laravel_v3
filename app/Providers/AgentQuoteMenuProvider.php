<?php

namespace App\Providers;

use App\Facades\AQLog;
use App\User;
use Dzineer\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\Product;

class AgentQuoteMenuProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        //compose all the views....
        view()->composer('*', function ($view) use ($events) {
            if (auth()->check()) {

                $user_type = strtolower(request()->user()->type->name);

                $user = auth()->user();

                $userArr = User::find($user->id)->toArray();

                AQLog::info(print_r([
                    // password should already be hashed
                    'message' => "AgentQuoteMenuProvider::boot - User",
                    'user' => $userArr
                ], true));

                $events->listen(BuildingMenu::class, function (BuildingMenu $event) use ($events, $user, $user_type) {


                    AQLog::info(print_r([
                        'message' => "AgentQuoteMenuProvider::boot - events->listen",
                    ], true));

                    $menu_type = 'agentquote.menus.'.$user_type;
                    $menu_items = config($menu_type);
                    // dd($menu_items);
                    $event->menu->clear();
                    $products = Product::all();
                    $productDetails = [];


                    if ($products) {
                        $productDetails = $products->map(function($product) {
                            return $product->menu_path;
                        })->toArray();
                    }

                    $products = $products->toArray();

                    AQLog::info(print_r([
                        'message' => "AgentQuoteMenuProvider::boot - Products",
                        'user' => $products
                    ], true));

                    AQLog::info(print_r([
                        'message' => "AgentQuoteMenuProvider::boot - Product Details",
                        'user' => $productDetails
                    ], true));

                    AQLog::info(print_r([
                        'message' => "AgentQuoteMenuProvider::boot - Menu Items",
                        'user' => $menu_items
                    ], true));

                    // loop though all items and see if one of the menu items belongs to a product. If so, only show the menu product item if the user is subscribed to it.
                    foreach ($menu_items as $item) {


                        AQLog::info(print_r([
                            'message' => "AgentQuoteMenuProvider::boot - Menu Item",
                            'user' => $item
                        ], true));

                        if (is_array($item) && array_key_exists('url', $item) ) {

                            AQLog::info(print_r([
                                'message' => "AgentQuoteMenuProvider::boot - Line 80",
                                'data' => is_array($item) && array_key_exists('url', $item)
                            ], true));

                            if ( array_key_exists('url', $item) && in_array($item['url'], $productDetails) ) {

                                $productToCheck = array_filter($products, function($product) use ($item) {
                                    return $product['menu_path'] === $item['url'];
                                });
                                // since we got an array of array of one item, pop array item out of outer array
                                $productToCheck = array_pop($productToCheck);

                                AQLog::info(print_r([
                                    'message' => "AgentQuoteMenuProvider::boot - Product to check",
                                    'data' => $productToCheck
                                ], true));

                                if ($productToCheck) {
                                    $productFound = Product::find(intval($productToCheck['id']));

                                    AQLog::info(print_r([
                                        'message' => "AgentQuoteMenuProvider::boot - Product found ?",
                                        'data' => $productFound
                                    ], true));

                                    if ($productFound) {

                                        AQLog::info(print_r([
                                            'message' => "AgentQuoteMenuProvider::boot - User have subscription?",
                                            'data' => $productFound->hasSubscription($user->id),
                                            'answer' => $productFound->hasSubscription($user->id) ? 'Yes' : 'No'
                                        ], true));

                                        if ($productFound->hasSubscription($user->id)) {
                                            $event->menu->add($item);
                                        }
                                    }
                                }

                            } else {
                                $event->menu->add($item);
                            }

                        }
                    }
                });
            }
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
