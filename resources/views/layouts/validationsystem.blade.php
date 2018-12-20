<link href="{{asset('/css/validation.css')}}" rel="stylesheet" type="text/css">
<script src="{{ asset('/js/RobinHerbots-inputmask/jquery.inputmask.bundle.js') }}" type="text/javascript" ></script>
<div class="wrapper">
    <div class="navbar-collapse">
        <nav class="navbar navbar-laravel">
            <div class="btn-group btn-group-justified">
                <ul class="navbar-nav mr-auto">
                    <button type="button" class="btn btn-theme04" onclick="window.location.href = '/administration'"><i class="fa fa-arrow-left"></i> Voltar ao Menu</button>
                </ul>
                <ul class="navbar-nav page_identify">
                    <p>Questionário de Validação de Sistema</p>
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
                        <form method="post" action="/savevalidation" class="formregister"> 
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id_empresa" value="{{Auth::user()->empresas_id_empresa}}">
                            <fieldset> 
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4>Dados do Avaliador:</h4> 
                                    </div>                                             
                                </div>
                                <div class="form-group row">  
                                    <label class="col-md-2 col-form-label text-md-right">Nome Completo</label> 
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nome" name="nome" value="" autofocus>
                                    </div> 
                                </div>
                                <div class="form-group row"> 
                                    <label class="col-md-2 col-form-label text-md-right">Idade</label>                                
                                        <div class="col-sm-2">
                                        <input type="text" class="form-control" id="idade" name="idade" value="" autofocus>
                                        </div>
                                    <label class="col-md-2 col-form-label text-md-right">Telefone</label>                                
                                        <div class="col-sm-4">
                                        <input type="text" class="form-control" id="telefone" name="telefone" value="" autofocus>
                                        </div>                             
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right">Área(s) de atuação</label>                                
                                    <div class="col-sm-10"> 
                                        <input type="text" class="form-control" id="areas" name="areas" value="" autofocus>
                                    </div>                             
                                </div>                             
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4>Questionário de Avaliação</h4> 
                                    </div> 
                                    <div class="col-sm-12">
                                        <h5>Com base nos testes efetuados responda seu grau de concordância com as funcinalidades oferecidas pelo sistema.</h5> 
                                    </div>                                    
                                </div>
                                <div class="row">                                
<!--************************************************************************************************************************** --> 
<!-- Clientes  -->
                                    <div class="col-sm-12">
                                    <label class="col-sm-12 label text-left"><p>1.1. O cadastro de clientes funciona corretamente.</p></label>                                
                                    <div class="col-sm-5 divcenter"> 
                                        <select class="form-control select" name="1.1">
                                            <option value="1">Discordo totalmente</option>
                                            <option value="2">Discordo parcialmente</option>
                                            <option value="3">Não concordo, nem discordo</option>
                                            <option value="4">Concordo parcialmente</option>
                                            <option value="5">Concordo totalmente</option>
                                        </select>
                                    </div>                              
                                    <label class="col-sm-12 label text-left"><p>1.2. É fácil realizar o cadastro de cliente.</p></label>                                
                                    <div class="col-sm-5 divcenter"> 
                                        <select class="form-control select" name="1.2">
                                            <option value="1">Discordo totalmente</option>
                                            <option value="2">Discordo parcialmente</option>
                                            <option value="3">Não concordo, nem discordo</option>
                                            <option value="4">Concordo parcialmente</option>
                                            <option value="5">Concordo totalmente</option>
                                        </select>
                                    </div>
                                    
                                    <label class="col-sm-12 label text-left"><p>1.3. Descreva necessidades não atendidas pelo cadastro de clientes, se houverem. (Opcional)</p></label> 
                                    <textarea rows="4" cols="50" class="textarea" name="1.3"></textarea>
                                    </div>                                                       
<!--************************************************************************************************************************** -->
<!-- tipo produtos,produtos e sabores  -->
                                <div class="col-sm-12">
                                    <label class="col-sm-12 label text-left"><p>2.1 O cadastro de tipos de produtos, produtos e sabores funciona corretamente.</p></label>                                
                                    <div class="col-sm-5 divcenter"> 
                                        <select class="form-control select" name="2.1">
                                            <option value="1">Discordo totalmente</option>
                                            <option value="2">Discordo parcialmente</option>
                                            <option value="3">Não concordo, nem discordo</option>
                                            <option value="4">Concordo parcialmente</option>
                                            <option value="5">Concordo totalmente</option>
                                        </select>
                                    </div>                              
                                    <label class="col-sm-12 label text-left"><p>2.2 É fácil realizar o cadastro de tipos de produtos, produtos e sabores.</p></label>                                
                                    <div class="col-sm-5 divcenter"> 
                                        <select class="form-control select" name="2.2">
                                            <option value="1">Discordo totalmente</option>
                                            <option value="2">Discordo parcialmente</option>
                                            <option value="3">Não concordo, nem discordo</option>
                                            <option value="4">Concordo parcialmente</option>
                                            <option value="5">Concordo totalmente</option>
                                        </select>
                                    </div>                              
                                    <label class="col-sm-12 label text-left"><p>2.3. Descreva necessidades não atendidas pelo cadastro de tipos de produtos, produtos e sabores, se houverem. (Opcional)</p></label> 
                                    <textarea rows="4" cols="50" class="textarea" name="2.3"></textarea>
                                </div>
