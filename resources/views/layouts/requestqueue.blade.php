<link href="{{asset('/css/requesttable.css')}}" rel="stylesheet" type="text/css">
<section class="wrapper">
    <div class="collapse navbar-collapse">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <ul class="navbar-nav mr-auto">
                    @can('isAdmin')
                    <button type="button" class="btn btn-theme04" onclick="window.location.href = '/registerrequests'"><i class="fa fa-pencil"></i> Cadastrar Pedido</button>
                    @endcan
                    @can('isAttendent')
                    <button type="button" class="btn btn-theme04" onclick="window.location.href = '/registerrequests'"><i class="fa fa-pencil"></i> Cadastrar Pedido</button>
                    @endcan                    
                </ul>
                <ul class="navbar-nav page_identify">
                    <p> Fila de Pedidos</p>
                </ul>
                <ul class="navbar-nav navbar-right">   
                    <div class="col-md-12">
                        <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" class="form-control input-sm" placeholder="Buscar Cliente" id="filtro" />
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-lg" type="button">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </nav>       
    </div> 
        <div id="filadados" class="row">
            <div class="col-lg-12">
                <div class="content-panel">
                    <section>
                        <table id="filapedidos" class="table table-striped points_table">
                            <thead>
                                <tr>
                                    <th class="col-xs-1">N°Pedido</th>
                                    <th class="col-xs-1">Horário</th>
                                    <th class="col-xs-2">Cliente</th>
                                    <th class="col-xs-6">Pedido</th>
                                    <th class="col-xs-2">Status</th>
                                </tr>
                            </thead>
                            <tbody class="points_table_scrollbar" id="abilityListContainer">
                                @include('layouts.requestqueuetable')
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>
        <div class="row">
            @include('includes.footer') 
        </div>        
        <div id="deliverymanForm" class="btn-group btn-group-justified">
            <h3>Escolha o entregador</h3>
            @inject('entregadores', 'HungerManagement\Http\Controllers\DeliveryManController')
            <form action="" method="post" id="formentregador">
                <select class="form-control select" id="entregadores" required>
                    <option value="" >Selecione o Entregador</option>
                    @foreach($entregadores->listDeliveryManActive(Auth::user()->empresas_id_empresa)->entregadores as $key => $entregador)
                    <option value="{{$entregador}}">{{$entregador->nome_entregador}}</option>
                    @endforeach
                </select>
                <p class="datadeliveryman" id="data"></p>
                <input type = "hidden" name = "_token" value = "{{csrf_token()}}">                        
                <button type="submit" class="btn btn-success" id="id_entregador" name='id_entregador' title="Entregue" value=""><i class="fa fa-check"></i>Salvar</button>
            </form>
        </div>
        <input type="hidden" id="hidden_row" name="hidden_row" value="0">        
    <script src="{{ asset('/js/control_scripts/requestqueuecontrol.js') }}" type="text/javascript" ></script>       
</section>

