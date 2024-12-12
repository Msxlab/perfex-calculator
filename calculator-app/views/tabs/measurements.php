<!-- views/tabs/measurements.php -->
<div class="row g-4">
    <!-- Tops Measurements -->
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title mb-0">
                        <i class="fas fa-vector-square text-primary me-2"></i>Tops Measurements
                    </h5>
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="addMeasurementRow('tops')">
                        <i class="fas fa-plus me-1"></i>Add Row
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="topsTable">
                        <thead>
                            <tr>
                                <th>Length (inches)</th>
                                <th>Width (inches)</th>
                                <th>Square Feet</th>
                                <th width="80">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="topsMeasurements">
                            <tr class="measurement-row">
                                <td>
                                    <input type="number" class="form-control length" step="0.01" min="0"
                                           onchange="updateMeasurement(this, 'tops')">
                                </td>
                                <td>
                                    <input type="number" class="form-control width" step="0.01" min="0"
                                           onchange="updateMeasurement(this, 'tops')">
                                </td>
                                <td>
                                    <input type="number" class="form-control sqft" readonly>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeMeasurementRow(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="text-end"><strong>Total Square Feet:</strong></td>
                                <td colspan="2"><span id="topsTotalSqft">0.00</span></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Backsplashes Measurements -->
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-grip-lines text-primary me-2"></i>Backsplashes Measurements
                    </h5>
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="addMeasurementRow('backsplashes')">
                        <i class="fas fa-plus me-1"></i>Add Row
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="backsplashesTable">
                        <thead>
                            <tr>
                                <th>Length (inches)</th>
                                <th>Width (inches)</th>
                                <th>Square Feet</th>
                                <th width="80">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="backsplashesMeasurements">
                            <tr class="measurement-row">
                                <td>
                                    <input type="number" class="form-control length" step="0.01" min="0"
                                           onchange="updateMeasurement(this, 'backsplashes')">
                                </td>
                                <td>
                                    <input type="number" class="form-control width" step="0.01" min="0"
                                           onchange="updateMeasurement(this, 'backsplashes')">
                                </td>
                                <td>
                                    <input type="number" class="form-control sqft" readonly>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeMeasurementRow(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="text-end"><strong>Total Square Feet:</strong></td>
                                <td colspan="2"><span id="backsplashesTotalSqft">0.00</span></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Summary -->
    <div class="col-12">
        <div class="card bg-primary bg-opacity-10 border-0">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="card-title text-primary mb-0">Total Project Square Feet</h5>
                    </div>
                    <div class="col-auto">
                        <h3 class="mb-0" id="totalProjectSqft">0.00</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function addMeasurementRow(type) {
    const newRow = `
        <tr class="measurement-row">
            <td>
                <input type="number" class="form-control length" step="0.01" min="0"
                       onchange="updateMeasurement(this, '${type}')">
            </td>
            <td>
                <input type="number" class="form-control width" step="0.01" min="0"
                       onchange="updateMeasurement(this, '${type}')">
            </td>
            <td>
                <input type="number" class="form-control sqft" readonly>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeMeasurementRow(this)">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
    `;
    $(`#${type}Measurements`).append(newRow);
}

function updateMeasurement(input, type) {
    const row = $(input).closest('tr');
    const length = parseFloat(row.find('.length').val()) || 0;
    const width = parseFloat(row.find('.width').val()) || 0;
    const sqft = Utils.calculateSqft(length, width);
    
    row.find('.sqft').val(sqft.toFixed(2));
    updateTotals(type);
}

function removeMeasurementRow(button) {
    const row = $(button).closest('tr');
    const type = $(button).closest('table').attr('id').replace('Table', '');
    if ($(`#${type}Measurements tr`).length > 1) {
        row.remove();
        updateTotals(type);
    }
}

function updateTotals(type) {
    let total = 0;
    $(`#${type}Measurements .sqft`).each(function() {
        total += parseFloat($(this).val()) || 0;
    });
    
    $(`#${type}TotalSqft`).text(total.toFixed(2));
    
    // Toplam square feet güncelleme
    const topsTotal = parseFloat($('#topsTotalSqft').text()) || 0;
    const backsplashesTotal = parseFloat($('#backsplashesTotalSqft').text()) || 0;
    const totalSqft = topsTotal + backsplashesTotal;
    
    $('#totalProjectSqft').text(totalSqft.toFixed(2));
    
    // Update calculator data
    let measurements = [];
    $(`#${type}Measurements tr`).each(function() {
        const length = parseFloat($(this).find('.length').val()) || 0;
        const width = parseFloat($(this).find('.width').val()) || 0;
        const sqft = parseFloat($(this).find('.sqft').val()) || 0;
        
        if (length > 0 || width > 0) {
            measurements.push({ length, width, sqft });
        }
    });
    // Hesaplamaları calculator data'ya kaydet
    calculator.data.measurements[type] = [];
    $(`#${type}Measurements tr`).each(function() {
        const length = parseFloat($(this).find('.length').val()) || 0;
        const width = parseFloat($(this).find('.width').val()) || 0;
        const sqft = Utils.calculateSqft(length, width);
        
        if (length > 0 || width > 0) {
            calculator.data.measurements[type].push({ length, width, sqft });
        }
    });
    const materialCost = totalSqft * 40;
    calculator.data.summary.totalSqft = totalSqft;
    calculator.data.summary.materialCost = materialCost;

}
</script>