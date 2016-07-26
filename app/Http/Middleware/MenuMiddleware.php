<?php

namespace App\Http\Middleware;

use Closure;
use Menu;
use App;
class MenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Menu::make('adminNavbar', function($menu){
            $menu->add('控制面板',['route'=>'admin_dashboard'])->divide();

            $province = $menu->add('省份管理', '#');
            $province->add('查看', route('admin.province.index'));
            $province->add('添加', route('admin.province.create'));

            $city = $menu->add('城市管理', '#');
            $city->add('查看', route('admin.city.index'));
            $city->add('添加', route('admin.city.create'));

            $store = $menu->add('店铺管理', '#');
            $store->add('查看', route('admin.store.index'));
            $store->add('添加', route('admin.store.create'));

            //$page->add('查看', 'page/view');
            //$menu->add('账户',['route'=>'admin_account']);
        });
        return $next($request);
    }
}
