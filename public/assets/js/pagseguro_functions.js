PagSeguroDirectPayment.setSessionId(sessionId);

function proccessPayment(token) {
  let data = {
    card_token: token,
    hash: PagSeguroDirectPayment.getSenderHash(),
    installment: document.getElementById("select_installment").value,
    card_name: document.getElementById("card_name").value,
    _token: csrfToken,
  };

  $.ajax({
    type: "POST",
    url: urlProccess,
    data: data,
    dataType: "json",
    success: function (res) {
      window.location.href = urlThanks + "?order=" + res.data.order;
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
