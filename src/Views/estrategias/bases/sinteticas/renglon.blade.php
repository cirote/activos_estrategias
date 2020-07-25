@if($bs)
	@if($numero = $bs->precioCompra)
		<td bgcolor="#DCDCDC" align="right">
		{{ number_format($numero, 2, '.', ',') }}
		<br>
		{{ number_format($bs->precioRealCompra, 2, '.', ',') }}
	</td>	
	@else
		<td bgcolor="#DCDCDC"></td>
	@endif
	@if($numero = $bs->precioVenta)
		<td bgcolor="#DCDCDC" align="right">
		{{ number_format($numero, 2, '.', ',') }}
		<br>
		{{ number_format($bs->precioRealVenta, 2, '.', ',') }}
	</td>	
	@else
		<td bgcolor="#DCDCDC"></td>
	@endif
	@if($numero = $bs->precioSpread)
		<td bgcolor="#DCDCDC" align="right">{{ number_format($numero, 2, '.', ',') }}</td>	
	@else
		<td bgcolor="#DCDCDC"></td>
	@endif
@else
	<td></td>
	<td></td>
	<td></td>
@endif
