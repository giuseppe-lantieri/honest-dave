<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    //


    public function index()
    {
        if (Auth::user()) {
            $cs = Collection::all()->where("user_id", Auth::user()->getAuthIdentifier());
            return view('home', [
                'cs' => $cs
            ]);
        }

        return view('home');
    }

    public function show(Collection $collection)
    {
        $items = Item::where(['collection_id'=> $collection->id,'user_id'=> Auth::user()->id])->get();
        return view("collections",[
            'collection'=>$collection,
            'items'=> $items
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
}