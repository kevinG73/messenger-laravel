@extends('layouts.basic')

@section('content')
    <div class="normal-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="normal-table-list">
                        <div class="basic-tb-hd">
                            <h2>Liste des classes</h2>
                        </div>
                        <div class="bsc-tbl">
                            @if(isset($classes) && !empty($classes))
                                <table class="table table-sc-ex">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOM</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($classes as $cl)
                                        <tr>
                                            <td>{{$cl->id}}</td>
                                            <td>{{$cl->nom}}</td>
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
