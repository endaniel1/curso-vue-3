@extends('layouts.app')

@section('content')
<keep-alive>
	<component
	v-bind:is="currentPage"
	></component>
</keep-alive>
@endsection