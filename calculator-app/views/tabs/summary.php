<!-- views/tabs/summary.php -->
<div class="row g-4">
    <!-- Customer & Project Summary -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">
                    <i class="fas fa-user-circle text-primary me-2"></i>Customer Information
                </h5>
                <table class="table table-borderless">
                    <tr>
                        <td width="140"><strong>Name:</strong></td>
                        <td id="summaryCustomerName">-</td>
                    </tr>
                    <tr>
                        <td><strong>Phone:</strong></td>
                        <td id="summaryCustomerPhone">-</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td id="summaryCustomerEmail">-</td>
                    </tr>
                    <tr>
                        <td><strong>Address:</strong></td>
                        <td id="summaryCustomerAddress">-</td>
                    </tr>
                </table>

                <h5 class="card-title mb-4 mt-5">
                    <i class="fas fa-project-diagram text-primary me-2"></i>Project Details
                </h5>
                <table class="table table-borderless">
                    <tr>
                        <td width="140"><strong>Project Type:</strong></td>
                        <td id="summaryProjectType">-</td>
                    </tr>
                    <tr>
                        <td><strong>Material:</strong></td>
                        <td id="summaryMaterial">-</td>
                    </tr>
                    <tr>
                        <td><strong>Material Name:</strong></td>
                        <td id="summaryMaterialName">-</td>
                    </tr>
                    <tr>
                        <td><strong>Edge Type:</strong></td>
                        <td id="summaryEdgeType">-</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Measurements Summary -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">
                    <i class="fas fa-ruler-combined text-primary me-2"></i>Measurements
                </h5>
                <div class="mb-4">
                    <h6 class="mb-3">Tops</h6>
                    <div class="table-responsive">
                        <table class="table table-sm" id="summaryTopsTable">
                            <thead>
                                <tr>
                                    <th>Length</th>
                                    <th>Width</th>
                                    <th>Sqft</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="text-end"><strong>Total:</strong></td>
                                    <td id="summaryTopsTotalSqft">0.00</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div>
                    <h6 class="mb-3">Backsplashes</h6>
                    <div class="table-responsive">
                        <table class="table table-sm" id="summaryBacksplashesTable">
                            <thead>
                                <tr>
                                    <th>Length</th>
                                    <th>Width</th>
                                    <th>Sqft</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="text-end"><strong>Total:</strong></td>
                                    <td id="summaryBacksplashesTotalSqft">0.00</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Services Summary -->
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">
                    <i class="fas fa-tools text-primary me-2"></i>Additional Services
                </h5>
                <div class="table-responsive">
                    <table class="table" id="summaryServicesTable">
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th width="120" class="text-end">Price</th>
                                <th width="100" class="text-end">Quantity</th>
                                <th width="120" class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total Services:</strong></td>
                                <td class="text-end" id="summaryServicesTotalCost">$0.00</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Cost Summary -->
    <div class="col-12">
        <div class="card border-0 shadow-sm bg-primary bg-opacity-10">
            <div class="card-body">
                <h5 class="card-title mb-4 text-primary">
                    <i class="fas fa-calculator me-2"></i>Cost Summary
                </h5>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Total Square Feet:</strong></td>
                                <td class="text-end" id="summaryTotalSqft">0.00</td>
                            </tr>
                            <tr>
                                <td><strong>Material Cost:</strong></td>
                                <td class="text-end" id="summaryMaterialCost">$0.00</td>
                            </tr>
                            <tr>
                                <td><strong>Additional Services:</strong></td>
                                <td class="text-end" id="summaryAdditionalServices">$0.00</td>
                            </tr>
                            <tr class="border-top">
                                <td><strong>Project Total:</strong></td>
                                <td class="text-end"><strong id="summaryProjectTotal">$0.00</strong></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Deposit Amount:</strong></td>
                                <td class="text-end" id="summaryDepositAmount">$0.00</td>
                            </tr>
                            <tr>
                                <td><strong>Payment Method:</strong></td>
                                <td class="text-end" id="summaryPaymentMethod">-</td>
                            </tr>
                            <tr class="border-top">
                                <td><strong>Remaining Balance:</strong></td>
                                <td class="text-end"><strong id="summaryRemainingBalance">$0.00</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="col-12">
        <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-outline-primary" onclick="saveQuote()">
                <i class="fas fa-save me-2"></i>Save Quote
            </button>
            <button type="button" class="btn btn-primary" onclick="generateQuotePDF()">
                <i class="fas fa-file-pdf me-2"></i>Generate PDF
            </button>
        </div>
    </div>
