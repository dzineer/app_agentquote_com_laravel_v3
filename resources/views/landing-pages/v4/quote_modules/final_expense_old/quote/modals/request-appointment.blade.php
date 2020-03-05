<!-- Modal-->
<div class="modal fade text-left" id="appointment" role="dialog">
    <div class="modal-wrap">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content inset-md-left-30 inset-md-right-30">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal"><span class="icon icon-light icon-xxs fa-close text-primary"></span></button>
                    <div class="modal-title border-bottom">Request Appointment</div>
                </div>
                <div class="modal-body">
                    <h6 class="text-gray-light">Custom Calendar One</h6>
                    <p>Please review and confirm that you would like to request the following appointment:</p>
                    <div class="form-group"><span><span class="icon icon-primary fa-calendar inset-right-5"></span><span class="text-gray-lighter text-italic">  May 26, 2018</span></span><span class="inset-left-20"><span class="icon icon-primary fa-clock-o inset-right-5"></span><span class="text-gray-lighter text-italic">  10:00 am</span></span></div>
                    <hr class="divider">
                    <!-- RD Mailform-->
                    <form class="rd-mailform text-left" data-form-output="form-output-global" data-form-type="contact" method="post" action="{{ asset_prepend('templates/landing-pages/v1/', 'bat/rd-mailform.php') }}">
                        <div>
                            <div class="reveal-xs-inline-block radio">
                                <label>
                                    <input type="radio" name="optradio" value="login"><span class="text-primary">I am a current customer</span>
                                </label>
                            </div>
                            <div class="reveal-xs-inline-block radio inset-xs-left-20">
                                <label>
                                    <input type="radio" name="optradio" value="register" checked="checked"><span class="text-primary">I am a new customer</span>
                                </label>
                            </div>
                        </div>
                        <hr class="divider offset-top-15">
                        <div class="register-form">
                            <h6><span class="text-gray-light">Registration</span><span class="text-primary"> *</span></h6>
                            <p>Your first name and an email address are required.</p>
                            <!-- Login form-->
                            <div class="offset-10">
                                <div class="form-group">
                                    <label class="form-label" for="name-2">First name *</label>
                                    <input class="form-control" id="name-2" type="text" name="name" data-constraints="@Required">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="name-3">Latest name</label>
                                    <input class="form-control" id="name-3" type="text" name="name2">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="email">Your e-mail *</label>
                                    <input class="form-control" id="email" type="text" name="email" data-constraints="@Required @Email">
                                </div>
                                <div class="offset-top-25">
                                    <h6><span class="text-gray-light">Custom Text Field:</span></h6>
                                </div>
                                <div class="form-group offset-top-25">
                                    <label class="form-label" for="text2">Text</label>
                                    <input class="form-control" id="text2" type="text" name="text22">
                                </div>
                                <div class="offset-top-25">
                                    <h6><span class="text-gray-light">Custom Checkboxes:</span></h6>
                                </div>
                                <div class="form-group">
                                    <label class="checkbox-inline">
                                        <input name="input-group-radio" value="checkbox-1" type="checkbox" checked><span class="text-primary">First Checkbox</span>
                                    </label>
                                </div>
                                <div class="form-group offset-top-10">
                                    <label class="checkbox-inline">
                                        <input name="input-group-radio" value="checkbox-2" type="checkbox"><span class="text-primary">Second Checkbox</span>
                                    </label>
                                </div>
                                <div class="form-group offset-top-10">
                                    <label class="checkbox-inline">
                                        <input name="input-group-radio" value="checkbox-2" type="checkbox"><span class="text-primary">Third Checkbox</span>
                                    </label>
                                </div>
                                <div class="form-group-btn offset-top-50">
                                    <button class="btn btn-primary" type="submit">Request Appointment</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="login-form">
                        <h6><span class="text-gray-light">Login</span></h6>
                        <!-- Login form-->
                        <form class="offset-10">
                            <div class="form-group">
                                <label class="form-label" for="name">Username or e-mail</label>
                                <input class="form-control" id="name" type="text" name="name">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="password">Password</label>
                                <input class="form-control" id="password" type="password" name="password">
                            </div>
                            <div class="form-group-btn offset-top-50">
                                <button class="btn btn-primary" type="submit">Enter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
