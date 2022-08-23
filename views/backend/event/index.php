<div class="event_container">
    <div class="notice" id="event_notice"></div>
    <div id="event-main" >
        <div class="customer-act">
            <span id="act-title">Event</span>
            <span>
                <button onclick="Hide('#event-main');Show('#event-add')" class="btn btn-info"><i class="fas fa-pencil-alt"></i> <span>Add new event</span></button>                
            </span>
        </div>
        <div class="event_search row no-gutter">
            <div class="col-md-3 event_sName">
                <input onkeyup="event_paging();" id="inp-sEvent" type="text" class="form-control" placeholder="Enter event name" style="padding-right: 32px;">
                <input onclick="event_paging();" value="1" type="checkbox" id="ckb-sEvent" title="Search by characters" class="ckb-sEvent">
            </div>
            <div class="col-md-1" style="padding: 0;">
                <select oninput="event_paging();" id="sel-sEvent-minPrice" class="form-control" selected>
                    <option value="-1">Min price</option>
                    <option value="25"> 25$ </option>
                    <option value="50"> 50$ </option>
                    <option value="75"> 75$ </option>
                    <option value="75"> 100$ </option>
                </select>
            </div>
            <div class="col-md-1" style="padding: 0;">
                <select oninput="event_paging();" id="sel-sEvent-maxPrice" class="form-control" selected>
                    <option value="-1">Max price</option>
                    <option value="150"> 150$ </option>
                    <option value="200"> 200$ </option>
                    <option value="500"> 500$ </option>
                    <option value="1000"> 1000$ </option>
                </select>
            </div>
            <div class="col-md-7 row">
                <div class="col-md-7 event_sDate">
                    <div class="event_sDate-item">
                        <input oninput="event_paging();" type="text" class="datepicker form-control" placeholder="Start " id="inp-sStartDate">
                    </div>
                    <div class="event_date-gr">to</div>
                    <div class="event_sDate-item">
                        <input oninput="event_paging();" type="text" class="datepicker form-control" placeholder="End " id="inp-sEndDate">
                    </div>
                </div>
                <div class="col-md-5 order-radio" style="padding: 0;">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input oninput="event_paging();" type="radio" class="custom-control-input rad-event_sADesc" value="asc" id="ord-sAsc" name="sADesc" checked>
                        <label class="custom-control-label" for="ord-sAsc">Asc</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input oninput="event_paging();" type="radio" class="custom-control-input rad-event_sADesc" value="desc" id="ord-sDesc" name="sADesc">
                        <label class="custom-control-label" for="ord-sDesc">Desc</label>
                    </div>
                    <div>
                        <button id="btn-sEvent" type="button" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>
            </div>
            
        </div>
 
        <div class="panel panel-success" id="">
            <div class="panel-body setting_panel-body" id="event_table">
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
                <?php else:?>
                    <div style="display: flex; justify-content: center;margin: 32px;">
                        <h2>No events listed!&nbsp;&nbsp;</h2>
                        <button onclick="Hide('#event-main');Show('#event-add')" class="btn btn-info"><i class="fas fa-pencil-alt"></i> <span>Add new event</span></button>                
                    </div>
                <?php endif;?>
            </div>  
        </div>
    </div>

    <div id="event-add" style="display: none;">
        <div class="customer-act">
            <span id="act-title">Add new event</span>
            <span>
                <button onclick="cre_event()" class="btn btn-info" id="event_add-save"><i class="fas fa-pencil-alt"></i> <span>Save</span></button>
                <button onclick="Show('#event-main');Hide('#event-add')" class="btn btn-primary"><i class="fas fa-chevron-circle-left"></i><span>Back</span></button>
            </span>
        </div>
        
        <div class="grid">
            <div class="row" style="display: flex; justify-content: center; margin-top: 5rem;">
                <div class="col-md-7">
                    <div class="form-group row">
                        <div class="col-md-7">
                            <label class="event_lab-add">Event name</label>
                            <input oninput="remove_error('.name-error')" type="text" id="name" class="form-control" placeholder="Enter event name">
                            <span class="name-error _error"></span>
                        </div>
                        <div class="col-md-5 row no-gutters">
                            <div class="col-md-6">
                                <label class="event_lab-add">Date start</label>
                                <input oninput="remove_error('.dayStart-error')" type="text" id="dayStart" class="form-control datepicker" maxlength="10" placeholder="Enter date start">
                                <span class="dayStart-error _error"></span>
                            </div>
                            <div class="col-md-6" style="padding: 0; margin-left: -1px; ">
                                <label class="event_lab-add">Time</label>
                                <input oninput="remove_error('.timeStart-error');" type="text" id="timeStart" class="form-control timepicker" maxlength="5" placeholder="time" value="07:00">
                                <span class="timeStart-error _error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-7">
                            <label class="event_lab-add">Event locations</label>
                            <input oninput="remove_error('.locations-error')" type="text" id="location" class="form-control" placeholder="Enter event locations">
                            <span class="locations-error _error"></span>
                        </div>
                        <div class="col-md-5 row no-gutters">
                            <div class="col-md-6">
                                <label class="event_lab-add">Date end</label>
                                <input oninput="remove_error('.dayEnd-error')" type="text" id="dayEnd" class="form-control datepicker" maxlength="10" placeholder="Enter date end">
                                <span class="dayEnd-error _error"></span>
                            </div>
                            <div class="col-md-6" style="padding: 0; margin-left: -1px;">
                                <label class="event_lab-add">Time</label>
                                <input onblur="remove_error('.timeEnd-error');" type="text" id="timeEnd" class="form-control timepicker" maxlength="5" placeholder="time" value="20:00">
                                <span class="timeEnd-error _error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-7" class="event_add-inp-file">
                        <form enctype="multipart/form-data" method="post">
                            <label class="event_lab-add">Main photo</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="event_upl_img"><i class="fas fa-upload"></i></span>
                                </div>
                                <div class="custom-file">
                                    <input  oninput="remove_error('.file-error')" type="file" class="custom-file-input" id="eventFile" aria-describedby="event_upl_img" onchange="getFileName('#event_lab-file')">
                                    <label class="custom-file-label" id="event_lab-file" for="eventFile">Chose image to upload.</label>
                                </div>
                            </div>
                            <span class="file-error _error"></span>
                        </form>
                        </div>
                        <div class="col-md-5">
                            <label class="event_lab-add">Ticket Number</label>
                            <input oninput="remove_error('.tkNum-error')" type="text"id="tkNum" class="form-control" placeholder="Enter ticket number">
                            <span class="tkNum-error _error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-7">
                            <form enctype="multipart/form-data" method="post">
                                <label class="event_lab-add">Sub photo</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="event_upl_sub_img"><i class="fas fa-upload"></i></span>
                                    </div>
                                    <div class="custom-file">
                                        <input  oninput="remove_error('.subFile-error')" type="file" class="custom-file-input" id="eventSubFile" aria-describedby="event_upl_sub_img" onchange="getFileName('#event_lab-subFile')">
                                        <label class="custom-file-label" id="event_lab-subFile" for="eventSubFile">Chose image to upload.</label>
                                    </div>
                                </div>
                                <span class="subFile-error _error"></span>
                            </form>
                        </div>
                        <div class="col-md-5">
                            <label class="event_lab-add">Ticket Price</label>
                            <input oninput="remove_error('.tkPrice-error')" type="text" id="tkPrice" class="form-control" placeholder="Enter ticket price">
                            <span class="tkPrice-error _error"></span>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <div class="col-md-7">
                            <label class="event_lab-add">Event introduction</label>
                            <input oninput="remove_error('.intro-error')" class="form-control" id="intro" placeholder="Enter article introduction" maxlength="200"></input>
                            <span class="intro-error _error"></span>
                        </div>
                        <div class="col-md-5" style="display: flex; justify-content: center; align-items: flex-end;">
                            <button onclick="cre_event()" class="btn btn-success event_btn-save" style="width: 200px; font-size: 1.2rem;">Save</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
