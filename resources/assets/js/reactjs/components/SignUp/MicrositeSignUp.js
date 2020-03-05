import React, { Component } from 'react';
import ReactDOM, { render } from 'react-dom';
import PropTypes from 'prop-types';
import TextInput from "../TextInput/TextInput";
import toastr from "toastr";
import PasswordProgressBar from "../Password/PasswordProgressBar";
import axios from "axios";
import FD3Frame from "./FD3Frame";
import Loader from "../Loader/Loader";
import qs from "qs";

/** function: Modal */
class MicrositeSignUp extends Component {

    constructor(props) {
        super(props);

        this.affiliate = {
            affiliate_id: 'aqterm'
        };

        this.state = {
            config: {
                use_coupon: false,
                logged_in: false
            },
            show_modal: true,
            ready: true,
            applied_discount: false,
            affiliate: this.affiliate,
            products: [
                {
                    name: 'AQ2E Microsite - Add On',
                    em: 'Billed Monthly',
                    qty: 1,
                    price: 19.00,
                }
            ],
            invoice: {
                total: 19.00,
                note: 'By Clicking "CONTINUE" below, you have agreed to subscribe to the additional product(s) listed above, and will be billed the additional amount(s) accordingly.'
            },
            fields: {
                account: {
                    first_name: '',
                    last_name: '',
                    email: '',
                    account_id: '',
                    phone: '',
                    company_name: '',

                },
                plan: {
                    plan_code: "aq2e_microsite",
                },
                user: {
                    login_id: '',
                    microsite_id: '',
                    microsite_url: '',
                    password: '',
                },
                custom_fields: [
                    {
                        "label": "has_affiliate",
                        "value": 1
                    },
                    {
                        "label": "is_affiliate",
                        "value": 0
                    },
                    {
                        "label": "affiliate_id",
                        "value": this.affiliate.affiliate_id
                    },
                    {
                        "label": "site_num",
                        "value": ""
                    }
                ],
                billing: {
                    street: '',
                    city: '',
                    state: '',
                    zip: '',
                    phone: '',
                    country: 'U.S.A'
                }
            },
            submit: {
                disabled: false,
                caption: 'Save',
                done: 'Message Sent.',
                normal: 'Save',
                onSave: 'Sending...'
            },
            buttons: {
              apply: {
                  clicked: false,
                  text: 'APPLY COUPON',
                  normal: 'APPLY COUPON',
                  loading: '<i class="fa fa-circle-o-notch fa-spin"></i> applying...'
              },
              login: {
                    clicked: false,
                    text: 'VERIFY',
                    normal: 'VERIFY',
                    loading: '<i class="fa fa-circle-o-notch fa-spin"></i> verifying...'
                },
              check_availability: {
                clicked: false,
                text: 'CHECK AVAILABILITY',
                normal: 'CHECK AVAILABILITY',
                loading: '<i class="fa fa-circle-o-notch fa-spin"></i> verify...'
              },
              continue: {
                clicked: false,
                text: 'CONTINUE',
                normal: 'CONTINUE',
                loading: '<i class="fa fa-circle-o-notch fa-spin"></i> Processing...'
              }
            },
            checkAvailabilityBtn: {
                disabled: false,
                caption: 'Save',
                normal: 'Check for Availability',
                onSave: 'Sending...'
            }
        };

        this.token = jQuery('meta[name="csrf-token"]').attr('content');

        if (this.token.length) {
            axios.defaults.headers.common = {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': this.token
            };
        }

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    }

    onComponentDidMount = () => {
    };

    onLoadSubdomain = event => {
        event.preventDefault();

    };

    capitalize = (s) => {
        if (typeof s !== 'string') return '';
        return s.charAt(0).toUpperCase() + s.slice(1);
    };

    onFormFieldChange = (section, event) => {
        event.preventDefault();
        if (this.state.fields.hasOwnProperty(section)) {
            let newState = Object.assign({}, this.state.fields);
            newState[section][event.target.name] = event.target.value;
            this.setState({
                fields: newState
            });
            this.updateIfNeeded( event.target );
        }
        console.log(this.state.fields);
    };

    updateIfNeeded = field => {
        if (field.name === 'email') {
          let newState = Object.assign({}, this.state.fields);
          newState.user.login_id = field.value;
          this.setState({
              fields: newState
          });
        }

        if (field.name === 'microsite_id') {
            $('#microsite_id').removeClass('error');
        }
    };

    onNewAccountChange = event => {
        const newState = Object.assign({}, this.state, { [event.target.name]: event.target.value });
        $(".message-point").fadeOut(2000);
        this.setState(newState, () => {
            if (this.state.username.length && this.state.password.length >= 9 && this.state.password === this.state.confirm_password) {
                this.setState({ ready: true });
            }
        });
    };

    applyCoupon = coupon => {
        const newState = Object.assign({}, this.state);
        $(".message-point").fadeOut(2000);
        newState.fields.plan.coupon = coupon;
        newState.applied_discount = true;
        if (coupon.discount_by === 'flat') {
            newState.invoice.total -= coupon.discount_value;
        }
        this.setState(newState);
        console.log("Coupon", newState.fields.plan);
    };

    onCheckForAvailability = event => {
        event.preventDefault();
        console.log('Checking for availability...');

        this.setState({
            submit: Object.assign({}, this.state.submit, { caption: this.state.submit.onSave, disabled: true })
        });
    };

    ignoreSubmit = event => {
        event.preventDefault();
    };

    adjustHeight = () => {
        const iframeDOMNode = ReactDOM.findDOMNode(this.iframeRef)
        iframeDOMNode.height = iframeDOMNode.contentWindow.document.body.scrollHeight || 'auto'
    };

    validateEmail = (email) => {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    };

