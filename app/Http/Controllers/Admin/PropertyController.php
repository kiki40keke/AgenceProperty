<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyFormRequest;
use App\Models\Option;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.properties.index',[
            'properties' => Property::orderBy('created_at', 'desc')->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.properties.form',[
        'property' => new Property(),'options' =>Option::pluck('name','id')->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyFormRequest $request)
    {
        $data = $request->validated();
        $property = Property::create($data);
        $property->options()->sync($data['options']);
        return redirect()->route('admin.property.show', ['property' => $property->id])
            ->with('success', 'Property created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.properties.show',[
            'property' => Property::findOrFail($id)->load('options')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {

        return view('admin.properties.form',[
            'property' => $property,'options' =>Option::pluck('name','id')->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyFormRequest $request, Property $property)
    {

        $data = $request->validated();
        $property->update($data);
        $property->options()->sync($data['options']);
        return redirect()->route('admin.property.show', ['property' => $property->id])
            ->with('success', 'Property updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('admin.property.index')
            ->with('success', 'Property deleted successfully!');
    }
}
