<form id="step1">
    <fieldset id="product-info" class="form-group">
        <h5 class="card-title">Customer Information</h5>
        <p class="card-text"></p>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="customerId">Magento Customer ID</label>
                <input type="text" class="form-control" id="customerId" name="customerId" value="2041" required>
            </div>
        </div>
    </fieldset>
    <hr>
    <fieldset id="shipping-info" class="form-group">
        <h5 class="card-title">Shipping Address</h5>
        <p class="card-text"><small class="form-text text-muted">* Required to obtain shipping rates. Optional for creating a negotiable quote</small></p>
        <div class="form-group">
            <label for="shippingstreet1">Street 1</label>
            <input type="text" class="form-control" id="shippingaddress1" name="shippingaddress1" value="2130 West Sam Houston Pkwy N">
        </div>
        <div class="form-group">
            <label for="shippingstreet2">Street 2</label>
            <input type="text" class="form-control" id="shippingstreet2" name="shippingstreet2" placeholder="">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="shippingcity">City</label>
                <input type="text" class="form-control" id="shippingcity" name="shippingcity">
            </div>
            <div class="form-group col-md-4">
                <label for="shippingstate">State</label>
                <select id="shippingstate" name="shippingstate" class="form-control">
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District Of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX" selected>Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="shippingzip">Zip</label>
                <input type="text" class="form-control" id="shippingzip" name="shippingzip">
            </div>
        </div>
    </fieldset>
    <hr>
    <button type="submit" class="btn btn-primary" id="createcustomerquote">Create Customer Order</button>
</form>