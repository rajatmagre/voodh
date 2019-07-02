<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(\Session::has('locale'))
        {
            \App::setLocale(\Session::get('locale'));

            /**local locale is en**/
        }
       

        return $next($request);
    }
}

?>