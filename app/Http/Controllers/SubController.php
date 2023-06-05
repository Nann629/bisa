<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sub;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sub = Sub::all();
        return view('sub', ['sub' => $sub]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sub = Sub::select('name')->get();
        return view('sub-add', ['class' => $sub]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'code' => 'unique:sub',
        // ]);
        // $request->validate([
        //     'code' => 'unique:sub'
        // ], [
        //     'code' => 'unimeric harus berbeda beb!.'
        // ]);

        $sub = Sub::create($request->all());

        if ($sub) {
            # code...
            Session::flash('status', 'succes');
            Session::flash('message', 'add new sub succes!');
        }

        return redirect('sub');
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
    public function edit(Request $request, $id)
    {
        //
        $sub = Sub::find($id);
        $sub->update($request->all());
        return redirect('sub');
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
        //
        $sub = Sub::findOrFail($id);
        $sub->update($request->all());
        return redirect('/sub');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $flight = Sub::find(1);
        $flight->delete();

        $sub = Sub::all();

        return view('sub', ['data' => $sub]);
    }

    public function delete($id)
    {
        # code...
        $sub = Sub::findOrFail($id);
        $sub->delete();
        return redirect('/sub');
    }
}
