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
                        <h1>Stwórz zestaw</h1>
                        {{Form::open(['action'=> 'WordSetController@store','method'=>'POST'])}}
                        <div class="form-group">
                            {{Form::label('title','Tytul')}}
                            {{Form::text('title','',['class'=>'form-control','placeholder'=>'Tytul'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('body','Słowa')}}
                            {{Form::textarea('body','',['class'=>'form-control','placeholder'=>'Slówka', 'rows'=>3])}}
                        </div>
                        <table>
                            <tr>
                                <th width="20%">Język nr 1</th>
                                <th width="20%">Jezyk nr 2</th>
                                <th width="20%">Podkategoria</th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <select class="form-control input-sm" name="lang1">
                                            @foreach($langList as $lang)
                                                <option value="{{$lang->id}}">{{$lang->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select class="form-control input-sm" name="lang2">
                                            @foreach($langList as $lang)
                                                <option value="{{$lang->id}}">{{$lang->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select class="form-control input-sm" name="subcategory">
                                            @foreach($subcategoryList as $subcategory)
                                                <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>

                            </tr>
                        </table>




                        {{Form::submit('Utwórz',['class'=>'btn btn-primary'])}}
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection