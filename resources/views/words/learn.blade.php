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

                        <h2>{{$wordSet->subcategory->name}}</h2>

                        <h3>{{$wordSet->name}}</h3>

                    </div>
                    <table>
                        <tr>
                            <td><button class="btn btn-primary" id="setLang1" style="width: 100px">PL->ENG</button></td>
                            <td><button class="btn btn-primary" id="setLang2" style="width: 100px">ENG->PL</button></td>
                        </tr>
                    </table>
                    <div class="lang1" style="display:none;">
                        <table>
                            <tr>
                                <td>
                                    <div class="btn btn-primary" id="showBtn1">Pokaż zestaw</div>
                                </td>
                                <td>
                                    <div class="btn btn-primary" id="showAlg1Btn1">Odpytaj</div>
                                </td>
                                <td>
                                    <div class="btn btn-primary" id="showAlg2Btn1">Sprawdz sie</div>
                                </td>
                                <td>
                                    <div class="btn btn-primary" id="showAlg3Btn1">Połącz słowa</div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="lang2" style="display:none;">
                        <table>
                            <tr>
                                <td>
                                    <div class="btn btn-primary" id="showBtn2">Pokaż zestaw</div>
                                </td>
                                <td>
                                    <div class="btn btn-primary" id="showAlg1Btn2">Odpytaj</div>
                                </td>
                                <td>
                                    <div class="btn btn-primary" id="showAlg2Btn2">Sprawdz sie</div>
                                </td>
                                <td>
                                    <div class="btn btn-primary" id="showAlg3Btn2">Połącz słowa</div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="pokaZestaw" style="display: none">
                        <table>
                            @for ($i = 0; $i <= count($words)-2; $i+=2)
                                <tr>
                                    <td><h5>{{ $words[$i] }}</h5></td>
                                    <td><h5>{{$words[$i+1]}}</h5></td>
                                </tr>
                            @endfor
                        </table>
                    </div>
                    <div class="alg1" style="display: none">
                        {{Form::open(['action'=> 'LearnController@respondToLearn','method'=>'POST'])}}
                        <table>
                            @for ($i = 0; $i <= count($words)-2; $i+=2)
                                <tr>
                                    <td>
                                        <h5>{{ $words[$i] }}</h5>
                                    </td>
                                    <td>

                                        {{Form::text('odp'.$i,'',['class'=>'form-control','placeholder'=>'słowo'])}}
                                    </td>
                                </tr>
                            @endfor
                        </table>
                        {{Form::hidden('slowo',serialize($words)) }}
                        {{Form::submit('Zatwierdz',['class'=>'btn btn-primary'])}}
                        {{Form::close()}}
                    </div>
                    <div class="alg2" style="display: none">
                        {{Form::open(['action'=> 'LearnController@respondToCheck','method'=>'POST'])}}
                        <table>
                            @for ($i = 0; $i <= count($words)-2; $i+=2)
                                <tr>
                                    <td>
                                        <h5>{{ $words[$i] }}</h5>
                                    </td>
                                    <td>

                                        {{Form::text('odp'.$i,'',['class'=>'form-control','placeholder'=>'słowo'])}}
                                    </td>
                                </tr>
                            @endfor
                        </table>
                        {{Form::hidden('slowo',serialize($words)) }}
                        {{Form::hidden('wordsetId',$wordSet->id) }}
                        {{Form::submit('Zatwierdz',['class'=>'btn btn-primary'])}}
                        {{Form::close()}}
                    </div>
                    <div class="pokaZestaw2" style="display: none">
                        <table>
                            @for ($i = 0; $i <= count($words)-2; $i+=2)
                                <tr>
                                    <td><h5>{{ $words[$i+1] }}</h5></td>
                                    <td><h5>{{$words[$i]}}</h5></td>
                                </tr>
                            @endfor
                        </table>
                    </div>
                    <div class="alg12" style="display: none">
                        {{Form::open(['action'=> 'LearnController@respondToLearn','method'=>'POST'])}}
                        <table>
                            @for ($i = 0; $i <= count($words)-2; $i+=2)
                                <tr>
                                    <td>
                                        <h5>{{ $words[$i+1] }}</h5>
                                    </td>
                                    <td>

                                        {{Form::text('odp'.($i+1),'',['class'=>'form-control','placeholder'=>'słowo'])}}
                                    </td>
                                </tr>
                            @endfor
                        </table>
                        {{Form::hidden('slowo',serialize($words)) }}
                        {{Form::hidden('langType',1) }}
                        {{Form::submit('Zatwierdz',['class'=>'btn btn-primary'])}}
                        {{Form::close()}}
                    </div>
                    <div class="alg22" style="display: none">
                        {{Form::open(['action'=> 'LearnController@respondToCheck','method'=>'POST'])}}
                        <table>
                            @for ($i = 0; $i <= count($words)-2; $i+=2)
                                <tr>
                                    <td>
                                        <h5>{{ $words[$i+1] }}</h5>
                                    </td>
                                    <td>

                                        {{Form::text('odp'.($i+1),'',['class'=>'form-control','placeholder'=>'słowo'])}}
                                    </td>
                                </tr>
                            @endfor
                        </table>
                        {{Form::hidden('slowo',serialize($words)) }}
                        {{Form::hidden('wordsetId',$wordSet->id) }}
                        {{Form::hidden('langType',1) }}
                        {{Form::submit('Zatwierdz',['class'=>'btn btn-primary'])}}
                        {{Form::close()}}
                    </div>
                    <div class="alg31" style="display:none;">
                        {{Form::open(['action'=> 'LearnController@respondToCheck','method'=>'POST'])}}
                        <table>
                            @for ($i = 0; $i <= count($words)-2; $i+=2)
                                <tr>
                                    <td>
                                       <h4>{{$words[$i]}}</h4>
                                    </td>
                                    <td>

                                        <select class="form-control input-sm" name='odp{{$i}}'>
                                            @for ($y = 0; $y <= count($words)-2; $y+=2)
                                                <option value="{{$words[$y+1]}}">{{$words[$y+1]}}</option>
                                            @endfor
                                        </select>
                                    </td>
                                </tr>
                            @endfor
                        </table>
                        {{Form::hidden('slowo',serialize($words)) }}
                        {{Form::hidden('wordsetId',$wordSet->id) }}
                        {{Form::hidden('langType',0) }}
                        {{Form::submit('Zatwierdz',['class'=>'btn btn-primary'])}}
                        {{Form::close()}}
                    </div>
                    <div class="alg32" style="display: none">
                        {{Form::open(['action'=> 'LearnController@respondToCheck','method'=>'POST'])}}
                        <table>
                            @for ($i = 0; $i <= count($words)-2; $i+=2)
                                <tr>
                                    <td>
                                        <h4>{{$words[$i]}}</h4>
                                    </td>
                                    <td>

                                        <select class="form-control input-sm" name='odp{{$i}}'>
                                            @for ($y = 0; $y <= count($words)-2; $y+=2)
                                                <option value="{{$words[$y+1]}}">{{$words[$y+1]}}</option>
                                            @endfor
                                        </select>
                                    </td>
                                </tr>
                            @endfor
                        </table>
                        {{Form::hidden('slowo',serialize($words)) }}
                        {{Form::hidden('wordsetId',$wordSet->id) }}
                        {{Form::hidden('langType',0) }}
                        {{Form::submit('Zatwierdz',['class'=>'btn btn-primary'])}}
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
