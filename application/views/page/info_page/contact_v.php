<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>



    <div class="topic-border color-cod-gray mb-30">
        <div class="topic-box-lg color-cod-gray">About Us</div>
    </div>
    
    <h2 class="title-semibold-dark size-xl"></h2>
    <p class="size-lg mb-40">
        <b>PressReview24</b> is your news, entertainment, technology, health & business website. 
        We provide you with the latest breaking news straight from the News Agencies.
    </p>
    
    <div class="topic-border color-cod-gray mb-30">
        <div class="topic-box-lg color-cod-gray">Location Info</div>
    </div>
    <ul class="address-info">
        <li>
            <i class="fa fa-map-marker" aria-hidden="true"></i>465 E Aultman St, Ely, NV 89301, US</li>
        <li>
            <i class="fa fa-phone" aria-hidden="true"></i><s>+1 775-289-3222</s></li>
        <li>
            <i class="fa fa-envelope-o" aria-hidden="true"></i>mail@pressfrom.info</li>
        <li>
            <i class="fa fa-fax" aria-hidden="true"></i><s>+1 775-289-3222</s></li>
    </ul>
    <div class="topic-border color-cod-gray mb-30">
        <div class="topic-box-lg color-cod-gray">Send Us Message</div>
    </div>
    <form id="contact-form" class="contact-form" novalidate="true">
        <fieldset>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <input type="text" placeholder="Name" class="form-control" name="name" id="form-subject" data-error="Name field is required" required="">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <input type="email" placeholder="Your E-mail" class="form-control" name="email" id="form-email" data-error="Email field is required" required="">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <textarea placeholder="Message" class="textarea form-control" name="message" id="form-message" rows="7" cols="20" data-error="Message field is required" required=""></textarea>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-sm-12">
                    <div class="form-group mb-none">
                        <button type="submit" class="btn-ftg-ptp-56 disabled">Send Message</button>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-6 col-sm-12">
                    <div class="form-response"></div>
                </div>
            </div>
        </fieldset>
    </form>
