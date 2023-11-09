<?php

namespace App\Http\Controllers;

use App\Models\Halaqah;
use App\Http\Requests\StoreHalaqahRequest;
use App\Http\Requests\UpdateHalaqahRequest;

class HalaqahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('halaqah');
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
     * @param  \App\Http\Requests\StoreHalaqahRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHalaqahRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Halaqah  $halaqah
     * @return \Illuminate\Http\Response
     */
    public function show(Halaqah $halaqah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Halaqah  $halaqah
     * @return \Illuminate\Http\Response
     */
    public function edit(Halaqah $halaqah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHalaqahRequest  $request
     * @param  \App\Models\Halaqah  $halaqah
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHalaqahRequest $request, Halaqah $halaqah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Halaqah  $halaqah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Halaqah $halaqah)
    {
        //
    }
}
