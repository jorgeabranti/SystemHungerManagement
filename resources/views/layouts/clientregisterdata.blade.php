<input type="hidden" name="id_cliente" value="{{$cliente[0]->id_cliente}}">
<div class="col-sm-6">
    <label class="label">Nome</label>
    <input id="nome_cliente" class="form-control" name="nome_cliente" value="{{$cliente[0]->nome_cliente}}" required autofocus>
    <label class="label">CPF</label>
    <input id="cpf_cliente" class="form-control" name="cpf_cliente" value="{{$cliente[0]->cpf_cliente}}" required autofocus>   
</div> 
<div class="col-sm-6">    
    <label class="label">Email</label>
    <input id="email_cliente" class="form-control" name="email_cliente" value="{{$cliente[0]->email_cliente}}" autofocus> 
    <label class="label">CEP</label>
    <input id="cep_cliente" class="form-control" name="cep_cliente" value="{{$cliente[0]->cep_cliente}}" required autofocus>
</div>
<div class="col-sm-6">    
    <label class="label">Endereço</label>
    <input id="endereco_cliente" class="form-control" name="endereco_cliente" value="{{$cliente[0]->endereco_cliente}}" required autofocus>
    <label class="label">Bairro</label>
    <input id="bairro_cliente" class="form-control" name="bairro_cliente" value="{{$cliente[0]->bairro_cliente}}" required autofocus>
    <label class="label">UF</label>
    <select class="form-control select" name="uf_cliente" required>
        <option value="SC" @php if ($cliente[0]->uf_cliente == 'SC'){ echo ' selected="selected"'; } @endphp disabled>SC</option>
        <option value="RS" @php if ($cliente[0]->uf_cliente == 'RS'){ echo ' selected="selected"'; } @endphp>RS</option>
        <option value="PR" @php if ($cliente[0]->uf_cliente == 'PR'){ echo ' selected="selected"'; } @endphp disabled>PR</option>
    </select>                                          
</div>
<div class="col-sm-6">
    <label class="label">Número</label>
    <input id="numero_cliente" class="form-control" name="endereco_numero_cliente" value="{{$cliente[0]->endereco_numero_cliente}}" required autofocus>                                         
    <label class="label">Cidade</label>
    <input id="cidade_cliente" class="form-control" name="cidade_cliente" value="{{$cliente[0]->cidade_cliente}}" required autofocus>                                             
</div>
<div class="col-sm-6">
    <label class="label">Tel. Celular</label>
    <input type="tel" maxlength="15" id="tel_cliente" class="form-control" name="telefone_celular_cliente" value="{{$cliente[0]->telefone_celular_cliente}}" required autofocus>           
</div>
<div class="col-sm-6">
    <label class="label">Tel. Residencial</label>
    <input type="tel" maxlength="15" id="tel_cliente" class="form-control" name="telefone_residencial_cliente" value="{{$cliente[0]->telefone_residencial_cliente}}" autofocus>        
</div>    