    validateCoupon = () => {
        let success = true;

        $('.help-block').removeClass("show");
        $('.form-control').removeClass("error");

        if ( ! this.state.fields.plan.coupon.length ) {
            const $coupon = $('#coupon')
            const $message = $('#coupon_DIV');
            $message.html("Invalid coupon");
            $coupon.addClass("error");
            $message.addClass("error");
            $message.addClass("show");
            success = false;
        }

        return success;
    };

    validateMicrositeId = () => {
        let success = true;

        $('#microsite_id_DIV').removeClass("error").removeClass("show");

        if ( ! this.state.fields.user.microsite_id ) {
            const $microsite_id = $('#microsite_id')
            const $message = $('#microsite_id_DIV');
            $message.html("Invalid microsit id");
            $microsite_id.addClass("error");
            $message.addClass("error");
            $message.addClass("show");
            success = false;
        }

        return success;
    };

    validateForm = () => {
        let success = true;

        $('.help-block').removeClass("show");
        $('.form-control').removeClass("error");
/*
        if ( ! this.state.fields.account.first_name.length ) {
            let $fname = $('#first_name');
            let $message = $('#first_name_DIV');
            $message.html("Invalid first name");
            $fname.addClass("error");
            $message.addClass("error");
            $message.addClass("show");
            success = false;
        }

        if ( ! this.state.fields.account.last_name.length ) {
            let $lname = $('#last_name');
            let $message = $('#last_name_DIV');
            $message.html("Invalid last name");
            $lname.addClass("error");
            $message.addClass("error");
            $message.addClass("show");
            success = false;
        }

        if ( ! this.state.fields.account.email ) {
            let $email = $('#email');
            let $message = $('#email_DIV');
            $message.html("Invalid email");
            $email.addClass("error");
            $message.addClass("error");
            $message.addClass("show");
            success = false;
        }

        if ( ! this.validateEmail( this.state.fields.account.email ) ) {
            let $email = $('#email');
            let $message = $('#email_DIV');
            $message.html("Invalid email");
            $email.addClass("error");
            $message.addClass("error");
            $message.addClass("show");
            success = false;
        }

        if ( ! this.state.fields.account.phone ) {
            let $phone = $('#phone');
            let $message = $('#phone_DIV');
            $message.html("Invalid phone");
            $phone.addClass("error");
            $message.addClass("error");
            $message.addClass("show");
            success = false;
        } */

        if ( ! this.validateMicrositeId() ) {
            success = false;
        }
        /*
        if ( ! this.state.fields.user.password ) {
            let $password = $('#password');
            let $message = $('#password_DIV');
            $message.html("Invalid password");
            $password.addClass("error");
            $message.addClass("error");
            $message.addClass("show");
            success = false;
        }

        if ( ! this.state.fields.billing.street ) {
            const $street = $('#street');
            const $message = $('#street_DIV');
            $message.html("Invalid street");
            $street.addClass("error");
            $message.addClass("error");
            $message.addClass("show");
            success = false;
        }

        if ( ! this.state.fields.billing.city ) {
            const $city = $('#city');
            const $message = $('#city_DIV');
            $message.html("Invalid city");
            $city.addClass("error");
            $message.addClass("error");
            $message.addClass("show");
            success = false;
        }

        if ( ! this.state.fields.billing.state ) {
            const $state = $('#state');
            const $message = $('#state_DIV');
            $message.html("Invalid state");
            $state.addClass("error");
            $message.addClass("error");
            $message.addClass("show");
            success = false;
        }

        if ( ! this.state.fields.billing.zip ) {
            const $zip = $('#zip');
            const $message = $('#zip_DIV');
            $message.html("Invalid zip");
            $zip.addClass("error");
            $message.addClass("error");
            $message.addClass("show");
            success = false;
        }
        */

        return success;
     };

    validateUser = () => {
        let success = true;

        $('.help-block').removeClass("show");
        $('.form-control').removeClass("error");

        if ( ! this.state.fields.user.login_id ) {
            let $login_id = $('#login_id');
            let $message = $('#login_id_DIV');
            $message.html("Invalid email");
            $login_id.addClass("error");
            $message.addClass("error");
            $message.addClass("show");
            success = false;
        }

        if ( ! this.state.fields.user.password ) {
            let $password = $('#password');
            let $message = $('#password_DIV');
            $message.html("Invalid password");
            $password.addClass("error");
            $message.addClass("error");
            $message.addClass("show");
            success = false;
        }

        return success;
    };

    applyAffiliate = affiliate => {
        const newState = Object.assign({}, this.state);
        newState.fields.custom_fields[0].value = 1;
        newState.fields.custom_fields[1].value = 0;
        newState.fields.custom_fields[2].value = affiliate;
        this.setState( newState );
    };

    onVerify = event => {
        event.preventDefault();
        let fd = new FormData();

        const userid = 'agentquote-api';
        const password = 'TVn3DSrb7z67rLre6HjDXjam';

        fd.append('userid', userid);
        fd.append('password', password);

        const headers = {
            'Content-Type': 'multipart/form-data'
        };

        let promise = axios.post(
            '/service/proxy',
            // 'https://mymobilelifequoter.com/webhooks/zoho/web-proxy.php',
            fd
        ).then(function(response) {
            if ( response.data.success === true ) {
                return response.data.token;
            }
            console.log(response);
        }).catch(function(response) {
            console.log(response);
        });

        promise.then( token => {

            let headers = {
                'Content-Type': 'application/json',
                'token': token,
                'X-Agentquote-Api': '92B35203FB5FDF6AE11AB4391954839E06E2ED4E',
                'accountid': '834839489'
            };

            let validData = this.validateUser();

            if ( !validData )
                return;

            let info = {
                "email": this.state.fields.user.login_id,
                "email_password": this.state.fields.user.password,
            };

            const json_str = JSON.stringify( info );
            console.log("JSON String" , json_str);

            // return;

            let that = this;

            const newState = Object.assign({}, this.state);
            newState.buttons.apply.clicked = true;
            newState.buttons.apply.text = "VERIFYING...";
            this.setState( newState );

            axios({
                method: 'POST',
                url: '/service/proxy',
                headers: headers,
                data: json_str
            }).then(function(response) {
                console.log(response);
                if ( response.data.success === true ) {
                    $('.help-block').removeClass("show");
                    $('.form-control').removeClass("error");

                    const newState = Object.assign({}, that.state);
                    newState.buttons.login.clicked = true;
                    newState.buttons.login.text = newState.buttons.login.normal;
                    newState.config.logged_in = true;
                    that.setState( newState );


                } else {
                    toastr.error( response.data.message );
                    return false;
                }
            }).catch(function(response) {
                console.log(response);
            });

        });
    };

