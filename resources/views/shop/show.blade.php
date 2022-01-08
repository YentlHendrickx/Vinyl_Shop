@extends('layouts.template')

@section('title', 'Record')

@section('main')
    <h1>{{ $record->title }}</h1>
    @include('shared.alert');
    @auth()
        @if(auth()->user()->admin)
            <div class="alert alert-primary">
                <a href="/admin/records/create" class="btn btn-success">
                    <i class="fas fa-plus-circle mr-1"></i>New record
                </a>
                <a href="/admin/records/{{ $record->id }}/edit" class="btn btn-primary">
                    <i class="fas fa-edit mr-1"></i>Edit record
                </a>
                <a href="#!" class="btn btn-danger" id="deleteRecord">
                    <i class="fas fa-trash mr-1"></i>Delete record
                </a>
            </div>
        @endif
    @endauth
    <div class="row">
        <div class="col-sm-4 text-center">
            <img class="img-thumbnail" id="cover" src="/assets/vinyl.png" data-src="{{ $record->cover }}"
                 alt="{{ $record->title }}">
            <p>
                <a href="#!" class="btn {{ $record->btnClass }} btn-sm btn-block mt-3">
                    <i class="fas fa-cart-plus mr-3"></i>Add to cart
                </a>
            </p>
            <p class="text-left">Genre: {{ $record->genreName }}<br>
                Stock: {{ $record->stock }}<br>
                Price: € {{ $record->price }}</p>
        </div>
        <div class="col-sm-8">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Track</th>
                    <th>Length</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tracks as $track)
                    <tr>
                        <td>{{ $track['position'] }}</td>
                        <td>{{ $track['title'] }}</td>
                        <td>{{ $track['length'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script_after')
    <script>
        $('#cover').attr('src', $('#cover').data('src'));
    </script>
@endsection
