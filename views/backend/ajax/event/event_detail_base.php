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