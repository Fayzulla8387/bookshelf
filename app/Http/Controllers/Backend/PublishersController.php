<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Publisher;

class PublishersController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers = Publisher::all();
        return view('backend.pages.publishers.index', compact('publishers'));
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
        $request->validate([
            'name' => 'required|max:50',
            'link' => 'nullable|url',
            'description' => 'nullable',
        ]);

        $publisher = new Publisher();
        $publisher->name = $request->name;
        $publisher->link = $request->link;
        $publisher->address = $request->address;
        $publisher->outlet = $request->outlet;
        $publisher->description = $request->description;
        $publisher->save();

        session()->flash('success', 'Publisher has been created !!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
            'link' => 'nullable|url',
            'description' => 'nullable',
        ]);

        $publisher = Publisher::find($id);
        $publisher->name = $request->name;
        $publisher->link = $request->link;
        $publisher->address = $request->address;
        $publisher->outlet = $request->outlet;
        $publisher->description = $request->description;
        $publisher->save();

        session()->flash('success', 'Publisher has been updated !!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publisher = Publisher::find($id);
        $publisher->delete();

        session()->flash('success', 'Publisher has been deleted !!');
        return back();
    }
}
