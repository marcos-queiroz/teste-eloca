<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Empresa::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|numeric|unique:empresa,codigo',
            'empresa' => 'required|numeric|unique:empresa,empresa',
            'sigla' => 'required|string|max:40',
            'razao_social' => 'required|string|max:255',
        ]);

        $empresa = Empresa::create($request->all());

        return response()->json($empresa, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $codigo)
    {
        $empresa = Empresa::where('codigo', $codigo)->firstOrFail();
        return response()->json($empresa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $codigo)
    {
        $request->validate([
            'empresa' => 'required|numeric',
            'sigla' => 'required|string|max:40',
            'razao_social' => 'required|string|max:255',
        ]);

        $empresa = Empresa::where('codigo', $codigo)->firstOrFail();
        $empresa->update($request->all());

        return response()->json($empresa);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $codigo)
    {
        $empresa = Empresa::where('codigo', $codigo)->firstOrFail();
        $empresa->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function count()
    {
        $count = Empresa::count();
        return response()->json(['count' => $count]);
    }
}
