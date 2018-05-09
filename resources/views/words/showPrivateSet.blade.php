@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        <table class="table-striped">
                            <tr>
                                <th width="15%">Kategoria</th>
                                <th width="15%">Podkategoria</th>
                                <th width="15%">Nazwa</th>
                                <th width="15%">Usun</th>
                                <th width="15%">Edytuj</th>
                                <th width="15%">Ucz się</th>
                            </tr>
                            @foreach($wordsets as $wordset)
                                <tr>
                                    <td><h4>{{$wordset->subcategory->category->name}}</h4></td>
                                    <td><h4>{{$wordset->subcategory->name}}</h4></td>
                                    <td><h4>{{$wordset->name}}</h4></td>
                                    <td>
                                        {{Form::open(['action' =>['WordSetController@destroy', $wordset->id], 'method' => 'DELETE', 'class'=>'pull-right' ])}}
                                        {{Form::hidden('_method','DELETE')}}
                                        {{Form::submit('Usuń', ['class'=> 'btn btn-danger' ])}}
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                        {{Form::open(['action' =>['WordSetController@wordsetEdit', $wordset->id], 'method' => 'POST', 'class'=>'pull-right' ])}}
                                        {{Form::hidden('_method','POST')}}
                                        {{Form::submit('Edytuj', ['class'=> 'btn btn-default' ])}}
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                        {{Form::open(['action' =>['LearnController@index', $wordset->id], 'method' => 'POST', 'class'=>'pull-right' ])}}
                                        {{Form::hidden('_method','POST')}}
                                        {{Form::submit('Ucz sie', ['class'=> 'btn btn-primary' ])}}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection