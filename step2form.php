<form id="step2">
    <h5 class="card-title">Negotiable Quote Information</h5>
    <p class="card-text">
        <div class="step_info">
            <div><strong>Customer ID:</strong> <span class="customerId"></span></div>
            <div><strong>Customer Shipping Address:</strong> <span class="customerShipping">No Address Set</span></div>
        </div>
    </p>
    <hr>
    <fieldset id="product-info" class="form-group">
        <h5 class="card-title">Add products to cart</h5>
        <div class="form-row" id="products">
        </div>
    </fieldset>
    <hr>
    <fieldset id="quote-info" class="form-group">
        <h5 class="card-title">Set Quote Information</h5>
        <p class="card-text"></p>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="quoteName">Quote Name</label>
                <input type="text" class="form-control" id="quoteName" name="quoteName" value="Foobar" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col">
                <label for="quoteNegotiatedPrice">Proposed quote price</label>
                <input type="text" class="form-control" id="quoteNegotiatedPrice" name="quoteNegotiatedPrice" value="10.00" required>
                <small class="form-text text-muted">
                    There are three types:<br>
                    1 - Apply a percentage discount to the quote.<br>
                    2 - Apply a fixed amount as a discount for the quote.<br>
                    3 - Set a proposed price for the entire quote.<br>
                    The one on this form is <pre>"negotiated_price_type": 3</pre>
                </small>
            </div>
        </div>
    </fieldset>
    <fieldset id="misc" class="form-group">
        <h5 class="card-title">Additional Information (Optional)</h5>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="quoteComment">Quote Comments</label>
                <textarea class="form-control" id="quoteComment" name="quoteComment" rows="3"></textarea>
            </div>
        </div>
    </fieldset>
    <hr>
    <button type="submit" class="btn btn-primary" id="addproductstocart">Add Products to Order</button>
</form>