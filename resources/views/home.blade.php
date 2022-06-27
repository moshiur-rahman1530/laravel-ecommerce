@extends('layouts.app')

@section('content')
<div class="container my-5">
    @include('userComponent.feature')
    @include('userComponent.categoryProduct')
    @include('userComponent.discount')
    @include('userComponent.products')
    @include('userComponent.subscribe')
    @include('userComponent.archiveProduct')
    @include('userComponent.vendor')
</div>
@endsection
