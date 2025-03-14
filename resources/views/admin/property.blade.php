@extends('admin.admin_base')

@section('title', 'Annonces')

@section('content')
    <div class="center">
        <div class="header">
            <h1>Les biens</h1>

            <a href="{{ route('admin.new_property') }}" class="bg-blue" style="margin: auto 0;">Ajouter un bien</a>
        </div>
        
        <table cellspacing="0" cellpadding="0">
            <thread>
                <tr style="background: none;">
                    <th scope="col" width="35%">Titre</th>
                    <th scope="col">Surface</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Ville</th>
                    <th scope="col" style="text-align: right;">Actions</th>
                </tr>
            </thread>

            <tbody>
                @foreach ($appartments as $appartment)
                    <tr>
                        <td>{{ $appartment->titre }}</td>
                        <td>{{ $appartment->surface }}m<sup>2</sup></td>
                        <td>{{ $appartment->price }}€</td>
                        <td>{{ $appartment->city }}</td>
                        <td style="text-align: right;">
                            <a class="bg-blue" href="{{ route('admin.modificate_property', ['appartment' => $appartment->id]) }}">Éditer</a>
                            <a class="bg-red" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $appartment->id }}').submit();">
                                Supprimer
                            </a>

                            <form id="delete-form-{{ $appartment->id }}" action="{{ route('admin.delete_property', ['appartment' => $appartment->id]) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
@endsection