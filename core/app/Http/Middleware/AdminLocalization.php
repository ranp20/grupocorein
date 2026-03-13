<?php
namespace App\Http\Middleware;
use App\Models\Language;
use Closure;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class AdminLocalization{
    public function handle($request, Closure $next){
        $language = Language::whereType('Dashboard')->where('is_default',1)->first();
        App::setlocale($language->name);
        return $next($request);
    }
}
