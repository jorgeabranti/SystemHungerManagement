<tr class='even'>
<td class='col-xs-1'></td>
<td class='col-xs-2'>
<select class='form-control select' name='id_tipo_produto' required>
@foreach($tipos_produtos_empresa as $key => $tipo_produto)
<option value='{{$tipo_produto->id_tipo_produto}}'>{{$tipo_produto->nome_tipo_produto}}</option>
@endforeach
</select>
</td>
<td class='col-xs-2'><input type='text' class='form-control' name='nome_produto' value='' required autofocus></td>
<td class='col-xs-2'><input type='text' class='form-control' name='descricao_produto' value='' required autofocus></td>
<td class='col-xs-1'><input type='number' class='form-control' step='0.01' name='valor_unitario_produto' value='' required autofocus></td>
<td class='col-xs-1'><input type='number' min='1' max='50' class='form-control' name='quant_sabores_produto' value='' autofocus></td>
<td class='col-xs-1'><input type='checkbox' checked='checked' class='form-control' name='status_produto' value='1'></td>
<td class='col-xs-2'>
<button type='submit' class='btn btn-success btn-xs'><i class='fa fa-check'></i></button>
<button class='btn btn-danger btn-xs' onclick='window.location.reload()'><i class='fa fa-asterisk'></i></button>
</td>
</tr>
<tr class='even'>
<td class='col-xs-4'>
<h4>Adicionar Imagem >>></h4>
</td>
<td class='col-xs-8'>
    <label for="product_image" class="textfile">Selecionar um arquivo</label>
    <input type="file" name="product_image" id="product_image" onchange="setfilenameproduct()">
    <span id="file-name"></span>
</td>
</tr>