import React, { Component } from 'react';
import ReactDOM, { render } from 'react-dom';
import PropTypes from 'prop-types';
import TextInput from "../TextInput/TextInput";
import toastr from "toastr";
import PasswordProgressBar from "../Password/PasswordProgressBar";
import axios from "axios";
import FD3Frame from "./FD3Frame";
import Loader from "../Loader/Loader";

/** function: Modal */
class MobileQuoterSignUp extends Component {

    constructor(props) {
        super(props);

        this.state = {
            config: {
                use_coupon: true,
                coupon_used: ''
            },
            show_modal: true,
            ready: true,
            applied_discount: false,
            products: [
                {
                    name: 'Mobile Quoter',
                    em: 'Billed Annually',
                    qty: 1,
                    price: 60.00,
                }
            ],
            coupon: {
                applied_coupon_code: '',
                value: ''
            },
            invoice: {
                total: 60.00,
                note: (<span>By Clicking "CONTINUE" below, you have agreed to our <a href="https://agentquoter.com/index.php/terms-conditions/260-terms-of-service" target="_blank">Terms & Conditions</a> and will be billed the amount(s) accordingly.</span>)
            },
            fields: {
                account: {
                    first_name: '',
                    last_name: '',
                    email: '',
                    phone: '',
                    company_name: ''
                },
                plan: {
                    plan_code: "my_mobile_life_quoter",
                    coupon: ''
                },
                user: {
                    login_id: '',
                    password: ''
                //    subdomain: '',
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
                        "value": "aqterm"
                    },
                    {
                        "label": "u",
                        "value": ""
                    },
                    {
                        "label": "p",
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
                },
                cc: {
                    card_number: '',
                    expiry_month: '',
                    expiry_year: '',
                    cvv_number: ''
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

        this.token = jQuery('meta[name="csrf-token"]').attr('content')

        axios.defaults.headers.common = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': this.token
        };

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

    onComponentDidMount = () => {};

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
    };

    applyCoupon = (coupon, input_coupon) => {
        const newState = Object.assign({}, this.state);
        $(".message-point").fadeOut(2000);
        newState.fields.plan.coupon = coupon;
        newState.applied_discount = true;
        newState.coupon.applied_coupon_code = coupon.coupon_code;
        newState.config.coupon_used = input_coupon;
        console.log("applied_coupon_code: ", coupon.coupon_code);
        newState.coupon.value = coupon.discount_value;
        if (coupon.discount_by === 'flat') {
            newState.invoice.total -= coupon.discount_value;
        }
        this.setState(newState);
        // console.log("Coupon", newState.fields.plan);
    };

    validateEmail = (email) => {
        let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    };

    clearErrors = () => {
        $('.help-block').removeClass("show");
        $('.form-control').removeClass("error");
    };

    setFieldError = (field_id, message_id, msg) => {
        const $field = $(field_id);
        const $message = $(message_id);
        $message.html(msg);
        $field.addClass("error");
        $message.addClass("error");
        $message.addClass("show");
    };

    validateCoupon = () => {
        let success = true;
        this.clearErrors();
        if ( ! this.state.fields.plan.coupon.length ) {
            this.setFieldError('#coupon', '#coupon_DIV', 'Invalid coupon');
            success = false;
        }
        return success;
    };

    validateForm = () => {
        let success = true;

        this.clearErrors();

        if ( ! this.state.fields.account.first_name.length ) {
            this.setFieldError('#first_name', '#first_name_DIV', 'Invalid first name');
            success = false;
        }

        if ( ! this.state.fields.account.last_name.length ) {
            this.setFieldError('#last_name', '#last_name_DIV', 'Invalid last name');
            success = false;
        }

        if ( ! this.state.fields.account.email ) {
            this.setFieldError('#email', '#email_DIV', 'Invalid email');
            success = false;
        }

        if ( ! this.validateEmail( this.state.fields.account.email ) ) {
            this.setFieldError('#email', '#email_DIV', 'Invalid email');
            success = false;
        }

        if ( ! this.state.fields.account.phone ) {
            this.setFieldError('#phone', '#phone_DIV', 'Invalid phone');
            success = false;
        }


        if ( ! this.state.fields.user.password ) {
            this.setFieldError('#password', '#password_DIV', 'Invalid password');
            success = false;
        }

        if ( ! this.state.fields.billing.street ) {
            this.setFieldError('#street', '#street_DIV', 'Invalid street');
            success = false;
        }

        if ( ! this.state.fields.billing.city ) {
            this.setFieldError('#city', '#city_DIV', 'Invalid city');
            success = false;
        }

        if ( ! this.state.fields.billing.state ) {
            this.setFieldError('#state', '#state_DIV', 'Invalid state');
            success = false;
        }

        if ( ! this.state.fields.billing.zip ) {
            this.setFieldError('#zip', '#zip_DIV', 'Invalid zipcode');
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

    setButtonState = () => {

    };

    onApplyCoupon = event => {
        event.preventDefault();
        let fd = new FormData();

        const userid = 'agentquote-api';
        const password = 'TVn3DSrb7z67rLre6HjDXjam';

        fd.append('userid', userid);
        fd.append('password', password);

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

            let headers = {
                'Content-Type': 'application/json',
                'token': token,
                'X-Agentquote-Api': 'D9496B04F01D4759764AF7ABBE968451DFE42BB5',
                'accountid': '834839489'
            };

            /*
              Debugging
              !!! Stop !!!
            */
            debugger;

            let validData = this.validateCoupon();

            if ( !validData )
                return;

            let info = {
                "coupon": this.state.fields.plan.coupon
            };

            const json_str = JSON.stringify( info );
            console.log("JSON String" , json_str);

            let that = this;

            const newState = Object.assign({}, this.state);
            newState.buttons.apply.clicked = true;
            newState.buttons.apply.text = "Loading...";
            this.setState( newState );

            axios({
                method: 'POST',
                url: '/service/proxy',
                headers: headers,
                data: json_str
            }).then(function(response) {
                console.log(response);
                if ( response.data.success === true ) {
                    that.applyAffiliate( response.data.affiliate );
                    that.applyCoupon( response.data.result.coupon,  that.state.fields.plan.coupon );
                } else {
                    toastr.error( response.data.message );

                    that.clearErrors();
                    that.setFieldError('#coupon', '#coupon_DIV', 'Invalid coupon');

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
                'X-Agentquote-Api': 'EC8C812CECA579F2F722C9626B073E8462B8777D',
                'accountid': '834839489'
            };

            let validData = this.validateForm();

            if ( !validData )
                return;

            this.state.fields.billing.phone = this.state.fields.account.phone;
            this.state.fields.custom_fields[3].value = this.state.fields.user.login_id;
            this.state.fields.custom_fields[4].value = this.state.fields.user.password;
            let info = {};

            if ( typeof this.state.fields.plan.coupon !== 'undefined') {
                info = {
                    "customer": {
                        "display_name": this.capitalize(this.state.fields.account.first_name) + " " +
                            this.capitalize(this.state.fields.account.last_name),
                        "first_name": this.state.fields.account.first_name, "last_name": this.state.fields.account.last_name,
                        "email": this.state.fields.account.email,
                        "company_name": this.state.fields.account.company_name,
                        "billing_address": this.state.fields.billing,
                        "custom_fields": this.state.fields.custom_fields,
                    },
                    "user": this.state.fields.user,
                    "plan":{
                        "plan_code":this.state.fields.plan.plan_code
                    },
                    "coupon_code": this.state.fields.plan.coupon.coupon_code,
                    "auto_collect":false
                };

            } else {
                info = {
                    "customer": {
                        "display_name": this.capitalize(this.state.fields.account.first_name) + " " +
                            this.capitalize(this.state.fields.account.last_name),
                        "first_name": this.state.fields.account.first_name, "last_name": this.state.fields.account.last_name,
                        "email": this.state.fields.account.email,
                        "company_name": this.state.fields.account.company_name,
                        "billing_address": this.state.fields.billing,
                        "custom_fields": this.state.fields.custom_fields,
                    },
                    "user": this.state.fields.user,
                    "plan":{
                        "plan_code":this.state.fields.plan.plan_code
                    },
                    "auto_collect":false
                };
            }

            const json_str = JSON.stringify( info );
            console.log("JSON String" , json_str);


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

                    $('#page-loader').addClass('spinner');

                    $('.signup-container').hide();
                    const $billing_container = $('.signup-billing-container');
                    $billing_container.toggleClass('hide');

                    $('html,body').animate({
                        scrollTop: $(".aq-header-footer").offset().top
                    }, 'slow');

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
            <div className="billing-info-container col-sm-12"><label>Billing
                Address</label>
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
                    <div className="col-8 cell text-left">COUPON: <span id="applied_coupon_code">{ this.state.config.coupon_used }</span> <em>(Applied Discount)</em></div>
                    <div className="col-2 cell qty-cell"></div>
                    <div className="col-2 cell qty-cell"><span id="discount_price">${ this.state.coupon.value }</span></div>
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
                        Mobile Quoter Subscription
                    </div>
                </div>
                <div className="col-md-12">
                    <div className="row header">
                        <div className="col-8 cell">Product</div>
                        <div className="col-2 cell">Qty</div>
                        <div className="col-2 cell">Price</div>
                    </div>
                </div>
                { products }
                { this.state.applied_discount && invoice_coupon }
                { this.state.config.use_coupon && ! this.state.applied_discount && coupon_form }
                <div className="col-md-12">
                    <div className="row total-row">
                        <div className="col-10 cell text-left">TOTAL</div>
                        <div className="col-2 cell last-cell">${ this.state.invoice.total }</div>
                    </div>
                </div>

            </div>
        );

        const new_signup_content = (
            <div className="wrapper-a">
                    <div className="form-group mb-3 signup-container">
                        <div className="col-sm-12 order-summary-container no-padding mb-20">
                            { invoice }
                        </div>

                        <form action="">
                            <div className="col-sm-12 order-form-container no-padding mb-20 form-group">
                                <div className="row">
                                    <div className="col-md-12">
                                        <div className="form-group account-info-container">

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

                                        <div className="form-group user-info-container">

                                            <label>User Information</label>

                                            <div className="row form-group">
                                                <div className="col-sm-6 control-group">
                                                    <input type="text" name="login_id" id="login_id" data-field-type="user" className="form-control"  value={this.state.fields.user.login_id} onChange={(e) => {this.onFormFieldChange('user', e)}} placeholder="Login Id*" is_mandatory="true" readOnly={true}  />
                                                    <span className="help-block hide" id="login_id_DIV"></span>
                                                </div>
                                                <div className="col-sm-6 control-group">
                                                    <input type="password" name="password" id="password" data-field-type="user" className="form-control" value={this.state.fields.user.password} onChange={(e) => {this.onFormFieldChange('user', e)}} is_mandatory="true" placeholder="Password*" />
                                                    <span className="help-block hide" id="password_DIV"></span>
                                                </div>
                                            </div>

                                        </div>

                                        {/*{ credit_from_details }*/}
                                        { billing_form_details }

                                        <div className="col-sm-12 no-padding">
                                            <p>{ this.state.invoice.note }</p>
                                            <a  className="btn submit-button btn-lg btn-block mt-4" href="" id="subscribe-btn" onClick={ this.state.ready ? this.onSubscribe : () => false }> CONTINUE </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div className="form-group mb-3 signup-billing-container hide">
                        <div id="billing-iframe" />
                    </div>
            </div>

        );

        return (
            <div>
                { new_signup_content }
            </div>
        );
    }

}

MobileQuoterSignUp.propTypes = {

};

MobileQuoterSignUp.defaultProps = {
    //myProp: val
};

export default MobileQuoterSignUp;

if (document.getElementById('signup')) {
    render(
        <MobileQuoterSignUp />,
        document.getElementById('signup')
    )
}
