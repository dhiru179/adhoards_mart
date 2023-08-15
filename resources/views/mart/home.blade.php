@extends('mart.layouts.app')

@section('content')
    <div class="container">
        <div class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control">
                <button type="button" class="btn btn-success">{{ __('Search') }}</button>
            </div>
        </div>
        <div class="mb-3">
            <ul class="nav nav-tabs" id="product_category">

            </ul>
            <div class="border border-top-0 rounded-start-0 p-3">
                <div class="d-flex">
                    <ul class="" style="list-style: none">
                        <li>
                            <h5>sub cate</h5>
                        </li>
                        <li>45</li>
                        <li>545</li>
                        <li>456cccccccccccccccccc4</li>
                        <li>645745</li>
                    </ul>
                    <ul class="" style="list-style: none">
                        <li>
                            <h5>sub cate</h5>
                        </li>
                        <li>45</li>
                        <li>545</li>
                        <li>4564</li>
                        <li>645745</li>
                    </ul>
                    <ul class="" style="list-style: none">
                        <li>
                            <h5>sub cate</h5>
                        </li>
                        <li>45</li>
                        <li>545</li>
                        <li>4564</li>
                        <li>645745</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('message.welcome') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ json_encode($product_category) }}
    <script>
        $(document).ready(function() {
            console.log("gg")
            let pd_html = '';
            let product_category = JSON.parse('{{ json_encode($product_category) }}'.replace(/&quot;/g, '"'));
            let bool = true;
            product_category.forEach(elem => {
                if (elem.parent_id == null) {
                    pd_html += `<li class="nav-item">
                                <a class="nav-link"  href="#">${elem.name}</a>
                            </li>`;
                      
                }

            });
            $('#product_category').html(pd_html);
            console.log(product_category)
        });
    </script>
@endsection
