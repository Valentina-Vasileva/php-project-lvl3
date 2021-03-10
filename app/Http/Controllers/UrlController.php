<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Url;
use Illuminate\Http\Request;
use App\Rules\CorrectUrl;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urls = DB::table('urls')->get();
        return view('url.index', compact('urls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => ['required', new CorrectUrl()]
            ]
        );

        $parsedUrl = parse_url($data['name']);
        $normalizedUrl = "{$parsedUrl['scheme']}://{$parsedUrl['host']}";
        $url = DB::table('urls')
            ->where('name', $normalizedUrl)
            ->first();
        
        if (empty($url)) {
            $newUrl = new Url(['name' => $normalizedUrl]);
            $newUrl->save();
            $request->session()->flash('status', 'Страница успешно добавлена');
            return redirect()->route('urls.show', ['url' => $newUrl->id]);
        }

        $request->session()->flash('status', 'Страница уже существует');
        return redirect()->route('urls.show', ['url' => $url->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Url $url)
    {
        $flash = $request->session()->get('status', null);
        return view('url.show', compact('url', 'flash'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function edit(Url $url)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Url $url)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function destroy(Url $url)
    {
        //
    }
}
