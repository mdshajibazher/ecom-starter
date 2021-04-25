<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Subcollection;
use App\Http\Controllers\Controller;

class SubcollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate($request,[
            'title' => 'required|unique:subcollections,title',
        ]);

        $subcollection = new Subcollection;
        $subcollection->title = $request->title;
        $subcollection->slug = Str::slug($request->title);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcollection  $subcollection
     * @return \Illuminate\Http\Response
     */
    public function show(Subcollection $subcollection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcollection  $subcollection
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcollection $subcollection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcollection  $subcollection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcollection $subcollection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcollection  $subcollection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcollection $subcollection)
    {
        //
    }
}
