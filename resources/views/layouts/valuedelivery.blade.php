@inject('company', 'HungerManagement\Http\Controllers\CompanyController')
@php 
if ($empresa['utilizar_taxa_fixa'] == 0){
    $origins = $empresa['endereco_empresa'].','.$empresa['endereco_numero_empresa'].','.$empresa['bairro_empresa'].','.$empresa['cidade_empresa'].','.$empresa['uf_empresa'];
    $destinations = $cliente[0]->endereco_cliente.','.$cliente[0]->endereco_numero_cliente.','.$cliente[0]->bairro_cliente.','.$cliente[0]->cidade_cliente.','.$cliente[0]->uf_cliente; 
    $calc = $company->calculateValueDelivery($origins, $destinations, $empresa['taxa_km_entrega'], $cliente[0]->id_cliente, $cliente[0]->distancia_endereco_km);
} else if ($empresa['utilizar_taxa_fixa'] == 1){
    $calc = $empresa['taxa_fixa_entrega'];
}
@endphp
<label class="label">Frete R$:</label>
<input id="valorfrete" name="taxa_entrega_pedido" type="text" value="@php echo number_format($calc, 2, ',', '.')  @endphp" readonly>