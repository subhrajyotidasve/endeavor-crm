<style>
p {
    line-height: 0.4rem;
}
.invoice-box {
    max-width: 850px;
    margin: auto;
    padding-left: 30px 20px;
    /*border: 1px solid #eee;*/
    /*box-shadow: 0 0 10px rgba(0, 0, 0, .15);*/
    font-size: 14px;
    line-height: 22px;
    color: #555;
}
.invoice-box table {
    width: 100%;
    max-width: 100%;
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
    font-size: 40px;
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
        <p>&nbsp;</p>
        <table>
            <tr class="top">
                <td class="title"><strong>JAY-BE LIMITED</strong></td>
            </tr>
            <tr>
                <td>VAT No: GB940417147</td>
            </tr>
            <tr>
                <td>Order No: <?= 'JB0000'.$order['order_no'] ?></td>
            </tr>
            <tr>
                <td>SAP Invoice No: <?= $order['sap_no'] ?></td>
            </tr>
            <tr>
                <td>Date of Purchase: <?= date('d/m/Y', strtotime($order['created_at'])) ?></td>
            </tr>
        </table>
        <p>&nbsp;</p>
        <table>
            <tr>
                <td><strong>Billing Address</strong></td>
                <td><strong>Delivery Address</strong></td>
            </tr>
            <tr>
                <td><?= $order['customer_first_name'] . ' ' . $order['customer_last_name'] ?></td>
                <td><?= $order['customer_first_name'] . ' ' . $order['customer_last_name'] ?></td>
            </tr>
            <tr>
                <td><?= $order['customer_billing_address1'] ?> </td>
                <td><?= $order['customer_address1'] ?> </td>
            </tr>
            <tr>
                <td><?= $order['customer_billing_address2'] ?> </td>
                <td><?= $order['customer_address2'] ?> </td>
            </tr>
            <tr>
                <td><?= $order['customer_billing_city'] ?> </td>
                <td><?= $order['customer_city'] ?> </td>
            </tr>
            <tr>
                <td><?= $order['customer_billing_county'] ?> </td>
                <td><?= $order['customer_county'] ?> </td>
            </tr>
            <tr>
                <td><?= $order['customer_billing_postcode'] ?> </td>
                <td><?= $order['customer_postcode'] ?> </td>
            </tr>
        </table>
        <p>&nbsp;</p>
        <table>
           <tr class="heading">
               <td>Product Name</td>
               <td>Quantity</td>
               <td>Subtotal (ex VAT at 20%)</td>
               <td>Subtotal (inc VAT at 20%)</td>
           </tr>
          <?php foreach($products as $product) { ?>
           <tr class="item">
               <td><?= $product['product_name'] . ' ' .$product['product_code']?></td>
               <td><?= $product['quantity']?></td>
               <td>£<?= Strings::priceExVat($product['pos_price'] * $product['quantity']) ?></td>
               <td>£<?= $product['pos_price'] * $product['quantity'] ?></td>
           </tr>
           <?php } ?>
           <tr class="total">
               <td></td>
               <td></td>
               <td>£<?= Strings::priceExVat($order['total_order_amount']) ?></td>
               <td><strong>Total: £<?= $order['total_order_amount'] ?></strong></td>
            </tr>
        </table>
        <p>&nbsp;</p>
        <p>Please contact us if you have any questions or would like to cancel your order:</p>
        <p>01924 666 633 | sales@jaybe.com</p>
        <p>Jay-Be Limited, Low Mill Lane, Ravensthorpe Industrial Estate, West Yorkshire, WF13 3LN</p>
        <p>Company Reg No. 6636595, VAT Reg No. 940417147</p>
    </div>
</page>