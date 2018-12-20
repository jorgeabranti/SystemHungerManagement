@foreach($sabores as $key => $sabor_produto)
<option value="{{$sabor_produto}}">{{$sabor_produto->nome_sabor_produto}}</option>
@endforeach