<!--************************************************************************************************************************** -->   
<!-- Entregadores  -->
                                <div class="col-sm-12">    
                                    <label class="col-sm-12 label text-left"><p>3.1. O cadastro de entregadores funciona corretamente.</p></label>                                
                                    <div class="col-sm-5 divcenter"> 
                                        <select class="form-control select" name="3.1">
                                            <option value="1">Discordo totalmente</option>
                                            <option value="2">Discordo parcialmente</option>
                                            <option value="3">Não concordo, nem discordo</option>
                                            <option value="4">Concordo parcialmente</option>
                                            <option value="5">Concordo totalmente</option>
                                        </select>
                                    </div>                              
                                    <label class="col-sm-12 label text-left"><p>3.2. É fácil realizar o cadastro de entregador.</p></label>                                
                                    <div class="col-sm-5 divcenter"> 
                                        <select class="form-control select" name="3.2">
                                            <option value="1">Discordo totalmente</option>
                                            <option value="2">Discordo parcialmente</option>
                                            <option value="3">Não concordo, nem discordo</option>
                                            <option value="4">Concordo parcialmente</option>
                                            <option value="5">Concordo totalmente</option>
                                        </select>
                                    </div>                              
                                    <label class="col-sm-12 label text-left"><p>3.3. Descreva necessidades não atendidas pelo cadastro de entregadores, se houverem. (Opcional)</p></label> 
                                    <textarea rows="4" cols="50" class="textarea" name="3.3"></textarea>
                                </div>
<!--************************************************************************************************************************** -->
<!-- Pednameos  -->
                                <div class="col-sm-12">    
                                    <label class="col-sm-12 label text-left"><p>4.1. O cadastro de pedidos funciona corretamente.</p></label>                                
                                    <div class="col-sm-5 divcenter"> 
                                        <select class="form-control select" name="4.1">
                                            <option value="1">Discordo totalmente</option>
                                            <option value="2">Discordo parcialmente</option>
                                            <option value="3">Não concordo, nem discordo</option>
                                            <option value="4">Concordo parcialmente</option>
                                            <option value="5">Concordo totalmente</option>
                                        </select>
                                    </div>                              
                                    <label class="col-sm-12 label text-left"><p>4.2. É fácil realizar o cadastro do pedidos.</p></label>                                
                                    <div class="col-sm-5 divcenter"> 
                                        <select class="form-control select" name="4.2">
                                            <option value="1">Discordo totalmente</option>
                                            <option value="2">Discordo parcialmente</option>
                                            <option value="3">Não concordo, nem discordo</option>
                                            <option value="4">Concordo parcialmente</option>
                                            <option value="5">Concordo totalmente</option>
                                        </select>
                                    </div>                              
                                    <label class="col-sm-12 label text-left"><p>4.3. Descreva necessidades não atendidas pelo cadastro de pedidos, se houverem. (Opcional)</p></label> 
                                    <textarea rows="4" cols="50" class="textarea" name="4.3"></textarea>
                                </div>
<!--************************************************************************************************************************** -->
<!-- Fila de pednameos  -->
                                <div class="col-sm-12">    
                                    <label class="col-sm-12 label text-left"><p>5.1. A fila de pedidos funciona corretamente.</p></label>                                
                                    <div class="col-sm-5 divcenter"> 
                                        <select class="form-control select" name="5.1">
                                            <option value="1">Discordo totalmente</option>
                                            <option value="2">Discordo parcialmente</option>
                                            <option value="3">Não concordo, nem discordo</option>
                                            <option value="4">Concordo parcialmente</option>
                                            <option value="5">Concordo totalmente</option>
                                        </select>
                                    </div>                              
                                    <label class="col-sm-12 label text-left"><p>5.2. É fácil visualizar e gerenciar os pedidos pela fila de pedidos.</p></label>                                
                                    <div class="col-sm-5 divcenter"> 
                                        <select class="form-control select" name="5.2">
                                            <option value="1">Discordo totalmente</option>
                                            <option value="2">Discordo parcialmente</option>
                                            <option value="3">Não concordo, nem discordo</option>
                                            <option value="4">Concordo parcialmente</option>
                                            <option value="5">Concordo totalmente</option>
                                        </select>
                                    </div>                              
                                    <label class="col-sm-12 label text-left"><p>5.3. Descreva necessidades não atendidas pela fila de pedidos, se houverem. (Opcional)</p></label> 
                                    <textarea rows="4" cols="50" class="textarea" name="5.3"></textarea>
                                </div>
