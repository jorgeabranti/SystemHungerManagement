<link href="{{ asset('/css/requestregister.css') }}" rel="stylesheet">
<link href="{{asset('/css/registerrequesttable.css')}}" rel="stylesheet">
<link href="{{ asset('/font-ds_digital/css/font-ds_digital.css')}}" rel="stylesheet">
<script src="{{ asset('/js/awesomplete/awesomplete.min.js')}}" type="text/javascript" ></script> 
<link href="{{ asset('/js/awesomplete/awesomplete.css')}}" rel="stylesheet">
@inject('tipos_produtos_empresa', 'HungerManagement\Http\Controllers\ProductsTypesController')
@inject('clientes', 'HungerManagement\Http\Controllers\ClientsController')
@inject('company', 'HungerManagement\Http\Controllers\CompanyController')
@php $data_company = $company->getCompany(Auth::user()->empresas_id_empresa); @endphp
<section class="wrapper">
    <div class="collapse navbar-collapse">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <ul class="navbar-nav mr-auto">
                    <button type="button" class="btn btn-theme04" onclick="window.location.href = '/home'"><i class="fa fa-home"></i> Voltar para Home</button>
                </ul>
                <ul class="navbar-nav page_identify">
                    <p>Cadastro de Pedidos</p>
                </ul>               
                <ul class="navbar-nav navbar-right">  
                    <div class="col-md-12">
                        @can('isAdmin')
                        <button type="button" class="btn btn-warning" value="" id="novocliente" onclick="window.location.href = '/registerclient'"><i class="fa fa-user"></i> Novo Cliente</button>
                        @endcan
                        @can('isAttendent')
                        <button type="button" class="btn btn-warning" value="" id="novocliente" onclick="window.location.href = '/registerclient'"><i class="fa fa-user"></i> Novo Cliente</button>
                        @endcan                        
                    </div>
                </ul>
            </div>
        </nav>       
    </div> 
    <div class="row">
        <div class="col-lg-12">
            <div class="content-panel">
                <section>
                    <div class="container">
                        <form method="post" action="/saverequest" class="formregister"> 
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id_empresa" value="{{Auth::user()->empresas_id_empresa}}">
                            <fieldset> 
                                <div class="row">
                                    <div class="col-sm-3">                                       
                                        <label class="label">Dados do Cliente:</label>
                                    </div>
                                    <div class="col-sm-4"> 
                                        <input type="text" id="cliente" class="form-control awesomplete" placeholder="Buscar Por Nome"
                                               data-list="@foreach($clientes->getClientesEmpresa(Auth::user()->empresas_id_empresa)->clientes_empresa as $key => $cliente){{$cliente->nome_cliente}} cpf:{{$cliente->cpf_cliente}},@endforeach" 
                                        autofocus/> 
                                    </div>
                                    <div class="col-sm-4"> 
                                        <input type="text" id="cliente_telefone" class="form-control awesomplete" placeholder="Buscar Por Telefone"
                                               data-list="@foreach($clientes->getClientesEmpresa(Auth::user()->empresas_id_empresa)->clientes_empresa as $key => $cliente){{$cliente->telefone_celular_cliente}}-{{$cliente->telefone_residencial_cliente}} cpf:{{$cliente->cpf_cliente}},@endforeach" 
                                        autofocus/> 
                                    </div>                                    
                                    <div class="divrequestsleft"> 
                                        <button class="btn btn-default" type="button" onclick="loadClient({{$data_company}})">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>                                    
                                    </div>       
                                    <div class="col-sm-12">
                                        <table class="table table-striped">                                                
                                            <tbody id="data" class="dataclienttable">
                                                <tr class='even'>
                                                    <td><b>Nome:</b></td>
                                                    <td></td>
                                                    <td><b>Endereço:</b></td>
                                                    <td></td>
                                                </tr>
                                                <tr class='even'>
                                                    <td><b>Tel. Celular:</b></td>
                                                    <td></td>
                                                    <td><b>Tel. Residencial:</b></td>
                                                    <td></td>
                                                </tr>                                                    
                                            </tbody>
                                        </table>  
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="label">Tipo de Produtos:</label>
                                        <br>                                                
                                        <select class="form-control select" id="tipos_produtos">
                                            <option value="" >Selecione o Tipo de Produto</option>
                                            @foreach($tipos_produtos_empresa->tiposProdutosEmpresaAtivos(Auth::user()->empresas_id_empresa)->tipos_produtos_empresa as $key => $tipo_produto)
                                            <option value="{{$tipo_produto}}">{{$tipo_produto->nome_tipo_produto}}</option>
                                            @endforeach                                                    
                                        </select>
                                        <label class="label">Produtos:</label>
                                        <br>
                                        <select class="form-control select" id="produtos">
                                            <option value="" >Selecione o Produto</option>
                                        </select>                                            
                                        <label class="label">Sabores:</label>
                                        <select class="form-control select" id="sabores">
                                            <option value="">Selecione o Sabor</option>
                                        </select>                                          
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="label">Forma Pagamento:</label>
                                        <select class="form-control select" name="forma_pagamento" required>
                                            @foreach($company->listPaymentCompanyActive(Auth::user()->empresas_id_empresa)->listaformaspagamento as $key => $forma)
                                            <option value="{{$forma->id_forma_pagamento_empresa}}">{{$forma->nome_forma_pagamento}}</option>
                                            @endforeach 
                                        </select>                                              
                                        <div class="divrequestsright" id="valuedelivery"> 
                                            <label class="label">Frete R$:</label>
                                            <input id="valorfrete" name="taxa_entrega_pedido" type="text" value="0,00" readonly>
                                        </div>
                                        <div class="divrequestsright"> 
                                            <label class="label">Valor Total R$:</label>
                                            <input id="valor" type='text' name='total_valor_pedido' value='@php echo number_format(0.00, 2, ',', '.') @endphp' readonly>
                                        </div>                                         
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="col-sm-6 divrequestsleft">
                                            <label class="label">Adicionar sempre um novo ítem:
                                                <input type="checkbox" value="0" id="newproduct">
                                            </label>
                                        </div>
                                        <div class="col-sm-6 divbuttonrequest">
                                            <button type="button" class="btn btn-theme04" id="additem">Adicionar Item <i class="fa fa-level-down"></i></button>
                                            <button type="submit" class="btn btn-success"id="finalizar_pedido"><i class="fa fa-check"></i> Finalizar Pedido</button>
                                        </div>                                                 
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="content-panel" id="dadospedido">
                                            <section>
                                                <table class="table table-hover table-striped points_table" id="tableitens">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-xs-1">Item</th>
                                                            <th class="col-xs-3">Produto</th>
                                                            <th class="col-xs-4">Sabores</th>
                                                            <th class="col-xs-2">Valor R$</th>
                                                            <th class="col-xs-2">Controles</th>
                                                        </tr>
                                                    </thead>                                                
                                                    <tbody id="rowstable" class="points_table_scrollbar">                                                                         
                                                    </tbody>
                                                </table>
                                            </section>
                                        </div><!-- /content-panel -->
                                    </div><!-- /col-md-12 -->
                                </div><!-- /row -->                                                             
                            </fieldset> 
                        </form>
                    </div>         
                </section>
            </div>
        </div>
    </div>
    <div class="row">
        @include('includes.footer') 
    </div>    
</section>
<div id="editItemForm">
    <h3>Editar Sabores</h3>
    <form method="post" action="" class="formregister" id="formedititem"> 
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="id_empresa" value="{{Auth::user()->empresas_id_empresa}}">
        <fieldset> 
            <div class="row">
                <div class="col-lg-12">
                    <div class="content-panel" id="rowEdiItem">
                        <section id="unseen"> 
                            <h6>CARREGANDO...</h6>
                        </section>  
                    </div><!-- /content-panel -->
                </div><!-- /col-md-12 -->
            </div><!-- /row -->                     
        </fieldset> 
    </form>
</div>
<script src="{{ asset('/js/control_scripts/requestregistercontrol.js') }}" type="text/javascript" ></script> 
