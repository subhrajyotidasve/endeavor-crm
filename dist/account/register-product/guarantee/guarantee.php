<style>

p {
    line-height: 0.4rem;
}
.invoice-box {
    max-width: 800px;
    margin: auto;
    padding: 30px;
    border: 1px solid #eee;
    box-shadow: 0 0 10px rgba(0, 0, 0, .15);
    font-size: 16px;
    line-height: 24px;
    color: #555;
}

.invoice-box table {
    width: 100%;
    line-height: inherit;
    text-align: left;
}

.invoice-box table td {
    padding: 5px;
    vertical-align: top;
}
.invoice-box table tr.top table td {
    padding-bottom: 20px;
}

.invoice-box table tr.top table td.title {
    font-size: 45px;
    line-height: 45px;
    color: #333;
}

.invoice-box table tr.information table td {
    padding-bottom: 40px;
}

.invoice-box table tr.heading td {
    background: #eee;
    border-bottom: 1px solid #ddd;
    font-weight: bold;
}

.invoice-box table tr.details td {
    padding-bottom: 20px;
}

.invoice-box table tr.item td {
    border-bottom: 1px solid #eee;
}

.invoice-box table tr.item.last td {
    border-bottom: none;
}

.invoice-box table tr.total td:nth-child(2) {
    border-top: 2px solid #eee;
    font-weight: bold;
}

@media only screen and (max-width: 600px) {
    .invoice-box table tr.top table td {
        width: 100%;
        display: block;
        text-align: center;
    }
}
.invoice-box table tr.information table td {
    width: 100%;
    display: block;
    text-align: center;
}


/** RTL **/
.rtl {
    direction: rtl;
}

.rtl table {
    text-align: right;
}

.rtl table tr td:nth-child(2) {
    text-align: left;
}

</style>
<page>
    <div id="invoice-box" class="invoice-box">
        <p><strong>JAY-BE LIMITED</strong></p>
        <p>&nbsp;</p>
        <p><strong>Name: </strong><?php echo $guarantee['first_name'] . ' ' . $guarantee['last_name']; ?></p>
        <p><strong>Email: </strong><?php echo $guarantee['email']; ?></p>
        <p>&nbsp;</p>
        <p><strong>Product Title: </strong><?php echo $guarantee['product']; ?></p>
        <p><strong>Product Code: </strong><?= $product_code ?></p>
        <p><strong>Quantity: </strong><?php echo $guarantee['quantity']; ?></p>
        <p><strong>Date of purchase: </strong><?php echo date('d/m/Y', strtotime($guarantee['date_of_purchase'])); ?></p>
        <p><strong>Date of expiry: </strong>See below</p>
        <p><strong>Order No: </strong><?= $order_no ?></p>
        <p><strong>SAP Invoice No: </strong><?= $sap_no ?></p>
        <p><strong>Retailer: </strong><?php echo $guarantee['retailer']; ?></p>
    </div>
    <p>&nbsp;</p>
    <p>For your peace of mind all Jay-Be products come with a guarantee.</p>
    <p>Duration of guarantee from date of purchase....</p>
    <p>&nbsp;</p>
    <p>Folding bed frame – Lifetime guarantee</p>
    <p>Folding bed frame in contract environments – 5 Years</p>
    <p>Folding bed mattress – 1 Year</p>
    <p>Storage covers and Mattress protectors – 1 Year</p>
    <p>&nbsp;</p>
    <p>Sofa/sofa bed frame – Lifetime guarantee</p>
    <p>Sofa bed 3-fold bed mechanism – 1 Year</p>
    <p>Sofa bed Retro roll-out mechanism – 5 Years</p>
    <p>Sofa/sofa bed seat and back cushions – 5 Years</p>
    <p>Sofa bed mattresses – 1 Year</p>
    <p>&nbsp;</p>
    <p>Adult mattresses – 5 Years</p>
    <p>Children’s and Toddler mattresses – 5 Years</p>
</page>