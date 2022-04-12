PagSeguroDirectPayment.setSessionId(sessionId);

function proccessPayment(paymentType, token = null) {
  let data = {
    hash: PagSeguroDirectPayment.getSenderHash(),
    paymentType: paymentType,
    _token: csrfToken,
  };

  if (paymentType === "CREDITCARD") {
    data.card_token = token;
    data.card_name = document.getElementById("card_name").value;
    data.installment = document.getElementById("select_installment").value;
  }

  $.ajax({
    type: "POST",
    url: urlProccess,
    data: data,
    dataType: "json",
    success: function (res) {
      let redirectUrl = urlThanks + "?order=" + res.data.order;
      let linkBoleto = redirectUrl + "&b=" + res.data.link_boleto;
      window.location.href =
        paymentType === "BOLETO" ? linkBoleto : redirectUrl;
    },
  });
}

function getInstallments(amount, brand) {
  PagSeguroDirectPayment.getInstallments({
    amount: amount,
    brand: brand,
    maxInstallmentNoInterest: 0,
    success: function (res) {
      let selectInstallments = drawSelectInstallments(res.installments[brand]);
      document.querySelector("div.installments").innerHTML = selectInstallments;
    },
    error: function (err) {
      console.log(err);
    },
    complete: function (res) {
      console.log(res);
    },
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
