<option value="">Selecione o Produto</option>
@foreach($produtos_empresa as $key => $produto)
<option value="{{$produto}}">{{$produto->nome_produto}} - Até {{$produto->quant_sabores_produto}} Sabores R${{$produto->valor_unitario_produto}}</option>
@endforeach
