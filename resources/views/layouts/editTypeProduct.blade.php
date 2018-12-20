<table class="table table-striped points_table" id="tableitens">                                           
    <thead>
        <tr>
            <th class="col-xs-1">Cód.</th>
            <th class="col-xs-4">Nome</th>
            <th class="col-xs-5">Descrição</th>
            <th class="col-xs-2">Status</th>
        </tr>
    </thead> 
    <tbody class="points_table_scrollbar"> 
        <tr class="even" id="rowStyleEdit">
            <td class="col-xs-1"><input type="text" class="form-control" name="id_tipo_produto" value="{{$tipo_produto[0]->id_tipo_produto}}" readonly></td>
            <td class="col-xs-4"><input type="text" class="form-control" name="nome_tipo_produto" value="{{$tipo_produto[0]->nome_tipo_produto}}" required autofocus></td>
            <td class="col-xs-5"><textarea class="form-control" name="descricao_tipo_produto" rows="5" required autofocus>{{$tipo_produto[0]->descricao_tipo_produto}}</textarea></td>                                                                    
            <td class="col-xs-2"><input type="checkbox" class="form-control" name="status_tipo_produto" value="1" @php if($tipo_produto[0]->status_tipo_produto == 1){ echo " checked=\"checked\""; }@endphp></td>
        </tr>
        <tr class="even" id="rowStyleImage">
            <td class="col-xs-2"></td>
            <td colspan="1" class="col-xs-4">                                  
                <img src="{{asset('/img/typeproducts/'.$tipo_produto[0]->tipo_produto_img)}}" class="figure" height="150" width="auto">
                <input type="hidden" name="tipo_produto_img" value="{{$tipo_produto[0]->tipo_produto_img}}">
            </td>
            <td colspan="2" class="col-xs-6">
                <label for="product_type_image" class="textfile">Selecionar um arquivo</label>
                <input type="file" name="product_type_image" id="product_type_image" onchange="setfilenametypeproduct()">
                <span id="file-name"></span>
            </td>
        </tr>
    </tbody>
</table> 

<input type = "hidden" name = "_token" value = "{{csrf_token()}}"> 
<button type="button" class="btn btn-danger" value="" onclick="cancelEditTypeProduct()"><i class="fa fa-"></i>Cancelar</button>
<button type="submit" class="btn btn-success" name="submit"><i class="fa fa-check"></i>Salvar</button>  