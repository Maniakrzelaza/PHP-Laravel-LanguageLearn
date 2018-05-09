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

                        {{Form::open(['action'=> ['UsersController@update',$editUser->id],'method'=>'PUT'])}}
                        <div class="form-group">
                            {{Form::label('title','Nazwa')}}
                            {{Form::text('title',''.$editUser->name,['class'=>'form-control','placeholder'=>$editUser->name, 'value'=>$editUser->name ])}}
                        </div>
                        <div class="form-group">
                            <label for=""> Role</label>
                            <select class="form-control input-sm" name="role" value="{{$editUser->role_id}}">
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        {{Form::submit('Aktualizuj',['class'=>'btn btn-primary'])}}
                        {{Form::close()}}
                    </div>
                    <hr style="color: #4267b2 !important;">

                    <table>
                        <tr>
                            <th width="40%"><h4>Dodaj uprawnienia</h4></th>
                            <th width="40%"><h4>Usuń uprawnienia</h4></th>
                        </tr>
                        <tr>
                            <td>
                                {{Form::open(['action'=> ['PriviligesController@addPrivilige',$editUser->id],'method'=>'POST'])}}
                                <div class="form-group">
                                    <select class="form-control input-sm" name="subcategory">
                                        @foreach($subcategorie as $subcategory)
                                            <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{Form::submit('Dodaj',['class'=>'btn btn-primary'])}}
                                {{Form::close()}}
                            </td>


                            <td>
                                {{Form::open(['action'=> ['PriviligesController@removePrivilige',$editUser->id],'method'=>'POST'])}}
                                <div class="form-group">
                                    <select class="form-control input-sm" name="privilige">
                                        @foreach($userPriviliges as $privilige)
                                            <option value="{{$privilige->subcategory_id}}">{{$privilige->subcategory->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{Form::submit('Zabierz',['class'=>'btn btn-danger'])}}
                                {{Form::close()}}
                            </td>
                        </tr>
                    </table>


                </div>
            </div>
        </div>
    </div>
@endsection