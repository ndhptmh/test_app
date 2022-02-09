<?php

namespace App\Http\Controllers;

use App\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genap = Provider::whereRaw('(no_hp % 2) = 0')->get();
        $ganjil = Provider::whereRaw('(no_hp % 2) != 0')->get();

        return response()->json([
            'status' => 1,
            'message' => 'berhasil mendapatkan data Provider',
            'data' => [
                'genap' => $genap,
                'ganjil' => $ganjil,
            ]
        ]);
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
        //dd($request);
        $request->validate([
            'no_hp' => 'required',
            'provider' => 'required',
        ],
        [
            'no_hp.required' => 'No Hp wajib di isi!',
            'provider.required' => 'Provider wajib di isi!',
        ]);

        Provider::updateOrCreate([
            'no_hp' => $request->no_hp,
            'provider' => strtolower($request->provider),
        ],[
            'no_hp' => $request->no_hp,
            'provider' => strtolower($request->provider),
            'user_id' => $request->user_id,
        ]);

        return response()->json([
            'status' => 1,
            'message' => 'berhasil menambah data Provider',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        return response()->json([
            'status' => 1,
            'message' => 'berhasil menghapus data Provider',
            'data' => $provider
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        //dd($provider);
        $request->validate([
            'no_hp' => 'required',
            'provider' => 'required',
        ],
        [
            'no_hp.required' => 'No Hp wajib di isi!',
            'provider.required' => 'Provider wajib di isi!',
        ]);

        Provider::whereId($provider->id)->update([
            'no_hp' => $request->no_hp,
            'provider' => $request->provider,
            'user_id' => $request->user_id,
        ]);  

        return response()->json([
            'status' => 1,
            'message' => 'berhasil mengedit data Provider',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        Provider::destroy($provider->id);
        return response()->json([
            'status' => 1,
            'message' => 'berhasil menghapus data Provider',
        ]);
    }
}
