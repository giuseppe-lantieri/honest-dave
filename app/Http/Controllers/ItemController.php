<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    //

    public function check()
    {
        $item = Item::where([
            'name' => request()->name,
            'image' => request()->image,
            'collection_id' => request()->collection_id,
            'user_id' => request()->user_id,
        ])->first();

        if (!$item) {
            return response()->json(false);
        } else {
            return response()->json(true);
        }
    }

    public function store()
    {
        Item::create([
            'name' => request()->name,
            'image' => request()->image,
            'collection_id' => request()->collection_id,
            'user_id' => request()->user_id
        ]);
    }
}