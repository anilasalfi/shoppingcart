 <!-------- styling for the table ------->
 <style>
    table {      
    border-collapse: collapse;
    }

    td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    }

    tr:nth-child(even) {
    background-color: #dddddd;
    }
</style>
<!-------------- end style ---------------->

<?php if(!$this->cart->contents()):
    echo 'You don\'t have any items yet.';
else:
?>

<?php echo form_open('cart/update_cart'); ?>
<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <td><strong>Qty</strong></td>
            <td><strong>Item Description</strong></td>
            <td><strong>Item Price</strong></td>
            <td><strong>Sub-Total</strong></td>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach($this->cart->contents() as $items): ?>
         
        <?php echo form_hidden('rowid[]', $items['rowid']); ?>
        <tr <?php if($i&1){ echo 'class="alt"'; }?>>
            <td>
                <?php echo form_input(array('name' => 'qty[]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?>
            </td>
             
            <td><?php echo $items['name']; ?></td>
             
            <td>&euro;<?php echo $this->cart->format_number($items['price']); ?></td>
            <td>&euro;<?php echo $this->cart->format_number($items['subtotal']); ?></td>
        </tr>
         
        <?php $i++; ?>
        <?php endforeach; ?>
         
        <tr>
            <td></td>
            <td></td>
            <td><strong>Total</strong></td>
            <td>&euro;<?php echo $this->cart->format_number($this->cart->total()); ?></td>
        </tr>
    </tbody>
</table>
 <p><?php echo form_submit('', 'Update your Cart'); echo anchor('cart/empty_cart', 'Empty Cart', 'class="empty"');?></p>
<p><small>If the quantity is set to zero, the item will be removed from the cart.</small></p>
<?php 
echo form_close(); 
endif;
?>