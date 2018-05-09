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


                    </div>
                    <div>
                        <table style="width:100%">
                            <tr>
                                <th><h3>Nazwa Kategori</h3></th>
                                <th><h3>Opis Kategori</h3></th>
                            </tr>
                            <tr>
                                @if(count($categories)> 0)
                                    @foreach($categories as $category)
                                        <div>
                            <tr class="expand-table-header" id="{{$category->name}}">
                                <td>{{$category->name}}</td>
                                <td>{{$category->description}}</td>
                            </tr>

                            <td class="{{$category->name}}" id="switchable" style="display: none">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Nazwa Podkategori</th>
                                        <th>Opis Podkategori</th>
                                    </tr>

                                    @foreach($category->subcategories as $sub)
                                        <div>
                                            <tr class="expand-subtable" id="{{$sub->name}}">
                                                <td>{{$sub->name}}</td>
                                                <td>{{$sub->description}}</td>
                                            </tr>

                                            @foreach($sub->wordsets as $wordset)
                                                @if($wordset->priv==0)
                                                    <tr class="{{$sub->name}}" id="sub-switchable" style="display: none">
                                                        <td>{{$wordset->name}}</td>
                                                        @if($user>0)
                                                            <td>
                                                                {{Form::open(['action' =>['LearnController@challange', $wordset->id], 'method' => 'POST', 'class'=>'pull-right' ])}}
                                                                {{Form::hidden('_method','POST')}}
                                                                {{Form::submit('Sprawdz się', ['class'=> 'btn btn-danger' ])}}
                                                                {{ Form::close() }}
                                                            </td>
                                                        @endif
                                                        <td>
                                                            {{Form::open(['action' =>['LearnController@index', $wordset->id], 'method' => 'POST', 'class'=>'pull-right' ])}}
                                                            {{Form::hidden('_method','POST')}}
                                                            {{Form::submit('Ucz sie', ['class'=> 'btn btn-primary' ])}}
                                                            {{ Form::close() }}
                                                        </td>
                                                        @if(($realUser->hasPrivilige($realUser->id,$sub->id) && $user>1) || ($user==4) || ($realUser->isItUsersSet($realUser->id,$wordset->id)))
                                                            <td>
                                                                {{Form::open(['action' =>['WordSetController@wordsetEdit', $wordset->id], 'method' => 'POST', 'class'=>'pull-right' ])}}
                                                                {{Form::hidden('_method','POST')}}
                                                                {{Form::submit('Edytuj', ['class'=> 'btn btn-default' ])}}
                                                                {{ Form::close() }}
                                                            </td>
                                                            <td>
                                                                {{Form::open(['action' =>['WordSetController@destroy', $wordset->id], 'method' => 'DELETE', 'class'=>'pull-right' ])}}
                                                                {{Form::hidden('_method','DELETE')}}
                                                                {{Form::submit('Usuń', ['class'=> 'btn btn-danger' ])}}
                                                                {{ Form::close() }}
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endif
                                            @endforeach


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



