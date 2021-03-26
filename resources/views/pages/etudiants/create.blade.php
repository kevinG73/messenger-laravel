@extends('layouts.basic')

@section('title')
    créer un étudiant
@endsection

@section('content')
    <!-- Compose email area Start-->
    <div class="inbox-area">
        <div class="container">
            <form method="post" action="{{route('etudiant.store')}}" class="row">
                @csrf

                <div class="col-lg-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <form method="post" action="{{route('etudiant.store')}}" class="view-mail-list sm-res-mg-t-30">
                        @csrf
                        <div class="cmp-int mg-t-20">
                            <div class="row">
                                <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                    <div class="cmp-int-lb cmp-int-lb1 text-right">
                                        <span>Classe: </span>
                                    </div>
                                </div>
                                <div class="col-lg-11 col-md-10 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <div class="nk-int-st cmp-int-in cmp-email-over">
                                            <select name="classe_id" id="id_classe" class="form-control">
                                                @foreach($classes as $classe)
                                                    <option value="{{$classe->id}}">{{$classe->nom}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                    <div class="cmp-int-lb text-right">
                                        <span>Nom: </span>
                                    </div>
                                </div>
                                <div class="col-lg-11 col-md-10 col-sm-10 col-xs-12">
                                    <div class="form-group cmp-em-mg">
                                        <div class="nk-int-st cmp-int-in cmp-email-over">
                                            <input name="nom" value="{{old('nom')}}" type="text" class="form-control"
                                                   placeholder=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                    <div class="cmp-int-lb text-right">
                                        <span>Prenom: </span>
                                    </div>
                                </div>
                                <div class="col-lg-11 col-md-10 col-sm-10 col-xs-12">
                                    <div class="form-group cmp-em-mg">
                                        <div class="nk-int-st cmp-int-in cmp-email-over">
                                            <input name="prenom" value="{{old('prenom')}}" type="text"
                                                   class="form-control" placeholder=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                    <div class="cmp-int-lb text-right">
                                        <span>Email: </span>
                                    </div>
                                </div>
                                <div class="col-lg-11 col-md-10 col-sm-10 col-xs-12">
                                    <div class="form-group cmp-em-mg">
                                        <div class="nk-int-st cmp-int-in cmp-email-over">
                                            <input type="email" value="{{old('email')}}" name="email" class="form-control" placeholder=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                    <div class="cmp-int-lb text-right">
                                        <span>Tel: </span>
                                    </div>
                                </div>
                                <div class="col-lg-11 col-md-10 col-sm-10 col-xs-12">
                                    <div class="form-group cmp-em-mg">
                                        <div class="nk-int-st cmp-int-in cmp-email-over">
                                            <input type="text" name="tel" class="form-control" placeholder=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="vw-ml-action-ls text-right mg-t-20">
                            <div class="btn-group ib-btn-gp active-hook nk-email-inbox">
                                <button type="submit" class="btn btn-default btn-sm waves-effect">enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </form>
        </div>
    </div>
    <!-- Compose email area End-->
@endsection
