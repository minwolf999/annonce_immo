@extends('admin.admin_base')

@section('title', 'Options')

@section('content')
    <div class="center">
        <div class="header">
            <h1>Les options</h1>

            <a href="{{ route('admin.new_option') }}" class="bg-blue" style="margin: auto 0;">Ajouter une option</a>
        </div>
        
        <table cellspacing="0" cellpadding="0">
            <thread>
                <tr style="background: none;">
                    <th scope="col" width="35%">Nom</th>
                    <th scope="col" style="text-align: right;">Actions</th>
                </tr>
            </thread>

            <tbody>
                @foreach ($options as $option)
                    <tr>
                        <td>{{ $option->name }}</td>
                        <td style="text-align: right;">
                            <a class="bg-blue" href="{{ route('admin.modificate_option', ['options' => $option->id]) }}">Éditer</a>

                            <a class="bg-red" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $option->id }}').submit();">
                                Supprimer
                            </a>

                            <form id="delete-form-{{ $option->id }}" action="{{ route('admin.delete_option', ['options' => $option->id]) }}" method="POST" style="display: none;">
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