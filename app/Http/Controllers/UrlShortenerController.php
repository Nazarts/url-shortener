<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class UrlShortenerController extends Controller
{
    public function generate_slug($seed, $max_len){
        $hexval = '';
        while($seed != 0)
        {
            $character = $seed % 62;
            if($character < 10){
                $hexval = $character.$hexval;
            } else if($character < 36){
                $hexval = chr(55 + $character).$hexval;
            } else {
                $hexval = chr(61 + $character).$hexval;
            }

            $seed = intdiv($seed, 62);
        }
        for ($i=0; $i < $max_len - strlen($hexval); $i++) { 
            $hexval = '0'.$hexval;
        }
        return $hexval;
    }

    public function show(Request $request, string $slug){
        $validator = Validator::make(['slug' => $slug], [
            'slug' => 'exists:urls,slug',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 'Slug not found'], 401);
        }
        $original_url = Url::all()->where('slug', '=', $slug)->first()->original_url;
        return Redirect($original_url);
    }

    public function store(Request $request) {
        $validatedData = $request->validate(
            [
                'original_url' => 'required|active_url'
            ]
        );

        try {
            $max_id = DB::table('urls')->max('id');
            $validatedData['slug'] = $this->generate_slug($max_id, 8);

            $url_instance = new Url($validatedData);

            $url_instance->save();

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json($th->getMessage());
        }

        return response()->json(['url' => url("/".$url_instance->slug)]);
    }
}
