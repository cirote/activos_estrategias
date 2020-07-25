@if($bs)
	@php($color = $bs->valorIntrinseco ? 'bgcolor="#98FB98"' : '')
	@if($numero = $bs->precioCompra)
		<td {{ $color }} align="right">
		{{ number_format($numero, 2, '.', ',') }}
		<br>
		{{ number_format($bs->valorExplicitoCompra, 2, '.', ',') }}
		</td>	
	@else
		<td {{ $color }}></td>
	@endif
	@if($numero = $bs->precioVenta)
		<td {{ $color }} align="right">
		{{ number_format($numero, 2, '.', ',') }}
		<br>
		{{ number_format($bs->valorExplicitoVenta, 2, '.', ',') }}
	</td>	
	@else
		<td {{ $color }}></td>
	@endif
	@if($numero = $bs->precioUltimo)
		<td {{ $color }} align="right">{{ number_format($numero, 2, '.', ',') }}</td>	
	@else
		<td {{ $color }}></td>
	@endif
	@if($numero = $bs->precioSpread)
		<td {{ $color }} align="right">{{ number_format($numero, 2, '.', ',') }}</td>	
	@else
		<td {{ $color }}></td>
	@endif
@else
	<td></td>
	<td></td>
	<td></td>
	<td></td>
@endif
