@extends('layouts.basic')

@section('title')
    envoyer un mail
@endsection

@section('css')
    <link href="{{asset('js/trumbowyg/ui/trumbowyg.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <!-- Compose email area Start-->
    <div class="inbox-area">
        <div class="container">
            <form method="post" action="{{route('mail.send')}}" class="row">
                @csrf

                <div class="col-lg-12">
                    <div class="view-mail-list sm-res-mg-t-30">
                        <div class="view-mail-hd">
                            <div class="view-mail-hrd">
                                <h2>Nouveau mail</h2>
                            </div>
                        </div>
                        <div class="cmp-int mg-t-20">
                            <div class="row">
                                <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                                    <div class="cmp-int-lb cmp-int-lb1 text-right">
                                        <span>To: </span>
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
                                        <span>Subject: </span>
                                    </div>
                                </div>
                                <div class="col-lg-11 col-md-10 col-sm-10 col-xs-12">
                                    <div class="form-group cmp-em-mg">
                                        <div class="nk-int-st cmp-int-in cmp-email-over">
                                            <input name="objet" type="text" class="form-control" placeholder=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cmp-int-box mg-t-20">
                            <textarea id="trumbowyg-demo" name="message" class="form-control" required></textarea>
                        </div>

                        <div class="vw-ml-action-ls text-right mg-t-20">
                            <div class="btn-group ib-btn-gp active-hook nk-email-inbox">
                                <button type="submit" class="btn btn-default btn-sm waves-effect">envoyer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Compose email area End-->
@endsection



@section('script')
    <script src="{{asset('js/trumbowyg/trumbowyg.min.js')}}"></script>
    <script>
        $('#trumbowyg-demo').trumbowyg({
            btns: [['strong', 'em',], ['insertImage']],
            autogrow: true,
            lang: 'fr'
        });
    </script>
@endsection
