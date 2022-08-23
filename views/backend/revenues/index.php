<div class="revenue_container">
    <div class="notice" id="notice"></div>
    <div id="revenue-main">
        <div class="customer-act orders-act">
            <span id="act-title">Report Revenue</span>
            <div class="col-md-10 order-radio" style="font-size: 16px;">
                <div class="custom-control custom-radio custom-control-inline">
                    <input onclick="revenue_paging();" type="radio" class="custom-control-input rev-classify" value="1" id="rev-summary" name="classify" checked>
                    <label class="custom-control-label" for="rev-summary">Summary report</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input onclick="revenue_paging();" type="radio" class="custom-control-input rev-classify" value="2" id="rev-customer" name="classify">
                    <label class="custom-control-label" for="rev-customer">According to customer</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input onclick="revenue_paging();" type="radio" class="custom-control-input rev-classify" value="3" id="rev-commodities" name="classify">
                    <label class="custom-control-label" for="rev-commodities">According commodities</label>
                </div>
                <span style="padding: 16px 8px; border-left: #d2b793 3px solid;"></span>
                <div class="custom-control custom-radio custom-control-inline">
                    <input oninput="revenue_paging()" type="radio" class="custom-control-input rev-sADesc" value="asc" id="rev-sAsc" name="rev_sOrd" checked>
                    <label class="custom-control-label" for="rev-sAsc">Asc</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input oninput="revenue_paging()" type="radio" class="custom-control-input rev-sADesc" value="desc" id="rev-sDesc" name="rev_sOrd">
                    <label class="custom-control-label" for="rev-sDesc">Desc</label>
                </div>
            </div>
        </div>

        <div class="product-sear panel-sear row no-gutters" style="margin-top: 32px;">
            <div class="form-group col-md-4 pad-0">
                <input onkeyup="revenue_paging()" id="inp-sRev-text" class="form-control" type="text" placeholder="Enter order code, cus name, method pay to search" style="padding-right: 46px;">
                <input onclick="revenue_paging()" id="ckb-sRev-type" class="ckb-sCus" type="checkbox" title="Search by characters">
            </div>
            <div class="form-group col-md-8 pad-0 row" style="padding-left: 5px; margin-left: 0; ">
                <div class="col-md-8 row">
                    <div class="col-md-9 pad-0" style="display: flex;">
                        <div class="event_sDate-item">
                            <input oninput="revenue_paging();" type="text" class="datepicker form-control" placeholder="Start " id="search-date-from">
                        </div>
                        <div class="event_date-gr">to</div>
                        <div class="event_sDate-item">
                            <input oninput="revenue_paging();" type="text" class="datepicker form-control" placeholder="End " id="search-date-to">
                        </div>
                    </div>
                    <div class="col-md-3 pad-0">
                        <button onclick="revenue_paging();" style="width: 100%; font-size: 14px; height: 38px; padding: 3px 6px;" type="button" class="btn btn-primary "><i class="fa fa-search"></i> Tìm kiếm</button>
                    </div>
                </div>
                <div class="col-md-4 pad-0" style="display: flex; justify-content: center;">
                    <div class="btn-group order-btn-calendar">
                        <button type="button" onclick="set_current_week()" class="btn btn-default">Week</button>
                        <button type="button" onclick="set_current_month()" class="btn btn-default">Month</button>
                        <button type="button" onclick="set_current_quarter()" class="btn btn-default">Quarter</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="revenue-body" style="margin-bottom: 100px;">
            
        </div>

    </div>
</div>