@include('web.common.functions')
@extends('web.layout')

@section('content')
	@php
		$page_title = "Sitemap";
		$x=0;
		$x++; $breadcrumbs[$x]['titolo']=$page_title; $breadcrumbs[$x]['link']=''; 
	@endphp
	@include('web.common.page_title')
	
	
	
@endsection