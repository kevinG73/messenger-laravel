@extends('layouts.basic')

@section('content')
    <div class="normal-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="normal-table-list">
                        <div class="basic-tb-hd">
                            <h2>Liste des étudiants</h2>
                        </div>
                        <div class="bsc-tbl">
                            @if(isset($etudiants) && !empty($etudiants))
                                <table class="table table-sc-ex">
                                    <thead>
                                    <tr>
                                        <th>NOM</th>
                                        <th>PRENOMS</th>
                                        <th>TEL</th>
                                        <th>email</th>
                                        <th>classe</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($etudiants as $etd)
                                        <tr>
                                            <td>{{$etd['first_name']}}</td>
                                            <td>{{$etd['last_name']}}</td>
                                            <td>{{$etd['email']}}</td>
                                            <td>{{$etd['tel']}}</td>
                                            <td>{{ $etd['classe'][0]['nom'] ?? '' }}</td>
                                            <td>
                                                <a href="{{route('etudiant.delete',$etd['id'])}}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
