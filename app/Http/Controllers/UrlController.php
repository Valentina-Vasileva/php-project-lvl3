<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUrlRequest;
use Carbon\Carbon;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): \Illuminate\View\View
    {
        $latestChecks = DB::table('url_checks')
            ->select(DB::raw('url_id, MAX(id) as last_check_id'))
            ->groupBy('url_id');

        $urls = DB::table('urls')
            ->leftJoinSub($latestChecks, 'latest_checks', function ($join): void {
                $join->on('urls.id', '=', 'latest_checks.url_id');
            })
            ->leftJoin('url_checks', 'latest_checks.last_check_id', '=', 'url_checks.id')
            ->select('urls.id as id', 'urls.name as name', 'url_checks.created_at as last_check', 'url_checks.status_code as status_code')
            ->orderBy('id', 'asc')
            ->get();

        return view('url.index', compact('urls'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUrlRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUrlRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();

        $parsedUrl = parse_url($data['url']['name']);
        $normalizedUrl = "{$parsedUrl['scheme']}://{$parsedUrl['host']}";
        $url = DB::table('urls')
            ->where('name', $normalizedUrl)
            ->first();

        if ($url === null) {
            $newUrl = DB::table('urls')->insertGetId(
                [
                    'name' => $normalizedUrl,
                    'created_at' => Carbon::now()->toString(),
                    'updated_at' => Carbon::now()->toString()
                ]
            );

            return redirect()
                ->route('urls.show', ['url' => $newUrl])
                ->with('status', 'Страница успешно добавлена');
        }
        return redirect()
            ->route('urls.show', ['url' => $url->id])
            ->with('status', 'Страница уже существует');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id): \Illuminate\View\View
    {
        $url = DB::table('urls')->find($id);

        if ($url === null) {
            abort(404);
        }

        $urlChecks = DB::table('url_checks')
            ->where('url_id', $id)
            ->orderBy('id', 'desc')
            ->get();

        $flash = $request->session()->get('status', null);
        return view('url.show', compact('url', 'urlChecks', 'flash'));
    }
}
