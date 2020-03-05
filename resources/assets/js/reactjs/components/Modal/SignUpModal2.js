import React, { Component } from 'react';
import PropTypes from 'prop-types';
import TextInput from "../TextInput/TextInput";
import toastr from "toastr";
import PasswordProgressBar from "../Password/PasswordProgressBar";

/** function: Modal */
class SignUpModal2 extends Component {

    constructor(props) {
        super(props);

        this.state = {
            show_modal: true,
            account_ready: false,
            fields: {
                account_first_name: '',
                account_last_name: '',
                account_email: '',
                account_company_name: '',
                user_login_id: '',
                user_password: '',
                user_subdomain: '',
                billing_street: '',
                billing_city: '',
                billing_state: '',
                billing_zip: '',
                billing_card_number: '',
                billing_expiry_month: '',
                billing_expiry_year: '',
                billing_cvv_number: ''
            },
            submit: {
                disabled: false,
                caption: 'Save',
                done: 'Message Sent.',
                normal: 'Save',
                onSave: 'Sending...'
            }
        };

        this.token = jQuery('meta[name="csrf-token"]').attr('content')

        axios.defaults.headers.common = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': this.token
        };

        toastr.options = {
            "debug": false,
            "positionClass": "toast-bottom-right",
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 21000
        };
    }

    onComponentDidMount = () => {
    };

    onLoadSubdomain = event => {
        event.preventDefault();

    };

    onChangeState = event => {
        event.preventDefault();
        // user_details
        console.log(event.target);

    };

    onNewAccountChange = event => {
        debugger;
        const newState = Object.assign({}, this.state, { [event.target.name]: event.target.value });
        $(".message-point").fadeOut(2000);
        this.setState(newState, () => {
            if (this.state.username.length && this.state.password.length >= 9 && this.state.password === this.state.confirm_password) {
                this.setState({ account_ready: true });
            }
        });
    };

    onFormFieldChange = event => {
        const newState = Object.assign({}, this.state.fields, { [event.target.name]: event.target.value });
        this.setState({
            fields: newState
        });
    };

    onCheckForAvailability = event => {
        event.preventDefault();
        console.log('Checking for availability...');
    };
    ignoreSubmit = event => {
        event.preventDefault();
    }

    onSubscribe = event => {
        event.preventDefault();
        let newState = Object.assign({}, this.state.submit);
        newState.disabled = true;
        this.setState({
            submit: newState
        });
        let fd = new FormData();
        console.log('Subscribing user: ', this.state.fields);

        return;

        fd.append("name" , this.state.contact.name);
        fd.append("phone" , this.state.contact.phone);
        fd.append("email" , this.state.contact.email);
        fd.append("message" , this.state.contact.message);

        setTimeout(
            function() {
                this.setState({
                    submit: Object.assign({}, this.state.submit, { caption: this.state.submit.onSave, disabled: true })
                });
            }
                .bind(this),
            1200
        );

        axios.post('/user/messages', fd).then( res => {
            console.log(res);

            setTimeout(
                function() {
                    this.setState({
                        submit: Object.assign({}, this.state.submit, { caption: this.state.submit.done, disabled: false })
                    });
                }
                    .bind(this),
                1200
            );

            if (res.data.success) {
                this.setState({contact: {}, show_modal: false});
                toastr.success('Message was sent.');

            } else {
                this.setState({contact: {}, show_modal: false});
            }
        }).catch( error => {
            setTimeout(
                function() {
                    this.setState({
                        submit: Object.assign({}, this.state.submit, { caption: this.state.submit.normal, disabled: false })
                    });
                }
                    .bind(this),
                1200
            );
            console.log(error);
            this.setState({contact: {}, show_modal: false});
        });

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
                    onChange={this.onFormFieldChange}
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
                "background": "#28A5ED",
                "borderTopLeftRadius": "5px",
                "borderTopRightRadius": "5px",
                "color": "#ffffff"
            }
        };

        const new_signup_content = (
                    <div className="form-group input-group mb-3" id="account_info">
                        <div className="col-md-12 order-summary-container no-padding mb-20">
                            <div className="row">

                                <div className="col-md-12">
                                    <div style={new_styles.productBanner}>
                                        My Mobile Life Quoter Subscription
                                    </div>
                                </div>
                                <div className="col-md-12">
                                    <div className="row header">
                                        <div className="col-8 cell">Product</div>
                                        <div className="col-2 cell">Qty</div>
                                        <div className="col-2 cell">Price</div>
                                    </div>
                                </div>
                                <div className="col-md-12">
                                    <div className="row product-row">
                                        <div className="col-8 cell text-left">My Mobile Life Quoter</div>
                                        <div className="col-2 cell qty-cell">1</div>
                                        <div className="col-2 cell last-cell">Price</div>
                                    </div>
                                </div>
                                <div className="col-md-12">
                                    <div className="row total-row">
                                        <div className="col-10 cell text-left">TOTAL</div>
                                        <div className="col-2 cell last-cell">$5.00</div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div className="col-sm-12 order-form-container no-padding mb-20 form-group">
                            <div className="row">
                                <div className="col-md-12">
                                    <div className="form-group account-info-container">

                                        <label>Account Information</label>

                                        <div className="row form-group">
                                            <div className="col-sm-6 control-group">
                                                <input type="text" name="account_first_name" id="account_first_name" className="form-control" value={this.state.fields.account_first_name} onChange={this.onFormFieldChange} placeholder="First Name*" />
                                                <span className="help-block hide" id="first_name_DIV" />
                                            </div>
                                            <div className="col-sm-6 control-group">
                                                <input type="text" name="account_last_name" id="account_last_name" className="form-control" value={this.state.fields.account_last_name} onChange={this.onFormFieldChange} placeholder="Last Name*" />
                                                <span className="help-block hide" id="last_name_DIV"></span>
                                            </div>
                                        </div>
                                        <div className="row form-group">
                                            <div className="col-sm-6 control-group">
                                                <input type="account_email" name="account_email" id="email" className="form-control"  value={this.state.fields.account_email} onChange={this.onFormFieldChange} placeholder="Email*" is_mandatory="true" />
                                                <span className="help-block hide" id="email_DIV"></span>
                                            </div>
                                            <div className="col-sm-6 control-group">
                                                <input type="text" name="account_company_name" id="account_company_name" className="form-control" value={this.state.fields.account_company_name} onChange={this.onFormFieldChange} placeholder="Company" />
                                                <span className="help-block hide" id="company_name_DIV"></span>
                                            </div>
                                        </div>

                                    </div>

                                    <div className="form-group user-info-container">

                                        <label>User Information</label>

                                        <div className="row form-group">
                                            <div className="col-sm-6 control-group">
                                                <input type="text" name="user_login_id" id="user_login_id" className="form-control"  value={this.state.fields.user_login_id} onChange={this.onFormFieldChange} placeholder="Login Id*" is_mandatory="true" />
                                                <span className="help-block hide" id="username_DIV"></span>
                                            </div>
                                            <div className="col-sm-6 control-group">
                                                <input type="password" name="user_password" id="user_password" className="form-control" value={this.state.fields.user_password} onChange={this.onFormFieldChange} placeholder="Password*" />
                                                <span className="help-block hide" id="password_DIV"></span>
                                            </div>
                                        </div>
                                        <div className="row form-group">
                                            <div className="col-sm-6 control-group">
                                                <input type="text" name="user_subdomain" id="user_subdomain" className="form-control" value={this.state.fields.user_subdomain} onChange={this.onFormFieldChange} is_mandatory="true" placeholder="Microsite Subdomain*" isnullable="false" />
                                                <span className="help-block hide" id="subdomain_DIV"></span>
                                            </div>
                                            <div className="col-sm-6 control-group">
                                                <a  className="btn btn-primary btn-md btn-block" href="" onClick={this.onCheckForAvailability}> Check for Availability </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div className="billing-info-container col-sm-12"><label>Billing
                                        Address</label>
                                        <div className="row form-group">
                                            <div className="col-sm-12 control-group">
                                                <input type="text" name="billing_street" id="billing_street" value={this.state.fields.billing_street} onChange={this.onFormFieldChange} className="form-control" placeholder="Street*" is_mandatory="true" />
                                                <span className="help-block hide" id="billing_street_DIV"></span>
                                            </div>
                                        </div>
                                        <div className="row form-group">
                                            <div className="col-sm-6 control-group">
                                                <input type="text" name="billing_city" id="billing_city" value={this.state.fields.billing_city} onChange={this.onFormFieldChange} className="form-control" placeholder="City*" is_mandatory="true" />
                                                <span className="help-block hide" id="billing_street_DIV"></span>
                                            </div>
                                            <div className="col-sm-6 control-group">
                                                <select name="billing_state_code" id="billing_state_code" className="form-control" is_mandatory="true" defaultValue={this.state.fields.billing_state} onChange={this.onFormFieldChange}>
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
                                                <span className="help-block hide" id="billing_street_DIV"></span>
                                            </div>
                                        </div>

                                        <div className="row form-group">
                                            <div className="col-sm-12 control-group">
                                                <input type="text" name="billing_zip" id="billing_zip" value={this.state.fields.billing_zip} onChange={this.onFormFieldChange} className="form-control" placeholder="Zip*" is_mandatory="true" />
                                                <span className="help-block hide" id="billing_street_DIV"></span>
                                            </div>
                                        </div>

                                    </div>

                                    <div className="payment-info-container col-sm-12"><label>Payment Information</label>
                                        <div className="row form-group">
                                            <div className="col-sm-12 control-group">
                                                <input type="tel" name="billing_card_number" id="billing_card_number" className="form-control" maxLength="25" placeholder="Card Number*" is_mandatory="true" value={this.state.fields.billing_card_number} onChange={this.onFormFieldChange} />
                                                <span className="help-block hide" id="billing_street_DIV"></span>
                                            </div>
                                        </div>

                                        <div className="row form-group">
                                            <div className="col-sm-4 control-group">
                                                <select name="billing_expiry_month" id="billing_expiry_month" className="form-control" is_mandatory="true" defaultValue={this.state.fields.billing_expiry_month} onChange={this.onFormFieldChange}>
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
                                                <select name="billing_expiry_year" id="billing_expiry_year" className="form-control" is_mandatory="true"  defaultValue={this.state.fields.billing_expiry_year} onChange={this.onFormFieldChange}>
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
                                                <span className="help-block hide" id="expiry_year_DIV"></span>
                                            </div>
                                            <div className="col-sm-4 control-group">
                                                <input type="password" name="billing_cvv_number" id="billing_cvv_number" className="form-control cvv_number" placeholder="CVV*" is_mandatory="true"  value={this.state.fields.billing_cvv_number} onChange={this.onFormFieldChange} />
                                                <span className="help-block hide" id="cvv_number_DIV"></span>
                                            </div>

                                        </div>

                                    </div>
                                    <div className="col-sm-12 no-padding">
                                        <a  className="btn submit-button btn-lg btn-block mt-4" href="" id="subscribe-btn" onClick={this.state.submit.disabled ? this.ignoreSubmit : this.onSubscribe}> Subscribe </a>
                                    </div>

                                </div>
                            </div>
                        </div>
{/*

                        <div className="col-md-12">
                            <div className="field">
                                <label htmlFor="username">Username</label>
                                <input className="form-control form-control-md" name="username" id="username" placeholder="" onChange={this.onFormFieldChange} />
                                <i className="fa fa-user orange-theme"></i>
                            </div>
                        </div>
                        <div className="col-md-12">
                            <div className="field">
                                <label htmlFor="username">Password</label>
                                <PasswordProgressBar name="password" onChange={this.onFormFieldChange} />
                            </div>
                        </div>
                        <div className="col-md-12">
                            <div className="field">
                                <label htmlFor="username">Confirm password</label>
                                <input type="password" className="form-control form-control-md" name="confirm_password" id="confirm_password" placeholder="" onChange={this.onFormFieldChange}/>
                                <i className="fa fa-lock orange-theme"></i>
                            </div>
                        </div>

                        <div className="input-group">
                            <div className="col-md-12 mb-3">
                                <a className="btn btn-primary btn-block mt-4" href="#new-account" data-whatever="@mdo" onClick={this.onChangeState} disabled={this.state.account_ready} value="Continue with Account Details" > Continue </a>
                            </div>
                        </div>*/}

                    </div>
        );

        const modal_footer = (
            <div className="modal-footer">
                <button type="button" className="btn btn-primary" data-toggle="modal" data-target="#SignUpModel" data-whatever="@mdo" onClick={this.onSubmit}>Next</button>
            </div>
        );

        const modal_window = (
            <div>
                <div className="fd3-modal fd3-modal-bg-black fd3-modal-fs" id="new-account2">
                    <div className="fd3-modal-container">
                        <a href="#modal-close" className="close-btn"><i className="fa fa-times"></i></a>
                        <div className="fd3-contents">
                            <div className="contents-container">
                                { new_signup_content }
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );

        return (
            <div>
                { modal_window }
            </div>
        );
    }

}

SignUpModal2.propTypes = {

};

SignUpModal2.defaultProps = {
    //myProp: val
};

export default SignUpModal2;

/*
Hi [Name of Person],

I’m sorry to hear that you weren't able to make it 12:00 noon. I was really looking forward to getting together. I’ve got so much going on these days that it would’ve been helpful had you reached out sooner, but I understand these things happen. I can meet with you on Friday Oct 12 between 2:00 - 3:00. Please be sure to verify with me an hour before. Thanks.
 */