<!-- views/tabs/extras.php -->
<div class="row g-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">
                    <i class="fas fa-plus-circle text-primary me-2"></i>Additional Services
                </h5>

                <div class="table-responsive">
                    <table class="table table-bordered" id="extrasTable">
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th width="150">Price ($)</th>
                                <th width="120">Quantity</th>
                                <th width="150">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-service-id="install">
                                <td>Installation & Template</td>
                                <td>
                                    <input type="number" id="installPrice" class="form-control price" value="0" min="0" step="0.01">
                                </td>
                                <td>
                                    <input type="number" id="installQuantity" class="form-control quantity" value="1" min="0">
                                </td>
                                <td class="text-end" id="installTotal">$0.00</td>
                            </tr>
                            <tr data-service-id="faucetHole">
                                <td>Faucet Hole</td>
                                <td>
                                    <input type="number" id="faucetHolePrice" class="form-control price" value="45" min="0" step="0.01">
                                </td>
                                <td>
                                    <input type="number" id="faucetHoleQuantity" class="form-control quantity" value="0" min="0">
                                </td>
                                <td class="text-end" id="faucetHoleTotal">$0.00</td>
                            </tr>
                            <tr data-service-id="sinkCutout">
                                <td>Sink Cut-out</td>
                                <td>
                                    <input type="number" id="sinkCutoutPrice" class="form-control price" value="350" min="0" step="0.01">
                                </td>
                                <td>
                                    <input type="number" id="sinkCutoutQuantity" class="form-control quantity" value="0" min="0">
                                </td>
                                <td class="text-end" id="sinkCutoutTotal">$0.00</td>
                            </tr>
                            <tr data-service-id="cooktopCutout">
                                <td>Cooktop Cut-out</td>
                                <td>
                                    <input type="number" id="cooktopCutoutPrice" class="form-control price" value="150" min="0" step="0.01">
                                </td>
                                <td>
                                    <input type="number" id="cooktopCutoutQuantity" class="form-control quantity" value="0" min="0">
                                </td>
                                <td class="text-end" id="cooktopCutoutTotal">$0.00</td>
                            </tr>
                            <tr data-service-id="edging">
                                <td>Edging (per linear ft)</td>
                                <td>
                                    <input type="number" id="edgingPrice" class="form-control price" value="15" min="0" step="0.01">
                                </td>
                                <td>
                                    <input type="number" id="edgingQuantity" class="form-control quantity" value="0" min="0">
                                </td>
                                <td class="text-end" id="edgingTotal">$0.00</td>
                            </tr>
                            <tr data-service-id="sealer">
                                <td>Sealer</td>
                                <td>
                                    <input type="number" id="sealerPrice" class="form-control price" value="75" min="0" step="0.01">
                                </td>
                                <td>
                                    <input type="number" id="sealerQuantity" class="form-control quantity" value="0" min="0">
                                </td>
                                <td class="text-end" id="sealerTotal">$0.00</td>
                            </tr>
                            <tr data-service-id="plumbing">
                                <td>Plumbing Disconnect/Reconnect</td>
                                <td>
                                    <input type="number" id="plumbingPrice" class="form-control price" value="250" min="0" step="0.01">
                                </td>
                                <td>
                                    <input type="number" id="plumbingQuantity" class="form-control quantity" value="0" min="0">
                                </td>
                                <td class="text-end" id="plumbingTotal">$0.00</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total Additional Services:</strong></td>
                                <td class="text-end" id="extrasTotal">$0.00</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Her input 