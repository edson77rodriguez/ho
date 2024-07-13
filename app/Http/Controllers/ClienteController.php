<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ClienteController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $clientes = Cliente::latest()->paginate(5);
        
        return view('clientes.index',compact('clientes'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('clientes.create');
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
           'name' => 'required|string|min:5|max:255|regex:/^[a-zA-Z ñ]+$/', 
            'ap_p' => 'required|string|min:5|max:255',
            'ap_m' => 'required|string|min:5|max:255',
            'edad'  => 'required|integer|min:1|max:120',
            'correo' => 'required|string|email|unique:clientes,correo|max:255', 
        ]);
        
        Cliente::create($request->all());
         
        return redirect()->route('clientes.index')
                        ->with('success','Product created successfully.');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente): View
    {
        return view('clientes.show',compact('cliente'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente): View
    {
        return view('clientes.edit',compact('cliente'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente): RedirectResponse
    {
        $request->validate([
          'name' => 'required', 
           'ap_p' => 'required',
           'ap_m' => 'required',
           'edad' => 'required',
           'correo' => 'required',
        ]);
        
        $product->update($request->all());
        
        return redirect()->route('clientes.index')
                        ->with('success','Cliente updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente): RedirectResponse
    {
        $cliente->delete();
         
        return redirect()->route('clientes.index')
                        ->with('success','cliente deleted successfully');
    }
}
