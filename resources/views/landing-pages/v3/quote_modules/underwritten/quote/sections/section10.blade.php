<section class="section-60 section-md-top-80 section-md-bottom-100" id="contacts">
    <div class="shell">
        <h3 class="text-center">Contact us</h3>
        <!-- RD Mailform-->
        <form class="rd-mailform text-left offset-top-30" data-form-output="form-output-global" data-form-type="contact" method="post" action="{{ asset_prepend('templates/landing-pages/' . $version . '/', 'bat/rd-mailform.php') }}">
            <div class="range offset-top-0">
                <div class="cell-md-4">
                    <div class="form-group">
                        <label class="form-label form-label-outside" for="contact-name">Your name<span class="text-primary">*</span></label>
                        <input class="form-control" id="contact-name" type="text" name="name" data-constraints="@Required" placeholder="Your name">
                    </div>
                </div>
                <div class="cell-md-4">
                    <div class="form-group">
                        <label class="form-label form-label-outside" for="contact-email">Email address<span class="text-primary">*</span></label>
                        <input class="form-control" id="contact-email" type="email" name="email" placeholder="info@demolink.org" data-constraints="@Required @Email">
                    </div>
                </div>
                <div class="cell-md-4">
                    <div class="form-group">
                        <label class="form-label form-label-outside" for="contact-phone">Subject</label>
                        <input class="form-control" id="contact-phone" type="text" name="subject" placeholder="Subject">
                    </div>
                </div>
            </div>
            <div class="form-group textarea-group">
                <label class="form-label form-label-outside" for="contact-message">You message<span class="text-primary">*</span></label>
                <textarea class="form-control" id="contact-message" name="message" placeholder="Your message" data-constraints="@Required"></textarea>
            </div>
            <div class="offset-top-40 text-center">
                <button class="btn btn-primary" type="submit">Send</button>
            </div>
        </form>
    </div>
</section>
