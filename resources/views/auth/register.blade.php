<link href="{{asset('/css/systemparameters.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('/css/registerdeliverymantable.css')}}" rel="stylesheet">
<div class="wrapper">
    <div class="navbar-collapse">
        <nav class="navbar navbar-laravel">
            <div class="btn-group btn-group-justified">
                <ul class="navbar-nav mr-auto">
                    <button type="button" class="btn btn-theme04" onclick="window.location.href = '/administration'"><i class="fa fa-arrow-left"></i> Voltar ao Menu</button>
                </ul>
                <ul class="navbar-nav page_identify">
                    <p>Cadastro de Usuários</p>
                </ul>             
                <ul class="navbar-nav navbar-right">   
                    <div class="col-md-12">

                    </div>
                </ul>
            </div>
        </nav>         
    </div>
    @inject('company', 'HungerManagement\Http\Controllers\CompanyController')
    <div class="row">
        <div class="col-lg-12">
            <div class="content-panel">
                <section>
                    <div class="container">
                        <form method="POST" action="{{ route('register') }}" class="formregister">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id_empresa" value="{{Auth::user()->empresas_id_empresa}}">
                            <fieldset>
                                <div id="userData">
                                    <input type="hidden" name="id_usuario" value="">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>
                                        <div class="col-md-6">
                                            <input id="nome_usuario" type="text" class="form-control{{ $errors->has('nome_usuario') ? ' is-invalid' : '' }}" name="nome_usuario" value="{{ old('nome_usuario') }}" required autofocus>
                                            @if ($errors->has('nome_usuario'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('nome_usuario') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--<div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>-->
                                    <div class="form-group row">
                                        <label for="cpf" class="col-md-4 col-form-label text-md-right">CPF</label>
                                        <div class="col-md-6">
                                            <input id="cpf" type="text" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" name="cpf" value="{{ old('cpf') }}"  required>
                                            @if ($errors->has('cpf'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('cpf') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>                            
                                    <div class="form-group row">
                                        <label for="username" class="col-md-4 col-form-label text-md-right">Login</label>
                                        <div class="col-md-6">
                                            <input id="login_usuario" type="text" class="form-control{{ $errors->has('login_usuario') ? ' is-invalid' : '' }}" name="login_usuario" value="{{ old('login_usuario') }}"  required>
                                            @if ($errors->has('login_usuario'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('login_usuario') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>
                                        <div class="col-md-6">
                                            <input id="senha_usuario" type="password" class="form-control{{ $errors->has('senha_usuario') ? ' is-invalid' : '' }}" name="senha_usuario" required>
                                            @if ($errors->has('senha_usuario'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('senha_usuario') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmação de Senha</label>
                                        <div class="col-md-6">
                                            <input id="senha_usuario-confirm" type="password" class="form-control" name="senha_usuario_confirmation" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tipousuario" class="col-md-4 col-form-label text-md-right">Nível de Acesso</label>
                                        <div class="col-md-6">
                                            <select class="form-control select" name="tipo_usuario" required>
                                                <option value="">Selecione o nível de acesso</option>
                                                <option value="1" disabled>Administrador</option>
                                                <option value="2">Atendente</option>
                                                <option value="3">Espectador</option>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-4"> 
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="form-check" checked="checked" name="status_usuario" value="1"> Status
                                                </label>
                                            </div>                                    
                                        </div>
                                    </div> 
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="reset" class="btn btn-primary">
                                                Limpar
                                            </button>                                            
                                            <button type="submit" class="btn btn-primary">
                                                Salvar
                                            </button>
                                        </div>
                                    </div>
                            </fieldset> 
                        </form>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="content-panel">
                                    <section id="unseen">
                                        <table class="table table-striped points_table">
                                            <thead>
                                                <tr>
                                                    <th class="col-xs-1">Cód.</th>
                                                    <th class="col-xs-3">Nome</th>
                                                    <th class="col-xs-2">Login</th>
                                                    <th class="col-xs-2">Acesso</th>
                                                    <th class="col-xs-2">Status</th>
                                                    <th class="col-xs-2">Opcoes</th>
                                                </tr>
                                            </thead>                                                
                                            <tbody class="points_table_scrollbar"> 
                                                @foreach($company->listUsersCompany(Auth::user()) as $key => $usuario)
                                                <tr class="even"> 
                                                    <td class="col-xs-1">{{$usuario->id_usuario}}</td>
                                                    <td class="col-xs-3">{{$usuario->nome_usuario}}</td>
                                                    <td class="col-xs-2">{{$usuario->login_usuario}}</td>
                                                    <td class="col-xs-2">@if ($usuario->tipo_usuario == 2) Atendente @elseif ($usuario->tipo_usuario == 3) Espectador @endif</td>
                                                    <td class="col-xs-2">@if ($usuario->status_usuario == 1) Ativo @elseif ($usuario->status_usuario == 0) Desativado @endif</td>
                                                    <td class="col-xs-2">
                                                        <button class='btn btn-primary' onclick="updateUser({{$usuario->id_usuario}}) "><i class='fa fa-pencil'></i></button>                                                                     
                                                    </td>
                                                </tr>
                                                @endforeach 
                                            </tbody>
                                        </table>
                                    </section>
                                </div><!-- /content-panel -->
                            </div><!-- /col-md-12 -->
                        </div><!-- /row -->                            
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
    function updateUser(id_usuario) {
        var $request = $.get('/getuser', {value: id_usuario}, function (result) {
            $('#userData').html(result.html);
        });
    }
</script>      