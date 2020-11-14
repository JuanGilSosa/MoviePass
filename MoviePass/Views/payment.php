<?php
require_once('nav.php');
?>
<main class="mx-auto py-5" style="height: 75%">
    <div class="container creditCardForm" style="height: 100%">
        <div class="row heading container">
            <h1>Confirmar Compra</h1>
        </div>
        <form class="" action="<?php echo FRONT_ROOT . 'Cart/ConfirmPayment' ?>">
            <div class="row payment container">
                <div class="form-group col-lg-2">
                </div>
                <div class="form-group col-lg-8">
                    <label for="">Propietario</label>
                    <input type="text" class="form-control" id="owner" required>
                </div>
                <div class="form-group col-lg-2">
                </div>

                <div class="form-group col-lg-2">
                </div>
                <div class="form-group col-lg-6">
                    <label for="cardNumber">Numero de Tarjeta</label>
                    <input type="text" class="form-control" id="cardNumber" required>
                </div>
                <div class="form-group col-lg-2">
                <label for="cvv">CVV</label>
                    <input type="text" class="form-control" id="cvv" required>
                </div>
                <div class="form-group col-lg-2">
                </div>



                <div class="form-group col-lg-2">
                </div>
                <div class="form-group col-lg-4">
                    <label>Fecha de Vencimiento</label>
                    <br>
                    <select required>
                        <option selected="true" disabled="disabled" value="">MES</option>
                        <option value="01">January</option>
                        <option value="02">February </option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <select required>
                        <option selected="true" disabled="disabled" value="">AÑO</option>
                        <option value="16"> 2021</option>
                        <option value="17"> 2022</option>
                        <option value="18"> 2023</option>
                        <option value="19"> 2024</option>
                        <option value="20"> 2025</option>
                        <option value="21"> 2026</option>
                    </select>
                </div>
                
                <div class="form-group col-lg-1" style="background-color:white;">
                    <img src="<?php echo IMG_PATH . 'visa.svg' ?>" id="visa" style="max-width:3vw;">
                </div>
                <div class="form-group col-lg-1" style="background-color:white;">
                    <img src="<?php echo IMG_PATH . 'mastercard.png' ?>" id="mastercard" style="max-width:3vw;">
                </div>
                <div class="form-group col-lg-1" style="background-color:white;">
                    <img src="<?php echo IMG_PATH . 'maestro.png' ?>" id="amex" style="max-width:3vw;">
                </div>
                <div class="form-group col-lg-2" style="background-color:white;">
                </div>
                
            </div>

            <div class="form-group text-center" id="pay-now">
                <button name="confirmar" type="submit" class="btn btn-default" id="confirm-purchase">Confirmar</button>
            </div>
        </form>
    </div>

<main>