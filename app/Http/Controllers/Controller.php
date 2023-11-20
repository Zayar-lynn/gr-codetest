<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboard()
    {
        $menu = Menu::where([
            'deleted_flag' => 0
        ])->get();
        return view('admin.dashboard')->with('menu', count($menu));
    }
}
