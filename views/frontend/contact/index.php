<div class="contact">
    <div class="ctc">
        <div class="row title">
            <h1 style="margin-top: -12px;">Contact</h1>
            <div class="col-md-8">
                <div class="form-group row" style="display: flex; flex-direction: column; align-items: center;">
                    <div class="col">
                        <!-- <h1 style="text-align: center; font-size: 42px; margin-bottom: 16px;">Contact</h1> -->
                        <p style="font-size: 18px;">If you can’t find the information you are looking and need quick help, please contact me!</br> 
                            Please use the contact form below to send me an email. I usually respond within 24 hours to all emails.
                        </p>
                    </div>
                </div>
                <div id="add-contact">
                    <form action="?controller=contact&action=InsertData" enctype="multipart/form-data" method="post">
                        <div class="form-group row" style="display: flex; flex-direction: column; align-items: center;">
                            <div class="col">
                                <label class="">Name: <span style="color: red;">(required)</span></label>
                                <input class="form-control" type="text" name="name" placeholder="Your name" required>
                            </div>
                        </div>
                        <div class="form-group row" style="display: flex; flex-direction: column; align-items: center;">
                            <div class="col">
                                <label class="">Email: <span style="color: red;">(required)</span></label>
                                <input class="form-control" type="text" name="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group row" style="display: flex; flex-direction: column; align-items: center;">
                            <div class="col">
                                <label class="">Title: <span style="color: red;">(required)</span></label>
                                <input class="form-control" type="text" name="title" placeholder="Title" required>
                            </div>
                        </div>
                        <div class="form-group row" style="display: flex; flex-direction: column; align-items: center;">
                            <div class="col">
                                <label class="">Your Message: <span style="color: red;">(required)</span></label>
                                <textarea rows="8" class="form-control" name="content" placeholder="Content" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row" style="display: flex; flex-direction: column; align-items: center;">
                            <div class="col">
                                <label class="event_lab-add">Image</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="contact_upl"><i class="fas fa-upload"></i></span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="contactFile" class="custom-file-input" id="contactFile" aria-describedby="contact_upl" onchange="getFileName('#contact_lab-file')">
                                        <label class="custom-file-label" id="contact_lab-file" for="contactFile">Chose image to upload.</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" style="display: flex; flex-direction: column; align-items: center;">
                            <div class="col" style="text-align: center;">
                                <button style=" width: 180px; font-size: 1.55rem;font-weight:bold" class="btn btn-success" name="sub"><i class="fas fa-pencil-alt"></i> <span>Send</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <iframe style="margin-top: 150px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.926558422217!2d105.8167619152306!3d21.03562438599468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab0d6e603741%3A0x208a848932ac2109!2sAptech%20Computer%20Education!5e0!3m2!1svi!2s!4v1623168796800!5m2!1svi!2s" width="380" height="380" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
        <div>
            <h3>Where I can pack</h3>
            <p style="margin-left: 36px;">The official Georgia Aquarium parking deck has entrance is located on Luckie Street; Located at 357 Luckie Street, NW Atlanta, GA 30313</p>
            <ul style="margin-left: 36px;">
                <li>We have made changes to the parking deck to allow for social distancing. This includes blocking off every other parking space to give guests ample room and providing signs to explain where to go upon arrival. Georgia Aquarium is not responsible for valuables left in vehicles.</li>
                <li>You must use the Luckie Street entrance for the parking deck. The Ivan Allen entrance is blocked and not accessible for vehicles or pedestrians.</li>
                <li>Also there is no Oversized vehicle parking currently available in our parking deck.</li>
            </ul>
            <p style="margin-left: 36px;">For your convenience, you can pay for parking in advance online. You will need to print and bring your pre-paid parking ticket with you in order to enter the parking deck. You will be asked to re-scan your ticket in order to exit the parking deck after your visit. There is no re-entry allowed on pre-paid parking.</p>
            <br>
            <h3>From Van Cao street</h3>
            <pre style="margin-left: 36px; font-size: 20px;">Continue on I-20 West
Exit at 56B Spring/Windsor Street
Turn right onto Spring Street
Turn left onto Marietta Street NW
Turn right onto Ivan Allen Jr. Blvd.
The official Georgia Aquarium parking deck is on the right.
            </pre>
        </div>
    </div>
</div>
<!-- <div class="contact">
		<div class="sidebar-inner">	
            <div class="form-group">	
                <form method="get" id="" class="" action="" role="search">
                    <input type="search" class="form-control" name=""  placeholder="To search type and hit enter"><i class="fas fa-search"></i>
                </form>
            </div>
            <div class="slides">
                <img src="/Aquarium/public/templates/upload/public/advanted.jpg" number="0" class="slide-item">
                <img src="/Aquarium/public/templates/upload/public/advanted4.jpg" number="1" class="slide-item" style="display: none;">
                <img src="/Aquarium/public/templates/upload/public/advanted2.jpg" number="2" class="slide-item" style="display: none;">
                <img src="/Aquarium/public/templates/upload/public/advanted3.jpg" number="3" class="slide-item" style="display: none;">                   
            </div>
        </div>
    </div> -->