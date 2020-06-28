@if($bs)
	@if($numero = $bs->strike)
		<td align="right">{{ number_format($numero, 2, '.', ',') }}</td>	
	@else
		<td></td>
	@endif
@else
	<td></td>
@endif
@include('estrategias::estrategias.bases.compra-venta')
