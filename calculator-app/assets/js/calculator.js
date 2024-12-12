class Calculator {
    constructor() {
        this.data = {
            customerInfo: {
                name: '',
                email: '',
                phone: '',
                address: '',
                company: '',
                city: '',
                state: '',
                zip: ''
            },
            projectDetails: {
                projectType: '',
                materialType: '',
                materialName: '',
                materialPrice: 0,
                edgeType: '',
                notes: ''
            },
            measurements: {
                tops: [],
                backsplashes: []
            },
            extras: {
                install: { id: 'install', name: 'Installation & Template', price: 0, quantity: 1 },
                faucetHole: { id: 'faucetHole', name: 'Faucet Hole', price: 45, quantity: 0 },
                sinkCutout: { id: 'sinkCutout', name: 'Sink Cut-out', price: 350, quantity: 0 },
                cooktopCutout: { id: 'cooktopCutout', name: 'Cooktop Cut-out', price: 150, quantity: 0 },
                edging: { id: 'edging', name: 'Edging (per linear ft)', price: 15, quantity: 0 },
                sealer: { id: 'sealer', name: 'Sealer', price: 75, quantity: 0 },
                plumbing: { id: 'plumbing', name: 'Plumbing Disconnect/Reconnect', price: 250, quantity: 0 }
            },
            summary: {
                totalSqft: 0,
                materialCost: 0,
                servicesCost: 0,
                total: 0
            },
            deposit: {
                depositAmount: 0,
                paymentMethod: ''
            }
        };

        this.initializeEventListeners();
    }

    initializeEventListeners() {
        // Customer info events
        $('#customerName, #customerPhone, #customerEmail, #customerAddress').on('change', (e) => {
            const id = e.target.id.replace('customer', '').toLowerCase();
            this.data.customerInfo[id] = e.target.value;
        });

        // Material price change
        $('#materialPrice').on('change', (e) => {
            this.data.projectDetails.materialPrice = parseFloat(e.target.value) || 0;
            this.updateCalculations();
        });

        // Extras quantity or price change
        $('.price, .quantity').on('change', (e) => {
            const serviceId = $(e.target).closest('tr').data('service-id');
            const field = $(e.target).hasClass('price') ? 'price' : 'quantity';
            this.updateExtra(serviceId, field, e.target.value);
        });

        // Summary tab shown
        $('a[data-bs-toggle="tab"][href="#summary"]').on('shown.bs.tab', () => {
            this.updateSummary();
        });
    }

    updateExtra(serviceId, field, value) {
        const numValue = parseFloat(value) || 0;

        if (this.data.extras[serviceId]) {
            this.data.extras[serviceId][field] = numValue;

            // Update total for the specific service
            const total = this.data.extras[serviceId].price * this.data.extras[serviceId].quantity;
            $(`#${serviceId}Total`).text(Utils.formatCurrency(total));

            // Update services total
            this.updateServiceTotals();
        }
    }

    updateServiceTotals() {
        let totalServices = 0;

        Object.values(this.data.extras).forEach(service => {
            totalServices += service.price * service.quantity;
        });

        $('#extrasTotal').text(Utils.formatCurrency(totalServices));
        this.data.summary.servicesCost = totalServices;

        this.updateCalculations();
    }

    updateCalculations() {
        const totalSqft = this.calculateTotalSqft();
        const materialCost = totalSqft * (this.data.projectDetails.materialPrice || 0);
        const servicesCost = this.data.summary.servicesCost || 0;
        const projectTotal = materialCost + servicesCost;

        this.data.summary = {
            totalSqft,
            materialCost,
            servicesCost,
            total: projectTotal
        };

        // Update summary tab if visible
        this.updateSummary();
    }

    calculateTotalSqft() {
        const topsSqft = this.data.measurements.tops.reduce((total, m) => total + m.sqft, 0);
        const backsplashesSqft = this.data.measurements.backsplashes.reduce((total, m) => total + m.sqft, 0);
        return topsSqft + backsplashesSqft;
    }

    updateSummary() {
        $('#summaryCustomerName').text(this.data.customerInfo.name || '-');
        $('#summaryCustomerPhone').text(this.data.customerInfo.phone || '-');
        $('#summaryCustomerEmail').text(this.data.customerInfo.email || '-');
        $('#summaryCustomerAddress').text(this.data.customerInfo.address || '-');

        $('#summaryProjectType').text(this.data.projectDetails.projectType || '-');
        $('#summaryMaterial').text(this.data.projectDetails.materialType || '-');
        $('#summaryMaterialName').text(this.data.projectDetails.materialName || '-');
        $('#summaryEdgeType').text(this.data.projectDetails.edgeType || '-');

        this.updateMeasurementsTable('Tops');
        this.updateMeasurementsTable('Backsplashes');
        this.updateServicesTable();
        this.updateTotals();
    }

    updateMeasurementsTable(type) {
        const tbody = $(`#summary${type}Table tbody`);
        tbody.empty();

        const measurements = this.data.measurements[type.toLowerCase()] || [];
        measurements.forEach(m => {
            tbody.append(`
                <tr>
                    <td>${m.length}"</td>
                    <td>${m.width}"</td>
                    <td>${m.sqft.toFixed(2)}</td>
                </tr>
            `);
        });

        const totalSqft = measurements.reduce((sum, m) => sum + m.sqft, 0);
        $(`#summary${type}TotalSqft`).text(totalSqft.toFixed(2));
    }

    updateServicesTable() {
        const tbody = $('#summaryServicesTable tbody');
        tbody.empty();

        let totalServices = 0;
        Object.values(this.data.extras).forEach(service => {
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

    updateTotals() {
        const totalSqft = this.data.summary.totalSqft || 0;
        const materialCost = this.data.summary.materialCost || 0;
        const servicesCost = this.data.summary.servicesCost || 0;
        const projectTotal = materialCost + servicesCost;
        const depositAmount = this.data.deposit.depositAmount || 0;
        const remainingBalance = projectTotal - depositAmount;

        $('#summaryTotalSqft').text(totalSqft.toFixed(2));
        $('#summaryMaterialCost').text(Utils.formatCurrency(materialCost));
        $('#summaryAdditionalServices').text(Utils.formatCurrency(servicesCost));
        $('#summaryProjectTotal').text(Utils.formatCurrency(projectTotal));
        $('#summaryDepositAmount').text(Utils.formatCurrency(depositAmount));
        $('#summaryPaymentMethod').text(this.data.deposit.paymentMethod || '-');
        $('#summaryRemainingBalance').text(Utils.formatCurrency(remainingBalance));
    }
}

// Initialize Calculator
window.calculator = new Calculator();
