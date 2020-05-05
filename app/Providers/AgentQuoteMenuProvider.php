<?php

namespace App\Providers;

use App\Facades\AQLog;
use App\Models\Subscription;
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
        // view()->composer('*', function ($view) use ($events) {


                $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

                    $ok = false;

                    if (auth()->check()) {
                        $user_type = strtolower(request()->user()->type->name);
                        $ok = true;
                    }

                    if ($ok) {

                        $user = auth()->user();

                        $userArr = User::find($user->id)->toArray();

/*                        AQLog::info(print_r([
                            // password should already be hashed
                            'message' => "AgentQuoteMenuProvider::boot - User",
                            'user' => $userArr
                        ], true));

                        AQLog::info(print_r([
                            'message' => "AgentQuoteMenuProvider::boot  - events->listen",
                        ], true));*/

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

/*                        AQLog::info(print_r([
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
                        ], true));*/

                        // loop though all items and see if one of the menu items belongs to a product. If so, only show the menu product item if the user is subscribed to it.
                        foreach ($menu_items as $item) {

                            if($user_type !== 'user') {
                                $event->menu->add($item);
                            }

/*                            AQLog::info(print_r([
                                'message' => "AgentQuoteMenuProvider::boot - Menu Item",
                                'user' => $item
                            ], true));*/

                            else if (is_array($item) && array_key_exists('url', $item) ) {

/*                                AQLog::info(print_r([
                                    'message' => "AgentQuoteMenuProvider::boot - Line 80",
                                    'data' => is_array($item) && array_key_exists('url', $item)
                                ], true));


                                AQLog::info(print_r([
                                    'message' => "Product Details",
                                    'data' => $productDetails
                                ], true));

                                AQLog::info(print_r([
                                    'message' => "Products",
                                    'data' => $products
                                ], true));*/

                                $userHasActiveSubscription = null;

                                if ( array_key_exists('url', $item) && in_array($item['url'], $productDetails) ) {


                                     // loop through each product to see which one the user has

                                    foreach($products as $product) {

                                        $productFound = Product::where( [ "id" => $product['id'] ] )->first();


                                        if ($productFound) {
                                            $userHasActiveSubscription = Subscription::where(["user_id" => $user->id, "product_id" => $productFound->id, "active" => 1])->first();
                                        }

                                        AQLog::info(print_r([
                                            'message' => "Does user have an active subscription",
                                            'condition' => $userHasActiveSubscription === null ? 'No' : 'Yes',
                                            'data' => $userHasActiveSubscription,
                                            'subscription' => $productFound->name
                                        ], true));

                                        if ($productFound && $userHasActiveSubscription !== null) {
                                            $hasSubscription = Subscription::where([
                                                'user_id' => $user->id,
                                                'product_id' => $productFound->id
                                            ])->first();
                                            if ($hasSubscription && $productFound->menu_path === $item['url']) {
                                                $event->menu->add($item);
                                            }
                                        }

                                    }


                                } else {
                                    $event->menu->add($item);
                                }

                            }
                        }
                    }
                }); // ./$events->listen
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
