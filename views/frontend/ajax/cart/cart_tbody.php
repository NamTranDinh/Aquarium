<?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) : ?>
    <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr style="font-size: 18px;">
                <th style="width:42%">Event Name</th>
                <th style="width:10%" class="text-center">Type</th>
                <th style="width:12%" class="text-center">Price</th>
                <th style="width:13%" class="text-center">Number</th>
                <th style="width:18%" class="text-center">Total money</th>
                <th style="width:5%"> <button onclick="del_cart_all();" class="btn btn-default btn-sm" style="padding-left: 12px;"><i class="fas fa-trash-alt"></i></button></th>
            </tr>
        </thead>
        <tbody id="cart-tbody">
            <?php
            $i = 0;
            $total_all_cart = 0;
            foreach ($data as $value) :
                if(!is_array($_SESSION['cart'][$value['id']])) unset($_SESSION['cart'][$value['id']]);
                foreach ($_SESSION['cart'][$value['id']] as $type => $val) :
                    $i++;
                    $total_all_cart += $val['price'] * $val['number']; ?>
                    <tr class="tr-cart-item-<?= $i ?> cart-item">
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-3 hidden-xs">
                                    <img width="100%" src="<?= $value['event_sub_img']; ?>" alt="<?= $value['event_name']; ?>" class="img-responsive">
                                </div>
                                <div class="col-sm-9">
                                    <h4><?= $value['event_name'] ?? ''; ?></h4>
                                    <p><?= $value['event_intro'] ?? ''; ?></p>
                                </div>
                            </div>
                        </td>
                        <td data-th="Type" class="text-center" style="font-weight: 600;"><?= $type == 0 ? 'General' : 'VIP'; ?></td>
                        <td data-th="Price" class="text-center">$<span class="price"><?= $val['price'] ?? ''; ?></span></td>
                        <td data-th="Quantity" class="text-center"><input oninput="change_num_ticket_cart(<?= $i; ?>, <?= $value['id']; ?>, <?= $type; ?>)" class="form-control text-center" value="<?= $val['number']; ?>" type="number" min="1" max="<?= $value['ticket_num']; ?>"></td>
                        <td data-th="Subtotal" class="text-center">$<span class="total_money total_money-<?= $i - 1 ?>"><?= $val['price'] * $val['number']; ?></span></td>
                        <td class="actions">
                            <button onclick="del_cart_item(<?= $value['id']; ?>, <?= $type; ?>);" class="btn btn-default btn-sm pad-12"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">
                    <!-- <div class="row">
                            <label for="" class="col-sm-2 text-center" style="line-height: 30px; font-weight: 650; font-size: 18px;">Note:</label>
                            <input type="text" class="form-control col-sm-9" id="">
                        </div> -->
                </td>
                <td colspan="2" class="text-center" style="padding-left: 75px;"><strong>Total money $<span class="total_all_cart"><?= $total_all_cart ?? 0; ?></span></strong></td>
                <td></td>
            </tr>
            <tr style="color: black;">
                <td colspan="2"><button onclick="location = '?controller=event&action=all';" class="btn btn-warning" style="font-weight: 600; padding: 12px 30px;"><i class="fa fa-angle-left"></i> Get more tickets</button></td>
                <td colspan="4"><button onclick="<?= isset($_SESSION['cus_id']) ? 'load_payment();' : 'redirect_login()'; ?>" class="btn btn-success" style="float: right; font-weight: 600; color: white; padding: 12px 32px;">Payment <i class="fa fa-angle-right"></i></button></td>
            </tr>
        </tfoot>
    </table>
<?php else : ?>
    <div class="col-md-12">
        <h3 class="text-center" style="width: 100%;">Your cart is empty.</h3>
        <div class="text-center"><a href="?controller=event&action=all" class="btn btn-warning text-center" style="font-weight: 600; font-size: 20px; margin-top: 12px; padding: 12px 16px;"><i class="fa fa-angle-left"></i> Get ticket</a></div>
    </div>
<?php endif; ?>