@extends('layouts/front')

@section('content')
<form action="" method="post">
    @csrf

    <div class="row">
        <div class="col-md-12 form-group">
            <label class="form-label" for="card_number">Numero do cartão <span id="card_brand_img"></span></label>
            <input class="form-control" type="text" name="card_number" id="card_number">

            <input type="hidden" name="card_brand" id="card_brand">
        </div>
        <div class="col-md-12 form-group">
            <label class="form-label" for="card_name">Nome no cartão</label>
            <input class="form-control" type="text" name="card_name" id="card_name">
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 form-group">
            <label class="form-label" for="card_month">Mês de expiração</label>
            <input class="form-control" type="text" name="card_month" id="card_month">
        </div>

        <div class="col-md-3 form-group">
            <label class="form-label" for="card_year">Ano de expiração</label>
            <input class="form-control" type="text" name="card_year" id="card_year">
        </div>

        <div class="col-md-6 form-group">
            <label class="form-label" for="card_cvv">Cod. de segurança</label>
            <input class="form-control" type="text" name="card_cvv" id="card_cvv">
        </div>

        <div class="col-md-12 installments form-group">

        </div>
    </div>

    <button id="submit_button" class="btn btn-success">Efetura pagamento</button>
</form>
@endsection

@section('scripts')

<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

<script type="text/javascript" src="{{ asset('assets/js/jqAjax.js') }}"></script>

<script>
    const sessionId = "{{ session()->get('pagseguro_session_code') }}";
    const csrfToken = "{{ csrf_token() }}"
    const transactionAmount = "{{ $total }}";
    const urlProccess = "{{ route('checkout.proccess') }}";
    const urlThanks = "{{ route('checkout.thanks') }}"
    const cardNumber = document.getElementById("card_number");
    const cardBrand = document.getElementById("card_brand");
    const cardBrandImg = document.getElementById("card_brand_img");
    const expirationMonth = document.getElementById("card_month");
    const expirationYear = document.getElementById("card_year");
    const cardCvv = document.getElementById("card_cvv");
    const submitBtn = document.getElementById("submit_button");
</script>

<script type="text/javascript" src="{{ asset('assets/js/pagseguro_events.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pagseguro_functions.js') }}"></script>

@endsection