    onApplyCoupon = event => {
        event.preventDefault();
        let fd = new FormData();

        const userid = 'agentquote-api';
        const password = 'TVn3DSrb7z67rLre6HjDXjam';

        fd.append('userid', userid);
        fd.append('password', password);

        const headers = {
            'Content-Type': 'multipart/form-data'
        };

        let promise = axios.post(
            '/service/proxy',
            // 'https://mymobilelifequoter.com/webhooks/zoho/web-proxy.php',
            fd
        ).then(function(response) {
            if ( response.data.success === true ) {
                return response.data.token;
            }
            console.log(response);
        }).catch(function(response) {
            console.log(response);
        });

        promise.then( token => {

            let headers = {
                'Content-Type': 'application/json',
                'token': token,
                'X-Agentquote-Api': 'coupons',
                'accountid': '834839489'
            };

            let validData = this.validateCoupon();

            if ( !validData )
                return;

            let info = {
                "coupon": this.state.fields.plan.coupon
            };

            const json_str = JSON.stringify( info );
            console.log("JSON String" , json_str);

            // return;

            let that = this;

            const newState = Object.assign({}, this.state);
            newState.buttons.apply.clicked = true;
            newState.buttons.apply.text = "APPLYING...";
            this.setState( newState );

            axios({
                method: 'POST',
                // url: 'https://mymobilelifequoter.com/webhooks/zoho/web-proxy.php',
                url: '/service/proxy',
                headers: headers,
                // data: '{"customer":{"display_name":"Bowman Furniture","salutation":"Mr.","first_name":"Benjamin","last_name":"George","email":"benjamin.george@bowmanfurniture.com"},"plan":{"plan_code":"my_mobile_life_quoter"},"auto_collect":false}'
                data: json_str
            }).then(function(response) {
                console.log(response);
                if ( response.data.success === true ) {
                    that.applyAffiliate( response.data.affiliate );
                    that.applyCoupon( response.data.result.coupon );

                } else {
                    toastr.error( response.data.message );

                    $('.help-block').removeClass("show");
                    $('.form-control').removeClass("error");

                    const $state = $('#coupon');
                    const $message = $('#coupon_DIV');
                    $message.html("Invalid coupon");
                    $state.addClass("error");
                    $message.addClass("error");
                    $message.addClass("show");

                    const newState = Object.assign({}, that.state);
                    newState.buttons.apply.clicked = true;
                    newState.buttons.apply.text = newState.buttons.apply.normal;
                    that.setState( newState );
                    return false;
                }
            }).catch(function(response) {
                console.log(response);
            });

        });
    };

    PackageData = dataToPackage => {
        let work = dataToPackage;
        let adj = work.length % 3;
        if (adj !== 0) {
            for (var indx = 0; indx < (3 - adj); indx++) {
                work = work + ' ';
            }
        }
        let tab = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
        let out = "",
            c1, c2, c3, e1, e2, e3, e4;
        for (let i = 0; i < work.length;) {
            c1 = work.charCodeAt(i++);
            c2 = work.charCodeAt(i++);
            c3 = work.charCodeAt(i++);
            e1 = c1 >> 2;
            e2 = ((c1 & 3) << 4) + (c2 >> 4);
            e3 = ((c2 & 15) << 2) + (c3 >> 6);
            e4 = c3 & 63;
            if (isNaN(c2)) {
                e3 = e4 = 64;
            } else if (isNaN(c3)) {
                e4 = 64;
            }
            out += tab.charAt(e1) + tab.charAt(e2) + tab.charAt(e3) + tab.charAt(e4);
        }
        return out;
    };

