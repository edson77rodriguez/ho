<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class MarcaController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $marcas = Marca::latest()->paginate(5);
        
        return view('marcas.index',compact('marcas'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('marcas.create');
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'marca' => 'required',
            'origen' => 'required',
        ]);
        
        Marca::create($request->all());
         
        return redirect()->route('marcas.index')
                        ->with('success','Product created successfully.');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(Marca $marca): View
    {
        return view('marcas.show',compact('marca'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marca $marca): View
    {
        return view('marcas.edit',compact('marca'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marca $marca): RedirectResponse
    {
        $request->validate([
            'marca' => 'required',
            'origen' => 'required',
        ]);
        
        $marca->update($request->all());
        
        return redirect()->route('marcas.index')
                        ->with('success','Marca updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marca $marca): RedirectResponse
    {
        $marca->delete();
         
        return redirect()->route('marcas.index')
                        ->with('success','Product deleted successfully');
    }
}
