@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged admin !

                    </div>
                    <div>
                        <table style="width:100%">
                            <tr>
                                <th><h3>Nazwa Kategori</h3></th>
                                <th><h3>Opis Kategori</h3></th>
                                <th><h3>Usuń</h3></th>
                            </tr>
                            <tr>
                                @if(count($categories)> 0)
                                    @foreach($categories as $category)
                                        <div>
                            <tr class="expand-table-header" id="{{$category->name}}">
                                <td>{{$category->name}}</td>
                                <td>{{$category->description}}</td>
                                <td>{{Form::open(['method'  => 'DELETE', 'route' => ['category.destroy', $category->id]])}}
                                    {{Form::button('Usuń', array('type' => 'submit', 'class' => 'btn btn-danger'))}}
                                    {{ Form::close() }}
                                </td>
                                <td>{{Form::open(['method'  => 'GET', 'route' => ['category.edit', $category->id]])}}
                                    {{Form::button('Edytuj', array('type' => 'submit', 'class' => 'btn btn-primary'))}}
                                    {{ Form::close() }}
                                </td>
                            </tr>

                            <td class="{{$category->name}}" id="switchable" style="display: none">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Nazwa Podkategori</th>
                                        <th>Opis Podkategori</th>
                                        <th>Usuń Podkategorie</th>
                                    </tr>

                                    @foreach($category->subcategories as $sub)
                                        <div>
                                            <tr class="expand-subtable" id="{{$sub->name}}">
                                                <td>{{$sub->name}}</td>
                                                <td>{{$sub->description}}</td>
                                                <td>{{Form::open(['method'  => 'DELETE', 'route' => ['subcategory.destroy', $sub->id]])}}
                                                    {{Form::button('Usuń', array('type' => 'submit', 'class' => 'btn btn-danger'))}}
                                                    {{ Form::close() }}
                                                </td>
                                                <td>{{Form::open(['method'  => 'GET', 'route' => ['subcategory.edit', $sub->id]])}}
                                                    {{Form::button('Edytuj', array('type' => 'submit', 'class' => 'btn btn-primary'))}}
                                                    {{ Form::close() }}
                                                </td>
                                            </tr>
                                        </div>
                                    @endforeach
                                </table>
                            </td>

                            @endforeach
                            @else
                                <p>Noooo</p>
                                @endif


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



