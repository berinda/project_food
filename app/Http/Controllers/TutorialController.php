<?php

namespace App\Http\Controllers;
//import model menu
use App\Models\Tutorial;
use App\Models\Menu;
//return type view
use Illuminate\View\View;
//return type redirectResponse
use Illuminate\Http\RedirectResponse;
//import facade "storage"
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class TutorialController extends Controller
{
    /**
     * index
     *
     * @return View
     */public function index(): View
     {
        //get menus
        $tutorials = Tutorial::with('menu')->paginate(5);

        //render view with menus
        return view('tutorials.indextutor', compact('tutorials'));
        
     }
      /**
     * create
     *
     * @return View
     */
    public function create() :View
    {
        $tutorials = Tutorial::all();
        $menus = Menu::all();
        return view('tutorials.createtutor', compact('tutorials', 'menus'));
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
            
            'menuId'             =>'required|exists:menus,id',
            'tutorialmemasak'    =>'required',
        ]);

        //upload image
        // $gambar = $request->file('gambar');
        // $gambar->storeAs('public/menus', $gambar->hashName());

        //create menu
        Tutorial::create([
        
            'menuId'        =>$request->menuId,
            'tutorialmemasak'    =>$request->tutorialmemasak
        ]);

        //redirect to index
        return redirect()->route('tutorials.index')->with(['success' => 'Resep Masakan Berhasil Disimpan']);

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
        $tutorial = Tutorial::findOrFail($id);

        //render view with post
        return view('tutorials.showtutor', compact('tutorial'));
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
        $tutorial = Tutorial::findOrFail($id);
        //render view with post
        return view('tutorials.edittutor', compact('tutorial'));
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

            'menuId'                 =>'required|exists:menus,id',
            // 'namamakanan'            => 'required',
            'tutorialmemasak'        => 'required'
        ]);
        $tutorial = Tutorial::findOrFail ($id);
        $tutorial->update([
            'menuId'             =>$request->menuId,
            'tutorialmemasak'    => $request->tutorialmemasak,
                    
        ]);

        //redirect to index
        return redirect()->route('tutorials.index')->with(['success' => 'Menu Berhasil Diubah!']);
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
        $tutorial = Tutorial::findOrFail($id);

        //delete post
        $tutorial->delete();

        //redirect to index
        return redirect()->route('tutorials.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
