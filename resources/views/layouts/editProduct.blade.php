<table class="table table-striped points_table" id="tableitens">                                           
    <thead>
        <tr>
            <th class="col-xs-1">Cód.</th>
            <th class="col-xs-2">Tipo</th>
            <th class="col-xs-2">Nome</th>
            <th class="col-xs-2">Descrição</th>
            <th class="col-xs-2">Valor R$</th>
            <th class="col-xs-2">Qtda Sabores</th>
            <th class="col-xs-1">Status</th>
        </tr>
    </thead> 
    <tbody class="points_table_scrollbar"> 
        @inject('tipos_produtos_empresa', 'HungerManagement\Http\Controllers\ProductsTypesController') 
        <tr class="even" id="rowStyleEdit"> 
            <td class="col-xs-1"><input type="text" class="form-control" name="id_produto" value="{{ $produto[0]->id_produto}}" readonly></td> 
            <td class="col-xs-2"> 
                <select class="form-control selectProduct" name="id_tipo_produto" required> 
                    @foreach($tipos_produtos_empresa->tiposProdutosEmpresa(Auth::user()->empresas_id_empresa)->tipos_produtos_empresa as $key => $tipo_produto) 
                    <option value="{{$tipo_produto->id_tipo_produto}}" @php if ($tipo_produto->id_tipo_produto == $produto[0]->tipos_produtos_id_tipo_produto){ echo ' selected="selected"'; } @endphp>{{$tipo_produto->nome_tipo_produto}}</option> 
                    @endforeach
                </select> 
            </td> 
            <td class="col-xs-2"><input type="text" class="form-control" name="nome_produto" value="{{ $produto[0]->nome_produto}}" required autofocus></td> 
            <td class="col-xs-2"><textarea wrap="hard" class="form-control" name="descricao_produto" rows="5" required autofocus>{{ $produto[0]->descricao_produto}}</textarea></td>
            <td class="col-xs-2"><input type="number" class="form-control" step="0.01" name="valor_unitario_produto" value="{{ $produto[0]->valor_unitario_produto}}" required autofocus></td> 
            <td class="col-xs-2"><input type="number" min="1" max="50" class="form-control" name="quant_sabores_produto" value="{{ $produto[0]->quant_sabores_produto}}" autofocus></td> 
            <td class="col-xs-1"><input type="checkbox" class="form-control" name="status_produto" value="1" @php if($produto[0]->status_produto == 1){ echo " checked=\"checked\""; }@endphp></td> 
        </tr>
        <tr class="even" id="rowStyleImage">
            <td class="col-xs-2"></td>
            <td colspan="1" class="col-xs-4">                                  
                <img src="{{asset('/img/products/'.$produto[0]->produto_img)}}" class="figure" height="150" width="auto">
                <input type="hidden" name="produto_img" value="{{$produto[0]->produto_img}}">
            </td>            
            <td colspan="2" class="col-xs-6">
                <label for="product_image" class="textfile">Selecionar um arquivo</label>
                <input type="file" name="product_image" id="product_image" onchange="setfilenameproduct()">
                <span id="file-name"></span>
            </td>
        </tr>    
    </tbody> 
</table>
<input type = "hidden" name = "_token" value = "{{csrf_token()}}">
<button type="button" class="btn btn-danger" value="" onclick="cancelEditProduct()"><i class="fa fa-"></i>Cancelar</button>
<button type="submit" class="btn btn-success" value=""><i class="fa fa-check"></i>Salvar</button>  