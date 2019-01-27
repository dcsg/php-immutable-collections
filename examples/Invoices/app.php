<?php declare(strict_types=1);

$loader = require __DIR__ . '/../../vendor/autoload.php';
$loader->addPsr4('Examples\\DCSG\\ImmutableCollections\\Invoices\\', __DIR__);

use Examples\DCSG\ImmutableCollections\Invoices\Invoice;
use Examples\DCSG\ImmutableCollections\Invoices\InvoiceItem;
use Examples\DCSG\ImmutableCollections\Invoices\InvoiceItems;
use Examples\DCSG\ImmutableCollections\Invoices\Invoices;

$invoice1 = new Invoice('1', 1, 2019, InvoiceItems::create([
        new InvoiceItem('1', 'Bread', 0.9, 0.06, 5),
        new InvoiceItem('2', 'Salmon', 10, 0.23, 2),
        new InvoiceItem('3', 'Garlic', 0.25, 0.06, 30)
]));
$invoice1->pay();
$invoice2 = new Invoice('2', 2, 2019, InvoiceItems::create([
        new InvoiceItem('4', 'Milk', 1.2, 0.06, 5),
        new InvoiceItem('5', 'Beer', 2, 0.23, 24),
        new InvoiceItem('6', 'Wine', 7, 0.23, 6)
]));
$invoice3 = new Invoice('3', 3, 2019, InvoiceItems::create([
        new InvoiceItem('4', 'Milk', 1.2, 0.06, 5)
]));

$invoices = Invoices::create([$invoice1, $invoice2, $invoice3]);

echo "###### Summary ######\n";
echo "# Invoices: {$invoices->count()}\n";
echo "Total excluding VAT: {$invoices->totalExcludingVAT()}\n";
echo "Total including VAT: {$invoices->totalIncludingVAT()}\n\n";
echo "###### Outstanding Invoices ######\n";
echo "# Invoices: {$invoices->countOutstandingInvoices()}\n";
echo "excluding VAT: {$invoices->allOutstandingInvoices()->totalExcludingVAT()}\n";
echo "including VAT: {$invoices->allOutstandingInvoices()->totalIncludingVAT()}\n\n";
echo "###### Paid Invoices ######\n";
echo "# Invoices: {$invoices->countPaidInvoices()}\n";
echo "excluding VAT: {$invoices->allPaidInvoices()->totalExcludingVAT()}\n";
echo "including VAT: {$invoices->allPaidInvoices()->totalIncludingVAT()}\n\n";
echo "###### Log ######\n";
$invoices->printLog();