    onCheckAvailability = event => {
        event.preventDefault();

        let signupInfo = {};
        signupInfo.account = {};
        signupInfo.account = {};
        signupInfo.account.type = 'affiliate';
        signupInfo.user = {};
        signupInfo.user.userName = this.state.fields.user.microsite_id;

        signupInfo.site = {};
        signupInfo.siteId = 'aqterm';
        signupInfo.request = 'availability';
        signupInfo.type = 'affiliate';
        signupInfo.mode = 'affiliate';

        let packagedSignUpInfoData = this.PackageData(JSON.stringify(signupInfo));

        const thePackageObject = {
            "params": {
                "data": packagedSignUpInfoData
            }
        };

        let packagedData = JSON.stringify(thePackageObject);

        const headers = {
            'Content-Type': 'application/json'
        };

        let url_request = "https://aqtermlife.com/aqtermlife-engine/index.php/aqmprocess";

        let validData = this.validateMicrositeId();

        if ( !validData )
            return;

        let that = this;

        const newState = Object.assign({}, this.state);
        newState.buttons.check_availability.clicked = true;
        newState.buttons.check_availability.text = "VERIFYING...";
        this.setState( newState );

        $.ajax({

            url: "https://aqtermlife.com/aqtermlife-engine/index.php/aqmprocess",
            type: 'put',
            data: packagedData,
            dataType: "json",
            cache: false,

            error: function(response) {
                console.log(response);
            },

            success: function(response) {

                if (response.successful === true) {
                    console.log(response);

                    console.log('Available');

                    setTimeout(
                        function() {
                            const newState = Object.assign({}, that.state);
                            newState.buttons.check_availability.clicked = true;
                            newState.buttons.check_availability.text = "AVAILABLE";
                            that.setState( newState );
                            $('#availability-btn').removeClass('btn-success').addClass('btn-success');

                            setTimeout(
                                function() {
                                    const newState = Object.assign({}, that.state);
                                    newState.buttons.check_availability.false = true;
                                    newState.buttons.check_availability.text = newState.buttons.check_availability.normal;
                                    that.setState( newState );
                                   //  $('#availability-btn').removeClass('btn-success');
                                }
                                    .bind(that),
                                8000
                            );

                        }
                            .bind(that),
                        1200
                    );

                } else if (response.successful === false) { // we have a form error
                    console.log(response);

                    toastr.error( response.message );

                    setTimeout(
                        function() {
                            const newState = Object.assign({}, that.state);
                            newState.buttons.check_availability.clicked = true;
                            newState.buttons.check_availability.text = "NOT AVAILABLE";
                            that.setState( newState );
                            $('#availability-btn').removeClass('btn-danger').addClass('btn-danger');

                            const $state = $('#microsite_id');
                            $state.addClass("error");

                            setTimeout(
                                function() {
                                    const newState = Object.assign({}, that.state);
                                    newState.buttons.check_availability.false = true;
                                    newState.buttons.check_availability.text = newState.buttons.check_availability.normal;
                                    that.setState( newState );
                                    $('#availability-btn').removeClass('btn-danger');
                                }
                                    .bind(that),
                                1200
                            );

                        }
                            .bind(that),
                        1200
                    );
                }
            }

        });
    };

    onSubscribe2 = event => {

        event.preventDefault();

        let signupInfo = {};
        let personal = {};
        let licenseinfo = {};
        let user = {};
        let account = {};

        let that = this;

        if (this.validateForm()) {
            console.log('info', 'all fields valid.');

            personal.companyName = this.state.fields.account.company_name;
            personal.firstName = this.state.fields.account.first_name;
            personal.lastName = this.state.fields.account.last_name;
            personal.emailAddress = this.state.fields.account.email;
            personal.phone = this.state.fields.account.phone;

            licenseinfo.domain = '';

            user.userName = this.state.fields.user.login_id;
            user.password = this.state.fields.user.password;

            signupInfo.personal = personal;
            signupInfo.user = user;
            signupInfo.micrositeId = this.state.fields.user.microsite_id;
            signupInfo.licenseinfo = licenseinfo;
            signupInfo.account = {};
            signupInfo.account.type = 'affiliate';
            signupInfo.account.promocode = '';
            signupInfo.siteId = 'aqterm';
            signupInfo.request = 'new_AP_Account';
            signupInfo.type = 'affiliate';
            signupInfo.mode = 'affiliate';

            signupInfo.debug = true;
            signupInfo.params = {};
            signupInfo.params.data = {};

            let data = {};
            data.personal = personal;
            data.user = user;
            data.account = {};
            data.account.promocode = 'AQ2ELIFE';
            data.licenseinfo = licenseinfo;
            data.request = signupInfo.request;
            data.siteId = signupInfo.siteId;
            data.type = signupInfo.type;
            data.mode = signupInfo.mode;
            data.micrositeId = this.state.fields.user.microsite_id;

            signupInfo.params.personal = personal;
            signupInfo.params.user = user;
            // signupInfo.params.account = account;
            signupInfo.params.licenseinfo = licenseinfo;
            signupInfo.params.account = {};
            signupInfo.params.account.promocode = 'AQ2ELIFE';

            signupInfo.params.siteId = 'aqterm';
            signupInfo.params.request = 'new_AP_Account';
            signupInfo.params.type = 'affiliate';
            signupInfo.params.mode = 'affiliate';

            signupInfo.params.data = this.PackageData( JSON.stringify(data) );

            setTimeout(function() {

                $.ajax({

                    url: "/service/proxy",
                    // url: "https://aqtermlife.com/aqtermlife-engine/index.php/aqmzohoprocess",
                    type: 'POST',
                    data: JSON.stringify(signupInfo),
                    dataType: "json",
                    cache: false,

                    error: function(response) {
                        console.log(response);
                    },

                    success: function(response) {

                        if (response.successful === true) {

                            let fd = new FormData();
                            console.log('Subscribing user: ', that.state.fields);

                            const userid = 'agentquote-api';
                            const password = 'TVn3DSrb7z67rLre6HjDXjam';

                            fd.append('userid', userid);
                            fd.append('password', password);

                            const headers = {
                                'Content-Type': 'multipart/form-data'
                            };

                            let promise = axios.post(
                                '/service/proxy',
                                fd
                            ).then(function(response) {
                                if ( response.data.success === true ) {
                                    return response.data.token;
                                }
                                console.log(response);
                            }).catch(function(response) {
                                console.log(response);
                            });

                            promise.then( token => {

                                let $data = $(this).serialize();

                                let headers = {
                                    'Content-Type': 'application/json',
                                    'token': token,
                                    'X-Agentquote-Api': '6B5CDF4073B8166E5CC01A2532469D2E356EEBFD',
                                    'accountid': '834839489'
                                };

/*                                let validData = this.validateForm();

                                if ( !validData )
                                    return;*/

                                let fields = Object.assign({}, that.state.fields);
                                fields.billing.phone = that.state.fields.account.phone;
                                fields.custom_fields[3].value = response.site_num;

                                that.setState({ fields });

                                let info = {};

                                info = {
                                    "customer": {
                                        "display_name": that.capitalize(that.state.fields.account.first_name) + " " +
                                            that.capitalize(that.state.fields.account.last_name),
                                        "first_name": that.state.fields.account.first_name, "last_name": that.state.fields.account.last_name,
                                        "email": that.state.fields.account.email,
                                        "company_name": that.state.fields.account.company_name,
                                        "custom_fields": that.state.fields.custom_fields,
                                        "billing_address": that.state.fields.billing,
                                    },
                                    "plan":{
                                        "plan_code":that.state.fields.plan.plan_code
                                    },
                                    "auto_collect": true
                                };

                                const json_str = JSON.stringify( info );
                                console.log("JSON String" , json_str);


                                $('html,body').animate({
                                    scrollTop: $(".aq-header-footer").offset().top
                                }, 'slow');

                                // return;

                                axios({
                                    method: 'POST',
                                    // url: 'https://mymobilelifequoter.com/webhooks/zoho/web-proxy.php',
                                    url: '/service/proxy',
                                    headers: headers,
                                    // data: '{"customer":{"display_name":"Bowman Furniture","salutation":"Mr.","first_name":"Benjamin","last_name":"George","email":"benjamin.george@bowmanfurniture.com"},"plan":{"plan_code":"my_mobile_life_quoter"},"auto_collect":false}'
                                    data: json_str
                                }).then(function(response) {
                                    console.log(response);
                                    if ( response.data.success === true ) {

                                        const $billing_container = $('.signup-billing-container');

                                        $('#page-loader').addClass('spinner');
                                        $('.signup-container').hide();

                                        $billing_container.toggleClass('hide');
                                        let ifrm = document.createElement('iframe');
                                        ifrm.setAttribute('id', 'mmlq-iframe'); // assign an id
                                        ifrm.setAttribute('allowtransparency', true);
                                        // ifrm.setAttribute('frameBorder', "0");

                                        render(
                                            <FD3Frame src={response.data.url} target={"mmlq-iframe"}/>,
                                            document.getElementById('billing-iframe')
                                        );

                                        $('#page-loader').removeClass('spinner');
                                        // location.href = response.data.url;
                                    } else {
                                        toastr.error( response.data.message );
                                        return false;
                                    }
                                }).catch(function(response) {
                                    console.log(response);
                                });

                            });




                        } else if (response.successful === false) { // we have a form error

                        }

                    }

                });

            }, 1000);

            return false;

        } else {
            console.log('info', 'all fields not valid.');
        }

    };

