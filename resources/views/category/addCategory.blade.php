@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body" >
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                            <table>
                                <tr>
                                    <th>Utwórz Kategorie</th>
                                    <th>Utwórz Podkategorie</th>
                                </tr>
                                <tr>
                                    <td>
                                        {{Form::open(['action'=> 'CategoryController@store','method'=>'POST'])}}
                                        <div class="form-group">
                                            {{Form::label('title','Nazwa Kategori')}}
                                            {{Form::text('title','',['class'=>'form-control','placeholder'=>'Nazwa'])}}
                                        </div>
                                        <div style="height: 37px"></div>
                                        <div class="form-group">
                                            {{Form::label('body','Słowa')}}
                                            {{Form::textarea('body','',['class'=>'form-control','placeholder'=>'Opis', 'rows'=>2])}}
                                            {{Form::submit('Utwórz Kategorie',['class'=>'btn btn-primary'])}}
                                            {{Form::close()}}
                                        </div>
                                    </td>
                                    <td>
                                        {{Form::open(['action'=> 'SubcategoryController@store','method'=>'POST'])}}
                                        <div class="form-group">
                                            {{Form::label('title','Nazwa Podkategori')}}
                                            {{Form::text('title','',['class'=>'form-control','placeholder'=>'Nazwa'])}}
                                        </div>

                                        <select class="form-control input-sm" name="subcategory">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>

                                        <div class="form-group">
                                            {{Form::label('body','Słowa')}}
                                            {{Form::textarea('body','',['class'=>'form-control','placeholder'=>'Opis', 'rows'=>2])}}
                                            {{Form::submit('Utwórz Podkategorie',['class'=>'btn btn-primary'])}}
                                            {{Form::close()}}
                                        </div>
                                    </td>
                                </tr>
                            </table>





                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection