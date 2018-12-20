<link href="{{asset('/css/menuadministration.css')}}" rel="stylesheet" type="text/css">
<script src="{{ asset('/js/metro.js')}}" type="text/javascript" ></script>
<link href="{{asset('/css/metro.css')}}" rel="stylesheet" type="text/css">
<div class="wrapper">
    <div class="navbar-collapse">
        <nav class="navbar navbar-laravel">
            <div class="btn-group btn-group-justified">
                <ul class="navbar-nav mr-auto">
                    <button type="button" class="btn btn-theme04" onclick="window.location.href = '/home'"><i class="fa fa-home"></i> Voltar para Home</button>
                </ul>
                <ul class="navbar-nav page_identify">
                    <p>Menu Administrativo</p>
                </ul>             
                <ul class="navbar-nav navbar-right">   
                    <div class="col-md-12">

                    </div>
                </ul>
            </div>
        </nav>         
    </div>       
    <div class="row">
        <div class="col-lg-12">
            <div class="content-panel">
                <section>
                    <div class="container-center">
                            <div  class="metro">
                                <div class="metro-sections unselectable">
                                    <div class="metro-section">
                                        <div class="tile tile-double tile-double-vertical bg-color-blueDark" onclick="window.location.href = '/salesreport'">
                                            <div class="tile-icon-large">
                                                <img src="img/icon/Control Panel.png" />
                                            </div>
                                            <span class="tile-label">Relatórios de Vendas</span>
                                        </div>
                                        @can('isAdmin')
                                        <div class="tile tile-double-vertical bg-color-yellow" onclick="window.location.href = '/registeruser'">
                                            <div class="tile-icon-large">
                                                <img src="img/icon/User With Frame.png" />
                                            </div>
                                            <span class="tile-label">Cadastro de Usuários</span>
                                        </div>
                                        @endcan
                                       <!-- <div class="tile bg-color-purple">
                                            <div class="tile-icon-large">
                                                
                                            </div>
                                            <span class="tile-label"></span>
                                        </div>
                                        <div class="tile bg-color-pink">
                                            <div class="tile-icon-large">
                                                
                                            </div>
                                            <span class="tile-label"></span>
                                        </div>
                                        <div class="tile tile-double tile-multi-content">
                                            <div class="tile-content-main">
                                                <div style="padding: 10px;">
                                                    <img src="" style="height: 96px; margin-right: 20px" class="place-left"/>
                                                    <div style="margin-left: 115px; margin-top: 10px">
                                                        <p style="font-size: 36px; margin-top: 0px;"></p>
                                                        <p style="font-size: 18px; margin-top: 0px;"></p>
                                                        <p style="font-size: 12px; margin-top: 5px"></p>
                                                    </div>
                                                </div>
                                                <span class="tile-label"></span>
                                            </div>
                                            <div class="tile-content-sub bg-color-blueDark">
                                                
                                            </div>
                                        </div>
                                        <div class="tile bg-color-orange">
                                            <div class="tile-icon-large">
                                                
                                            </div>
                                            <span class="tile-label"></span>
                                            <span class="tile-counter"></span>
                                        </div>-->
                                        <div class="tile tile-double bg-color-green">
                                            <div class="tile-icon-large">
                                                <img src="img/icon/Calendar.png" />
                                            </div>
                                            <span class="tile-label">Calendar</span>
                                            <span class="tile-counter">8 events</span>
                                        </div>
                                        <div class="tile tile-double bg-color-purple" onclick="window.location.href = '/systemparameters'">
                                            <div class="tile-icon-large">
                                                <img src="img/icon/Configure alt 1.png" />
                                            </div>
                                            <span class="tile-label">Parâmetros de Sistema</span>
                                        </div><!--
                                        <div class="tile bg-color-pink">
                                            <div class="tile-icon-large">
                                                <img src="img/icon/Internet%20Explorer.png" />
                                            </div>
                                            <span class="tile-label">Internet Explorer</span>
                                        </div>
                                        <div class="tile">
                                            <div class="tile-icon-large">
                                                <img src="img/icon/Internet%20Explorer.png" />
                                            </div>
                                            <span class="tile-label">Internet Explorer</span>
                                        </div>
                                        <div class="tile bg-color-darken">
                                            <div class="tile-icon-large">
                                                <img src="img/icon/Internet%20Explorer.png" />
                                            </div>
                                            <span class="tile-label">Internet Explorer</span>
                                        </div>
                                        <div class="tile bg-color-yellow">
                                            <div class="tile-icon-large">
                                                <img src="img/icon/Internet%20Explorer.png" />
                                            </div>
                                            <span class="tile-label">Internet Explorer</span>
                                        </div>
                                        <div class="tile bg-color-orange">
                                            <div class="tile-icon-large">
                                                <img src="img/icon/Internet%20Explorer.png" />
                                            </div>
                                            <span class="tile-label">Internet Explorer</span>
                                        </div>
                                        <div class="tile tile-triple bg-color-purple">
                                            <div class="tile-icon-large">
                                                <img src="img/icon/Music.png" />
                                            </div>
                                            <span class="tile-label">Music</span>
                                        </div>
                                        <div class="tile">
                                            <div class="tile-icon-large">
                                                <img src="img/icon/Android.png" />
                                            </div>
                                            <span class="tile-label">Android</span>
                                        </div>

                                        <div class="tile bg-color-orange">
                                            <div class="tile-icon-large">
                                                <img src="img/icon/Remote%20Desktop.png" />
                                            </div>
                                            <span class="tile-label">Remote Desktop</span>
                                        </div>

                                        <div class="tile bg-color-orange">
                                        </div>

                                        <div class="tile bg-color-orange">
                                        </div>

                                        <div class="tile bg-color-orange">
                                        </div>

                                        <div class="tile tile-double bg-color-blue">
                                            <div class="tile-icon-large">
                                                <img src="img/icon/Live%20SkyDrive.png" />
                                            </div>
                                            <span class="tile-label">Live SkyDrive</span>
                                        </div>
                                        <div class="tile bg-color-blueDark">
                                            <div class="tile-icon-large">
                                                <img src="img/icon/Bluetooth.png" />
                                            </div>
                                            <span class="tile-label">Bluetooth</span>
                                        </div>
                                        <div class="tile bg-color-red">
                                            <div class="tile-icon-large">
                                                <img src="img/icon/Control%20Panel.png" />
                                            </div>
                                            <span class="tile-label">Control Panel</span>
                                        </div>
                                        <div class="tile bg-color-green">
                                            <div class="tile-icon-large">
                                                <img src="img/icon/Signal.png" />
                                            </div>
                                            <span class="tile-label">WiFi Settings</span>
                                        </div>
                                        <div class="tile bg-color-yellow">
                                            <div class="tile-icon-large">
                                                <img src="img/icon/Computer%20alt%202.png" />
                                            </div>
                                            <span class="tile-label">My Computer</span>
                                        </div>
                                    </div>-->
                                </div>     
                        </div>                           
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="row">
        @include('includes.footer') 
    </div>        
</div>
    <script type="text/javascript">
        $(function(){
            window.prettyPrint && prettyPrint();
        });

        $(".metro").metro();

    </script>