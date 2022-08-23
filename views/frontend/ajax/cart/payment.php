<div class="row title">
    <h1>Payment</h1>
</div>

<div class="row" style="justify-content: flex-end; margin-bottom: 12px;">
    <button type="button" id="address" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add_address" style="margin-left: 16px;">Change address</button>
</div>

<!-- Modal -->
<div class="change_info">
    <div class="modal fade" id="add_address" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document" style="margin-top: 180px; max-width: 540px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="text-transform: uppercase;"><i class="far fa-address-card"></i>&nbsp;<span>Add address</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal__address">
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="name">Name</label>
                        </div>
                        <div class="col-sm-9">
                            <input oninput="remove_error('.name-error');" type="text" class="form-control" id="name" placeholder="Enter your name" value="<?= $data_info['cus_name'] ?? ''; ?>">
                            <span class="name-error _error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="phone">Phone</label>
                        </div>
                        <div class="col-sm-9">
                            <input oninput="remove_error('.phone-error');" type="text" class="form-control" id="phone" placeholder="Enter your phone" value="<?= $data_info['phone'] ?? ''; ?>">
                            <span class="phone-error _error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="address">Address</label>
                        </div>
                        <div class="col-sm-9">
                            <textarea oninput="remove_error('.address-error');" type="text" class="form-control" id="address" placeholder="Enter your address" style="max-height: 100px; min-height: 60px;"><?= $data_info['address'] ?? ''; ?></textarea>
                            <span class="address-error _error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="gender">Gender</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="radio" name="gender" class="gender" value="0" id="gender1" <?= $data_info['gender'] == 0 ? 'checked' : ''; ?>><label for="gender1">&nbsp;Male</label>&nbsp;
                            <input type="radio" name="gender" class="gender" value="1" id="gender2" <?= $data_info['gender'] == 1 ? 'checked' : ''; ?>><label for="gender2">&nbsp;Female</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="change_address_payment()" type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="close-model btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr style="font-size: 18px;">
                <th style="width:45%">Event Name</th>
                <th style="width:12%" class="text-center">Type</th>
                <th style="width:12%" class="text-center">Price</th>
                <th style="width:13%" class="text-center">Number</th>
                <th style="width:18%" class="text-center">Total money</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $total_all_cart = 0;
            foreach ($data as $value) :
                if (!is_array($_SESSION['cart'][$value['id']])) unset($_SESSION['cart'][$value['id']]);
                foreach ($_SESSION['cart'][$value['id']] as $type => $val) :
                    $i++;
                    $total_all_cart += $val['price'] * $val['number']; ?>
                    <tr class="cart-item">
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
                        <td data-th="Quantity" class="text-center"><?= $val['number']; ?></td>
                        <td data-th="Subtotal" class="text-center">$<span class="total_money total_money-<?= $i - 1 ?>"><?= $val['price'] * $val['number']; ?></span></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-sm-5">
                            <label for="" class="text-center" style="line-height: 30px; font-weight: 650; font-size: 18px;">Payment methods:</label>
                        </div>
                        <div class="col-sm-7">
                            <select name="" id="pay_method" class="form-control">
                                <?php foreach ($method_pay as $val) : ?>
                                    <option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </td>
                <td colspan="2"></td>
                <td colspan="2" class="text-center" style="padding-left: 75px;"><strong>Total money $<span class="total_all_cart"><?= $total_all_cart ?? 0; ?></span></strong></td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="" class="text-center" style="line-height: 30px; font-weight: 650; font-size: 18px;">Note:</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="note" placeholder="Enter note">
                        </div>
                    </div>
                </td>
                <td colspan="10">
                    <button onclick="order_ticket();" class="btn btn-warning btn-lg" style="float: right; margin-right: -15px; display: block;">Order now</button>
                    <button onclick="load_cart();" type="button" class="btn btn-secondary btn-lg" style="float: right; margin-right: 15px;">Return</button>
                </td>
            </tr>
        </tfoot>
    </table>
</div>


<?php if ($check_info) : ?>
<script>
    $(function() {
        $('#address').trigger('click');
        setTimeout(function() {
            change_address_payment(1)
        }, 600)
    })
</script>
<?php endif; ?>