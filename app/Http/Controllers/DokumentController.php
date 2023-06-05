<?php

namespace App\Http\Controllers;

use App\Models\Dokument;
use App\Models\Kriteria;
use App\Models\Sub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class DokumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dokumentlist  = Dokument::get();
        $kriterias = Kriteria::all();
        $subs = Sub::all();

        return view('dokument', compact('dokumentlist', 'kriterias', 'subs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $kriteria = Kriteria::all();
        $kriteria = Kriteria::select('id', 'name', 'keterangan')->get();
        $sub = Sub::select('name')->get();
        return view('dokument-add', ['kriteria' =>  $kriteria, 'sub' => $sub]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $newName = '';

        if ($request->file('image')) {

            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->name . '.' . now()->timestamp . '.' . $extension;
            $request->file('image')->store('image', $newName);
        }
        $dokument['image'] = $newName;

        // $validated = $request->validate([
        //     'code' => 'unique:dokument',
        // ]);
        // $request->validate([
        //     'code' => 'unique:dokument'
        // ], [
        //     'code' => 'unimeric harus berbeda beb!.'
        // ]);

        $dokument = Dokument::create($request->all());
        if ($dokument) {
            # code...
            Session::flash('status', 'succes');
            Session::flash('message', 'add new dokument succes!');
        }

        return redirect('dokument');
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
        $dokument = Dokument::findOrFail($id);
        return view('dokument-detail', compact('dokumentlist', 'kriterias', 'subs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        //
        // $dokument = Dokument::with('dokument')->findOrFail($id);
        // $dokument = Dokument::where('id', '!=', $dokument->sub_id)->get('id', 'deskripsi');
        // return view('dokument-edit', ['dokument' => $dokument, 'dokument' => $dokument]);
        $dokument = Dokument::find($id);
        $dokument->update($request->all());
        return redirect('dokument');
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
        $dokument = Dokument::find($id);
        // $dokument = $request["image", "kriterias_id", 'subs_id'];
        $dokument->save();
        dd($request);
        return redirect('/dokument');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $request = Dokument::with(['kriteria.sub'])
            ->findOrFail($id);
        $request->delete($id);
        $dokument = Dokument::all();

        // return view('dokument', ['dokumentlist' => $dokument]);
        return view('/dokument', compact('dokumentlist', 'kriterias', 'subs'));
    }

    public function delete($id)
    {
        $dokument = Dokument::findOrFail($id);
        $dokument->delete();
        return redirect('/dokument');
    }
}
