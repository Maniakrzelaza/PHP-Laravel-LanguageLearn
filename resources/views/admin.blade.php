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

                        <h3>Witaj {{Auth::user()->name}}</h3>

                    </div>
                    <div>
                        <table style="width:100%">
                            <tr>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>role</th>
                            </tr>


                        @if(count($users)> 0)
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->role->name}}</td>
                                    <td>
                                        {{Form::open(['method'  => 'DELETE', 'route' => ['users.destroy', $user->id]])}}
                                        {{Form::button('Usuń', array('type' => 'submit', 'class' => 'btn btn-danger'))}}
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                        {{Form::open(['method'  => 'GET', 'route' => ['users.edit', $user->id]])}}
                                        {{Form::button('Edytuj', array('type' => 'submit', 'class' => 'btn btn-info'))}}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <p>no !!!</p>
                        @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
