@inject('pedidos', 'HungerManagement\Http\Controllers\RequestController')
@inject('pedidos_sabores_produtos', 'HungerManagement\Http\Controllers\RequestFlavorsProductsController')
@inject('sabor_produto', 'HungerManagement\Http\Controllers\FlavorsProductsController')
@inject('company', 'HungerManagement\Http\Controllers\CompanyController')
@inject('entregadores', 'HungerManagement\Http\Controllers\DeliveryManController')

@foreach($pedidos->getRequestsCompany($company->show(Auth::user()->empresas_id_empresa)->empresa[0]->id_empresa)->pedidos as $key => $pedido) 
@php 
$rowshow = "hidden_row".$key;
if ($pedido->status_pedido === 1): 
$status = "Pendente";
elseif ($pedido->status_pedido === 2):
$status = "Em Produção";
elseif ($pedido->status_pedido === 3):
$status = "Expedido";
elseif($pedido->status_pedido === 4):
$status = "Entregue";
endif;
$entregador = $entregadores->getDeliveryman($pedido->entregadores_id_entregador);
@endphp
<tr class="even" onclick="show_hide_row({{$rowshow}});" id="roweffect"> 
    <td class="col-xs-1"><p>{{ $pedido->id_pedido }}<p></td>          
    <td class="col-xs-1">@php echo date("H:i:s", strtotime($pedido->data_pedido));@endphp</td>
    <td class="col-xs-2">{{$pedido->nome_cliente}}</td>
    <td class="col-xs-6 tablelist">
        <!-- <marquee direction="up" behavior="alternate" style="height:100px"  scrolldelay="350" truespeed>  --> 
        @foreach($pedidos_sabores_produtos->itensPedido($pedido->id_pedido)->itens_pedido as $key => $itens_pedido)
        <b>Item {{$key+1}}: {{$itens_pedido->nome_produto}}:</b>( 
        @foreach($sabor_produto->saborProdutoPedido($itens_pedido->pedidos_id_pedido,$itens_pedido->id_item)->sabor_produto as $key => $sabor)
        @if ($key > 0)
        /{{$sabor->nome_sabor_produto}}
        @else
        {{$sabor->nome_sabor_produto}}
        @endif    
        @endforeach
        )<br>
        @endforeach
        <!-- </marquee>-->  
    </td> 
    <td class="col-xs-2">
        <p id="statustext" class="<?php if ($status == 'Pendente') echo 'shaketext' ?>">{{$status}}</p>
        <form action="/updatestatus/{{ $pedido->id_pedido }}" method="post">
            @can('isAdmin')
            <input type = "hidden" name = "_token" value = "{{csrf_token()}}">
            <button type="submit" id="emproducao" class="btn btn-success btn-xs <?php if ($status == 'Em Produção') echo ' buttoneffect' ?>" name='status_pedido' value ="2" title="Em Produção"><i class="fa fa-fire"></i></button>
            <button type="submit" id="expedido" class="btn btn-success btn-xs <?php if ($status == 'Expedido') echo ' buttoneffect' ?>" onclick="@php if(!is_null($entregador) && !is_null($pedido->id_rede_social_cliente)){ echo 'alertPostDelivery('.$pedido->id_pedido.')'; } else {echo 'return alertDeliveryMan()';} @endphp" name='status_pedido' value ="3" title="Expedido"><i class="fa fa-car"></i></button>
            <button type="submit" id="entregue" class="btn btn-success btn-xs <?php if ($status == 'Entregue') echo ' buttoneffect' ?>" onClick="return confirm('Confirme se o pedido foi entregue.')" name='status_pedido' value ="4" title="Entregue"><i class="fa fa-check"></i></button>                                                               
            <button type="submit" class="btn btn-danger btn-xs" onClick="return confirm('Deseja excluir o pedido?')" name='status_pedido' value ="5" title="Excluir Pedido"><i class="fa fa-trash-o" name = 'status_pedido' value ="5"></i></button>  
            @endcan
            @can('isAttendent')
            <input type = "hidden" name = "_token" value = "{{csrf_token()}}">
            <button type="submit" id="emproducao" class="btn btn-success btn-xs <?php if ($status == 'Em Produção') echo ' buttoneffect' ?>" name='status_pedido' value ="2" title="Em Produção"><i class="fa fa-fire"></i></button>
            <button type="submit" id="expedido" class="btn btn-success btn-xs <?php if ($status == 'Expedido') echo ' buttoneffect' ?>" onclick="@php if(!is_null($entregador) && !is_null($pedido->id_rede_social_cliente)){ echo 'alertPostDelivery('.$pedido->id_pedido.')'; } else {echo 'return alertDeliveryMan()';} @endphp" name='status_pedido' value ="3" title="Expedido"><i class="fa fa-car"></i></button>
            <button type="submit" id="entregue" class="btn btn-success btn-xs <?php if ($status == 'Entregue') echo ' buttoneffect' ?>" onClick="return confirm('Confirme se o pedido foi entregue.')" name='status_pedido' value ="4" title="Entregue"><i class="fa fa-check"></i></button>                                                               
            <button type="submit" class="btn btn-danger btn-xs" onClick="return confirm('Deseja excluir o pedido?')" name='status_pedido' value ="5" title="Excluir Pedido"><i class="fa fa-trash-o" name = 'status_pedido' value ="5"></i></button>  
            @endcan            
        </form>
    </td>
</tr>
<tr id="<?php echo $rowshow; ?>" class="hidden_row" style="display:none">
    <td>
        @can('isAdmin')
            <button class="btn btn-danger btn-xs" onclick="setDeliveryman({{$pedido->id_pedido}})">Definir <br> Entregador</button>
        @endcan
        @can('isAttendent')
            <button class="btn btn-danger btn-xs" onclick="setDeliveryman({{$pedido->id_pedido}})">Definir <br> Entregador</button>
        @endcan        
    </td>
    <td>
        @php 
        if ($entregador !== null) {
        echo "<b>Nome: </b>".$entregador['nome_entregador']."<b><br>Placa: </b>".$entregador['placa_entregador'];
        } else {
        echo "Não Definido";
        }
        @endphp
    </td>
    <td><b>Endereço:</b>
        {{$pedido->endereco_cliente}} - {{$pedido->endereco_numero_cliente}} - {{$pedido->cidade_cliente}}
    </td>                            
    <td><b>Valor Total R$: </b>{{$pedido->total_valor_pedido}}</td> 
</tr>      
@endforeach                    
