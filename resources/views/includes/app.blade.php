<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    @include('includes.head') 
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel navbar-fixed-top">
        @guest 
        <link href="{{ asset('/css/login.css') }}" rel="stylesheet">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"> 
                <!-- Authentication Links -->                                        
                <div>
                    <li><a class="link" href="{{ url('/') }}">Início</a></li>
                    <!--  <li><a class="nav-link" href="{{ route('register') }}">Registre-se</a></li> -->
                </div>                    
            </ul>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav navbar-right">                       
                <div>
                    <li class="systemname">Sistema de Gestão Hunger Management</li>
                </div>  
            </ul> 
        </div>
        @else
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">  
                @inject('company', 'HungerManagement\Http\Controllers\CompanyController')
                <div class="company"><a href="https://www.facebook.com/{{$company->show(Auth::user()->empresas_id_empresa)->empresa[0]->id_page_empresa}}" class="logo"><b>{{$company->show(Auth::user()->empresas_id_empresa)->empresa[0]->nome_fantasia}}</b></a></div>
            </ul>
        </div>
        <!--<a href="/validation" class="linkvalidacao"><b>!!!Clique aqui para o questionário de validação!!!</b></a>-->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <!--  <ul class="navbar-nav mr-auto">                          
              </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav navbar-right">                       
                <!-- Authentication Links -->
                <div>
                    <li class="systemname">Sistema de Gestão Hunger Management</li>
                </div>  
            </ul> 
        </div>                
        @endguest 
    </nav>
    <body>
        <div id="app" class="bg">
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </body> 
</html>
