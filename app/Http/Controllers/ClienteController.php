<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Cliente::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'empresa' => 'required|numeric|exists:empresa,codigo',
            'codigo' => 'required|numeric|unique:cliente,codigo',
            'razao_social' => 'required|string|max:255',
            'tipo' => 'required|in:PJ,PF',
            'cpf_cnpj' => 'required|string|max:14',
        ]);

        $cliente = Cliente::create($request->all());

        return response()->json($cliente, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $codigo)
    {
        $cliente = Cliente::where('codigo', $codigo)->firstOrFail();
        return response()->json($cliente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $codigo)
    {
        $request->validate([
            // 'empresa' => 'required|numeric|exists:empresa,codigo',
            'razao_social' => 'required|string|max:255',
            'tipo' => 'required|in:PJ,PF',
            'cpf_cnpj' => 'required|string|max:14',
        ]);

        $cliente = Cliente::where('codigo', $codigo)->firstOrFail();
        $cliente->update($request->all());

        return response()->json($cliente);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $codigo)
    {
        $empresa = Cliente::where('codigo', $codigo)->firstOrFail();
        $empresa->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
