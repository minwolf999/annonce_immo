@extends('base')

@section('title', 'Annonces')

@section('content')
    <div style="margin: 10px">
        <form class="grid" action="{{ route('filter_properties') }}" style="width: 50%; margin: 25px auto;" method="post">
            @csrf

            <input class="no-spinners" style="border-radius: 5px; height: 36px" type="number" name="surface" id="surface" placeholder="Surface minimum">
            <input class="no-spinners" style="border-radius: 5px; height: 36px" type="number" name="piece" id="piece" placeholder="Nombre de pièces min">
            <input class="no-spinners" style="border-radius: 5px; height: 36px" type="number" name="price" id="price" placeholder="Budget max">
            <select style="border-radius: 5px; width: 180px; height: 36px; padding-top: 5px" name="options[]" id="option" multiple>
                @foreach ($options as $option)
                    <option value="{{ $option->id }}">{{ $option->name }}</option>
                @endforeach
            </select>
            <button class="bg-blue" style="font-size: 13px;">Rechercher</button>
        </form>
    </div>

    <div class="property_div">
        <div class="grid" style="margin-top: 80px;">
            @foreach ($appartments as $appartment)
            <div class="shadow" style="overflow: hidden; border-radius: 40px; padding-bottom: 25px; color: grey; border: 1px solid black">
                    <img src="{{ Request::root() }}/storage/{{ $appartment->images()->first()->path }}" height="200px" width="100%" alt="" style="margin-bottom: 10px;">
                    <p style="color: black;"><b>{{ $appartment->titre }}</b></p>

                    <div style="border: none; display: flex; margin: 15px auto; padding: 10px; width: 90%;">
                        <div style="display: flex; border: none; align-items: center;">
                            <img src="{{ Request::root() }}/rubber.png" alt="" width="20px" height="20px">
                            <p>{{ $appartment->surface }} m<sup>2</sup></p>
                        </div>
    
                        <div style="display: flex; border: none; align-items: center; margin-left: auto">
                            <img src="{{ Request::root() }}/ping.png" alt="" width="20px" height="20px">
                            <p>{{ $appartment->city }} ({{ $appartment->postal_code }})</p>
                        </div>
                    </div>

                    
                    <div style="display: flex; align-items: center; border: none;">
                        <h3 style="color: black">{{ $appartment->price }} €</h3>
                        <p style="margin: 5px;;">/mois</p>
                        <a class="bg-red shadow" style="margin-left: auto;" href="{{ route('detail_property', ['appartment' => $appartment->id]) }}">VOIR PLUS</a>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
    {{ $appartments->links() }}
@endsection