<input type="hidden" name="id_entregador" value="{{$entregador[0]->id_entregador}}">
<div class="col-md-6">
    <label class="label">Nome Entregador</label>
    <input id="nome_entregador" class="form-control" name="nome_entregador" value="{{$entregador[0]->nome_entregador}}" required autofocus>
    <label class="label">Placa Veículo</label>
    <input id="placa_entregador" class="form-control" name="placa_entregador" value="{{$entregador[0]->placa_entregador}}" autofocus> 
</div>
<div class="col-md-6">
    <label class="label">Cpf</label>
    <input id="cpf_entregador" class="form-control" name="cpf_entregador" value="{{$entregador[0]->cpf_entregador}}" required autofocus>
    <label class="label">Status</label>
    <input type='checkbox' class='form-check' name='status_entregador' value='1' @php if($entregador[0]->status_entregador == 1){ echo " checked=\"checked\""; }@endphp>
</div>