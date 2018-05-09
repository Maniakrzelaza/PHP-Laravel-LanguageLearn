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
                    {{Form::open(['action'=> ['WordSetController@update',$wordset->id],'method'=>'PUT'])}}
                    <div class="form-group">
                        {{Form::label('title','Tytul')}}
                        {{Form::text('title',$wordset->name,['class'=>'form-control','placeholder'=>'Tytul'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('body','Słowa')}}
                        {{Form::textarea('body',$wordset->words,['class'=>'form-control','placeholder'=>'Slówka', 'rows'=>3])}}
                    </div>
                    <table>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for=""> Jezyk nr 1</label>
                                    <select class="form-control input-sm" name="lang1">
                                        @foreach($langList as $lang)
                                            @if($wordset->lang1_id==$lang->id)
                                                <option value="{{$lang->id}}" selected>{{$lang->name}}</option>
                                            @else
                                                <option value="{{$lang->id}}">{{$lang->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for=""> Jezyk nr 2</label>
                                    <select class="form-control input-sm" name="lang2" value="{{$wordset->lang2_id}}">
                                        @foreach($langList as $lang)
                                            @if($wordset->lang2_id==$lang->id)
                                                <option value="{{$lang->id}}" selected>{{$lang->name}}</option>
                                            @else
                                                <option value="{{$lang->id}}">{{$lang->name}}</option>
                                            @endif

                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for=""> Jezyk nr 2</label>
                                    <select class="form-control input-sm" name="subcategory" value="{{$wordset->subcategory->id}}">
                                        @foreach($subcategoryList as $subcategory)
                                            @if($wordset->subcategory->id==$subcategory->id)
                                                <option value="{{$subcategory->id}}" selected>{{$subcategory->name}}</option>
                                            @else
                                                <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </td>

                        </tr>
                    </table>



                    {{Form::hidden('priv',serialize($wordset->priv)) }}
                    {{Form::submit('Edytuj',['class'=>'btn btn-primary'])}}
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection