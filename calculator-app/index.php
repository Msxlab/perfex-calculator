<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counter Top Calculator</title>
    
    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-dark">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-calculator text-primary me-2"></i>
                <span class="fw-bold">Counter Top Calculator</span>
            </a>
            <div class="d-flex align-items-center">
                <span class="badge bg-primary me-2">
                    <i class="fas fa-save me-1"></i> Quote #<span id="quoteNumber">New</span>
                </span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">
                <div class="card bg-dark-subtle border-0 shadow-lg">
                    <div class="card-body p-0">
                        <!-- Progress Indicators -->
                        <div class="px-4 py-3 border-bottom border-primary">
                            <div class="d-flex justify-content-between mb-2">
                                <small class="text-muted">Progress</small>
                                <small class="text-primary" id="progressPercentage">0%</small>
                            </div>
                            <div class="progress" style="height: 4px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 0%"></div>
                            </div>
                        </div>

                        <!-- Tab Navigation -->
                        <div class="d-flex border-bottom">
                            <div class="nav nav-tabs nav-fill flex-column flex-sm-row w-100" role="tablist">
                                <button class="nav-link active py-3" data-bs-toggle="tab" data-bs-target="#customer">
                                    <i class="fas fa-user-circle"></i>
                                    <span class="d-none d-md-inline ms-2">Customer</span>
                                </button>
                                <button class="nav-link py-3" data-bs-toggle="tab" data-bs-target="#project">
                                    <i class="fas fa-project-diagram"></i>
                                    <span class="d-none d-md-inline ms-2">Project</span>
                                </button>
                                <button class="nav-link py-3" data-bs-toggle="tab" data-bs-target="#measurements">
                                    <i class="fas fa-ruler-combined"></i>
                                    <span class="d-none d-md-inline ms-2">Measurements</span>
                                </button>
                                <button class="nav-link py-3" data-bs-toggle="tab" data-bs-target="#extras">
                                    <i class="fas fa-plus-circle"></i>
                                    <span class="d-none d-md-inline ms-2">Extras</span>
                                </button>
                                <button class="nav-link py-3" data-bs-toggle="tab" data-bs-target="#invoice">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                    <span class="d-none d-md-inline ms-2">Invoice</span>
                                </button>
                                <button class="nav-link py-3" data-bs-toggle="tab" data-bs-target="#deposit">
                                    <i class="fas fa-hand-holding-usd"></i>
                                    <span class="d-none d-md-inline ms-2">Deposit</span>
                                </button>
                                <button class="nav-link py-3" data-bs-toggle="tab" data-bs-target="#summary">
                                    <i class="fas fa-clipboard-check"></i>
                                    <span class="d-none d-md-inline ms-2">Summary</span>
                                </button>
                            </div>
                        </div>

                        <!-- Tab Content -->
                        <div class="tab-content p-4">
                            <!-- Customer Info Tab -->
                            <div class="tab-pane fade show active" id="customer">
                                <?php include 'views/tabs/customer_info.php'; ?>
                            </div>

                            <!-- Project Details Tab -->
                            <div class="tab-pane fade" id="project">
                                <?php include 'views/tabs/project_details.php'; ?>
                            </div>

                            <!-- Measurements Tab -->
                            <div class="tab-pane fade" id="measurements">
                                <?php include 'views/tabs/measurements.php'; ?>
                            </div>

                            <!-- Extras Tab -->
                            <div class="tab-pane fade" id="extras">
                                <?php include 'views/tabs/extras.php'; ?>
                            </div>

                            <!-- Invoice Tab -->
                            <div class="tab-pane fade" id="invoice">
                                <?php include 'views/tabs/invoice.php'; ?>
                            </div>

                            <!-- Deposit Tab -->
                            <div class="tab-pane fade" id="deposit">
                                <?php include 'views/tabs/deposit.php'; ?>
                            </div>

                            <!-- Summary Tab -->
                            <div class="tab-pane fade" id="summary">
                                <?php include 'views/tabs/summary.php'; ?>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="d-flex justify-content-between p-4 border-top">
                            <button class="btn btn-outline-primary" id="prevBtn" style="display: none;">
                                <i class="fas fa-arrow-left me-2"></i>Previous
                            </button>
                            <div class="ms-auto">
                                <button class="btn btn-outline-primary me-2" id="saveBtn">
                                    <i class="fas fa-save me-2"></i>Save Quote
                                </button>
                                <button class="btn btn-primary" id="nextBtn">
                                    Next<i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <div class="modal fade" id="saveQuoteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header border-primary">
                    <h5 class="modal-title">Save Quote</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Quote has been saved successfully!</p>
                    <p class="mb-0">Quote Number: <strong id="savedQuoteNumber"></strong></p>
                </div>
                <div class="modal-footer border-primary">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/utils.js"></script>
    <script src="assets/js/calculator.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>

</body>
</html>