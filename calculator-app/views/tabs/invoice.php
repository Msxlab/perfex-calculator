<!-- views/tabs/invoice.php -->
<div class="row g-4">
    <!-- Invoice Header -->
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-file-invoice-dollar text-primary me-2"></i>Generate Invoice
                    </h5>
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="addInvoiceItem()">
                        <i class="fas fa-plus me-1"></i>Add Item
                    </button>
                </div>

                <!-- Manual Item Entry -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Item Description</label>
                            <input type="text" class="form-control" id="newItemDescription" placeholder="Enter item description">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Price ($)</label>
                            <input type="number" class="form-control" id="newItemPrice" min="0" step="0.01" value="0">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="newItemQuantity" min="1" value="1">
                        </div>
                    </div>
                </div>

                <!-- Invoice Items Table -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="invoiceTable">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th width="150">Price ($)</th>
                                <th width="120">Quantity</th>
                                <th width="150">Total</th>
                                <th width="80">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="invoiceItems"></tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Subtotal:</strong></td>
                                <td class="text-end" id="invoiceSubtotal">$0.00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end">
                                    <div class="d-flex justify-content-end align-items-center">
                                        <span class="me-2"><strong>Tax Rate:</strong></span>
                                        <input type="number" class="form-control form-control-sm w-25" 
                                               id="taxRate" value="6.625" min="0" max="100" step="0.001"
                                               onchange="updateInvoiceTotals()">
                                        <span class="ms-1">%</span>
                                    </div>
                                </td>
                                <td class="text-end" id="invoiceTax">$0.00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td class="text-end" id="invoiceTotal">$0.00</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoice Settings -->
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">
                    <i class="fas fa-cog text-primary me-2"></i>Invoice Settings
                </h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Invoice Date</label>
                            <input type="date" class="form-control" id="invoiceDate" 
                                   value="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Due Date</label>
                            <input type="date" class="form-control" id="invoiceDueDate" 
                                   value="<?php echo date('Y-m-d', strtotime('+30 days')); ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" id="invoiceNotes" rows="3" 
                                      placeholder="Enter any additional notes for the invoice"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="col-12">
        <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-primary" onclick="previewInvoice()">
                <i class="fas fa-eye me-2"></i>Preview Invoice
            </button>
            <button type="button" class="btn btn-success" onclick="generateInvoicePDF()">
                <i class="fas fa-file-pdf me-2"></i>Generate PDF
            </button>
        </div>
    </div>
</div>

<script>
function addInvoiceItem() {
    const description = $('#newItemDescription').val();
    const price = parseFloat($('#newItemPrice').val()) || 0;
    const quantity = parseInt($('#newItemQuantity').val()) || 1;

    if (!description || price <= 0) {
        calculator.showError('Please enter valid item details');
        return;
    }

    const id = Date.now().toString();
    const newItem = `
        <tr data-item-id="${id}">
            <td>${description}</td>
            <td>
                <input type="number" class="form-control item-price" value="${price}" 
                       min="0" step="0.01" onchange="updateInvoiceItem('${id}')">
            </td>
            <td>
                <input type="number" class="form-control item-quantity" value="${quantity}" 
                       min="1" onchange="updateInvoiceItem('${id}')">
            </td>
            <td class="text-end item-total">${Utils.formatCurrency(price * quantity)}</td>
            <td>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeInvoiceItem('${id}')">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
    `;

    $('#invoiceItems').append(newItem);
    calculator.data.invoice.items.push({ id, description, price, quantity });

    // Clear input fields
    $('#newItemDescription').val('');
    $('#newItemPrice').val('0');
    $('#newItemQuantity').val('1');

    updateInvoiceTotals();
}

function updateInvoiceItem(id) {
    const row = $(`tr[data-item-id="${id}"]`);
    const price = parseFloat(row.find('.item-price').val()) || 0;
    const quantity = parseInt(row.find('.item-quantity').val()) || 1;
    const total = price * quantity;

    row.find('.item-total').text(Utils.formatCurrency(total));

    // Update data object
    const itemIndex = calculator.data.invoice.items.findIndex(item => item.id === id);
    if (itemIndex !== -1) {
        calculator.data.invoice.items[itemIndex] = { id, price, quantity };
    }

    updateInvoiceTotals();
}

function removeInvoiceItem(id) {
    $(`tr[data-item-id="${id}"]`).remove();
    calculator.data.invoice.items = calculator.data.invoice.items.filter(item => item.id !== id);
    updateInvoiceTotals();
}

function updateInvoiceTotals() {
    let subtotal = 0;
    calculator.data.invoice.items.forEach(item => {
        subtotal += item.price * item.quantity;
    });

    const taxRate = parseFloat($('#taxRate').val()) / 100;
    const tax = subtotal * taxRate;
    const total = subtotal + tax;

    $('#invoiceSubtotal').text(Utils.formatCurrency(subtotal));
    $('#invoiceTax').text(Utils.formatCurrency(tax));
    $('#invoiceTotal').text(Utils.formatCurrency(total));

    calculator.data.invoice.subtotal = subtotal;
    calculator.data.invoice.tax = tax;
    calculator.data.invoice.total = total;
    calculator.data.invoice.taxRate = taxRate;
}

function previewInvoice() {
    // Implementation for invoice preview
}

function generateInvoicePDF() {
    // Implementation for PDF generation
}

$(document).ready(() => {
    calculator.data.invoice = {
        items: [],
        subtotal: 0,
        tax: 0,
        total: 0,
        taxRate: 0.06625,
        date: new Date().toISOString().split('T')[0],
        dueDate: new Date(Date.now() + 30*24*60*60*1000).toISOString().split('T')[0],
        notes: ''
    };
});
</script>