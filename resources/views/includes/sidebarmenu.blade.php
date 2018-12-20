    @inject('company', 'HungerManagement\Http\Controllers\CompanyController') 
    @php $datacompany = $company->getCompany(Auth::user()->empresas_id_empresa); @endphp
<div id="sidebar"  class="nav-collapse">
    <ul class="sidebar-menu sidebar_scrollbar" id="nav-accordion" >
        <p class="centered"><img src="{{asset('/img/logo/'.$datacompany->logo_img)}}" class="img-fluid" width="180"></p>
        <p class="centered"><a href=""><img src="{{asset('/img/icon/User No-Frame.png')}}" class="img-circle" width="60"></a></p>
        <h5 class="centered">Olá @if (Auth::check()) {{{explode(' ',trim(Auth::user()->nome_usuario))[0]}}} @endif</h5>                       
        <li class="mt">
            <a href="/home">
                <i class="fa fa-home"></i>
                <span>Home</span>
            </a>
        </li>
        @can('isAttendent')  
        <li class="sub-menu">
            <a href="/registerclient">
                <i class="fa fa-book"></i>
                <span>Clientes</span>
            </a>
        </li>
        @endcan        
        @can('isAdmin')
        <li class="sub-menu">
            <a href="/registerclient">
                <i class="fa fa-book"></i>
                <span>Clientes</span>
            </a>
        </li>
        <li class="sub-menu">
            <a href="/registerproducts" >
                <i class="fa fa-shopping-cart"></i>
                <span>Produtos</span>
            </a>
        </li>             
        <li class="sub-menu">
            <a href="/registerdeliveryman" >
                <i class="fa fa-automobile"></i>
                <span>Entregadores</span>
            </a>
        </li>
        @endcan
        @can('isAttendent')
        <li class="sub-menu">
            <a href="/registerrequests" >
                <i class="fa fa-book"></i>
                <span>Pedidos</span>
            </a>
        </li>
        @endcan
        @can('isAdmin')
        <li class="sub-menu">
            <a href="/registerrequests" >
                <i class="fa fa-book"></i>
                <span>Pedidos</span>
            </a>
        </li>
        @endcan
        @can('isAdmin')
        <li class="sub-menu">
            <a href="/administration">
                <i class="fa fa-cogs"></i>
                <span>Administração</span>
            </a>
        </li>
        @endcan
        @guest
        <li class="sub-menu"><a class="nav-link" href="{{ url('/') }}">Inicio</a></li>
        <!--  <li><a class="nav-link" href="{{ route('register') }}">Registre-se</a></li> -->
        @else
        <li class="sub-menu">            
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                <i class="fa fa-backward"></i>
                Sair
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
        @endguest  
        <li class="sub-menu-final"></li>
    </ul>
    <div id="sidebar-menu-btn" title="Clique Me!">
        <img id="imagesidebarmenu" src="{{asset('/img/prewiev-arrow-right.png')}}" class="img-expand">
        <!--<span></span>
        <span></span>
        <span></span>-->
    </div>
</div>
<script src="{{ asset('/js/control_scripts/sidebarmenucontrol.js') }}" type="text/javascript" ></script> 