<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    //

    public function index()
    {
        if (Auth::user()) {
            $collections = Collection::all();
            $my_collections = Auth::user()->collections;
            $favorites = Auth::user()->favorites;

            // dd($favorites);
            return view('home', [
                'collections' => $collections,
                "my_collections" => $my_collections,
                "favorites"=> $favorites
            ]);
        }

        return view('home');
    }

    public function show(Collection $collection)
    {
        $items = $collection->items;
        return view("collections", [
            'collection' => $collection,
            'items' => $items
        ]);
    }


    public function other(Collection $collection)
    {
        $items = $collection->items;
        return view("other-collections", [
            'collection' => $collection,
            'items' => $items
        ]);
    }

    public function store()
    {
        Collection::create([
            'name' => request()->name,
            'user_id' => Auth::user()->getAuthIdentifier()
        ]);

        return redirect()->route("home");
    }


    public function destroy(Collection $collection)
    {
        $collection->delete();
        return redirect()->route('home');
    }

    public function favorite(Collection $collection)
    {
        $collection->favorites()->attach(Auth::user()->id);
        return redirect()->route('home');
    }

    public function unfavorite(Collection $collection)
    {
        $collection->favorites()->detach(Auth::user()->id);
        return redirect()->route('home');
    }
}