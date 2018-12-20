<link href="{{asset('/css/reportsales.css')}}" rel="stylesheet" type="text/css">
<script src="{{asset('/js/Chart.bundle.min.js')}}"></script>
<section class="wrapper">
    <div class="collapse navbar-collapse">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <ul class="navbar-nav mr-auto">
                    <button type="button" class="btn btn-theme04" onclick="window.location.href = '/administration'"><i class="fa fa-arrow-left"></i> Voltar ao Menu</button>
                </ul>
                <ul class="navbar-nav page_identify">
                    <p>Relatórios de Vendas</p>
                </ul>
                <ul class="navbar-nav navbar-right">   

                </ul>
            </div>
        </nav>       
    </div> 
    <div class="row">
        <input type="hidden" id="id_empresa" name="id_empresa" value="{{Auth::user()->empresas_id_empresa}}">
        <div class="col-lg-12">
            <div class="content-panel">               
                <section>
                    <div class="container-center">
                        <div class="row">                         
                            <div class="col-lg-6">
                                <h4>Valor Total Bruto de Vendas por Mês:</h4> 
                                <div class="row">
                                    <div class="col-lg-4">
                                        <select class="form-control select" id="valueSalesMonth" required>
                                            <option value="1" >Três Meses</option>
                                            <option value="2" >Seis Meses</option>
                                            <option value="3" >Um Ano</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" id="canvas_container_bar-3">                                
                                    <canvas id="bar-graph-3" width="auto" height="auto"></canvas>
                                </div>   
                            </div>
                            <div class="col-lg-6">
                                <h4>Quantidade de Vendas por Mês:</h4> 
                                <div class="row">
                                    <div class="col-lg-4">
                                        <select class="form-control select" id="salesMonth" required>
                                            <option value="1" >Três Meses</option>
                                            <option value="2" >Seis Meses</option>
                                            <option value="3" >Um Ano</option>
                                        </select> 
                                    </div>
                                </div>
                                <div class="row" id="canvas_container_bar-1">                                
                                    <canvas id="bar-graph-1" width="auto" height="auto"></canvas>
                                </div>                                
                            </div>
                        </div>                      
                        <div class="row">
                            <div class="col-lg-6">
                                <h4>Quantidade de Vendas por Canal de Atendimento Mês:</h4>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <select class="form-control select" id="salesServiceChannel" required>
                                            <option value="1" >Três Meses</option>
                                            <option value="2" >Seis Meses</option>
                                            <option value="3" >Um Ano</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" id="canvas_container_bar-2">                                
                                    <canvas id="bar-graph-2" width="auto" height="auto"></canvas>
                                </div> 
                            </div>                            
                            <div class="col-lg-6">
                                <h4>Percentual de Produtos Vendidos no Mês:</h4>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <select class="form-control select" id="topSalesProduct" required>
                                            <option value="1" >Mês Corrente</option>
                                            <option value="2" >Um Mês Atrás</option>
                                            <option value="3" >Dois Meses Atrás</option>
                                            <option value="4" >Três Meses Atrás</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" id="canvas_container_pie-1">                                
                                    <canvas id="pie-graph-1" width="auto" height="auto"></canvas>
                                </div>
                            </div> 
                        </div> 
                    </div>
                </section>
            </div>
        </div>                    
    </div>
    <div class="row">
        @include('includes.footer') 
    </div>
</section>
<script src="{{asset('/js/control_scripts/salesreportcontrol.js')}}" type="text/javascript" ></script> 




