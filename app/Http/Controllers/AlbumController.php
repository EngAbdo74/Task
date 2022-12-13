<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Album;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::paginate(15);
        return view('albums.index', compact('albums'));
    }


    public function create()
    {
        return view('albums.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'album_title' => 'required'|'max:100',
        ]);

        $albums = Album::create([
            'album_title' => $request->album_title,
        ]);
        return redirect()->route('albums.index');
    }


    public function edit($id)
    {
        $album = Album::findOrFail($id);
        return view('albums.edit', compact('album'));
    }


    public function update(Request $request, $id)
    {

        $album = Album::findOrFail($id);
        $this->validate($request, ['album_title' => 'filled', ]);

        $album->update([
            'album_title' => $request->album_title,
        ]);

        return redirect()->route('albums.index');
    }

    public function delete($id)
    {
       
        $album = Album::findOrFail($id);
        $album->delete();

        return redirect()->back();
    }
}