</div>

<script>
function updateSummary() {
    // Update customer information
    $('#summaryCustomerName').text(calculator.data.customerInfo.name || '-');
    $('#summaryCustomerPhone').text(calculator.data.customerInfo.phone || '-');
    $('#summaryCustomerEmail').text(calculator.data.customerInfo.email || '-');
    $('#summaryCustomerAddress').text(calculator.data.customerInfo.address || '-');

    // Update project details
    $('#summaryProjectType').text(calculator.data.projectDetails.projectType || '-');
    $('#summaryMaterial').text(calculator.data.projectDetails.materialType || '-');
    $('#summaryMaterialName').text(calculator.data.projectDetails.materialName || '-');
    $('#summaryEdgeType').text(calculator.data.projectDetails.edgeType || '-');

    // Update measurements tables
    updateMeasurementsTable('Tops');
    updateMeasurementsTable('Backsplashes');

    // Update services table
    updateServicesTable();

    // Update totals
    updateTotals();
}

function updateMeasurementsTable(type) {
    const measurements = calculator.data.measurements[type.toLowerCase()];
    const tbody = $(`#summary${type}Table tbody`);
    tbody.empty();

    let totalSqft = 0;
    measurements.forEach(m => {
        if (m.length > 0 || m.width > 0) {
            tbody.append(`
                <tr>
                    <td>${m.length}"</td>
                    <td>${m.width}"</td>
                    <td>${m.sqft.toFixed(2)}</td>
                </tr>
            `);
            totalSqft += m.sqft;
        }
    });

    $(`#summary${type}TotalSqft`).text(totalSqft.toFixed(2));
}

function updateServicesTable() {
    const tbody = $('#summaryServicesTable tbody');
    tbody.empty();

    let totalServices = 0;
    Object.values(calculator.data.extras).forEach(service => {
        if (service.quantity > 0) {
            const total = service.price * service.quantity;
            tbody.append(`
                <tr>
                    <td>${service.name}</td>
                    <td class="text-end">${Utils.formatCurrency(service.price)}</td>
                    <td class="text-end">${service.quantity}</td>
                    <td class="text-end">${Utils.formatCurrency(total)}</td>
                </tr>
            `);
            totalServices += total;
        }
    });

    $('#summaryServicesTotalCost').text(Utils.formatCurrency(totalServices));
}

function updateTotals() {
    const totalSqft = calculator.data.summary.totalSqft || 0;
    const materialCost = calculator.data.summary.materialCost || 0;
    const servicesCost = calculator.data.summary.servicesCost || 0;
    const projectTotal = materialCost + servicesCost;
    const depositAmount = calculator.data.deposit?.depositAmount || 0;
    const remainingBalance = projectTotal - depositAmount;

    $('#summaryTotalSqft').text(totalSqft.toFixed(2));
    $('#summaryMaterialCost').text(Utils.formatCurrency(materialCost));
    $('#summaryAdditionalServices').text(Utils.formatCurrency(servicesCost));
    $('#summaryProjectTotal').text(Utils.formatCurrency(projectTotal));
    $('#summaryDepositAmount').text(Utils.formatCurrency(depositAmount));
    $('#summaryPaymentMethod').text(calculator.data.deposit?.paymentMethod || '-');
    $('#summaryRemainingBalance').text(Utils.formatCurrency(remainingBalance));
}

// Initialize summary when tab is shown
$('a[data-bs-toggle="tab"][href="#summary"]').on('shown.bs.tab', function (e) {
    updateSummary();
});
</script>