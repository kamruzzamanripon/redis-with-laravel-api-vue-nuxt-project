<?php

namespace App\Http\Controllers;

use App\Events\ProductUpdatedEvent;
use App\Models\Product;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller {
    public function index(): Collection {
        return Product::all();
    }

    public function store( Request $request ): Response | ResponseFactory {
        $product = Product::create( $request->only( 'title', 'description', 'image', 'price' ) );

        event( new ProductUpdatedEvent );

        return response( $product, Response::HTTP_CREATED );
    }

    public function show( Product $product ): Product {
        return $product;
    }

    public function update( Request $request, Product $product ) {
        // dd('hleo');
        //dd($request->only('title', 'description', 'image', 'price'));
        $product->update( $request->only( 'title', 'description', 'image', 'price' ) );

        event( new ProductUpdatedEvent );

        return response( $product, Response::HTTP_ACCEPTED );
    }

    public function destroy( Product $product ): Response | ResponseFactory {
        $product->delete();

        event( new ProductUpdatedEvent );

        return response( null, Response::HTTP_NO_CONTENT );
    }

    public function frontend(): mixed {
        if ( $products = Cache::get( 'products_frontend' ) ) {
            return $products;
        }
        //sleep(5);
        $products = Product::all();

        Cache::set( 'products_frontend', $products, 30 * 60 ); //30 min

        return $products;
    }

    public function backend( Request $request ): array {
        $page = $request->input( 'page', 1 );

        /** @var Collection $products */
        $products = Cache::remember( 'products_backend', 30 * 60, fn() => Product::all() );

        if ( $s = $request->input( 's' ) ) {
            $products = $products
                ->filter(
                    fn( Product $product ) => Str::contains( $product->title, $s ) || Str::contains( $product->description, $s )
                );
        }

        $total = $products->count();

        if ( $sort = $request->input( 'sort' ) ) {
            if ( $sort === 'asc' ) {
                $products = $products->sortBy( [
                    fn( $a, $b ) => $a['price'] <=> $b['price'],
                ] );
            } else if ( $sort === 'desc' ) {
                $products = $products->sortBy( [
                    fn( $a, $b ) => $b['price'] <=> $a['price'],
                ] );
            }
        }

        return [
            'data' => $products->forPage( $page, 9 )->values(),
            'meta' => [
                'total'     => $total,
                'page'      => $page,
                'last_page' => ceil( $total / 9 ),
            ],
        ];
    }

    // public function backendWithPagination( Request $request ): array {
    //     $page = $request->input( 'page', 1 );
    //     $cacheKey = "products_backend_pagination_page_{$page}";

    //     /** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $products */
    //     $products = Cache::remember( $cacheKey, 30 * 60, fn() => Product::paginate( 9, ['*'], 'page', $page ) );
    //     //dd($products);
    //     return [
    //         'data' => $products->items(),
    //         'meta' => [
    //             'total'     => $products->total(),
    //             'page'      => $products->currentPage(),
    //             'last_page' => $products->lastPage(),
    //         ],
    //     ];
    // }

    public function backendWithPagination(Request $request): array
    {
        $page = $request->input('page', 1);
        $cacheKey = "products_backend_pagination_page_{$page}";
        //$cachedProducts = Cache::get($cacheKey);
        //dd($cachedProducts);
    
        /** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $products */
        $products = Cache::remember($cacheKey, 30 * 60, function () use ($page, $cacheKey): LengthAwarePaginator {
            //sleep(10); // Simulate delay
            $products = Product::paginate(9, ['*'], 'page', $page);
            Log::info('Caching products for page:', ['key' => $cacheKey]); 
            return $products;
        });
    
        // Log the cache key for debugging
        Log::info("Cached products for page {$page}", ['key' => $cacheKey]);
    
        return [
            'data' => $products->items(),
            'meta' => [
                'total'     => $products->total(),
                'page'      => $products->currentPage(),
                'last_page' => $products->lastPage(),
            ],
        ];
    }
    

}