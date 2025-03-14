<?php

namespace App\Http\Controllers;

use App\Models\Appartment;
use App\Models\Options;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class BaseController extends Controller
{
    public function home(): View
    {
        return view('home', [
            "appartments" => Appartment::latest()->where('is_sell', '!=', '1')->take(4)->get(),
        ]);
    }

    public function properties()
    {
        return view('properties', [
            "appartments" => Appartment::latest()->where('is_sell', '!=', '1')->paginate(20),
            "options" => Options::all(),
        ]);
    }

    public function filter_properties(Request $request)
    {
        $appartment = Appartment::query();

        if ($request->input('surface'))
        {
            $appartment->where('surface', '>=', $request->input('surface'));
        }

        if ($request->input('piece'))
        {
            $appartment->where('piece', '>=', $request->input('piece'));
        }

        if ($request->input('price'))
        {
            $appartment->where('price', '<=', $request->input('price'));
        }

        if ($request->input('options')) {
            $options = (array) $request->input('options');
    
            $appartment->whereHas('options', function ($query) use ($options) {
                $query->whereIn('id', $options);
            });
        }

        return view('properties', [
            "appartments" => $appartment->where('is_sell', '!=', '1')->orderBy('id', 'desc')->paginate(20),
            "options" => Options::all(),
        ]);
    }

    public function detail_property(Appartment $appartment)
    {
        return view('detail_property', [
            'appartment' => $appartment,
        ]);
    }
}
