<link href="{{ asset('/css/productsregister.css') }}" rel="stylesheet">
<link href="{{asset('/css/registerproductstable.css')}}" rel="stylesheet">
<section class="wrapper">
    <div class="collapse navbar-collapse">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <ul class="navbar-nav mr-auto">
                    <button type="button" class="btn btn-theme04" onclick="window.location.href = '/home'"><i class="fa fa-home"></i> Voltar para Home</button>
                </ul>
                <ul class="navbar-nav page_identify">
                    <p>Cadastro de Produtos</p>
                </ul>                 
                <ul class="navbar-nav navbar-right">  
                    <div class="col-md-12">

                    </div>
                </ul>
            </div>
        </nav>       
    </div>
    @inject('sabores_produtos_empresa', 'HungerManagement\Http\Controllers\FlavorsProductsController')
    @inject('produtos_empresa', 'HungerManagement\Http\Controllers\ProductsController')
    @inject('tipos_produtos_empresa', 'HungerManagement\Http\Controllers\ProductsTypesController')
    <div class="row">
        <div class="col-lg-12">
            <div class="content-panel">    
                <form method="post" action="/saveproduct" class="formregister" enctype="multipart/form-data"> 
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="id_empresa" value="{{Auth::user()->empresas_id_empresa}}">
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-4">
                                <button type="button" id="novoproduto" class="btn btn-success" onclick="newProduct({{Auth::user()->empresas_id_empresa}})">Novo Produto</button>
                            </div>
                            <div class="col-sm-4">
                                <h4>Tabela de Produtos</h4>
                            </div>
                            <div class="col-sm-4">
                                <div class="col-md-12">
                                    <div id="custom-search-input">
                                        <div class="input-group col-md-12">
                                            <input type="text" class="form-control input-sm" placeholder="Buscar Produto" id="filtroproduto" autofocus/>
                                            <span class="input-group-btn">
                                                <button class="btn btn-info" type="button">
                                                    <span class="glyphicon glyphicon-search"></span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>  
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="content-panel">
                                    <section id="unseen">
                                        <table class="table table-striped points_table" id="tableproducts">
                                            <thead>
                                                <tr>
                                                    <th class="col-xs-1">Cód.</th>
                                                    <th class="col-xs-2">Tipo</th>
                                                    <th class="col-xs-2">Nome</th>
                                                    <th class="col-xs-2">Descrição</th>
                                                    <th class="col-xs-1">Valor R$</th>
                                                    <th class="col-xs-1">Qtda Sabores</th>
                                                    <th class="col-xs-1">Status</th>
                                                    <th class="col-xs-2">Controles</th>
                                                </tr>
                                            </thead>                                                
                                            <tbody id="rowsProduct" class="points_table_scrollbar"> 
                                                @foreach($produtos_empresa->listaProdutosEmpresa(Auth::user()->empresas_id_empresa)->produtos_empresa as $key => $produto)
                                                <tr class='even'>
                                                    <td class="col-xs-1">{{$produto->id_produto}}</td>
                                                    <td class="col-xs-2">{{$produto->nome_tipo_produto}}</td>
                                                    <td class="col-xs-2">{{$produto->nome_produto}}</td>
                                                    <td class="col-xs-2" id="autotext">{{$produto->descricao_produto}}</td>                                                                    
                                                    <td class="col-xs-1">R$ {{$produto->valor_unitario_produto}}</td>
                                                    <td class="col-xs-1">{{$produto->quant_sabores_produto}}</td>
                                                    <td class="col-xs-1">@if ($produto->status_produto == 1) Ativo @elseif ($produto->status_produto == 0) Desativado @endif</td>
                                                    <td class="col-xs-2">
                                                        <button type="button" class="btn btn-primary" onclick="setEditProductForm({{$produto->id_produto}})"><i class="fa fa-pencil"></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </section>
                                </div><!-- /content-panel -->
                            </div><!-- /col-md-12 -->
                        </div><!-- /row -->                                                                 
                    </fieldset> 
                </form>               
                <form method="post" action="/saveflavor" class="formregister" enctype="multipart/form-data"> 
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="id_empresa" value="{{Auth::user()->empresas_id_empresa}}">
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-4">
                                <button type="button" id="novosabor" class="btn btn-success" onclick="newFlavor({{Auth::user()->empresas_id_empresa}})">Novo Sabor</button>
                            </div>
                            <div class="col-sm-4">
                                <h4>Tabela de Sabores</h4>
                            </div>                            
                            <div class="col-sm-4">
                                <div class="col-md-12">
                                    <div id="custom-search-input">
                                        <div class="input-group col-md-12">
                                            <input type="text" class="form-control input-sm" placeholder="Buscar Sabor" id="filtrosabor" autofocus/>
                                            <span class="input-group-btn">
                                                <button class="btn btn-info" type="button">
                                                    <span class="glyphicon glyphicon-search"></span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>  
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="content-panel">
                                    <section id="unseen">
                                        <table class="table table-striped points_table" id="tableflavors">
                                            <thead>
                                                <tr>
                                                    <th class="col-xs-1">Cód.</th>
                                                    <th class="col-xs-2">Tipo</th>
                                                    <th class="col-xs-2">Nome</th>
                                                    <th class="col-xs-3">Descrição</th>
                                                    <th class="col-xs-2">Status</th>
                                                    <th class="col-xs-2">Controles</th>
                                                </tr>
                                            </thead>                                                
                                            <tbody id="rowsFlavor" class="points_table_scrollbar"> 
                                                @foreach($sabores_produtos_empresa->listaSaboresProdutosEmpresa(Auth::user()->empresas_id_empresa)->sabores_produtos as $key => $sabor_produto)
                                                <tr class='even'>
                                                    <td class="col-xs-1">{{$sabor_produto->id_sabor_produto}}</td>
                                                    <td class="col-xs-2">{{$sabor_produto->nome_tipo_produto}}</td>
                                                    <td class="col-xs-2">{{$sabor_produto->nome_sabor_produto}}</td>
                                                    <td class="col-xs-3" id="autotext">{{$sabor_produto->descricao_sabor_produto}}</td>                                                                    
                                                    <td class="col-xs-2">@if ($sabor_produto->status_sabor_produto == 1) Ativo @elseif ($sabor_produto->status_sabor_produto == 0) Desativado @endif</td>
                                                    <td class="col-xs-2">
                                                        <button type="button" class="btn btn-primary" onclick="setEditFlavorForm({{$sabor_produto->id_sabor_produto}})"><i class="fa fa-pencil"></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </section>
                                </div><!-- /content-panel -->
                            </div><!-- /col-md-12 -->
                        </div><!-- /row -->                                                                 
                    </fieldset> 
                </form>                  
                <form method="post" action="/savetypeproduct" class="formregister" enctype="multipart/form-data"> 
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="id_empresa" value="{{Auth::user()->empresas_id_empresa}}">
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-4">
                                <button type="button" id="novotipoproduto" class="btn btn-success" onclick="newTypeProduct()">Novo Tipo de Produto</button>
                            </div>
                            <div class="col-sm-4">
                                <h4>Tabela de Tipos de Produtos</h4>
                            </div>                             
                            <div class="col-sm-4">
                                <div class="col-md-12">
                                    <div id="custom-search-input">
                                        <div class="input-group col-md-12">
                                            <input type="text" class="form-control input-sm" placeholder="Buscar Tipo de Produto" id="filtrotipoproduto" autofocus/>
                                            <span class="input-group-btn">
                                                <button class="btn btn-info" type="button">
                                                    <span class="glyphicon glyphicon-search"></span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>  
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="content-panel">
                                    <section id="unseen">
                                        <table class="table table-striped points_table" id="tabletypeproduct">
                                            <thead>
                                                <tr>
                                                    <th class="col-xs-1">Cód.</th>
                                                    <th class="col-xs-3">Nome</th>
                                                    <th class="col-xs-5">Descrição</th>
                                                    <th class="col-xs-2">Status</th>
                                                    <th class="col-xs-1">Controles</th>
                                                </tr>
                                            </thead>                                                
                                            <tbody id="rowsTypeProduct"  class="points_table_scrollbar">  
                                                @foreach($tipos_produtos_empresa->tiposProdutosEmpresa(Auth::user()->empresas_id_empresa)->tipos_produtos_empresa as $key => $tipo_produto)
                                                <tr class='even'>
                                                    <td class="col-xs-1">{{$tipo_produto->id_tipo_produto}}</td>
                                                    <td class="col-xs-3">{{$tipo_produto->nome_tipo_produto}}</td>
                                                    <td class="col-xs-5">{{$tipo_produto->descricao_tipo_produto}}</td>                                                                    
                                                    <td class="col-xs-2">@if ($tipo_produto->status_tipo_produto == 1) Ativo @elseif ($tipo_produto->status_tipo_produto == 0) Desativado @endif</td>
                                                    <td class="col-xs-1">
                                                        <button type="button" class='btn btn-primary' onclick="setEditTypeProductForm({{$tipo_produto->id_tipo_produto}})"><i class='fa fa-pencil'></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </section>
                                </div><!-- /content-panel -->
                            </div><!-- /col-md-12 -->
                        </div><!-- /row -->                                                                 
                    </fieldset> 
                </form>                
            </div>
        </div>
    </div>
    <div class="row">
        @include('includes.footer') 
    </div>    
    <div id="editTypeProductForm">
        <h3>Editar o Tipo de Produto</h3>
        <form method="post" action="/savetypeproduct" class="formregister" id="formedittypeproduct" enctype="multipart/form-data"> 
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="id_empresa" value="{{Auth::user()->empresas_id_empresa}}">
            <fieldset> 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content-panel" id="rowEditTypeProduct">
                            <section id="unseen"> 
                                <h6>CARREGANDO...</h6>
                            </section>  
                        </div><!-- /content-panel -->
                    </div><!-- /col-md-12 -->
                </div><!-- /row -->                     
            </fieldset> 
        </form>
    </div>      
    <div id="editProductForm">
        <h3>Editar o Produto</h3>
        <form method="post" action="/saveproduct" class="formregister" id="formeditproduct" enctype="multipart/form-data"> 
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="id_empresa" value="{{Auth::user()->empresas_id_empresa}}">
            <fieldset> 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content-panel" id="rowEditProduct">
                            <section id="unseen"> 
                                <h6>CARREGANDO...</h6>
                            </section>  
                        </div><!-- /content-panel -->
                    </div><!-- /col-md-12 -->
                </div><!-- /row -->                     
            </fieldset> 
        </form>
    </div> 
    <div id="editFlavorForm">
        <h3>Editar o Sabor</h3>
        <form method="post" action="/saveflavor" class="formregister" id="formeditflavor"> 
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="id_empresa" value="{{Auth::user()->empresas_id_empresa}}">
            <fieldset> 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content-panel" id="rowEditFlavor">
                            <section id="unseen"> 
                                <h6>CARREGANDO...</h6>
                            </section>  
                        </div><!-- /content-panel -->
                    </div><!-- /col-md-12 -->
                </div><!-- /row -->                     
            </fieldset> 
        </form>
    </div>
    <script src="{{ asset('/js/control_scripts/productsregistercontrol.js') }}" type="text/javascript" ></script>     
</section>
