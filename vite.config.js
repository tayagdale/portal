import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/main.scss',
                'resources/sass/oneui/themes/amethyst.scss',
                'resources/sass/oneui/themes/city.scss',
                'resources/sass/oneui/themes/flat.scss',
                'resources/sass/oneui/themes/modern.scss',
                'resources/sass/oneui/themes/smooth.scss',
                'resources/js/oneui/app.js',
                'resources/js/app.js',
                'resources/js/pages/datatables.js',
                'resources/js/pages/file_maintenance/usersDatatable.js',
                'resources/js/pages/file_maintenance/customersDatatable.js',
                'resources/js/pages/file_maintenance/suppliersDatatable.js',
                'resources/js/pages/file_maintenance/unitsDatatable.js',
                'resources/js/pages/file_maintenance/itemsDatatable.js',
                'resources/js/pages/file_maintenance/subCategoriesDatatable.js',
                'resources/js/pages/file_maintenance/categoriesDatatable.js',
                'resources/js/pages/purchasing/purchaseOrdersDatatable.js',
                'resources/js/pages/purchasing/inspectionsDatatable.js',
                'resources/js/pages/purchasing/inventoryDatatable.js',
                'resources/js/pages/sales/orderSlipsDatatable.js',
                'resources/js/pages/sales/salesOrdersDatatable.js',
                'resources/js/pages/sales/deliveryDatatable.js',
                'resources/js/pages/sales/salesInvoiceDatatable.js',
                'resources/js/pages/payment/incomingPaymentDatatable.js',
                'resources/js/pages/payment/outgoingPaymentDatatable.js',
                'resources/js/pages/file_maintenance/warehouseDatatable.js',
            ],
            refresh: true,
        }),
    ],
});
