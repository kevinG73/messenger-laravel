@extends('layouts.basic')

@section('content')
    <div class="normal-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="normal-table-list">
                        <div class="basic-tb-hd">
                            <h2>Bôite de reception des emails</h2>
                        </div>
                        <div class="bsc-tbl">
                            @if(isset($mail) && !empty($mail))
                                <table class="table table-sc-ex">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Destinatire</th>
                                        <th>objet</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($mail as $cl)
                                        <tr>
                                            <td>{{$cl['id']}}</td>
                                            <td>
                                                {{ $cl['etudiant']['user']['first_name']   ?? '' }}
                                                {{ $cl['etudiant']['user']['last_name']   ?? '' }}
                                            </td>
                                            <td>{{$cl['objet']}}</td>
                                            <td>{{ date('d-M-y', strtotime($cl['created_at']))  }}</td>
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
