subCreditCard.addEventListener("click", function (event) {
  event.preventDefault();

  PagSeguroDirectPayment.createCardToken({
    cardNumber: cardNumber.value,
    brand: cardBrand.value,
    cvv: cardCvv.value,
    expirationMonth: expirationMonth.value,
    expirationYear: expirationYear.value,
    success: function (res) {
      proccessPayment("CREDITCARD", res.card.token);
    },
  });
});

subBoleto.addEventListener("click", function (event) {
  event.preventDefault();

  proccessPayment("BOLETO");
});

cardNumber.addEventListener("keyup", function () {
  cardNumber.value.length >= 6 &&
    PagSeguroDirectPayment.getBrand({
      cardBin: cardNumber.value.substr(0, 6),
      success: function (res) {
        brand = res.brand.name;
        card_brand.value = brand;

        let imgUrl =
          "https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/" +
          brand +
          ".png";

        cardBrandImg.innerHTML = "<img src='" + imgUrl + "' />";

        getInstallments(transactionAmount, brand);
      },
      error: function (err) {
        console.log(err);
      },
      complete: function (res) {
        console.log("Complete: ", res);
      },
    });
});
