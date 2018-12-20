<input type="hidden" name="id_sabor_produto" value="{{ $sabor_produto[0]->id_sabor_produto}}">
<table class="table table-striped points_table">
    <thead>
        <tr>
            <th class="col-xs-1">Cód.</th>
            <th class="col-xs-3">Tipo</th>
            <th class="col-xs-2">Nome</th>
            <th class="col-xs-3">Descrição</th>
            <th class="col-xs-3">Status</th>
        </tr>
    </thead>                                                
    <tbody class="points_table_scrollbar">
        @inject('tipos_produtos_empresa', 'HungerManagement\Http\Controllers\ProductsTypesController')
        <tr class='even'id="rowStyleEdit">
            <td class="col-xs-1">{{$sabor_produto[0]->id_sabor_produto}}</td>
            <td class="col-xs-3"> 
                <select class="form-control select" name="id_tipo_produto" required> 
                    @foreach($tipos_produtos_empresa->tiposProdutosEmpresa(Auth::user()->empresas_id_empresa)->tipos_produtos_empresa as $key => $tipo_produto) 
                    <option value="{{$tipo_produto->id_tipo_produto}}" @php if ($tipo_produto->id_tipo_produto == $sabor_produto[0]->tipos_produtos_id_tipo_produto){ echo ' selected="selected"'; } @endphp>{{$tipo_produto->nome_tipo_produto}}</option> 
                    @endforeach
                </select> 
            </td> 
            <td class="col-xs-2"><input type="text" class="form-control" name="nome_sabor_produto" value="{{$sabor_produto[0]->nome_sabor_produto}}" required autofocus></td>
            <td class="col-xs-3" id="autotext"><textarea wrap="hard" class="form-control" name="descricao_sabor_produto" rows="5" required autofocus>{{ $sabor_produto[0]->descricao_sabor_produto}}</textarea></td>                                                                    
            <td class="col-xs-3"><input type="checkbox" class="form-control" name="status_sabor_produto" value="1" @php if($sabor_produto[0]->status_sabor_produto == 1){ echo " checked=\"checked\""; }@endphp></td>
        </tr>
    </tbody>
</table>    
<input type = "hidden" name = "_token" value = "{{csrf_token()}}"> 
<button type="button" class="btn btn-danger" value="" onclick="cancelEditFlavor()"><i class="fa fa-"></i>Cancelar</button>
<button type="submit" class="btn btn-success" value=""><i class="fa fa-check"></i>Salvar</button>   