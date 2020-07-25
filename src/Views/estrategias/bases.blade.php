@extends('opciones::layouts.master')

@section('main_content')
<div class="row">
	<div class="col-md-10">
		<div class="box">

			<div class="box-header with-border">
				<h3 class="box-title">Bases</h3>
			</div>

			<div class="box-body">

				@foreach(\Cirote\Estrategias\Models\Subyacente::all() as $subyacente)
				<div class="btn-group">
					<a href="{{ route('estrategias.bases', ['subyacente' => $subyacente->simbolo, 'vencimiento' => $subyacente->vencimientos()[0]]) }}" type="button" class="btn btn-default">{{ $subyacente->simbolo }}</a>
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<ul class="dropdown-menu" role="menu">
						@foreach($subyacente->vencimientos() as $vencimiento)
						<li><a href="{{ route('estrategias.bases', ['subyacente' => $subyacente->simbolo, 'vencimiento' => $vencimiento]) }}">{{ $vencimiento }}</a></li>
						@endforeach
					</ul>
				</div>
				@endforeach

                <hr>

				<table class="table table-bordered">
					<tbody>
						<tr>
							<th style="width: 30px">Mes</th>
							<th style="width: 30px">Ano</th>
							<th style="width: 30px">Subyacente</th>
							<th style="width: 30px">Compra</th>
							<th style="width: 30px">Venta</th>
							<th style="width: 30px">Último</th>
							<th style="width: 30px">Spread</th>
						</tr>
						@php($base = $bases->first())
						<tr>
							<td>{{ $base->mes }}</td>
							<td>{{ $base->ano }}</td>

							@php($bs = $base->subyacente)
							<td>{{ $bs->simbolo }}</td>
							@include('estrategias::estrategias.bases.compra-venta')
						</tr>
					</tbody>
				</table>

                <hr>

				<table class="table table-bordered">
					<tbody>
						<tr>
							<th colspan="4">Calls</th>
							<th rowspan="2" style="width: 30px">Strike</th>
							<th colspan="4">Puts</th>
							<th colspan="4">Sintéticas</th>
						</tr>
						<tr>
							@include('estrategias::estrategias.bases.opciones.titulo')

							@include('estrategias::estrategias.bases.opciones.titulo')

							@include('estrategias::estrategias.bases.sinteticas.titulo')
						</tr>
						@foreach($bases as $base)
						<tr>
							@php($bs = $base->call)
							@include('estrategias::estrategias.bases.opciones.renglon')

							<td align="right" bgcolor="#DCDCDC">{{ number_format($base->strike, 2, ',', '.') }}</td>

							@php($bs = $base->put)
							@include('estrategias::estrategias.bases.opciones.renglon')

							@php($bs = $base->sintetica)
							@include('estrategias::estrategias.bases.sinteticas.renglon')

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
