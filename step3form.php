<form id="step3">
    <h5 class="card-title">Set Shipping Method</h5>
    <p class="card-text"></p>
    <div class="step_info">
        <div><strong>Customer ID:</strong> <span class="customerId"></span></div>
        <div><strong>Customer Shipping Address:</strong> <span class="customerShipping">No address set</span></div>
    </div>
    <hr>
    <fieldset id="negotiable-shipping-rates" class="form-group mx-3">
        <h5 class="card-title">Shipping Methods</h5>
        <div id="negotiable-carriers">
            <small class="form-text text-muted">* No shipping address provided in the previous step.</small>
        </div>
    </fieldset>
    <hr>
    <button type="button" class="btn btn-primary" id="skipshippingmethod">Skip Step</button>
    <button type="submit" class="btn btn-primary" id="setshippingmethod" disabled>Set Shipping Method</button>
</form>