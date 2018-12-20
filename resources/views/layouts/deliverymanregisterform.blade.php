<link href="{{ asset('/css/deliverymanregister.css') }}" rel="stylesheet">
<link href="{{asset('/css/registerdeliverymantable.css')}}" rel="stylesheet">
<script src="{{ asset('/js/RobinHerbots-inputmask/jquery.inputmask.bundle.js') }}" type="text/javascript" ></script>
<section class="wrapper">
    <div class="collapse navbar-collapse">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <ul class="navbar-nav mr-auto">
                    <button type="button" class="btn btn-theme04" onclick="window.location.href = '/home'"><i class="fa fa-home"></i> Voltar para Home</button>
                </ul>
                <ul class="navbar-nav page_identify">
                    <p>Cadastro de Entregadores</p>
                </ul>                
                <ul class="navbar-nav navbar-right">   
                    <div class="col-md-12">

                    </div>
                </ul>
            </div>
        </nav>       
    </div> 
    @inject('entregadores', 'HungerManagement\Http\Controllers\DeliveryManController')
    @php $listaentregadores = $entregadores->listDeliveryMan(Auth::user()->empresas_id_empresa)->entregadores; @endphp     
    <div class="row">
        <div class="col-lg-12">
            <div class="content-panel">
                <section>
                    <div class="container">
                        <form method="post" action="/savedeliveryman" class="formregister"> 
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id_empresa" value="{{Auth::user()->empresas_id_empresa}}">
                            <fieldset> 
                                <div class="row" id="deliveryData">
                                    <div class="col-md-6">
                                        <label class="label">Nome Entregador</label>
                                        <input id="nome_entregador" class="form-control" name="nome_entregador" value="" required autofocus>
                                        <label class="label">Placa Veículo</label>
                                        <input id="placa_entregador" class="form-control" name="placa_entregador" value="" autofocus> 
                                    </div>
                                    <div class="col-md-6">
                                        <label class="label">Cpf</label>
                                        <input id="cpf_entregador" class="form-control" name="cpf_entregador" value="" required autofocus>
                                        <label class="label">Status</label>
                                        <input type='checkbox' checked='checked' class='form-check' name='status_entregador' value='1'>
                                    </div>
                                </div>                                     
                                <div class="divbuttondeliveryman">
                                    <button type="button" class="btn btn-theme04" onclick="window.location.reload()"><i class="fa fa-circle"></i> Limpar Cadastro</button>
                                    <button type="submit" class="btn btn-theme04" onclick=""><i class="fa fa-check"></i> Salvar Entregador</button>

                                    <div class="col-sm-12">
                                        <label class="label">Total de Entregadores:</label>
                                        <label class="label">
                                            @php echo sizeof($listaentregadores) @endphp
                                        </label>
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
                                                    <th class="col-xs-3">Nome Entregador</th>
                                                    <th class="col-xs-2">Placa Veic.</th>
                                                    <th class="col-xs-2">Cpf</th>
                                                    <th class="col-xs-2">Status</th>
                                                    <th class="col-xs-2">Opcoes</th>
                                                </tr>
                                            </thead>                                                
                                            <tbody class="points_table_scrollbar"> 
                                                @foreach($listaentregadores as $key => $entregador)
                                                <tr class="even"> 
                                                    <td class="col-xs-1">{{$entregador->id_entregador}}</td>
                                                    <td class="col-xs-3">{{$entregador->nome_entregador}} </td>
                                                    <td class="col-xs-2">{{$entregador->placa_entregador}}</td>
                                                    <td class="col-xs-2">{{$entregador->cpf_entregador}}</td>
                                                    <td class="col-xs-2">@if ($entregador->status_entregador == 1) Ativo @elseif ($entregador->status_entregador == 0) Desativado @endif</td>
                                                    <td class="col-xs-2">
                                                        <button class='btn btn-primary' onclick="updateDeliveryMan({{$entregador->id_entregador}})"><i class='fa fa-pencil'></i></button>                                                                     
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
<script src="{{ asset('/js/control_scripts/deliverymanregistercontrol.js') }}" type="text/javascript" ></script> 