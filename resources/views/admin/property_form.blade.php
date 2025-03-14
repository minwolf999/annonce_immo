@extends('admin.admin_base')

@if (Route::is('admin.new_property'))
    @section('title', 'Créer une nouvelle annonce')
@else
    @section('title', 'Modifier une annonce')
@endif

@section('content')
    <div class="property_div">
        @if (Route::is('admin.new_property'))
            <h2>Créer une nouvelle annonce</h2>
        @else
            <h2>Éditer "{{ $appartment->titre }}"</h2>
        @endif
    
        <form action="" method="post" class="" style="display: flex;" enctype="multipart/form-data">
            @csrf

            @if (Route::is('admin.new_property'))
                @method('POST')
            @else
                @method('PATCH')
            @endif
    
            <div style="width: 50%;">
                <div>
                    <label for="titre">Titre</label>
                    <input type="text" name="titre" id="titre" value="{{ $appartment->titre }}">
        
                    @error('titre')
                        {{ $message }}
                    @enderror
                </div>
        
                <div>
                    <label for="description">Description</label>
                    <textarea name="description" id="description" style="height: 100px">{{ $appartment->description }}</textarea>
        
                    @error('description')
                        {{ $message }}
                    @enderror
                </div>
        
                <div>
                    <label for="surface">Surface</label>
                    <input type="number" class="no-spinners" name="surface" id="surface" value="{{ $appartment->surface }}">
        
                    @error('surface')
                        {{ $message }}
                    @enderror
                </div>
        
                <div>
                    <label for="price">Prix</label>
                    <input type="number" class="no-spinners" name="price" id="price" value="{{ $appartment->price }}" step="0.01">
        
                    @error('price')
                        {{ $message }}
                    @enderror
                </div>
        
                <div>
                    <label for="piece">Pièce</label>
                    <input type="number" class="no-spinners" name="piece" id="piece" value="{{ $appartment->piece }}" step="1">
        
                    @error('piece')
                        {{ $message }}
                    @enderror
                </div>
        
                <div>
                    <label for="bedroom">Chambre</label>
                    <input type="number" class="no-spinners" name="bedroom" id="bedroom" value="{{ $appartment->bedroom }}" step="1">
        
                    @error('bedroom')
                        {{ $message }}
                    @enderror
                </div>
        
                <div>
                    <label for="floor">Étage</label>
                    <input type="number" class="no-spinners" name="floor" id="floor" value="{{ $appartment->floor }}" step="1">
        
                    @error('floor')
                        {{ $message }}
                    @enderror
                </div>
        
                <div>
                    <label for="address">Adresse</label>
                    <input type="text" name="address" id="address" value="{{ $appartment->address }}">
        
                    @error('address')
                        {{ $message }}
                    @enderror
                </div>
        
                <div>
                    <label for="city">Ville</label>
                    <input type="text" name="city" id="city" value="{{ $appartment->city }}">
        
                    @error('city')
                        {{ $message }}
                    @enderror
                </div>
        
                <div>
                    <label for="postal_code">Code Postal</label>
                    <input type="text" name="postal_code" id="postal_code" value="{{ $appartment->postal_code }}">
        
                    @error('postal_code')
                        {{ $message }}
                    @enderror
                </div>

                @php
                    $optionsIds = $appartment->options()->pluck('id');
                    $images = $appartment->images()->get(['id', 'path']);
                @endphp

                <div>
                    <label for="options">Options</label>
                    <select name="options[]" id="options" multiple>
                        @foreach ($options as $option)
                            <option @selected($optionsIds->contains($option->id)) value="{{ $option->id }}">{{ $option->name }}</option>
                        @endforeach
                    </select>
                </div>
        
                <button class="bg-blue">Enregistrer</button>
            </div>

            <!-- right -->
            <div style="width: 50%;">
                <div style="display: flex; flex-direction: row; align-items: center; margin-left: auto;">
                    <input type="checkbox" name="is_sell" id="is_sell" @if ($appartment->is_sell) checked @endif>
                    <label for="is_sell">Vendu ?</label>

                    @error('is_sell')
                        {{ $message }}
                    @enderror
                </div>

                @foreach ($images as $image)
                    <img src="{{ Request::root() }}/storage/{{ $image->path }}" alt="" style="max-height: 200px;">
                    <a class="bg-red" href="#" onclick="event.preventDefault(); document.getElementById('delete-image-{{ $image->id }}').submit();">
                        Supprimer
                    </a>
                @endforeach

                <div>
                    <label for="image">Images</label>
                    <input type="file" name="images[]" id="image" multiple>

                    @error('images')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </form>
    </div>

    @foreach ($images as $image)
        <form id="delete-image-{{ $image->id }}" action="{{ route('admin.delete_image', ['appartment' => $appartment->id,'image' => $image->id]) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    @endforeach
@endsection