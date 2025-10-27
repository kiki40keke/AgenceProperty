<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyFormRequest;
use App\Http\Requests\Client\PropertyContactRequest;
use App\Http\Requests\Client\SearchPropertyRequest;
use App\Mail\PropertyContactMail;
use App\Models\Option;
use App\Models\Property;
use Illuminate\Support\Facades\Mail;

class PropertyController extends Controller
{
    public function index(SearchPropertyRequest $request)
    {
        $query=Property::Query();

        if($request->filled('min_price')){
            $query->where('price','>=',$request->input('min_price'));
        }
        if($request->filled('max_price')){
            $query->where('price','<=',$request->input('max_price'));
        }
        if($request->filled('min_surface')){
            $query->where('surface','>=',$request->input('min_surface'));
        }
        if($request->filled('max_surface')){
            $query->where('surface','<=',$request->input('max_surface'));
        }
        if($request->filled('rooms')){
            $query->where('rooms','>=',$request->input('rooms'));
        }
        if($request->filled('bedrooms')){
            $query->where('bedrooms','>=',$request->input('bedrooms'));
        }
        if($request->filled('options')){
            $options=$request->input('options');
            $query->whereHas('options',function ($q) use ($options){
                $q->whereIn('options.id',$options);
            });
        }


        $inputs=$request->validated();
        $properties = $query->paginate(8);
        $options =Option::pluck('name','id')->toArray();
        return view('client.property.index',compact('properties','inputs','options'));

    }

    public function show($slug, $property)
    {
        $property = Property::findOrFail($property)->load('options');
        if ($slug !== $property->getSlug()) {
            return redirect()->route('properties.show', [
                'slug' => $property->getSlug(),
                'property' => $property->id
            ], 301);
        }
        return view('client.property.show', compact('property'));
    }

    public  function contact (PropertyContactRequest $request, Property $property)
    {
        Mail::send(new PropertyContactMail($property, $request->validated()));
        return back()->with('success', 'Your inquiry has been sent successfully.');
    }
}
