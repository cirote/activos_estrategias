@extends('opciones::layouts.master')

@section('main_content')
<div class="row">
	<div class="col-md-10">
		<div class="box">

			<div class="box-header with-border">
				<h3 class="box-title">Bases</h3>
			</div>

			<div class="box-body">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th rowspan="2" style="width: 10px">#</th>
							<th rowspan="2" style="width: 30px">Base</th>
							<th colspan="5">Subyacente</th>
							<th colspan="4">Calls</th>
							<th colspan="4">Puts</th>
							<th colspan="4">Sintéticas</th>
						</tr>
						<tr>
							<th>Ticker</th>
							<th>Compra</th>
							<th>Venta</th>
							<th>Último</th>
							<th>Spread</th>

							<th>Compra</th>
							<th>Venta</th>
							<th>Último</th>
							<th>Spread</th>

							<th>Compra</th>
							<th>Venta</th>
							<th>Último</th>
							<th>Spread</th>

							<th>Compra</th>
							<th>Venta</th>
							<th>Último</th>
							<th>Spread</th>
						</tr>
						@foreach($bases as $base)
						<tr>
							<td>{{ $bases->firstItem() + $loop->index }}.</td>
							<td>{{ $base->base }}</td>

							@php($bs = $base->subyacente)
							<td>{{ $bs->simbolo }}</td>
							@include('estrategias::estrategias.bases.compra-venta')

							@php($bs = $base->call)
							@include('estrategias::estrategias.bases.compra-venta')

							@php($bs = $base->put)
							@include('estrategias::estrategias.bases.compra-venta')

							@php($bs = $base->sintetica)
							@include('estrategias::estrategias.bases.compra-venta')

						</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			<div class="box-footer clearfix">
				{{ $bases->links('layouts::pagination.default') }}
			</div>

		</div>
	</div>
</div>
@endsection
