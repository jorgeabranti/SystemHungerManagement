<tr class='even'>
<td class='col-xs-1'></td>
<td class='col-xs-2'>
<select class='form-control select' name='id_tipo_produto' required>
@foreach($tipos_produtos_empresa as $key => $tipo_produto)
<option value='{{$tipo_produto->id_tipo_produto}}'>{{$tipo_produto->nome_tipo_produto}}</option>
@endforeach
</select>
</td>
<td class='col-xs-2'><input type='text' class='form-control' name='nome_sabor_produto' value='' required autofocus></td>
<td class='col-xs-3'><input type='text' class='form-control' name='descricao_sabor_produto' value='' required autofocus></td>
<td class='col-xs-2'><input type='checkbox' checked='checked' class='form-control' name='status_sabor_produto' value='1'></td>
<td class='col-xs-2'>
<button type='submit' class='btn btn-success btn-xs'><i class='fa fa-check'></i></button>
<button class='btn btn-danger btn-xs' onclick='window.location.reload()'><i class='fa fa-asterisk'></i></button>
</td>
</tr>