<link href="{{asset('/css/systemparameters.css')}}" rel="stylesheet" type="text/css">
<script src="{{ asset('/js/metro.js')}}" type="text/javascript" ></script>
<link href="{{asset('/css/metro.css')}}" rel="stylesheet" type="text/css">
<script src="{{ asset('/js/RobinHerbots-inputmask/jquery.inputmask.bundle.js') }}" type="text/javascript" ></script>
<div class="wrapper">
    <div class="navbar-collapse">
        <nav class="navbar navbar-laravel">
            <div class="btn-group btn-group-justified">
                <ul class="navbar-nav mr-auto">
                    <button type="button" class="btn btn-theme04" onclick="window.location.href = '/administration'"><i class="fa fa-arrow-left"></i> Voltar ao Menu</button>
                </ul>
                <ul class="navbar-nav page_identify">
                    <p>Parâmetros do Sistema</p>
                </ul>             
                <ul class="navbar-nav navbar-right">   
                    <div class="col-md-12">

                    </div>
                </ul>
            </div>
        </nav>         
    </div> 
    @inject('company', 'HungerManagement\Http\Controllers\CompanyController') 
    @php $datacompany = $company->getCompany(Auth::user()->empresas_id_empresa); @endphp
    <div class="row">
        <div class="col-lg-12">
            <div class="content-panel">
                <section>
                    <div class="container">
                        <form method="post" action="" class="formregister"> 
                            <fieldset> 
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4>Dados da Empresa:</h4>
                                    </div>     
                                    <div class="col-sm-12">
                                        <table class="table table-striped datatable">                                                
                                            <tbody id="data">
                                                <tr class='even'>
                                                    <td class="col-xs-1"><b>Nome:</b></td>
                                                    <td class="col-xs-3">{{$datacompany->nome_fantasia}}</td>
                                                    <td class="col-xs-2"><b>Endereço:</b></td>
                                                    <td class="col-xs-7">{{$datacompany->endereco_empresa}}, número {{$datacompany->endereco_numero_empresa}}, cep {{$datacompany->cep_empresa}}</td>
                                                </tr>
                                                <tr class='even'>
                                                    <td class="col-xs-1"><b>Cnpj:</b></td>
                                                    <td class="col-xs-3">{{$datacompany->cnpj_empresa}}</td>
                                                    <td class="col-xs-2"><b></b></td>
                                                    <td class="col-xs-7"></td>
                                                </tr>                                                
                                                <tr class='even'>
                                                    <td><b>Telefone:</b></td>
                                                    <td>{{$datacompany->telefone1_empresa}}</td>
                                                    <td><b>Telefone:</b></td>
                                                    <td>{{$datacompany->telefone2_empresa}}</td>
                                                </tr> 
                                                <tr class='even'>
                                                    <td><b>Telefone:</b></td>
                                                    <td>{{$datacompany->telefone3_empresa}}</td>
                                                    <td><b>Telefone:</b></td>
                                                    <td>{{$datacompany->telefone4_empresa}}</td>
                                                </tr>                                                 
                                            </tbody>
                                        </table>  
                                    </div>
                                </div>                                                           
                            </fieldset> 
                        </form>
                        <form method="post" action="/uploadlogo" class="formregister"  enctype="multipart/form-data"> 
                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                            <input type="hidden" name="id_empresa" value="{{Auth::user()->empresas_id_empresa}}">
                            <input type="hidden" name="logo_img" value="{{$datacompany->logo_img}}">
                            <fieldset> 
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4>Logo da Empresa:</h4>
                                    </div>     
                                    <div class="col-sm-12">                                       
                                        <div class="col-sm-6">
                                            <img src="{{asset('/img/logo/'.$datacompany->logo_img)}}" class="img-fluid" width="180">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="label">!!!Atenção!!!</label>
                                            <h5>Formatos aceitos: jpeg, png, jpg, gif, svg</h5>
                                            <h5>Tamanho máximo de 2Mb</h5>
                                        </div>
                                        <div class="col-sm-12 divbuttonitem">
                                            <span id="file-name"></span>
                                        </div>                                        
                                        <div class="col-sm-12 divbuttonitem">
                                            <label for='logo' class="textfile">Selecionar um arquivo</label>
                                            <input type="file" name="logo" id="logo" onchange="setfilename()">
                                            <button type="submit" class="btn btn-success" value="Upload" name="submit"><i class="fa fa-check"></i>Salvar</button>
                                        </div>
                                    </div>
                                </div>                                                           
                            </fieldset> 
                        </form>
                        <form method="post" action="/saveformpayment" class="formregister"> 
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id_empresa" value="{{Auth::user()->empresas_id_empresa}}">
                            <fieldset> 
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4>Formas de Pagamento:</h4>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="label">Formas de Pagamento Disponíveis:</label>
                                        <select class="form-control select" id="forma_pagamento">
                                            <option value="">Selecione a Forma de Pagamento</option>
                                            @foreach($company->listPaymentCompanyNotRegistered(Auth::user()->empresas_id_empresa)->listaformaspagamento as $key => $forma)
                                            <option value="{{$forma}}">{{$forma->nome_forma_pagamento}}</option>
                                            @endforeach                                            
                                        </select>
                                        <div class="divbuttonitem">
                                            <button type="button" id="addformpayment" class="btn btn-theme04">Adicionar <i class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="label">Formas de Pagamento Cadastradas:</label>
                                        <div class="col-sm-8" id="forma_pagamento_cadastradas">
                                            @foreach($company->listPaymentCompany(Auth::user()->empresas_id_empresa)->listaformaspagamento as $key => $forma)                                           
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="1" name="status_forma_pagamento_empresa[{{$key}}]" @php if($forma->status_forma_pagamento_empresa == 1){ echo " checked=\"checked\""; }@endphp>{{$forma->nome_forma_pagamento}}
                                                           <input type="hidden" name="id_forma_pagamento[{{$key}}]" value="{{$forma->id_forma_pagamento}}">
                                                    <input type="hidden" name="cadastrado[{{$key}}]" value="{{$forma->id_forma_pagamento_empresa}}">
                                                </label>
                                            </div>
                                            @endforeach                                                 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 divbuttonitem">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>Salvar</button>
                                </div>                                  
                            </fieldset> 
                        </form>
                        <form method="post" action="/savehourcompany" class="formregister"> 
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id_empresa" value="{{Auth::user()->empresas_id_empresa}}">
                            <fieldset> 
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4>Horários e Dias de atendimento:</h4> 
                                    </div>    
                                    @php $horarios_atendimento = $company->listHoursCompany(Auth::user()->empresas_id_empresa); @endphp                                          
                                </div>
                                <div class="row"> 
                                    <div class="col-sm-4">
                                        <label class="label">Horários Inicio</label> 
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="label">Horários Fim</label> 
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="label">Dia da Semana</label> 
                                    </div>                                    
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="horario" name="horario_inicio[1]" value="@php if($horarios_atendimento <> null) echo $horarios_atendimento->horario_inicio_segunda @endphp" autofocus>
                                    </div>
                                    <div class="col-sm-4"> 
                                        <input type="text" class="form-control" id="horario" name="horario_fim[1]" value="@php if($horarios_atendimento <> null) echo $horarios_atendimento->horario_fim_segunda @endphp" autofocus>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="status_dia[1]" value="1" @php if($horarios_atendimento <> null){if($horarios_atendimento->atendimento_segunda == 1){ echo " checked=\"checked\""; }}@endphp>Segunda-Feira
                                            </label>
                                        </div> 
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="horario" name="horario_inicio[2]" value="@php if($horarios_atendimento <> null) echo $horarios_atendimento->horario_inicio_terca @endphp" autofocus>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="horario" name="horario_fim[2]" value="@php if($horarios_atendimento <> null) echo $horarios_atendimento->horario_fim_terca @endphp" autofocus>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="status_dia[2]" value="1" @php if($horarios_atendimento <> null){if($horarios_atendimento->atendimento_terca == 1){ echo " checked=\"checked\""; }}@endphp>Terça-Feira
                                            </label>
                                        </div>
                                    </div>  
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="horario" name="horario_inicio[3]" value="@php if($horarios_atendimento <> null) echo $horarios_atendimento->horario_inicio_quarta @endphp" autofocus>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="horario" name="horario_fim[3]" value="@php if($horarios_atendimento <> null) echo $horarios_atendimento->horario_fim_quarta @endphp" autofocus>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="status_dia[3]" value="1" @php if($horarios_atendimento <> null){if($horarios_atendimento->atendimento_quarta == 1){ echo " checked=\"checked\""; }}@endphp>Quarta-Feira
                                            </label>
                                        </div>  
                                    </div>   
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="horario" name="horario_inicio[4]" value="@php if($horarios_atendimento <> null) echo $horarios_atendimento->horario_inicio_quinta @endphp" autofocus>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="horario" name="horario_fim[4]" value="@php if($horarios_atendimento <> null) echo $horarios_atendimento->horario_fim_quinta @endphp" autofocus>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="status_dia[4]" value="1" @php if($horarios_atendimento <> null){if($horarios_atendimento->atendimento_quinta == 1){ echo " checked=\"checked\""; }}@endphp>Quinta-Feira
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="horario" name="horario_inicio[5]" value="@php if($horarios_atendimento <> null) echo $horarios_atendimento->horario_inicio_sexta @endphp" autofocus>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="horario" name="horario_fim[5]" value="@php if($horarios_atendimento <> null) echo $horarios_atendimento->horario_fim_sexta @endphp" autofocus>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="status_dia[5]" value="1" @php if($horarios_atendimento <> null){if($horarios_atendimento->atendimento_sexta == 1){ echo " checked=\"checked\""; }}@endphp>Sexta-Feira
                                            </label>
                                        </div>
                                    </div> 
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="horario" name="horario_inicio[6]" value="@php if($horarios_atendimento <> null) echo $horarios_atendimento->horario_inicio_sabado @endphp" autofocus>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="horario" name="horario_fim[6]" value="@php if($horarios_atendimento <> null) echo $horarios_atendimento->horario_fim_sabado @endphp" autofocus>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="status_dia[6]" value="1" @php if($horarios_atendimento <> null){if($horarios_atendimento->atendimento_sabado == 1){ echo " checked=\"checked\""; }}@endphp>Sabádo
                                            </label>
                                        </div> 
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="horario" name="horario_inicio[0]" value="@php if($horarios_atendimento <> null) echo $horarios_atendimento->horario_inicio_domingo @endphp" autofocus>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="horario" name="horario_fim[0]" value="@php if($horarios_atendimento <> null) echo $horarios_atendimento->horario_fim_domingo @endphp" autofocus>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="status_dia[0]" value="1" @php if($horarios_atendimento <> null){if($horarios_atendimento->atendimento_domingo == 1){ echo " checked=\"checked\""; }}@endphp>Domingo
                                            </label>
                                        </div> 
                                    </div>                                    
                                </div>
                                <div class="col-sm-12 divbuttonitem">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>Salvar</button>
                                </div>                                  
                            </fieldset> 
                        </form>
                        <form method="post" action="/updatevaluekm" class="formregister"> 
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id_empresa" value="{{Auth::user()->empresas_id_empresa}}">
                            <fieldset> 
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4>Base de Calculo para o Frete:</h4>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="label">Valor Km em R$:</label>  
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="valor_km" name="valor_km" value="{{$datacompany->taxa_km_entrega}}" autofocus @php if($datacompany->utilizar_taxa_fixa == 1){ echo " disabled"; }@endphp>
                                    </div>
                                </div>    
                                <div class="row">    
                                    <div class="col-sm-3">
                                        <label class="label">Taxa Fixa em R$:</label>  
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="taxa_fixa_entrega" name="taxa_fixa_entrega" value="{{$datacompany->taxa_fixa_entrega}}" autofocus @php if($datacompany->utilizar_taxa_fixa == 0){ echo " disabled"; }@endphp>
                                    </div>                                        
                                    <div class="col-sm-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="utilizar_taxa_fixa" name="utilizar_taxa_fixa" value="1" onclick="checkTaxaFixa()" @php if($datacompany->utilizar_taxa_fixa == 1){ echo " checked=\"checked\""; }@endphp>Utilizar Taxa Fixa
                                            </label>
                                        </div>                                             
                                    </div>
                                </div>
                                <div class="col-sm-12 divbuttonitem">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>Salvar</button>
                                </div>                                  
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
</div>
<script>
    function setfilename() {
        document.getElementById('file-name').textContent = document.getElementById('logo').files[0].name;
    }
    ;

    $("#addformpayment").click(function () {
        var f = JSON.parse($("#forma_pagamento").val());
        var s = document.getElementById("forma_pagamento");
        var markup = "<div class='checkbox'>" +
                "<label>" +
                "<input type='checkbox' value='1' name='status_forma_pagamento_empresa[" + (4 - s.length) + "]' @php if($forma->status_forma_pagamento_empresa == 1){ echo ' checked=\'checked\''; }@endphp>" + f['nome_forma_pagamento'] +
                "<input type='hidden' name='id_forma_pagamento[" + (4 - s.length) + "]' value='" + f['id_forma_pagamento'] + "'>" +
                "<input type='hidden' name='cadastrado[" + (4 - s.length) + "]' value='-1'>" +
                "</label>" +
                "</div>";
        $("#forma_pagamento_cadastradas").append(markup);
        s.remove(s.selectedIndex);
    });

    $("input[id*='horario']").inputmask({
        mask: ['99:99:00'],
        keepStatic: true
    });
    $('#valor_km').inputmask("currency", {radixPoint: ","});
    $('#taxa_fixa_entrega').inputmask("currency", {radixPoint: ","});
    function checkTaxaFixa() {
        var checkbox = document.getElementById("utilizar_taxa_fixa");
        if (checkbox.checked == true) {
            document.getElementById("valor_km").disabled = true;
            document.getElementById("valor_km").readOnly = true;
            document.getElementById("taxa_fixa_entrega").disabled = false;
            document.getElementById("taxa_fixa_entrega").readOnly = false;
        } else {
            document.getElementById("valor_km").disabled = false;
            document.getElementById("valor_km").readOnly = false;
            document.getElementById("taxa_fixa_entrega").disabled = true;
            document.getElementById("taxa_fixa_entrega").readOnly = true;
        }
    }
    ;
</script>    