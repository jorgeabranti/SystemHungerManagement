<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include('includes.head') 
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/welcome.css') }}" rel="stylesheet">
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
            <div class="top-right links">
                @auth
                <a href="{{ url('/home') }}">Home</a>
                @else
                <a href="{{ route('login') }}">Login</a>
                <!--   <a href="{{ route('register') }}">Register</a> -->
                @endauth
            </div>
            @endif
            <div class="content"> 
                <div class="imagefastfood">
                <div class="title1">
                    Sistema de Gestão
                </div>              
                <div class="title">
                    Hunger Management
                </div>   
                </div>                  
                <div class="doc">
                    <a href="{{ asset('/doc/hunger_management_doc.pdf') }}">Documentação</a>
                    <!--<a href="https://github.com/jorgeabranti">GitHub</a>-->
                    <a href="{{ asset('/policies') }}">Politicas de Privacidade</a>
                </div> 
            </div>
        </div>  
    </body>     
</html>
