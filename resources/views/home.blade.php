@extends('layouts.app')

@section('content')
<!--<keep-alive>-->
	<component 
	v-bind:is="currentPage"
	:key="refreshComponent"
	></component>
<!--</keep-alive>-->
@endsection