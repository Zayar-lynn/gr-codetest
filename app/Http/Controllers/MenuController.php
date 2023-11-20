<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::where(['deleted_flag' => 0])->get();
        return view('admin.menu.show')->with('menus', $menus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);

            Menu::create([
                'photo' => $new_name,
                'name' => $data['name'],
                'sub_name' => $data['sub_name'],
                'category' => $data['category'],
                'desc' => $data['desc'],
            ]);
        }


        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::where([
            'id' => $id
        ])->first();
        return view('admin.menu.edit')->with('menu', $menu);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();

        $menu = Menu::findOrFail($request->id);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);

            $menu->update([
                'photo' => $new_name,
                'name' => $data['name'],
                'sub_name' => $data['sub_name'],
                'category' => $data['category'],
                'desc' => $data['desc'],
            ]);
        }else{
            $menu->update([
                'name' => $data['name'],
                'sub_name' => $data['sub_name'],
                'category' => $data['category'],
                'desc' => $data['desc'],
            ]);
        }


        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Menu::findOrFail($id)->update([
            'deleted_flag' => 1
        ]);
        return response()->json([
            'status' => 'success',
        ]);
    }
}
