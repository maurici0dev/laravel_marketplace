@extends('layouts/front')

@section('content')
<div class="container">


    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-creditcard-tab" data-bs-toggle="tab" data-bs-target="#nav-creditcard" type="button" role="tab" aria-controls="nav-creditcard" aria-selected="true">Cartão de credito</button>
            <button class="nav-link" id="nav-boleto-tab" data-bs-toggle="tab" data-bs-target="#nav-boleto" type="button" role="tab" aria-controls="nav-boleto" aria-selected="false">Boleto</button>
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-creditcard" role="tabpanel" aria-labelledby="nav-creditcard-tab">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Dados para Pagamento</h2>
                        <hr>
                    </div>
                </div>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Nome no Cartão</label>
                            <input id="card_name" type="text" class="form-control" name="card_name">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Número do Cartão <span id="card_brand_img"></span></label>
                            <input id="card_number" type="text" class="form-control" name="card_number">
                            <input id="card_brand" type="hidden" name="card_brand">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Mês de Expiração</label>
                            <input id="card_month" type="text" class="form-control" name="card_month">
                        </div>

                        <div class="col-md-4 form-group">
                            <label>Ano de Expiração</label>
                            <input id="card_year" type="text" class="form-control" name="card_year">
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-5 form-group">
                            <label>Código de Segurança</label>
                            <input id="card_cvv" type="text" class="form-control" name="card_cvv">
                        </div>

                        <div class="col-md-12 installments form-group"></div>
                    </div>

                    <button id="btnCard" class="btn btn-success">Efetuar Pagamento</button>
                </form>
            </div>
        </div>

        <div class="tab-pane fade" id="nav-boleto" role="tabpanel" aria-labelledby="nav-boleto-tab">
            <div class="row">
                <div class="col-12">
                    <h2>Pagar com Boleto</h2>
                    <button id="btnBoleto" class="btn btn-success">Emitir Boleto</button>
                </div>
            </div>
        </div>
    </div>

</div>


</div>
@endsection

@section('scripts')

<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

<script type="text/javascript" src="{{ asset('assets/js/jqAjax.js') }}"></script>

<script>
    const sessionId = "{{ session()->get('pagseguro_session_code') }}";
    const csrfToken = "{{ csrf_token() }}";
    const transactionAmount = "{{ $total }}";
    const urlProccess = "{{ route('checkout.proccess') }}";
    const urlThanks = "{{ route('checkout.thanks') }}";
    const cardNumber = document.getElementById("card_number");
    const cardBrand = document.getElementById("card_brand");
    const cardBrandImg = document.getElementById("card_brand_img");
    const expirationMonth = document.getElementById("card_month");
    const expirationYear = document.getElementById("card_year");
    const cardCvv = document.getElementById("card_cvv");
    const subCreditCard = document.getElementById("btnCard");
    const subBoleto = document.getElementById("btnBoleto");
</script>

<script type="text/javascript" src="{{ asset('assets/js/pagseguro_events.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/pagseguro_functions.js') }}"></script>

@endsection
