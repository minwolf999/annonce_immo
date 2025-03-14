@extends('admin.admin_base')

@if (Route::is('admin.new_option'))
    @section('title', 'Créer une nouvelle option')
@else
    @section('title', 'Modifier une option')
@endif

@section('content')
    <div class="property_div">
        @if (Route::is('admin.new_option'))
            <h2>Créer une nouvelle option</h2>
        @else
            <h2>Éditer "{{ $option->name }}"</h2>
        @endif
    
        <form action="" method="post" class="">
            @csrf

            @if (Route::is('admin.new_option'))
                @method('POST')
            @else
                @method('PATCH')
            @endif
    
            <div>
                <label for="name">Nom</label>
                <input type="text" name="name" id="name" value="{{ $option->name }}">
    
                @error('name')
                    {{ $message }}
                @enderror
            </div>
    
            <button class="bg-blue">Enregistrer</button>
        </form>
    </div>
@endsection