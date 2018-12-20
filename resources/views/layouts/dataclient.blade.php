@php
if ($cliente[0]->telefone_celular_cliente !== null)
    $telefone_celular_cliente = $cliente[0]->telefone_celular_cliente;
else 
    $telefone_celular_cliente = 'Sem Registro';
if ($cliente[0]->telefone_residencial_cliente !== null)
    $telefone_residencial_cliente = $cliente[0]->telefone_residencial_cliente;
else 
    $telefone_residencial_cliente = 'Sem Registro';    
@endphp
<tr class="even">
    <td><b>Nome:</b></td>
    <td><input type="hidden" name="id_cliente" value="{{$cliente[0]->id_cliente}}">{{$cliente[0]->nome_cliente}}</td>
    <td><b>Endereço:</b></td>
    <td>Rua {{$cliente[0]->endereco_cliente}}, N° {{$cliente[0]->endereco_numero_cliente}}, Bairro {{$cliente[0]->bairro_cliente}}, Cidade de {{$cliente[0]->cidade_cliente}}</td>
</tr>
<tr class="even">
    <td><b>Tel. Celular:</b></td>
    <td>{{$telefone_celular_cliente}}</td>
    <td><b>Tel. Residencial:</b></td>
    <td>{{$telefone_residencial_cliente}}</td>
</tr> 