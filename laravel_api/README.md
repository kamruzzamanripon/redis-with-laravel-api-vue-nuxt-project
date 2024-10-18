## Instraction

### Redis-cli command
```
1. monitor
2. keys laravel_database_your_key_name
3. flushall 
```

### Cache Facade
```
1. Cache::put('key', 'value', $seconds=10) 
2. Cache::put('key', 'value', now()->addMinutes(5)) 
3. Cache::add(('key', 'value', $seconds=10)
4. Cache::get('key', 'default value')
5. Cache::get('key', callback)
6. Cache::has('key') //For checking key is available or not
7. Cache::remember('user', $seconds=10, function(){})
8. Cache::rememberForever('user', function(){}) //Retrieving and Store Item
9. Cache::pull('key') //Retrieving and Delete Item
10. Cache::forever('key', 'value')
11. Cache::forget('key') // For delete
12. Cache::put('key', 'value', 0 OR -5) // For delete
13. Cache::flush() //For remove all cache data
```