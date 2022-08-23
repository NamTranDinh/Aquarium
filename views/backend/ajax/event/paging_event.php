<?php if(!empty($data)):?>
<div class="table-responsive">
    <table class="table table-hover table-user table-striped setting_table">
        <thead class="setting_thead">
            <tr>
                <th class="text-center" style="width: 4%;">STT</th>
                <th>Event code</th>
                <th>Event Name</th>
                <th class="text-center" style="width: 8%;">Ticket Num</th>
                <th class="text-center" style="width: 8%;">Ticket Price</th>
                <th class="text-center" style="width: 13%;">Time Start</th>
                <th class="text-center" style="width: 13%;">Time End</th>
                <th style="width: 12%;">Locations</th>
                <th class="text-center" style="width: 10%;">Status</th>
                <th class="text-center" style="width: 8%;"></th> 
            </tr>
        </thead>

        <tbody class="setting_tbody" id="">
            <?php
                $i=0;
                foreach($data as $val):
                $i++;
                $stt = $i+(($paging_event->page-1)*$paging_event->limit);
                ?>
            <tr class="tr-item-<?=$stt??$i;?>" style="display: table-row;">
                <td class="text-center"><?=$stt??$i;?></td>
                <td><button onclick="show_detail_event(<?=$val['id']??''?>)" class="btn post_btn-name"><?=$val['event_code']??'';?></button></td>
                <td><button onclick="show_detail_event(<?=$val['id']??''?>)" class="btn post_btn-name"><?=$val['event_name']??'';?></button></td>
                <td class="text-center"><?=$val['ticket_num']??'';?></td>
                <td class="text-center"><?=$val['ticket_price']??'';?>$</td>
                <td class="text-center"><?=date_format(date_create($val['time_start']), 'H:i d/m/Y')??'';?></td>
                <td class="text-center"><?=date_format(date_create($val['time_end']), 'H:i d/m/Y')??'';?></td>
                <td><?=$val['locations']??'';?></td>
                <td class="text-center"><span class="user_status"><i class="fa fa-<?=$val['status']==0 ? 'lock': 'unlock';?>"></i> <span><?=$val['status']==0 ? 'Locked': 'Active';?></span></span></td>
                <td class="text-center" style="padding: 0;">
                    <button onclick="toggle_edit_event(<?=$stt??$i?>, 'show');" class="btn btn-default"><i class="fas fa-edit edit-item" title="Edit"></i></button>
                    <button onclick="del_event(<?=$val['id']?>, '<?=$val['event_name']?>');" class="btn btn-default" ><i title="Delete" class="far fa-trash-alt delete-item"></i></button>
                </td>
            </tr> 
            <tr class="tr-edit-item-<?=$stt??$i;?>" style="display: none;">
                <td class="text-center"><?=$stt??$i;?></td>
                <td class="text-center"><?=$val['event_code'];?></td>
                <td><input type="text" class="form-control" id="event_inp-name-<?=$val['id'];?>" value="<?=$val['event_name']?>"></td>
                <td class="text-center"><input type="text"  value="<?=$val['ticket_num']?>" class="form-control text-center" id="event_inp-ticket_num-<?=$val['id'];?>"></td>
                <td class="text-center"><input type="text"  value="<?=$val['ticket_price']?>" class="form-control text-center" id="event_inp-ticket_price-<?=$val['id'];?>"></td>
                <td class="text-center" style="padding: 6px 3px;">
                    <div class="event_choseTime">
                        <input type="text"  value="<?=date_format(date_create($val['time_start']), 'd/m/Y')??'';?>" class="datepicker form-control" id="event_inp-dStart-<?=$val['id'];?>" maxlength="10">
                        <input type="text"  value="<?=date_format(date_create($val['time_start']), 'H:i')??'';?>" class="timepicker form-control" id="event_inp-tStart-<?=$val['id'];?>" maxlength="5">
                    </div>
                </td>
                <td class="text-center" style="padding: 6px 3px;">
                    <div class="event_choseTime">
                        <input type="text"  value="<?=date_format(date_create($val['time_end']), 'd/m/Y')??'';?>" class="datepicker form-control" id="event_inp-dEnd-<?=$val['id'];?>" maxlength="10">
                        <input type="text"  value="<?=date_format(date_create($val['time_end']), 'H:i')??'';?>" class="timepicker form-control" id="event_inp-tEnd-<?=$val['id'];?>" maxlength="5">
                    </div>
                </td>
                <td><input type="text" class="form-control" id="event_inp-locations-<?=$val['id'];?>" value="<?=$val['locations']?>"></td>
                <td class="text-center" style="padding: 0 12px;"> 
                    <select class="form-control" id="event_inp-status-<?=$val['id'];?>">
                        <option value="1" selected="selected">Active</option>
                        <option value="0">Locked</option>
                    </select> 
                </td>
                <td class="text-center st_btn" style="padding: 0;">
                    <button onclick="udp_event_base(<?=$val['id'];?>);" class="btn btn-default"><i class="fas fa-save" title="Save" style="color: #EC971F;"></i></button>
                    <button onclick="toggle_edit_event(<?=$stt??$i?>, 'hide');" class="btn btn-default"><i class="fa fa-undo" title="Return" style="color: green;"></i></button>
                </td>
            </tr> 
            <?php endforeach;?>
        </tbody>
    </table>  
    <?php if($paging_event && $paging_event->total_page>1):?>
    <div style="margin-bottom: 1rem;">
        <?php $paging_event->getPage('ajax', 'page_event');?>
    </div>
    <?php endif;?>
    <input type="hidden" id="page-event" value="<?=$paging_event->page??1;?>">
</div>
<?php elseif(isset($isSearch)):?>
    <div style="display: flex; justify-content: center;margin: 32px;">
        <h2>No search results<?=$search!=''?" for '$search'":''?> ! </h2>
    </div>
<?php else:?>
    <div style="display: flex; justify-content: center;margin: 32px;">
        <h2>No events listed!&nbsp;&nbsp;</h2>
        <button onclick="Hide('#event-main');Show('#event-add')" class="btn btn-info"><i class="fas fa-pencil-alt"></i> <span>Add new event</span></button>                
    </div>
<?php endif;?>