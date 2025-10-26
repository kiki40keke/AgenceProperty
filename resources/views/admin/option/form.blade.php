@extends('admin.layout')

@section('name',$option->exists ? 'Edit Option' : 'Add New Option')

@section('content')
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h3 class="card-title mb-3">Create a option</h3>

            <form action="{{ route($option->exists ? 'admin.option.update' : 'admin.option.store',$option) }}" method="post"   novalidate>
                @csrf
             @method($option->exists ? 'PUT' : 'POST')
                <div class="row">
                    @include('shared.input', ['class' => 'col-6 mb-3', 'label' => 'Title', 'name' => 'name', 'value' => $option->name ?? '', 'placeholder' => 'Ex: Swimming Pool'])
                    <div class="col-12">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                {{ $option->exists ? 'Update Option' : 'Create Option' }}
                            </button>
                            <a href="{{route('admin.option.index')}}" class="btn btn-outline-secondary">Annuler</a>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