    onSubscribe = event => {
        event.preventDefault();
        let newState = Object.assign({}, this.state.submit);
        newState.disabled = true;
        this.setState({
            submit: newState
        });
        let fd = new FormData();
        console.log('Subscribing user: ', this.state.fields);

        const userid = 'agentquote-api';
        const password = 'TVn3DSrb7z67rLre6HjDXjam';

        fd.append('userid', userid);
        fd.append('password', password);

        const headers = {
            'Content-Type': 'multipart/form-data'
        };

        let promise = axios.post(
            '/service/proxy',
            fd
        ).then(function(response) {
            if ( response.data.success === true ) {
                return response.data.token;
            }
            console.log(response);
        }).catch(function(response) {
            console.log(response);
        });

        promise.then( token => {

            let $data = $(this).serialize();

            let headers = {
                'Content-Type': 'application/json',
                'token': token,
                'X-Agentquote-Api': '6B5CDF4073B8166E5CC01A2532469D2E356EEBFD',
                'accountid': '834839489'
            };

            let validData = this.validateForm();

            if ( !validData )
                return;

            /*
            let fields = Object.assign({}, this.state.fields);
            fields.fields.billing.phone = this.state.fields.account.phone;
            fields.fields.custom_fields[3].value = this.state.fields.user.login_id;
            fields.fields.custom_fields[4].value = this.state.fields.user.password;

            this.setState({ fields });
            */

            let info = {
                "user": this.state.fields.user,
            };

            const json_str = JSON.stringify( info );
            console.log("JSON String" , json_str);

//            $('.signup-container').hide();
//            const $billing_container = $('.signup-billing-container')
//            $billing_container.toggleClass('hide');

/*            $('html,body').animate({
                scrollTop: $(".aq-header-footer").offset().top
            }, 'slow'); */

            // return;

            axios({
                method: 'POST',
                // url: 'https://mymobilelifequoter.com/webhooks/zoho/web-proxy.php',
                url: '/service/proxy',
                headers: headers,
                // data: '{"customer":{"display_name":"Bowman Furniture","salutation":"Mr.","first_name":"Benjamin","last_name":"George","email":"benjamin.george@bowmanfurniture.com"},"plan":{"plan_code":"my_mobile_life_quoter"},"auto_collect":false}'
                data: json_str
            }).then(function(response) {
                console.log(response);
                if ( response.data.success === true ) {
                    location.href= response.data.url;
                } else {
                    console.log (response);
                    toastr.error( response.data.message );
                    return false;
                }
            }).catch(function(response) {
                console.log(response);
            });

        });

        // setTimeout(
        //     function() {
        //         this.setState({
        //             submit: Object.assign({}, this.state.submit, { caption: this.state.submit.onSave, disabled: true })
        //         });
        //     }
        //         .bind(this),
        //     1200
        // );

        // axios.post('/user/messages', fd).then( res => {
        //     console.log(res);
        //
        //     setTimeout(
        //         function() {
        //             this.setState({
        //                 submit: Object.assign({}, this.state.submit, { caption: this.state.submit.done, disabled: false })
        //             });
        //         }
        //             .bind(this),
        //         1200
        //     );
        //
        //     if (res.data.success) {
        //         this.setState({contact: {}, show_modal: false});
        //         toastr.success('Message was sent.');
        //
        //     } else {
        //         this.setState({contact: {}, show_modal: false});
        //     }
        // }).catch( error => {
        //     setTimeout(
        //         function() {
        //             this.setState({
        //                 submit: Object.assign({}, this.state.submit, { caption: this.state.submit.normal, disabled: false })
        //             });
        //         }
        //             .bind(this),
        //         1200
        //     );
        //     console.log(error);
        //     this.setState({contact: {}, show_modal: false});
        // });

    };

