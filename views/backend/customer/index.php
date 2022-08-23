<div class="customer_container">
    <div class="notice" id="notice"></div>
    <div id="customer-main" >
        <div class="customer-act" style="justify-content: left;">
            <span id="act-title">Customers</span>
            <div class="col-md-10 order-radio" style="font-size: 16px;">
                <b style="margin-left: 8px;">&nbsp;&nbsp;Order by:&nbsp;&nbsp;</b>
                <div class="custom-control custom-radio custom-control-inline">
                    <input oninput="cus_paging()" type="radio" class="custom-control-input rad-cus_sOrd" value="normal" id="cus-sNormal" name="rad_sCus" checked>
                    <label class="custom-control-label" for="cus-sNormal">Normal</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input oninput="cus_paging()" type="radio" class="custom-control-input rad-cus_sOrd" value="lastBuy" id="cus-sLastBuy" name="rad_sCus">
                    <label class="custom-control-label" for="cus-sLastBuy">Last purchase</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input oninput="cus_paging()" type="radio" class="custom-control-input rad-cus_sOrd" value="total" id="cus-sTotalMoney" name="rad_sCus">
                    <label class="custom-control-label" for="cus-sTotalMoney">Total money</label>
                </div>
                <span style="padding: 16px 8px; border-left: #d2b793 3px solid;"></span>
                <div class="custom-control custom-radio custom-control-inline">
                    <input oninput="cus_paging()" type="radio" class="custom-control-input rad-cus_sADesc" value="asc" id="cus-sAsc" name="ord_sCus" checked>
                    <label class="custom-control-label" for="cus-sAsc">Asc</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input oninput="cus_paging()" type="radio" class="custom-control-input rad-cus_sADesc" value="desc" id="cus-sDesc" name="ord_sCus">
                    <label class="custom-control-label" for="cus-sDesc">Desc</label>
                </div>
            </div>
        </div>
        <div class="cus_search row no-gutters">
            <div class="col-md-3 event_sCus">
                <input onkeyup="cus_paging();" id="inp-sCus-text" type="text" class="form-control" placeholder="Enter customer name, phone or email" style="padding-right: 46px;">
                <input onclick="cus_paging();" id="ckb-sCus-type" class="ckb-sCus" type="checkbox" title="Search by characters" >
            </div>
            <div class="col-md-2">
                <select oninput="cus_paging();" id="sel-sCus" class="form-control sel-sCus select">
                    <option value="-1" selected> -------- All --------</option>
                    <option value="1" >Buy at least once</option>
                    <option value="2" >Never purchased</option>
                    <option value="3" >Account active</option>
                    <option value="4" >Account locked</option>
                </select>
            </div>
            <div class="col-md-2" style="margin-left: 15px;">
                <div class="cus_sBtn">
                    <button id="btn-sEvent" type="button" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                </div>
            </div>
        </div>

        <div class="panel panel-success setting_panel" id="setting_panel-cus">
            <div class="panel-heading setting_panel-head">
                <span><i class="fa fa-user"></i> <span>Customer</span></span>
                <span><button onclick="show_cre_cus();" class="btn btn-success btn-sm "><i class="fas fa-pencil-alt"></i> <span>Add new customer</span></button></span>
            </div>
            <div class="panel-body setting_panel-body" id="cus_table">
                <div class="table-responsive">
                    <table class="table table-hover table-user table-striped setting_table" style="margin-bottom: 0;">
                        <thead class="setting_thead">
                            <tr>
                                <th class="text-center" style="width: 5%;">STT</th>
                                <th class="text-center">Customer code</th>
                                <th class="text-center">Name</th>
                                <th>User name</th>
                                <th>Email</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Last purchase</th>
                                <th class="text-right">Total money</th>
                                <th class="text-center">Status</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody class="setting_tbody" id="cus_tbody">
                            <?php 
                            if(!empty($data)):
                                $i=0;
                                $total_money = 0;
                                foreach($data as $val):
                                $i++;
                                $stt = $i+(($paging_cus->page-1)*$paging_cus->limit);
                                $total_money += $val['total_money'];
                            ?>
                            <tr style="display: table-row;">
                                <td class="text-center"><?=$stt??$i?></td>
                                <td class="text-center"><button onclick="show_detail_cus(<?=$val['id']?>);" class="btn btn-default cus_btn-name"><?=$val['customer_code']??'';?></button></td>
                                <td class="text-center"><button onclick="show_detail_cus(<?=$val['id']?>);" class="btn btn-default cus_btn-name"><?=$val['cus_name']??'';?></button></td>
                                <td><?=$val['username']??'';?></td>
                                <td><?=$val['email']??'-';?></td>
                                <td class="text-center"><?=$val['phone']??'';?></td>
                                <td class="text-center"><?=$val['last_purchase'] != NULL ? date_format(date_create($val['last_purchase']), 'H:i d/m/Y') : '-';?></td>
                                <td class="text-right"><?=isset($val['total_money'])?'<b>'.$val['total_money'].'</b>$':'-';?></td>
                                <td class="text-center"><span class="user_status"><i class="fa fa-<?=$val['status']==0 ? 'lock': 'unlock';?>"></i> <span><?=$val['status']==0 ? 'Locked': 'Active';?></span></span></td>
                                <td class="text-center cus_btn" style="padding: 0;">
                                    <button onclick="udp_cus_status(<?=$val['id'];?>, <?=$val['status'];?>)" class="btn btn-default" >
                                    <?php if($val['status']==1):?>
                                        <i title="Lock  " class="fas fa-user-lock"></i>
                                    <?php else:?>
                                        <i title="Unlock" class="fas fa-unlock"></i>
                                    <?php endif;?>
                                    </button>
                                    <button onclick="del_cus(<?=$val['id'];?>, '<?=$val['cus_name'];?>');" class="btn btn-default" ><i title="Delete" class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        <?php else:?>
                            <tr class="no-bg">
                                <td colspan="10" ><h6 class="text-center">No have data!</h6></td>
                            </tr>
                        <?php endif;?>
                            <tr class="no-bg">
                                <td colspan="10" style="padding: 0;">
                                    <div class="alert alert-info ">
                                        <div class=" sm-info ">
                                            Number customers: <span style="color: red;"><b><?=$num_customers?></b></span>&nbsp;&nbsp;
                                            Total in page: <span style="color: red;"><b><?=isset($total_money) && $total_money>0? $total_money.'$': 0;?></b></span>&nbsp;&nbsp;
                                            Total money( all ): <span style="color: red;"><b><?=$total_all>0?$total_all.'$':0?></b></span>
                                        </div>
                                    </div>
                                    <?php if($paging_cus->total_page>1):?>
                                    <div style="margin-bottom: 1rem;">
                                        <?php $paging_cus->getPage('ajax', 'cus_page');?>
                                    </div>
                                    <?php endif;?>
                                    <input type="hidden" name="" id="cus_page" value="<?=$paging_cus->page??1;?>">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
            </div>        
        </div>
    </div>
    <div class="overlay" id="overlay" style="display: none;"></div>
    <div class="modal-content cre_customer" id="cre_cus-box">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Create new customer</h4>
            <button onclick="hide_cre_cus()" type="button" class="close"><span>×</span></button>
        </div>
        <div class="modal-body grid frm-crcust">
            <form class="form-horizontal" id="frm-crcust">
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="customer_userName">User name*</label>
                    </div>
                    <div class="col-sm-9">
                        <input oninput="remove_error('.error-userName');" type="text" id="customer_userName" name="customer_userName" class="form-control" value="" placeholder="Enter user name">
                        <span class="error-userName _error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="customer_pass">Password*</label>
                    </div>
                    <div class="col-sm-9">
                        <input oninput="remove_error('.error-pass');" type="password" id="customer_pass" name="customer_pass" class="form-control" value="" placeholder="Enter password">
                        <span class="error-pass _error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="customer_name">Customer name*</label>
                    </div>
                    <div class="col-sm-9">
                        <input oninput="remove_error('.error-name');" type="text" id="customer_name" name="customer_name" class="form-control" value="" placeholder="Enter customer name">
                        <span class="error-name _error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="customer_phone">Phone*</label>
                    </div>
                    <div class="col-sm-9">
                        <input oninput="remove_error('.error-phone');" type="text" id="customer_phone" name="customer_phone" class="form-control" value="" placeholder="Enter phone number">
                        <span class="error-phone _error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="customer_email">Email*</label>
                    </div>
                    <div class="col-sm-9">
                        <input oninput="remove_error('.error-email');" type="text" id="customer_email" name="customer_email" class="form-control" value="" placeholder="Enter email (abc@gmail.com)">
                        <span class="error-email _error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="customer_addr">Address</label>
                    </div>
                    <div class="col-sm-9">
                        <input oninput="remove_error('.error-addr');" type="text" id="customer_addr" name="customer_addr" class="form-control" value="" placeholder="Enter address">
                        <span class="error-addr _error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="customer_dateBirth">Date birth</label>
                    </div>
                    <div class="col-sm-9">
                        <input oninput="remove_error('.error-dateBirth');" type="text" id="customer_dateBirth" name="customer_dateBirth" class="form-control customer_birthday" value="" placeholder="dd-mm-yyyy">
                        <span class="error-dateBirth _error"></span>
                    </div>
                    <script>$('.customer_birthday').datepicker({format: "dd/mm/yyyy"});</script>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="customer_gender">Gender</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="radio" name="gender" checked="" class="customer_gender" value="0"> Male
                        <input type="radio" name="gender" class="customer_gender" value="1"> Female
                        <span class="error-gender _error"></span>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button onclick="cre_cus()" type="button" class="btn btn-primary btn-sm btn-crcust"><i class="fa fa-check"></i> Save</button>
            <button onclick="hide_cre_cus()" type="button" class="btn btn-default btn-sm btn-close"><i class="fa fa-undo"></i> Return</button>
        </div>
    </div>
</div>

 