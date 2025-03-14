@extends('base')

@section('title', 'Accueil')

@section('content')
    <div class="property_div">
        <h1 style="text-align: center; font-size: 40px">Agence lorem ipsum</h1>
        <p style="width: 50%; margin: auto; text-align: center">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure, modi accusantium perferendis quos quae magni, quisquam reprehenderit dolorum nam non officiis doloribus enim impedit quasi aliquam magnam vel, obcaecati maiores!
        </p>

        <div class="grid" style="margin-top: 80px">
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
@endsection