@if($bs)
	@if($numero = $bs->precioCompra)
		<td align="right">{{ number_format($numero, 2, '.', ',') }}</td>	
	@else
		<td></td>
	@endif
	@if($numero = $bs->precioVenta)
		<td align="right">{{ number_format($numero, 2, '.', ',') }}</td>	
	@else
		<td></td>
	@endif
	@if($numero = $bs->precioUltimo)
		<td align="right">{{ number_format($numero, 2, '.', ',') }}</td>	
	@else
		<td></td>
	@endif
	@if($numero = $bs->precioSpread)
		<td align="right">{{ number_format($numero, 2, '.', ',') }}</td>	
	@else
		<td></td>
	@endif
@else
	<td></td>
	<td></td>
	<td></td>
	<td></td>
@endif