    render() {

        const {label, from, email} = this.props;

        const fields = [
            {name: 'email', label: 'Email', col: '6', type: 'single'},
            {name: 'phone', label: 'Phone', col: '6', type: 'single'},
            {name: 'fname', label: 'First Name', col: '6', type: 'single'},
            {name: 'lname', label: 'Last Name', col: '6', type: 'single'},
            {name: 'gender', label: 'Gender', col: '6', type: 'single'},
            {name: 'street', label: 'Street', col: '6', type: 'single'},
            {name: 'city', label: 'City', col: '6', type: 'single'},
            {name: 'state', label: 'State', col: '6', type: 'single'},
            {name: 'zipcode', label: 'Zip Code', col: '6', type: 'single'},
        ];

        const cc_icons = [
            { name: 'cc-icon visa' },
            { name: 'cc-icon mastercard' },
            { name: 'cc-icon american-express' },
            { name: 'cc-icon discover' },
            { name: 'cc-icon paypal' },
        ];

        const styles = {
            for: {
                label: {
                    textAlign: 'left',
                    width: '100%',
                    color: '#333 !important'
                },
                modalTitle: {
                    width: '100%',
                    textTransform: 'capitalize'
                }
            }
        };

        const form_fields = fields.map(field => {
            return field.type === 'single' ?
                <TextInput
                    key={field.name+field.label}
                    name={field.name}
                    id={name}
                    label={field.label}
                    className="field-label"
                    required={false}
                    styles={styles}
                    onChange={(e) => {}}
                />
                :
                <div className="form-group" key={field.name+field.label}>
                    <label htmlFor="message-text" className="field-label"
                           style={styles.for.label}>{field.label}</label>
                    <textarea className="form-control" id={field.name} name={field.name} rows={field.rows} onChange={this.onFormFieldChange} />
                </div>
        });

        const modal_header = (
            <div className="modal-header">
                {/*<h5 className="modal-title" id="ModalLabel" style={styles.for.modalTitle}>Sign Up Form</h5>*/}
                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        );

        const new_styles = {
            productBanner: {
                "padding": "10px 20px",
                "background": "#2a3440",
                "borderTopLeftRadius": "5px",
                "borderTopRightRadius": "5px",
                "color": "#ffffff"
            }
        };

        const credit_from_details = (
            <div className="payment-info-container col-sm-12"><label>Payment Information</label>
                <div className="row form-group">
                    <div className="col-sm-12 control-group">
                        <input type="tel" name="card_number" id="card_number" data-field-type="cc" className="form-control" maxLength="25" placeholder="Card Number*" is_mandatory="true" value={this.state.fields.card_number} onChange={(e) => {this.onFormFieldChange('cc', e)}} />
                        <span className="help-block hide" id="street_DIV"></span>
                    </div>
                </div>

                <div className="row form-group">
                    <div className="col-sm-4 control-group">
                        <select name="expiry_month" id="expiry_month" data-field-type="cc" className="form-control" is_mandatory="true" defaultValue={this.state.fields.expiry_month} onChange={(e) => {this.onFormFieldChange('cc', e)}}>
                            <option value="">Expiry Month*</option>
                            <option value="1">01</option>
                            <option value="2">02</option>
                            <option value="3">03</option>
                            <option value="4">04</option>
                            <option value="5">05</option>
                            <option value="6">06</option>
                            <option value="7">07</option>
                            <option value="8">08</option>
                            <option value="9">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                        <span className="help-block hide" id="expiry_month_DIV"></span>
                    </div>
                    <div className="col-sm-4 control-group">
                        <select name="expiry_year" id="expiry_year" data-field-type="cc" className="form-control" is_mandatory="true"  defaultValue={this.state.fields.expiry_year} onChange={(e) => {this.onFormFieldChange('cc', e)}}>
                            <option value="">Expiry Year*</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                            <option value="2031">2031</option>
                            <option value="2032">2032</option>
                            <option value="2033">2033</option>
                            <option value="2034">2034</option>
                            <option value="2035">2035</option>
                            <option value="2036">2036</option>
                            <option value="2037">2037</option>
                            <option value="2038">2038</option>
                        </select>
                        //
                        <span className="help-block hide" id="expiry_year_DIV"></span>
                    </div>
                    <div className="col-sm-4 control-group">
                        <input type="password" name="cvv_number" id="cvv_number" data-field-type="cc" className="form-control cvv_number" placeholder="CVV*" is_mandatory="true"  value={this.state.fields.cvv_number} onChange={(e) => {this.onFormFieldChange('cc', e)}} />
                        <span className="help-block hide" id="cvv_number_DIV"></span>
                    </div>

                </div>

            </div>
        );

        const billing_form_details = (
            <div className="billing-info-container col-sm-12">

                <label>Billing Information</label>

                <div className="row form-group">
                    <div className="col-sm-12 control-group">
                        <input type="text" name="street" id="street" data-field-type="billing" value={this.state.fields.street} onChange={(e) => {this.onFormFieldChange('billing', e)}} className="form-control" placeholder="Street*" is_mandatory="true" />
                        <span className="help-block hide" id="street_DIV"></span>
                    </div>
                </div>
                <div className="row form-group">
                    <div className="col-sm-6 control-group">
                        <input type="text" name="city" id="city" data-field-type="billing" value={this.state.fields.city} onChange={(e) => {this.onFormFieldChange('billing', e)}} className="form-control" placeholder="City*" is_mandatory="true" />
                        <span className="help-block hide" id="city_DIV"></span>
                    </div>
                    <div className="col-sm-6 control-group">
                        <select name="state" id="state" data-field-type="billing" className="form-control" is_mandatory="true" defaultValue={this.state.fields.state} onChange={(e) => {this.onFormFieldChange('billing', e)}}>
                            <option value="">State*</option>
                            <option value="AK">Alaska</option>
                            <option value="AL">Alabama</option>
                            <option value="AR">Arkansas</option>
                            <option value="AZ">Arizona</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DC">District of Columbia</option>
                            <option value="DE">Delaware</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="IA">Iowa</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MD">Maryland</option>
                            <option value="ME">Maine</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MO">Missouri</option>
                            <option value="MS">Mississippi</option>
                            <option value="MT">Montana</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="NE">Nebraska</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NV">Nevada</option>
                            <option value="NY">New York</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VA">Virginia</option>
                            <option value="VT">Vermont</option>
                            <option value="WA">Washington</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WV">West Virginia</option>
                            <option value="WY">Wyoming</option>
                        </select>
                        <span className="help-block hide" id="state_DIV"></span>
                    </div>
                </div>

                <div className="row form-group">
                    <div className="col-sm-12 control-group">
                        <input type="text" name="zip" id="zip" data-field-type="billing" value={this.state.fields.zip} onChange={(e) => {this.onFormFieldChange('billing', e)}} className="form-control" placeholder="Zip*" is_mandatory="true" />
                        <span className="help-block hide" id="zip_DIV"></span>
                    </div>
                </div>

            </div>
        );

        const header_details = (
            <div className="aq-header-footer">
                <div className="aq-header-footer-container">
                    <img src="https://mymobilelifequoter.com/images/AQ_Logo_trns.png" />
                    <span>AgentQuote</span></div>
            </div>
        );

        const invoice_coupon = (
            <div className="col-md-12 invoice-product">
                <div className="row discount-row">
                    <div className="col-8 cell text-left">COUPON: AGENTQUOTE <em>(Applied Discount)</em></div>
                    <div className="col-2 cell qty-cell"></div>
                    <div className="col-2 cell qty-cell">$10.00</div>
                </div>
            </div>
        );

        const coupon_form = (
            <div className="col-md-12 invoice-product">
                <div className="row product-row">
                    <div className="col-sm-6 control-group py-3">
                        <input type="coupon" name="coupon" id="coupon" data-field-type="account" className="form-control"  value={this.state.fields.account.coupon} onChange={(e) => {this.onFormFieldChange('plan', e)}} placeholder="Coupon Code" is_mandatory="false" />
                        <span className="help-block hide" id="coupon_DIV"></span>
                    </div>
                    <div className="col-sm-6 control-group py-3">
                        <a className="btn submit-button btn-md btn-block" href="" id="coupon-btn" onClick={this.onApplyCoupon}> { this.state.buttons.apply.text } </a>
                    </div>
                </div>
            </div>
        );

        const account_id_form = (
            <div className="col-md-12 invoice-product">
                <div className="row product-row">
                    <div className="col-sm-6 control-group py-3">
                        <input type="coupon" name="coupon" id="coupon" data-field-type="account" className="form-control"  value={this.state.fields.account.coupon} onChange={(e) => {this.onFormFieldChange('plan', e)}} placeholder="Coupon Code" is_mandatory="false" />
                        <span className="help-block hide" id="coupon_DIV"></span>
                    </div>
                    <div className="col-sm-6 control-group py-3">
                        <a className="btn submit-button btn-md btn-block" href="" id="coupon-btn" onClick={this.onApplyCoupon}> { this.state.buttons.apply.text } </a>
                    </div>
                </div>
            </div>
        );

        const products = (
            <div className="col-md-12 invoice-products">
                {
                 this.state.products.map(product => {
                        return (
                            <div className="row product-row" key={product.name}>
                                <div className="col-8 cell text-left">{product.name} <em>({product.em})</em></div>
                                <div className="col-2 cell qty-cell">{product.qty}</div>
                                <div className="col-2 cell last-cell">${product.price}</div>
                            </div>
                        )
                    })
                }
            </div>
        );

        const invoice = (
            <div className="row">

                <div className="col-md-12">
                    <div style={new_styles.productBanner}>
                        AQ2E Microsite Subscription - Add On
                    </div>
                </div>
                <div className="col-md-12">
                    <div className="row header">
                        <div className="col-8 cell">Product</div>
                        <div className="col-2 cell">Qty</div>
                        <div className="col-2 cell">Price</div>
                    </div>
                </div>

                { this.state.config.logged_in && products }
                { this.state.config.logged_in && this.state.applied_discount && invoice_coupon }
                { this.state.config.logged_in && this.state.config.use_coupon && ! this.state.applied_discount && coupon_form }
                <div className="col-md-12">
                    <div className="row total-row">
                        <div className="col-10 cell text-left">TOTAL</div>

                        <div className="col-2 cell last-cell">${ this.state.invoice.total }</div>
                    </div>
                </div>

            </div>
        );

        const login_info_content = (
            <div>
                <h4>Account Verification</h4>
                <p></p>
                <p>To subscribe to this product/service add-on you must have an existing Mobile Quoter subscription. In order to verify your account please login below:</p>
                <div className="row form-group">
                    <div className="col-sm-12 control-group">
                        <input type="text" name="email" id="email" data-field-type="user" className="form-control"  value={this.state.fields.user.login_id} onChange={(e) => {this.onFormFieldChange('user', e)}} placeholder="User Id*" is_mandatory="true" />
                        <span className="help-block hide" id="email_DIV"></span>
                    </div>

                    <div className="col-sm-12 control-group">
                        <input type="password" name="password" id="password" data-field-type="user" className="form-control" value={this.state.fields.user.password} onChange={(e) => {this.onFormFieldChange('user', e)}} is_mandatory="true" placeholder="Password*" />
                        <span className="help-block hide" id="password_DIV"></span>
                    </div>

                    <div className="col-sm-12 control-group">
                        <div className="col-sm-12 no-padding">
                            <a  className="btn submit-button btn-lg btn-block mt-4" href="" id="login-btn" onClick={this.onVerify} > { this.state.buttons.login.text } </a>
                        </div>
                    </div>

                </div>
            </div>
        );

        const account_info_content = (
            <div>
                <label>Account Information</label>

                <div className="row form-group">
                    <div className="col-sm-6 control-group">
                        <input type="text" name="first_name" id="first_name" data-field-type="account" className="form-control" value={this.state.fields.first_name} onChange={(e) => {this.onFormFieldChange('account', e)}} placeholder="First Name*" />
                        <span className="help-block hide" id="first_name_DIV" />
                    </div>
                    <div className="col-sm-6 control-group">
                        <input type="text" name="last_name" id="last_name" data-field-type="account" className="form-control" value={this.state.fields.last_name} onChange={(e) => {this.onFormFieldChange('account', e)}} placeholder="Last Name*" />
                        <span className="help-block hide" id="last_name_DIV"></span>
                    </div>
                </div>
                <div className="row form-group">
                    <div className="col-sm-12 control-group">
                        <input type="email" name="email" id="email" data-field-type="account" className="form-control"  value={this.state.fields.email} onChange={(e) => {this.onFormFieldChange('account', e)}} placeholder="Email* (Note: this will be your Login Id)" is_mandatory="true" />
                        <span className="help-block hide" id="email_DIV"></span>
                    </div>
                </div>

                <div className="row form-group">
                    <div className="col-sm-6 control-group">
                        <input type="phone" name="phone" id="phone" data-field-type="account" className="form-control"  value={this.state.fields.phone} onChange={(e) => {this.onFormFieldChange('account', e)}} placeholder="Phone*" is_mandatory="true" />
                        <span className="help-block hide" id="phone_DIV"></span>
                    </div>
                    <div className="col-sm-6 control-group">
                        <input type="text" name="company_name" id="company_name" data-field-type="account" className="form-control" value={this.state.fields.company_name} onChange={(e) => {this.onFormFieldChange('account', e)}} placeholder="Company" />
                        <span className="help-block hide" id="company_name_DIV"></span>
                    </div>
                </div>


            </div>
        );

        const user_info_content = (
            <div>
                <label>User Information</label>

                <div className="row form-group">
                    <div className="col-sm-6 control-group">
                        <input type="text" name="microsite_id" id="microsite_id" data-field-type="user" className="form-control"  value={this.state.fields.user.microsite_id} onChange={(e) => {this.onFormFieldChange('user', e)}} placeholder="Microsite Id*" is_mandatory="true" />
                        <span className="help-block hide" id="microsite_id_DIV"></span>
                    </div>
                    <div className="col-sm-6 control-group">
                        <a className="btn btn-success submit-button btn-md btn-block" href="" id="availability-btn" onClick={this.onCheckAvailability}> { this.state.buttons.check_availability.text } </a>
                    </div>
                </div>

                { this.state.fields.user.microsite_id.length !== 0 &&
                <div className="row form-group">
                    <div className="col-sm-12 control-group">
                        <label className="" id="fd3_form_microsite_id_label" htmlFor="fd3_form_microsite_url">Your
                            Microsite URL</label>
                        <span
                            id="fd3_form_microsite_url">https://aqterm.aq2e.com/ms/{this.state.fields.user.microsite_id} </span>
                    </div>
                </div>
                }
            </div>
        );

        const login_block = (
            <div className="col-sm-12 order-form-container no-padding mb-20 form-group">
                <div className="row">
                    <div className="col-md-12">
                        <div className="form-group account-info-container">
                            { login_info_content }
                        </div>
                    </div>
                </div>
            </div>
        );

        const account_block = (
            <div className="col-sm-12 order-form-container no-padding mb-20 form-group">
                <div className="row">
                    <div className="col-md-12">
                        <div className="form-group account-info-container">
                            { account_info_content }
                        </div>
                    </div>
                </div>
            </div>
        );

        const user_block = (
            <div className="col-sm-12 order-form-container no-padding mb-20 form-group">
                <div className="row">
                    <div className="col-md-12">
                        <div className="form-group user-info-container">
                            { user_info_content }
                        </div>
                    </div>
                </div>
                <div className="row">
                    <div className="col-sm-12">
                        <p>{ this.state.invoice.note }</p>
                        <a  className="btn submit-button btn-lg btn-block mt-4" href="" id="subscribe-btn" onClick={ this.onSubscribe }> CONTINUE</a>
                    </div>
                </div>
            </div>
        );

        const billing_block = (
            <div className="col-sm-12 order-form-container no-padding mb-20 form-group">
                <div className="row">
                    <div className="col-md-12">
                        { billing_form_details }
                        <div className="col-sm-12 no-padding">
                            <a  className="btn submit-button btn-lg btn-block mt-4" href="" id="subscribe-btn" onClick={ this.onSubscribe }> CONTINUE </a>
                        </div>
                    </div>
                </div>
            </div>
        );

        const invoice_block = (
            <div className="col-sm-12 order-summary-container no-padding mb-20">
                { invoice }
            </div>
        );

        const new_signup_content = (
            <div className="wrapper-a">
                    <div className="form-group mb-3 signup-container">

                        { invoice_block }

                        <form action="">
                            { false && account_block }

                            { user_block }

                            { false && billing_block }
                        </form>

                    </div>

                    <div className="form-group mb-3 signup-billing-container hide">
                        <div id="billing-iframe" />
                    </div>
            </div>

        );

        const login_content = (
            <div className="wrapper-a">
                <div className="form-group mb-3 signup-container">

                    <form action="">
                        { login_block }
                    </form>

                </div>
            </div>

        );

        return (
            <div>
                { this.state.config.logged_in ? new_signup_content : login_content }
            </div>
        );
    }

}

MicrositeSignUp.propTypes = {

};

MicrositeSignUp.defaultProps = {
    //myProp: val
};

export default MicrositeSignUp;

if (document.getElementById('agent-signup')) {
    render(
        <MicrositeSignUp />,
        document.getElementById('agent-signup')
    )
}
