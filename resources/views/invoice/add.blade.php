@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">
                Nuevo comprobante
            </h2>

            <invoice></invoice>
        </div>
    </div>
</div>
@endsection

@section('bottom')
    <script src="{{asset('components/invoice.tag')}}" type="riot/tag"></script>
    <script>
        $(document).ready(function(){
            riot.mount('invoice');
        })
    </script>
@endsection
