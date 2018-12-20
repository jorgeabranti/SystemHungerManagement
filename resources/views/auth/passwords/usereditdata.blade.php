<input type="hidden" name="id_usuario" value="{{$user->id_usuario}}">
@csrf
<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>
    <div class="col-md-6">
        <input id="nome_usuario" type="text" class="form-control{{ $errors->has('nome_usuario') ? ' is-invalid' : '' }}" name="nome_usuario" value="{{$user->nome_usuario}}" required autofocus>
        @if ($errors->has('nome_usuario'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('nome_usuario') }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="cpf" class="col-md-4 col-form-label text-md-right">CPF</label>
    <div class="col-md-6">
        <input id="cpf" type="text" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" name="cpf" value="{{$user->cpf_usuario}}"  required>
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
        <input id="login_usuario" type="text" class="form-control{{ $errors->has('login_usuario') ? ' is-invalid' : '' }}" name="login_usuario" value="{{$user->login_usuario}}" required>
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
        <input id="senha_usuario" type="password" class="form-control{{ $errors->has('senha_usuario') ? ' is-invalid' : '' }}" value="******" name="senha_usuario" required>
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
        <input id="senha_usuario-confirm" type="password" class="form-control" value="******" name="senha_usuario_confirmation" required>
    </div>
</div>
<div class="form-group row">
    <label for="tipousuario" class="col-md-4 col-form-label text-md-right">Nível de Acesso</label>
    <div class="col-md-6">
        <select class="form-control select" name="tipo_usuario" required @php if ($user->tipo_usuario == 1){ echo ' disabled '; } @endphp>
            <option value="" >Selecione o nível de acesso</option>
            <option value="1" disabled @php if ($user->tipo_usuario == 1){ echo ' selected="selected"'; } @endphp>Administrador</option>
            <option value="2" @php if ($user->tipo_usuario == 2){ echo ' selected="selected"'; } @endphp>Atendente</option>
            <option value="3" @php if ($user->tipo_usuario == 3){ echo ' selected="selected"'; } @endphp>Espectador</option>
        </select> 
    </div>
</div>
<div class="form-group row">
    <div class="col-md-6 offset-md-4"> 
        <div class="checkbox">
            <label>
                <input type="checkbox" class="form-check" name="status_usuario" value="1" @php if($user->status_usuario == 1){ echo " checked=\"checked\""; }@endphp> Status
            </label>
        </div>                                    
    </div>
</div> 