<!--************************************************************************************************************************** -->
<!-- Relatórios  -->
                                <div class="col-sm-12">    
                                    <label class="col-sm-12 label text-left"><p>6.1. A tela de relatórios exibe os dados corretamente.</p></label>                                
                                    <div class="col-sm-5 divcenter"> 
                                        <select class="form-control select" name="6.1">
                                            <option value="1">Discordo totalmente</option>
                                            <option value="2">Discordo parcialmente</option>
                                            <option value="3">Não concordo, nem discordo</option>
                                            <option value="4">Concordo parcialmente</option>
                                            <option value="5">Concordo totalmente</option>
                                        </select>
                                    </div>                              
                                    <label class="col-sm-12 label text-left"><p>6.2. Os relatórios de vendas por canal de atendimento, venda bruta mensal em R$, quantidade de vendas por mês e produtos mais vendnameos por mês facilitam o acompanhamento financeiro da empresa.</p></label>                                
                                    <div class="col-sm-5 divcenter"> 
                                        <select class="form-control select" name="6.2">
                                            <option value="1">Discordo totalmente</option>
                                            <option value="2">Discordo parcialmente</option>
                                            <option value="3">Não concordo, nem discordo</option>
                                            <option value="4">Concordo parcialmente</option>
                                            <option value="5">Concordo totalmente</option>
                                        </select>
                                    </div>                              
                                    <label class="col-sm-12 label text-left"><p>6.3. Descreva necessidades não atendidas pela tela de relatórios, se houverem. (Opcional)</p></label> 
                                    <textarea rows="4" cols="50" class="textarea" name="6.3"></textarea>
                                </div>
<!--************************************************************************************************************************** -->
<!-- Usuários  -->
                                <div class="col-sm-12">    
                                    <label class="col-sm-12 label text-left"><p>7.1. O cadastro de usuários funciona corretamente.</p></label>                                
                                    <div class="col-sm-5 divcenter"> 
                                        <select class="form-control select" name="7.1">
                                            <option value="1">Discordo totalmente</option>
                                            <option value="2">Discordo parcialmente</option>
                                            <option value="3">Não concordo, nem discordo</option>
                                            <option value="4">Concordo parcialmente</option>
                                            <option value="5">Concordo totalmente</option>
                                        </select>
                                    </div>                              
                                    <label class="col-sm-12 label text-left"><p>7.2. É fácil cadastrar um usuário.</p></label>                                
                                    <div class="col-sm-5 divcenter"> 
                                        <select class="form-control select" name="7.2">
                                            <option value="1">Discordo totalmente</option>
                                            <option value="2">Discordo parcialmente</option>
                                            <option value="3">Não concordo, nem discordo</option>
                                            <option value="4">Concordo parcialmente</option>
                                            <option value="5">Concordo totalmente</option>
                                        </select>
                                    </div>                              
                                    <label class="col-sm-12 label text-left"><p>7.3. Descreva necessidades não atendidas pelo cadastro de usuários, se houverem. (Opcional)</p></label> 
                                    <textarea rows="4" cols="50" class="textarea" name="7.3"></textarea>
                                </div>
<!--************************************************************************************************************************** -->
<!-- Parâmetros  -->
                                <div class="col-sm-12">    
                                    <label class="col-sm-12 label text-left"><p>8.1. A tela de parâmetros do sistema funciona corretamente.</p></label>                                
                                    <div class="col-sm-5 divcenter"> 
                                        <select class="form-control select" name="8.1">
                                            <option value="1">Discordo totalmente</option>
                                            <option value="2">Discordo parcialmente</option>
                                            <option value="3">Não concordo, nem discordo</option>
                                            <option value="4">Concordo parcialmente</option>
                                            <option value="5">Concordo totalmente</option>
                                        </select>
                                    </div>                              
                                    <label class="col-sm-12 label text-left"><p>8.2. É fácil alterar os parâmteros do sistema.</p></label>                                
                                    <div class="col-sm-5 divcenter"> 
                                        <select class="form-control select" name="8.2">
                                            <option value="1">Discordo totalmente</option>
                                            <option value="2">Discordo parcialmente</option>
                                            <option value="3">Não concordo, nem discordo</option>
                                            <option value="4">Concordo parcialmente</option>
                                            <option value="5">Concordo totalmente</option>
                                        </select>
                                    </div>                              
                                    <label class="col-sm-12 label text-left"><p>8.3. Descreva necessidades não atendidas nos parâmetros de sistema, por exemplo, configurações que ajudariam no sistema, se houverem. (Opcional)</p></label> 
                                    <textarea rows="4" cols="50" class="textarea" name="8.3"></textarea>
                                </div>
<!--************************************************************************************************************************** -->
                                <div class="col-sm-12 divbuttonitem">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>Enviar</button>
                                </div>
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