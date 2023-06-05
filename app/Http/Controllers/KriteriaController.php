<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Validated;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kriteria = Kriteria::all();
        // $kriteria = Kriteria::with('dokuments')->get();

        return view('kriteria', ['data' => $kriteria]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $kriteria = Kriteria::select('name', 'keterangan')->get();

        dd($kriteria);
        return view('kriteria-add', ['class' => $kriteria]);
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
        //     'code' => 'unique:kriteria',
        // ]);
        // $request->validate([
        //     'code' => 'unique:kriteria'
        // ], [
        //     'code' => 'unimeric harus berbeda beb!.'
        // ]);

        $kriteria = Kriteria::create($request->all());

        if ($kriteria) {
            # code...
            Session::flash('status', 'succes');
            Session::flash('message', 'add new kriteria succes!');
        }


        return redirect('kriteria');
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
        $kriteria = Kriteria::find($id);
        $kriteria->update($request->all());
        return redirect('kriteria');
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
        $kriteria = Kriteria::find($id);
        $kriteria->deskripsi = $request["keterangan"];
        $kriteria->save();
        dd($request);
        return redirect('/kriteria');
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
        $flight = Kriteria::find(1);
        $flight->delete();

        $kriteria = Kriteria::all();
        // $kriteria = Kriteria::with('dokuments')->get();

        return view('kriteria', ['data' => $kriteria]);
    }

    public function delete($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();
        return redirect('/kriteria');
    }
}
