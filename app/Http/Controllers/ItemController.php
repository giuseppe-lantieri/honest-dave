<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    //

    public function exist()
    {
        return Item::where([
            'imdbID' => request()->imdbID,
            'collection_id' => request()->collection_id,
            'user_id' => request()->user_id,
        ])->exists();
    }

    public function store()
    {
        $validated = request()->validate([
            'name' => 'required',
            'image' => 'required',
            'imdbID' => 'required',
            'collection_id' => 'required',
            'user_id' => 'required'
        ]);
        Item::create([
            'name' => $validated["name"],
            'image' => $validated["image"],
            'imdbID' => $validated["imdbID"],
            'collection_id' => $validated["collection_id"],
            'user_id' => $validated["user_id"]
        ]);
        return redirect()->route('collections.show', request()->collection_id);
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('collections.show', $item->collection_id);
    }

    public function like(Item $item)
    {
        $item->likes()->attach(Auth::user()->id);
        return redirect()->route('collections.other', $item->collection_id);
    }

    public function unlike(Item $item)
    {
        $item->likes()->detach(Auth::user()->id);
        return redirect()->route('collections.other', $item->collection_id);
    }
}