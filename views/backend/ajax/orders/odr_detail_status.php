<div class="col-md-5">
    <label class="bold-600">Status</label>
</div>
<div class="col-md-7 ordDetail-status">
    <span class=" bold-600 status_change_bg <?= $dataOrder['status'] == 0 ? 'disabled' : ''; ?>" onclick="FadeIn('.change_status_ord', 200)" status='<?= $dataOrder['status']; ?>'>
        <?php $s = $dataOrder['status'];
        echo $s == 0 ? 'Cancel' : ($s == 1 ? 'Unprocessed' : ($s == 2 ? 'Processing' : ($s == 3 ? 'Complete' : 'Cancel <sup>A</sup>'))); ?>
    </span>
    <div class="change_status_ord" style="display: none;">
        <div class="custom-control custom-radio custom-control-inline">
            <span>
                <input type="radio" class="custom-control-input status-item" value="-1" id="ord-Cancel" name="rad_sOrd" checked>
                <label class="custom-control-label" for="ord-Cancel">Cancel</label>
            </span>
            <span>
                <input type="radio" class="custom-control-input status-item" value="1" id="ord-Unprocessed" name="rad_sOrd">
                <label class="custom-control-label" for="ord-Unprocessed">Unprocessed</label>
            </span>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <span>
                <input type="radio" class="custom-control-input status-item" value="2" id="ord-Processing" name="rad_sOrd">
                <label class="custom-control-label" for="ord-Processing">Processing</label>
            </span>
            <span>
                <input type="radio" class="custom-control-input status-item" value="3" id="ord-Complete" name="rad_sOrd">
                <label class="custom-control-label" for="ord-Complete">Complete</label>
            </span>
        </div>

        <div class="text-center">
            <button onclick="udp_order_status(<?= $dataOrder['id'] ?? ''; ?>);" class="btn btn-success">Save</button>
        </div>
    </div>
</div>