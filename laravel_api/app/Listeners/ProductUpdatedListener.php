<?php

namespace App\Listeners;

use App\Events\ProductUpdatedEvent;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class ProductUpdatedListener {
    public function handle( ProductUpdatedEvent $event ) {
        // Clear frontend and backend caches
        Cache::forget( 'products_frontend' );
        Cache::forget( 'products_backend' );

        // Clear all cached pages (if using Redis)
        $this->clearPaginatedCache($prefix = "products_backend_pagination_page_");
    }
    
    private function clearPaginatedCache($prefix): void {
        for ($page = 1; $page <= 1000; $page++) {
            $key = $prefix . $page;
            if (Cache::has($key)) {
                Cache::forget($key);
                Log::info('Cleared Cache for page:', ["products_backend_pagination_page_{$page}"]);
            } else {
                Log::info('Cleared Cache for break:', ["products_backend_pagination_page_{$page}"]);
                break;
            }
           // Cache::forget("products_backend_pagination_page_{$page}");
            
        }
    }
    
    
}
