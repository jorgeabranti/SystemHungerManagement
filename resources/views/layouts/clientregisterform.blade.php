<link href="{{ asset('css/clientregister.css') }}" rel="stylesheet">
<script src="{{ asset('/js/RobinHerbots-inputmask/jquery.inputmask.bundle.js') }}" type="text/javascript" ></script>
@inject('tipos_produtos_empresa', 'HungerManagement\Http\Controllers\ProductsTypesController')
@inject('clientes', 'HungerManagement\Http\Controllers\ClientsController')
@inject('produtos_empresa', 'HungerManagement\Http\Controllers\ProductsController')   
<section class="wrapper">
    <div class="collapse navbar-collapse">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <ul class="navbar-nav mr-auto">
                    <button type="button" class="btn btn-theme04" onclick="window.location.href = '/home'"><i class="fa fa-home"></i> Voltar para Home</button>
                </ul>
                <ul class="navbar-nav page_identify">
                    <p>Cadastro de Clientes</p>
                </ul>                
                <ul class="navbar-nav navbar-right">   
                    <div class="col-md-12">
                        <button type="button" class="btn btn-warning" value="" id="novocliente" onclick="window.location.href = '/registerrequests'"><i class="fa fa-book"></i> Cadastro de Pedidos</button>
                    </div>
                </ul>
            </div>
        </nav>       
    </div>
    @inject('clientes', 'HungerManagement\Http\Controllers\ClientsController')
    @php $listaclientesempresa = $clientes->getClientesEmpresa(Auth::user()->empresas_id_empresa)->clientes_empresa; @endphp    
    <div class="row">
        <div class="col-lg-12">
            <div class="content-panel">
                <section>
                    <div class="container">
                        <form method="post" action="/saveclient" class="formregister" id="registerclientform"> 
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id_empresa" value="{{Auth::user()->empresas_id_empresa}}">
                            <fieldset> 
                                <div class="row" id="clientData">
                                    <div class="col-sm-6">
                                        <label class="label">Nome</label>
                                        <input id="nome_cliente" class="form-control" name="nome_cliente" value="" required autofocus>
                                        <label class="label">CPF</label>
                                        <input id="cpf_cliente" class="form-control" name="cpf_cliente" value="" required autofocus>                                        
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="label">Email</label>
                                        <input id="email_cliente" class="form-control" name="email_cliente" value="" autofocus>
                                        <label class="label">CEP</label>
                                        <input id="cep_cliente" class="form-control" name="cep_cliente" value="" required autofocus>                                        
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="label">Endereço</label>
                                        <input id="endereco_cliente" class="form-control" name="endereco_cliente" value="" required autofocus>
                                        <label class="label">Bairro</label>
                                        <input id="bairro_cliente" class="form-control" name="bairro_cliente" value="" required autofocus>
                                        <label class="label">UF</label>
                                        <select class="form-control select" name="uf_cliente" required>
                                            <option value="SC" disabled>SC</option>
                                            <option value="RS">RS</option>
                                            <option value="PR" disabled>PR</option>
                                        </select>                                            
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="label">Número</label>
                                        <input id="numero_cliente" class="form-control" name="endereco_numero_cliente" value="" required autofocus>                                         
                                        <label class="label">Cidade</label>
                                        <input id="cidade_cliente" class="form-control" name="cidade_cliente" value="" required autofocus>                                         
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="label">Tel. Celular</label>
                                        <input type="tel" maxlength="15" id="tel_cliente" class="form-control" name="telefone_celular_cliente" value="" required autofocus>                                          
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="label">Tel. Residencial</label>
                                        <input type="tel" maxlength="15" id="tel_cliente" class="form-control" name="telefone_residencial_cliente" value="" autofocus>                                         
                                    </div>
                                </div>                                     
                                <div class="divbuttonsave">
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-theme04" onclick="window.location.reload()"><i class="fa fa-circle"></i> Limpar Cadastro</button>
                                        <button type="submit" class="btn btn-success" onclick=""><i class="fa fa-check"></i> Salvar Cliente</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="col-md-12">
                                            <div id="custom-search-input">
                                                <div class="input-group col-md-12">
                                                    <input type="text" class="form-control input-sm" placeholder="Buscar Cliente" id="filtroclientes" autofocus/>
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-info" type="button">
                                                            <span class="glyphicon glyphicon-search"></span>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="col-sm-12">
                                        <label class="label">Total de Clientes:</label>
                                        <label class="label">
                                            @php echo sizeof($listaclientesempresa) @endphp
                                        </label>
                                    </div>
                                </div>
                            </fieldset> 
                        </form>
                        <div class="row">
                            <div class="col-lg-12">                                     
                                <div class="content-panel">
                                    <section id="unseen">
                                        <table class="table table-striped points_table" id="tableclients">
                                            <thead>
                                                <tr>
                                                    <th class="col-xs-1">Cód.</th>
                                                    <th class="col-xs-2">Nome</th>
                                                    <th class="col-xs-2">Cpf</th>
                                                    <th class="col-xs-4">Endereço</th>
                                                    <th class="col-xs-2">Telefone</th>
                                                    <th class="col-xs-1">Opcoes</th>
                                                </tr>
                                            </thead>                                                
                                            <tbody class="points_table_scrollbar"> 
                                                @foreach($listaclientesempresa as $key => $cliente)
                                                <tr class="even"> 
                                                    <td class="col-xs-1">{{$cliente->id_cliente}}</td>
                                                    <td class="col-xs-2">{{$cliente->nome_cliente}} </td>
                                                    <td class="col-xs-2">@if (!empty ($cliente->cpf_cliente)) {{$cliente->cpf_cliente}} @else Sem registro @endif</td>
                                                    <td class="col-xs-4">
                                                        @if (!empty ($cliente->endereco_cliente)) {{$cliente->endereco_cliente}} - @else Sem registro @endif
                                                        @if (!empty ($cliente->endereco_numero_cliente)) {{$cliente->endereco_numero_cliente}}@else @endif<br>
                                                        @if (!empty ($cliente->bairro_cliente)) {{$cliente->bairro_cliente}} - @else @endif
                                                        @if (!empty ($cliente->cidade_cliente)) {{$cliente->cidade_cliente}}@else @endif
                                                    </td>
                                                    <td class="col-xs-2">
                                                        @if (!empty ($cliente->telefone_celular_cliente)) {{$cliente->telefone_celular_cliente}} @else Sem registro @endif<br> 
                                                        @if (!empty ($cliente->telefone_residencial_cliente)) {{$cliente->telefone_residencial_cliente}} @else Sem registro @endif
                                                    </td>
                                                    <td class="col-xs-1">
                                                        <button class='btn btn-primary' onclick="updateClient({{$cliente->id_cliente}})"><i class='fa fa-pencil'></i></button>                                                                     
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
</section>
<script type="text/javascript">
    $("input[id*='cpf_cliente']").inputmask({
    mask: ['999.999.999-99'/*, '99.999.999/9999-99'*/],
            keepStatic: true
    });
    $("input[id*='email_cliente']").inputmask('email');
    $("input[id*='tel_cliente']").inputmask({
    mask: ['(99) 9999[9]-9999'],
            keepStatic: true
    });
    $("input[id*='cep_cliente']").inputmask({
    mask: ['99999-999'],
            keepStatic: true
    });    
    function updateClient(id_cliente) {
    var $request = $.get('/getclient', {value: id_cliente}, function (result) {
    //callback function once server has complete request
    $('#clientData').html(result.html);
    });
    }
    $(function () {
    $("#filtroclientes").keyup(function () {
    var index = $(this).parent().index();
    var nth = "#tableclients td:nth-child(" + (index + 2).toString() + ")";
    var valor = $(this).val().toUpperCase();
    $("#tableclients tbody tr").show();
    $(nth).each(function () {
    if ($(this).text().toUpperCase().indexOf(valor) < 0) {
    $(this).parent().hide();
    }
    });
    });
    })
</script>    
