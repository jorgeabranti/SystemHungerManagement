@inject('sabor_produto', 'HungerManagement\Http\Controllers\FlavorsProductsController')
<table class="table">
<thead>
<tr>
<th class="col-xs-2">Item</th>
<th class="col-xs-7">Sabores</th>
<th class="col-xs-3">Opções</th>
</tr>
</thead>
<tbody class="points_table_scrollbar">
    
<tr class="even">
<td class="col-xs-2">
{{$row}}
</td>
<td class="col-xs-7">
<select class="form-control select" id="sabores" required>
    <option value="">Selecione o Sabor</option>
    @foreach($sabor_produto->saboresTipoProduto($id_tipo_produto)->sabor_produto as $key => $flavor)
    <option value="{{$key}}">{{$flavor->nome_sabor_produto}}</option>
    @endforeach
</select>   
</td>
<td class="col-xs-3">
    <button type="button" class="btn btn-theme04" id="additem">Adicionar Sabor<i class="fa fa-level-down"></i></button>
</td>
</tr>

    @foreach($array_id_sabores as $key => $flavor)
<tr class="even">
<td class="col-xs-2">

</td>    
    <td class="col-xs-7">
        @php $flavor = $sabor_produto->saborProduto($flavor)->sabor_produto @endphp
        <input type="hidden" name="id_sabor_produto" value="{{$flavor->id_sabor_produto}}"/>
        <span class="check">
            <input type="text" name="nome_sabor_produto" value="{{$flavor->nome_sabor_produto}}"/>
        </span>
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button> 
    </td>
<td class="col-xs-3">

</td> 
</tr>
    @endforeach

</tbody>
</table>
<input type = "hidden" name = "_token" value = "{{csrf_token()}}">
<button type="button" class="btn btn-danger" value="" onclick=""><i class="fa fa-"></i>Cancelar</button>
<button type="button" class="btn btn-success" value=""><i class="fa fa-check"></i>Salvar</button>'