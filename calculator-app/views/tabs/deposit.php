<!-- views/tabs/deposit.php -->
<div class="row g-4">
    <!-- Project Summary -->
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">
                    <i class="fas fa-clipboard-list text-primary me-2"></i>Project Summary
                </h5>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Customer Name:</strong></td>
                                <td id="depositCustomerName">-</td>
                            </tr>
                            <tr>
                                <td><strong>Project Type:</strong></td>
                                <td id="depositProjectType">-</td>
                            </tr>
                            <tr>
                                <td><strong>Material:</strong></td>
                                <td id="depositMaterial">-</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Total Sqft:</strong></td>
                                <td id="depositTotalSqft">0.00</td>
                            </tr>
                            <tr>
                                <td><strong>Material Cost:</strong></td>
                                <td id="depositMaterialCost">$0.00</td>
                            </tr>
                            <tr>
                                <td><strong>Additional Services:</strong></td>
                                <td id="depositServicesCost">$0.00</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Deposit Details -->
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">
                    <i class="fas fa-hand-holding-usd text-primary me-2"></i>Deposit Details
                </h5>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Standard deposit is 50% of the total project cost.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Project Total</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="depositProjectTotal" 
                                       readonly value="0.00">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Deposit Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="depositAmount" 
                                       onchange="updateDeposit('amount', this.value)" step="0.01" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Payment Method</label>
                            <select class="form-select" id="depositPaymentMethod" 
                                    onchange="updateDeposit('paymentMethod', this.value)">
                                <option value="cash">Cash</option>
                                <option value="check">Check</option>
                                <option value="credit">Credit Card</option>
                                <option value="debit">Debit Card</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Payment Date</label>
                            <input type="date" class="form-control" id="depositDate" 
                                   value="<?php echo date('Y-m-d'); ?>"
                                   onchange="updateDeposit('date', this.value)">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" id="depositNotes" rows="3" 
                                      placeholder="Enter any additional notes about the deposit"
                                      onchange="updateDeposit('notes', this.value)"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Deposit Summary -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-primary bg-opacity-10">
            <div class="card-body">
                <h5 class="card-title mb-4 text-primary">
                    <i class="fas fa-calculator me-2"></i>Deposit Summary
                </h5>
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Project Total:</strong></td>
                        <td class="text-end" id="summaryProjectTotal">$0.00</td>
                    </tr>
                    <tr>
                        <td><strong>Deposit Amount:</strong></td>
                        <td class="text-end" id="summaryDepositAmount">$0.00</td>
                    </tr>
                    <tr>
                        <td><strong>Deposit Percentage:</strong></td>
                        <td class="text-end" id="summaryDepositPercentage">0%</td>
                    </tr>
                    <tr>
                        <td><strong>Remaining Balance:</strong></td>
                        <td class="text-end" id="summaryRemainingBalance">$0.00</td>
                    </tr>
                </table>

                <button type="button" class="btn btn-primary w-100" onclick="generateDepositReceipt()">
                    <i class="fas fa-file-invoice me-2"></i>Generate Deposit Receipt
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function updateDeposit(field, value) {
    calculator.data.deposit[field] = value;
    updateDepositSummary();
}

function updateDepositSummary() {
    const projectTotal = parseFloat($('#depositProjectTotal').val()) || 0;
    const depositAmount = parseFloat($('#depositAmount').val()) || 0;
    const depositPercentage = (depositAmount / projectTotal * 100) || 0;
    const remainingBalance = projectTotal - depositAmount;

    $('#summaryProjectTotal').text(Utils.formatCurrency(projectTotal));
    $('#summaryDepositAmount').text(Utils.formatCurrency(depositAmount));
    $('#summaryDepositPercentage').text(depositPercentage.toFixed(1) + '%');
    $('#summaryRemainingBalance').text(Utils.formatCurrency(remainingBalance));

    // Update calculator data
    calculator.data.deposit = {
        ...calculator.data.deposit,
        projectTotal,
        depositAmount,
        depositPercentage,
        remainingBalance
    };
}

function generateDepositReceipt() {
    if (!calculator.data.deposit.depositAmount || calculator.data.deposit.depositAmount <= 0) {
        calculator.showError('Please enter a valid deposit amount');
        return;
    }
    
    // Implementation for deposit receipt generation
}

// Initialize deposit data when tab is shown
$('a[data-bs-toggle="tab"][href="#deposit"]').on('shown.bs.tab', function (e) {
    const projectTotal = calculator.data.summary.total || 0;
    const suggestedDeposit = projectTotal * 0.5; // 50% deposit

    $('#depositProjectTotal').val(projectTotal.toFixed(2));
    $('#depositAmount').val(suggestedDeposit.toFixed(2));

    // Update customer info
    $('#depositCustomerName').text(calculator.data.customerInfo.name || '-');
    $('#depositProjectType').text(calculator.data.projectDetails.projectType || '-');
    $('#depositMaterial').text(calculator.data.projectDetails.materialType || '-');
    $('#depositTotalSqft').text(calculator.data.summary.totalSqft?.toFixed(2) || '0.00');
    $('#depositMaterialCost').text(Utils.formatCurrency(calculator.data.summary.materialCost || 0));
    $('#depositServicesCost').text(Utils.formatCurrency(calculator.data.summary.servicesCost || 0));

    updateDepositSummary();
});
</script>