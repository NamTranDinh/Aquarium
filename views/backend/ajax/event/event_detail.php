<div class="notice" id="notice"></div> 
<div class=" post_detail-all" >
    <div class="post_detail-head customer-act">
        <span id="act-title" class="act-title"><b onclick="load_event()">Event</b> / <i><?=$data['event_name']??'';?></i></span>
        <span>
            <button onclick="load_event()" class="btn btn-primary"><i class="fas fa-chevron-circle-left"></i><span>Back</span></button>
        </span>
    </div>
    <?php if(isset($data)): ?>
    <div class="post_dv_add-content" id="event-add_content">
        <button onclick="show_add_content_event(<?=$data['id'];?>, '<?=$data['event_name']?>')" class="btn btn-edit post_btn-add-content"><i class="fas fa-pencil-alt"></i><span>Add content</span></button>
    </div>
    <div class="post_detail-container">
        <div class="post_detail-top" id="event_detail" style="position: relative;height: 454px; display: flex; align-items: center; justify-content: center;"
                onmouseover="Show('.post_detail-btn');" onmouseout="Hide('.post_detail-btn');" >
            <button onclick="show_edit_detail_event('#event-edit')" class="btn btn-edit post_detail-btn" style="display: none;"><i class="fas fa-edit edit-item"></i><span>Edit</span></button>
            <img width="100%" height="100%" src="<?=$data['event_img']?>" alt="SHARKS!">
            <div class="post_detail-title">
                <div class="text text-light">
                    <h1><?=$data['event_name']?></h1>
                    <h5><?=$data['event_intro']?></h5>
                </div>
            </div>
        </div>

        <div class="grid post_detail-content" id="event_detail-content" >
            <div class="row">
                <div class="col-md-9">
                <?php 
                    if(count($description)>0):
                    foreach($description as $val):
                ?>
                    <div class="post_detail-des" 
                                    onmouseover="Show('.btn-edit-<?=$val['id']?>');
                                                Show('.btn-del-<?=$val['id']?>');" 
                                    onmouseout=" Hide('.btn-edit-<?=$val['id']?>');
                                                Hide('.btn-del-<?=$val['id']?>')">
                        <div class="post_detail-box-btn">
                            <button onclick="show_edit_content_event(<?=$val['id']?>, <?=$data['id'];?>)" class="btn btn-edit btn-edit-<?=$val['id']?>" style="display: none;"><i class="fas fa-edit edit-item"></i><span>&nbsp;Edit</span></button>
                            <button onclick="del_content_event(<?=$val['id'];?>,'<?=$val['des_name'];?>', <?=$data['id'];?>)" class="btn btn-edit btn-del-<?=$val['id']?>" style="display: none;"><i class="far fa-trash-alt delete-item"></i><span>&nbsp;Delete</span></button>
                        </div>
                        <div class="event_content-des" style='display: flex; '>
                            <div class="" style="width: <?=!empty($val['des_img'])?'70%':'100%';?>;">
                                <h2><?=$val['des_name']??'';?></h2>
                                <p style="font-size: 1.2rem;"><?=$val['des_content']??'';?></p>
                            </div>
                            <div style="display: <?php echo !empty($val['des_img'])?'flex':'none';?>; width: 30%;">
                                <img width="100%" src="<?=$val['des_img'];?>" >
                            </div>
                        </div>
                    </div>
                <?php 
                    endforeach;
                    else:
                ?>
                    <div class="post_detail-add">
                        <h3 style="text-align: center;">The event don't have content. Please add any content!</h3>
                        <button onclick="show_add_content_event(<?=$data['id'];?>, '<?=$data['event_name']?>')" class="btn btn-edit post_btn-add-content"><i class="fas fa-pencil-alt"></i> <span>Add new content</span></button>
                    </div>
                <?php endif; ?>
                </div>
                <div class="col-md-3" id="event_base">
                    <aside class="sideblock" onmouseover="Show('.event_detail-btn');" onmouseout="Hide('.event_detail-btn');" >
                        <div class="sideblock-wrap">
                            <div class="max-height-wrap">
                                <button onclick="show_edit_detail_event('#event_base-edit')" class="btn btn-edit event_detail-btn" ><i class="fas fa-edit edit-item"></i><span>&nbsp;Edit</span></button>
                                <header class="sideblock-header">
                                    <h3>Event Details</h3>
                                    <hr>
                                </header>
                                <div class="sideblock-sub-block">
                                    <span class="sideblock-thin-heading">Date &amp; Time</span> 
                                    <div class="sideblock-fatty">
                                        <p>Begin</p>
                                        <p><strong><?=date_format(date_create($data['time_start']), 'F j, Y, g:i a')?></strong></p>
                                    </div>
                                    <div class="sideblock-fatty">
                                        <p>End</p>
                                        <p><strong><?=date_format(date_create($data['time_end']), 'F j, Y, g:i a')?></strong></p><hr>
                                    </div>    
                                </div>
                                <div class="sideblock-sub-block">
                                    <span class="sideblock-thin-heading">Price</span>
                                    <div class="pricing-manual">
                                        <div>
                                            <p>General Admission: &nbsp;$<strong><?=$data['ticket_price']??'';?></strong></p>
                                            <p>VIP Admission: &nbsp;$<strong><?=$data['ticket_price']+20??'';?></strong><br></p><hr>
                                        </div>
                                    </div>
                                </div>
                                <div class="sideblock-sub-block"> <span class="sideblock-thin-heading">Location: </span> <strong><?=$data['locations']??'';?><hr></strong></div>
                                <footer class="sideblock-actions"> <button class="btn btn-default">Get Tickets</button></footer>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
        <h1 style="text-align: center;">No result found.</h1>
    <?php endif;?>

    <div class="overlay" id="event_overlay" style="display: none;"></div>
    <div class="modal-content event-editDetail" id="event-edit">
        <div class="modal-header st_addAccount-head">
            <h4 class="modal-title" style="text-transform: uppercase;"><i class="fas fa-list-ul"></i>Edit event detail</h4>
            <button onclick="hide_edit_detail_event('#event-edit');" type="button" class="close"><span>×</span></button>
        </div>
        <div class="modal-body grid">
            <form class="form-horizontal st_addAccount-frm">
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label>Event name</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" oninput="remove_error('.error-event_name')" value="<?=$data['event_name']??'';?>" class="form-control" id="event_inp-name" placeholder="Enter event name">
                        <span class="error-event_name _error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label class="event_lab-add">Event introduction</label>
                    </div>
                    <div class="col-sm-9">
                        <input oninput="remove_error('.intro-error')" class="form-control" id="event_inp-intro" placeholder="Enter article introduction" maxlength="200" value="<?=$data['event_intro']?>">
                        <span class="intro-error _error"></span>
                    </div>
                </div>
                <div class="form-group row">
                <form enctype="multipart/form-data" method="post">
                    <label class="event_lab-add col-md-3">Main photo</label>
                    <div class="input-group col-md-9">
                        <div class="input-group-prepend" style="height: 43px;">
                            <span class="input-group-text" id="event_upl_img">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input  oninput="remove_error('.file-error')" type="file" class="custom-file-input" id="event_inp-file" aria-describedby="event_upl_img" onchange="getFileName('#event_lab-file')">
                            <label class="custom-file-label" id="event_lab-file" for="event_inp-file" style="font-weight: normal;">Chose image to upload.</label>
                        </div>
                    </div>
                    <span class="file-error _error"></span>
                    <span style="display: block; margin: 12px; width: 100%;"></span>
                    <label class="event_lab-add col-md-3">Sub photo</label>
                    <div class="input-group col-md-9">
                        <div class="input-group-prepend" style="height: 43px;">
                            <span class="input-group-text" id="event_upl_sub_img">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input  oninput="remove_error('.subFile-error')" type="file" class="custom-file-input" id="eventSubFile" aria-describedby="event_upl_sub_img" onchange="getFileName('#event_lab-subFile')">
                            <label class="custom-file-label" id="event_lab-subFile" for="eventSubFile" style="font-weight: normal;">Chose image to upload.</label>
                        </div>
                    </div>
                    <span class="subFile-error _error"></span>
                </form>
                </div>
            </form>
        </div>
        <div class="modal-footer st_addAccount-footer">
            <button onclick="udp_event_detail(<?=$data['id'];?>);" type="button" class="btn btn-primary"><i class="fa fa-check"></i> <span>Save</span></button>
            <button onclick="hide_edit_detail_event('#event-edit');" type="button" class="btn btn-default post_cate_btn" data-dismiss="modal"><i class="fa fa-undo"></i> <span>Return</span></button>
        </div>
    </div>

    <div class="modal-content event_base-edit" id="event_base-edit" >
        <div class="modal-header st_addAccount-head">
            <h4 class="modal-title" style="text-transform: uppercase;"><i class="fas fa-list-ul"></i>Edit event detail</h4>
            <button onclick="hide_edit_detail_event('#event_base-edit');" type="button" class="close"><span>×</span></button>
        </div>
        <div class="modal-body grid" >
            <form class="form-horizontal st_addAccount-frm">
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label>Event locations</label>
                    </div>
                    <div class="col-sm-9">
                        <input oninput="remove_error('.locations-error')" value="<?=$data['locations'];?>" type="text" id="location" class="form-control" placeholder="Enter event locations">
                        <span class="locations-error _error"></span>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label class="event_lab-add">Date start</label>
                    </div>
                    <div class="col-md-9 row" style="padding: 0; margin-left: -1px; ">
                        <div class="col-md-8">
                            <input oninput="remove_error('.dayStart-error')" value="<?=date_format(date_create($data['time_start']), 'd/m/Y')??'';?>" type="text" id="dayStart" class="form-control datepicker" maxlength="10" placeholder="Enter date start">
                            <span class="dayStart-error _error"></span>
                        </div>
                        <div class="col-md-4">
                            <input oninput="remove_error('.timeStart-error');" value="<?=date_format(date_create($data['time_start']), 'H:i')??'';?>" type="text" id="timeStart" class="form-control timepicker" maxlength="5" placeholder="time">
                            <span class="timeStart-error _error"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label class="event_lab-add">Date end</label>
                    </div>
                    <div class="col-md-9 row" style="padding: 0; margin-left: -1px; ">
                        <div class="col-md-8">
                            <input oninput="remove_error('.dayEnd-error')" value="<?=date_format(date_create($data['time_end']), 'd/m/Y')??'';?>" type="text" id="dayEnd" class="form-control datepicker" maxlength="10" placeholder="Enter date end">
                            <span class="dayEnd-error _error"></span>
                        </div>
                        <div class="col-md-4">
                            <input oninput="remove_error('.timeEnd-error');" value="<?=date_format(date_create($data['time_end']), 'H:i')??'';?>" type="text" id="timeEnd" class="form-control timepicker" maxlength="5" placeholder="time">
                            <span class="timeEnd-error _error"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label>Ticket Price</label>
                    </div>
                    <div class="col-sm-9">
                        <input oninput="remove_error('.tkPrice-error')" value="<?=$data['ticket_price'];?>" type="text"id="tkPrice" class="form-control" placeholder="Enter ticket price">
                        <span class="tkPrice-error _error"></span>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer st_addAccount-footer">
            <button onclick="udp_event_detail_base(<?=$data['id'];?>);" type="button" class="btn btn-primary"><i class="fa fa-check"></i> <span>Save</span></button>
            <button onclick="hide_edit_detail_event('#event_base-edit');" type="button" class="btn btn-default post_cate_btn" data-dismiss="modal"><i class="fa fa-undo"></i> <span>Return</span></button>
        </div>
    </div>

</div>