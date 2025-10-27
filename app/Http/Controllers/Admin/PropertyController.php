<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyFormRequest;
use App\Models\Option;
use App\Models\Picture;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $property->attachedFiles($data['pictures']);

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
        $property->attachedFiles($data['pictures']);
        return redirect()->route('admin.property.show', ['property' => $property->id])
            ->with('success', 'Property updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        Picture::destroy($property->pictures()->pluck('id')->toArray());

        Storage::disk('public')->deleteDirectory('properties/' . $property->id);
        $property->delete();
        return redirect()->route('admin.property.index')
            ->with('success', 'Property deleted successfully!');
    }
}
