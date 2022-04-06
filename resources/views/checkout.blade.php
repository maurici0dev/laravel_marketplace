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
<script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script src="{{ asset('assets/js/jqAjax.js') }}"></script>
<script>
    const sessionId = "{{ session()->get('pagseguro_session_code') }}";

    const transactionAmount = {{$total}};
    const cardNumber = document.getElementById("card_number");
    const cardBrand = document.getElementById("card_brand");
    const cardBrandImg = document.getElementById("card_brand_img");
    const expirationMonth = document.getElementById("card_month");
    const expirationYear = document.getElementById("card_year");
    const cardCvv = document.getElementById("card_cvv");
    const submitBtn = document.getElementById("submit_button");

    PagSeguroDirectPayment.setSessionId(sessionId);

    submitBtn.addEventListener("click", function(event) {
        event.preventDefault();

        PagSeguroDirectPayment.createCardToken({
            cardNumber: cardNumber.value
            , brand: cardBrand.value
            , cvv: cardCvv.value
            , expirationMonth: expirationMonth.value
            , expirationYear: expirationYear.value
            , success: function(res) {
                proccessPayment(res.card.token);
            }
        });
    });

    cardNumber.addEventListener("keyup", function() {
        cardNumber.value.length >= 6 &&
            PagSeguroDirectPayment.getBrand({
                cardBin: cardNumber.value.substr(0, 6)
                , success: function(res) {
                    brand = res.brand.name;
                    card_brand.value = brand;

                    let imgUrl =
                        "https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/" +
                        brand +
                        ".png";

                    cardBrandImg.innerHTML = "<img src='" + imgUrl + "' />";

                    getInstallments(transactionAmount, brand);
                }
                , error: function(err) {
                    console.log(err);
                }
                , complete: function(res) {
                    console.log("Complete: ", res);
                }
            });
    });

    function proccessPayment(token) {
        let data = {
            card_token: token
            , hash: PagSeguroDirectPayment.getSenderHash()
            , installment: document.getElementById("select_installment").value
            , card_name: document.getElementById("card_name").value
            , _token: "{{ csrf_token() }}"
        };

        $.ajax({
            type: "POST"
            , url: '{{ route("checkout.proccess") }}'
            , data: data
            , dataType: "json"
            , success: function(res) {
                window.location.href = '{{ route("checkout.thanks") }}?order=' + res.data.order;
            }
        });
    }

    function getInstallments(amount, brand) {
        PagSeguroDirectPayment.getInstallments({
            amount: amount
            , brand: brand
            , maxInstallmentNoInterest: 0
            , success: function(res) {
                let selectInstallments = drawSelectInstallments(res.installments[brand]);
                document.querySelector("div.installments").innerHTML = selectInstallments;
            }
            , error: function(err) {
                console.log(err);
            }
            , complete: function(res) {
                console.log(res);
            }
        });
    }

    function drawSelectInstallments(installments) {
        let select = "<label>Opções de Parcelamento:</label>";
        select += '<select class="form-control" id="select_installment">';

        for (let l of installments) {
            select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;
        }

        select += "</select>";
        return select;
    }

</script>
@endsection
