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
                                    {{Form::open(['action'=> ['CategoryController@update',$id],'method'=>'PUT'])}}
                                    <div class="form-group">
                                        {{Form::label('title','Nazwa Kategori')}}
                                        {{Form::text('title',$cat->name,['class'=>'form-control','placeholder'=>'Nazwa'])}}
                                    </div>
                                    <div style="height: 37px"></div>
                                    <div class="form-group">
                                        {{Form::label('body','Słowa')}}
                                        {{Form::textarea('body',$cat->description,['class'=>'form-control','placeholder'=>'Opis', 'rows'=>2])}}
                                        {{Form::submit('Edytuj Kategorie',['class'=>'btn btn-primary'])}}
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