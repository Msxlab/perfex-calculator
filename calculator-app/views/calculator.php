<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <!-- Üst Başlık ve Butonlar -->
                        <div class="clearfix">
                            <h4 class="pull-left"><?= _l('counter_top_calculator') ?></h4>
                            <div class="pull-right">
                                <button type="button" class="btn btn-primary" onclick="saveQuote()">
                                    <i class="fa fa-save"></i> Save Quote
                                </button>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />

                        <!-- Tab Navigation -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#customer_info" aria-controls="customer_info" role="tab" data-toggle="tab">
                                    Customer Information
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#project_details" aria-controls="project_details" role="tab" data-toggle="tab">
                                    Project Details
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#measurements" aria-controls="measurements" role="tab" data-toggle="tab">
                                    Measurements
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#extras" aria-controls="extras" role="tab" data-toggle="tab">
                                    Extras
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#invoice" aria-controls="invoice" role="tab" data-toggle="tab">
                                    Invoice
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#deposit" aria-controls="deposit" role="tab" data-toggle="tab">
                                    Deposit
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#summary" aria-controls="summary" role="tab" data-toggle="tab">
                                    Summary
                                </a>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content">
                            <!-- Customer Information Tab -->
                            <div role="tabpanel" class="tab-pane active" id="customer_info">
                                <?php $this->load->view('calculator/tabs/customer_info'); ?>
                            </div>

                            <!-- Project Details Tab -->
                            <div role="tabpanel" class="tab-pane" id="project_details">
                                <?php $this->load->view('calculator/tabs/project_details'); ?>
                            </div>

                            <!-- Measurements Tab -->
                            <div role="tabpanel" class="tab-pane" id="measurements">
                                <?php $this->load->view('calculator/tabs/measurements'); ?>
                            </div>

                            <!-- Extras Tab -->
                            <div role="tabpanel" class="tab-pane" id="extras">
                                <?php $this->load->view('calculator/tabs/extras'); ?>
                            </div>

                            <!-- Invoice Tab -->
                            <div role="tabpanel" class="tab-pane" id="invoice">
                                <?php $this->load->view('calculator/tabs/invoice'); ?>
                            </div>

                            <!-- Deposit Tab -->
                            <div role="tabpanel" class="tab-pane" id="deposit">
                                <?php $this->load->view('calculator/tabs/deposit'); ?>
                            </div>

                            <!-- Summary Tab -->
                            <div role="tabpanel" class="tab-pane" id="summary">
                                <?php $this->load->view('calculator/tabs/summary'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php init_tail(); ?>

<!-- Custom Scripts -->
<script>
// Global veri objesi
let calculatorData = {
    customerInfo: {},
    projectDetails: {},
    measurements: {
        tops: [{}],
        backsplashes: [{}],
        edges: [{}]
    },
    extras: [],
    invoice: {
        items: []
    },
    deposit: {
        amount: 0,
        paymentMethod: 'cash'
    }
};

// Tab değişikliğinde veri kontrolü
$('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
    const targetTab = $(e.target).attr('href');
    validateTabChange(targetTab);
});

// Teklif kaydetme fonksiyonu
function saveQuote() {
    $.ajax({
        url: admin_url + 'calculator/save_quote',
        type: 'POST',
        data: calculatorData,
        success: function(response) {
            response = JSON.parse(response);
            if (response.success) {
                alert_float('success', 'Quote saved successfully');
            } else {
                alert_float('danger', 'Failed to save quote');
            }
        }
    });
}

// Tab validasyonu
function validateTabChange(targetTab) {
    if (targetTab === '#project_details') {
        if (!calculatorData.customerInfo.name) {
            alert_float('warning', 'Please fill customer information first');
            return false;
        }
    }
    // Diğer validasyonlar...
    return true;
}
</script>