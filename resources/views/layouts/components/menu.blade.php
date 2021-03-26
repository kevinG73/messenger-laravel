<div class="main-menu-area mg-tb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                    <li><a data-toggle="tab" href="#Home"><i class="notika-icon notika-house"></i>Dashboard</a>
                    </li>
                    <li><a data-toggle="tab" href="#mailbox"><i class="notika-icon notika-mail"></i> Email</a>
                    </li>
                    <li><a data-toggle="tab" href="#Charts"><i class="notika-icon notika-bar-chart"></i> Etudiants</a>
                    </li>
                </ul>
                <div class="tab-content custom-menu-content">
                    <div id="Home" class="tab-pane in notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            <li><a href="{{route('classe.index')}}">Dashboard</a>
                            </li>
                        </ul>
                    </div>
                    <div id="mailbox" class="tab-pane notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            <li><a href="{{route('mail.history')}}">Liste des emails</a>
                            </li>
                            <li><a href="{{route('mail.create')}}">envoyer un email</a>
                            </li>
                        </ul>
                    </div>
                    <div id="Charts" class="tab-pane notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            <li><a href="{{route('etudiant.index')}}">Liste des étudiants</a>
                            </li>
                            <li><a href="{{route('etudiant.create')}}">créer un étudiant</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
