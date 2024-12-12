// assets/js/utils.js
const Utils = {
    calculateSqft: (length, width) => {
        if (!length || !width) return 0;
        // İnch'ten square feet'e çevirmek için 144'e böl
        return Number(((length * width) / 144).toFixed(2));
    },

    calculateTotal: (measurements) => {
        let total = 0;
        // Tops hesaplama
        if (measurements.tops) {
            total += measurements.tops.reduce((sum, item) => {
                return sum + Utils.calculateSqft(item.length, item.width);
            }, 0);
        }
        // Backsplashes hesaplama
        if (measurements.backsplashes) {
            total += measurements.backsplashes.reduce((sum, item) => {
                return sum + Utils.calculateSqft(item.length, item.width);
            }, 0);
        }
        return Number(total.toFixed(2));
    },

    formatCurrency: (amount) => {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format(amount || 0);
    }
};

function generatePDF(data) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Başlık
    doc.setFontSize(20);
    doc.text('Quote Summary', 105, 20, { align: 'center' });

    // Müşteri Bilgileri
    doc.setFontSize(12);
    doc.text('Customer Information:', 20, 40);
    doc.text(`Name: ${data.customerInfo.name || 'N/A'}`, 20, 50);
    doc.text(`Phone: ${data.customerInfo.phone || 'N/A'}`, 20, 60);
    doc.text(`Email: ${data.customerInfo.email || 'N/A'}`, 20, 70);
    doc.text(`Address: ${data.customerInfo.address || 'N/A'}`, 20, 80);

    // Proje Detayları
    doc.text('Project Details:', 20, 100);
    doc.text(`Project Type: ${data.projectDetails.projectType || 'N/A'}`, 20, 110);
    doc.text(`Material: ${data.projectDetails.materialType || 'N/A'}`, 20, 120);
    doc.text(`Edge Type: ${data.projectDetails.edgeType || 'N/A'}`, 20, 130);

    // Ölçümler Tablosu
    const measurements = [
        ['Description', 'Length', 'Width', 'Sqft'],
        ...data.measurements.tops.map((top, index) => [
            `Top ${index + 1}`,
            `${top.length || 0}"`,
            `${top.width || 0}"`,
            `${top.sqft.toFixed(2) || 0}`,
        ]),
        ...data.measurements.backsplashes.map((backsplash, index) => [
            `Backsplash ${index + 1}`,
            `${backsplash.length || 0}"`,
            `${backsplash.width || 0}"`,
            `${backsplash.sqft.toFixed(2) || 0}`,
        ]),
    ];

    doc.autoTable({
        startY: 150,
        head: [measurements[0]],
        body: measurements.slice(1),
        theme: 'striped',
    });

    // Fiyatlandırma
    let yPos = doc.lastAutoTable.finalY + 20;
    doc.text('Pricing:', 20, yPos);
    yPos += 10;
    doc.text(`Material Cost: ${Utils.formatCurrency(data.summary.materialCost)}`, 20, yPos);
    yPos += 10;
    doc.text(`Services Cost: ${Utils.formatCurrency(data.summary.servicesCost)}`, 20, yPos);
    yPos += 10;
    doc.text(`Total: ${Utils.formatCurrency(data.summary.total)}`, 20, yPos);

    // Footer
    doc.setFontSize(10);
    doc.text('Thank you for your business!', 105, 280, { align: 'center' });

    // PDF'i kaydet
    doc.save(`quote_${data.customerInfo.name.replace(/\s+/g, '_')}.pdf`);
}


// Butonlara event listener ekleyin
document.addEventListener('DOMContentLoaded', () => {
    const generatePdfBtn = document.querySelector('[onclick="generateQuotePDF()"]');
    if (generatePdfBtn) {
        generatePdfBtn.addEventListener('click', () => {
            generatePDF(calculator.data);
        });
    }
});