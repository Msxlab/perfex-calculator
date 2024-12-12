<!-- views/tabs/customer_info.php -->
<div class="row g-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">
                    <i class="fas fa-user-circle text-primary me-2"></i>Customer Information
                </h5>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="customerName"
                                   placeholder="Enter customer name"
                                   onchange="calculator.data.customerInfo.name = this.value">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="customerEmail"
                                   placeholder="Enter email address"
                                   onchange="calculator.data.customerInfo.name = this.value">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="customerPhone"
                                   placeholder="Enter phone number"
                                   onchange="calculator.data.customerInfo.phone = this.value">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Company (Optional)</label>
                            <input type="text" class="form-control" id="customerCompany"
                                   placeholder="Enter company name"
                                   onchange="calculator.data.customerInfo.company = this.value">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" id="customerAddress" rows="3"
                                      placeholder="Enter complete address"
                                      onchange="calculator.data.customerInfo.address = this.value"></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" id="customerCity"
                                   placeholder="Enter city"
                                   onchange="calculator.data.customerInfo.city = this.value">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">State</label>
                            <input type="text" class="form-control" id="customerState"
                                   placeholder="Enter state"
                                   onchange="calculator.data.customerInfo.state = this.value">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">ZIP Code</label>
                            <input type="text" class="form-control" id="customerZip"
                                   placeholder="Enter ZIP code"
                                   onchange="calculator.data.customerInfo.zip = this.value">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>