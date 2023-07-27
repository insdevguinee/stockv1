<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Permission;
use Illuminate\Http\Request;


class PermissionsMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $_adminPannel = '';

    public function __construct()
    {
        // // if (Auth::user()->active == 0 )
        //     return view('users.desactiver');
    }

    public function handle($request, Closure $next)
    {
        if (Auth::user()->hasRole('Admin|admin'))
        {
            return $next($request);
        }else{


            // foreach (Permission::getModels() as $model) {
                // if (Auth::user()->hasPermissionTo('access_admin')) continue;
                $path = explode('/', $request->path())[0];
                $this->AutorisationUser($request, $path , $next);
            // }
        }
        return $next($request);
    }


    private function AutorisationUser($request, $modelName, $next)
    {

        // View
        if ($request->method() == 'GET' AND $request->is($this->_adminPannel.$modelName) )
        {

            if (!Auth::user()->hasPermissionTo('view_'.$modelName))
            {
               return abort(401);
            }
            else {

               return $next($request);
            }
        }

        // Create Add

        if ($request->is($this->_adminPannel.$modelName.'/create'))
        {
            if (!Auth::user()->hasPermissionTo('add_'.$modelName))
            {
               return abort(401);
            }
            else {
               return $next($request);
            }
        }

        // Edit

        if ($request->method() == 'PUT')
        {
            if (!Auth::user()->hasPermissionTo('edit_'.$modelName))
            {
               return abort(401);
            }
            else {
               return $next($request);
            }
        }

        // Delete
        if ($request->method() == 'DELETE')
        {
            if (!Auth::user()->hasPermissionTo('delete_'.@$modelName))
            {
               return abort(401);
            }
            else {
               return $next($request);
            }
        }
    }
}
