<?php

namespace App\Http\Controllers;
//import model menu
use App\Models\Menu;
//return type view
use Illuminate\View\View;
//return type redirectResponse
use Illuminate\Http\RedirectResponse;
//import facade "storage"
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * index
     *
     * @return View
     */public function index(): View
     {
        //get menus
        $menus = Menu::latest()->paginate(5);

        //render view with menus
        return view('menus.index', compact('menus'));
     }
      /**
     * create
     *
     * @return View
     */
    public function create() :View
    {
        return view('menus.create');
    }
    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'gambar'        =>'required|mimes:jpeg,jpg,png|max:2048',
            'namamakanan'   =>'required|min:0',
            'khasdaerah'    =>'required|min:0'
        ]);

        //upload image
        $gambar = $request->file('gambar');
        $gambar->storeAs('public/menus', $gambar->hashName());

        //create menu
        Menu::create([
            'gambar'        =>$gambar->hashName(),
            'namamakanan'   =>$request->namamakanan,
            'khasdaerah'    =>$request->khasdaerah
        ]);

        //redirect to index
        return redirect()->route('menus.index')->with(['success' => 'Menu Makanan Berhasil Disimpan']);
    }
    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get menu by ID
        $menu = Menu::findOrFail($id);

        //render view with post
        return view('menus.show', compact('menu'));
    }
    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get menu by ID
        $menu = Menu::findOrFail($id);
        //render view with post
        return view('menus.edit', compact('menu'));
    }
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate
        $this->validate($request, [
            'gambar'            => 'mimes:jpeg,jpg,png|max:2048',
            'namamakanan'       => 'required',
            'khasdaerah'        => 'required'
        ]);
        //get post by ID
        $menu = Menu::findOrFail($id);
        //check if imageis uploaded
        if ($request->hasFile('gambar')){
            //upload new image
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/menus', $gambar->hashName());
            //delete old image
            Storage::delete('public/menus/' .$menu->gambar);

            //update post with new image
            $menu->update([
                'gambar'        =>$gambar->hashName(),
                'namamakanan'   =>$request->namamakanan,
                'khasdaerah'    =>$request->khasdaerah
            ]);
        }else{
            //update post without image
            $menu->update([
                'namamakanan'       =>$request->namamakanan,
                'khasdaerah'        =>$request->khasdaerah
            ]);
        }

        //redirect to index
        return redirect()->route('menus.index')->with(['success' => 'Menu Berhasil Diubah!']);
    }
    /**
     * destroy
     *
     * @param  mixed $menu
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $menu = Menu::findOrFail($id);

        //delete image
        Storage::delete('public/menus/'. $menu->gambar);

        //delete post
        $menu->delete();

        //redirect to index
        return redirect()->route('menus.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
