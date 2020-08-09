@if($bs)
	@php($color = $bs->valorIntrinseco ? 'bgcolor="#fcf5e2"' : 'bgcolor="#e2e9fc"')

	@if($numero = $bs->precioCompra)
		<td {!! $color !!} align="right">
		<b>{{ number_format($numero, 2, '.', ',') }}</b>

		@if(($ve = $bs->valorExplicitoCompra) > 0)
		<span style="color: blue;">
		({{ number_format($ve, 2, '.', ',') }})
		@else
		<span style="color: red;">
		({{ number_format(-$ve, 2, '.', ',') }})
		@endif
		</span>

		[{{ number_format($bs->volatilidadImplicita($numero), 0, '.', ',') }}]
		</td>	
	@else
		<td {!! $color !!}></td>
	@endif

	@if($numero = $bs->precioVenta)
		<td {!! $color !!} align="right">
		<b>{{ number_format($numero, 2, '.', ',') }}</b>

		@if(($ve = $bs->valorExplicitoVenta) > 0)
		<span style="color: blue;">
		({{ number_format($ve, 2, '.', ',') }})
		@else
		<span style="color: red;">
		({{ number_format(-$ve, 2, '.', ',') }})
		@endif
		</span>

		[{{ number_format($bs->volatilidadImplicita($numero), 0, '.', ',') }}]
	</td>	
	@else
		<td {!! $color !!}></td>
	@endif

	@if($numero = $bs->precioUltimo)
		<td {!! $color !!} align="right">{{ number_format($numero, 2, '.', ',') }}</td>	
	@else
		<td {!! $color !!}></td>
	@endif

	@if($numero = $bs->precioSpread)
		<td {!! $color !!} align="right">{{ number_format($numero, 2, '.', ',') }}</td>	
	@else
		<td {!! $color !!}></td>
	@endif

@else
	<td></td>
	<td></td>
	<td></td>
	<td></td>
@endif
