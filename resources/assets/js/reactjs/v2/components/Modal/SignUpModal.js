import React, { Component } from 'react';
import PropTypes from 'prop-types';
import TextInput from "../TextInput/TextInput";
import toastr from "toastr";
import PasswordProgressBar from "../Password/PasswordProgressBar";

/** function: Modal */
class SignUpModal extends Component {

    constructor(props) {
        super(props);

        this.state = {
            show_modal: true,
            username: '',
            password: '',
            confirm_password: '',
            subdomain: '',
            account_ready: false,
            cc_number: '',
            cc_expiration: '',
            cc_cvc: '',
            billing_ready: false,
            flow: 'account-setup',
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
        if (this.state.flow === 'account-setup') {
            this.setState({
                flow: 'settings-setup'
            });
            $('#settings-setup').tab('show');
        } else if (this.state.flow === 'settings-setup') {
            this.setState({
                flow: 'billing-setup'
            });
            $('#billing-setup').tab('show');
        } else if (this.state.flow === 'billing-setup') {
            this.setState({
                flow: 'account-setup'
            });
            $('#account-setup').tab('show');
        }
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
        debugger;
        const newState = Object.assign({}, this.state, { [event.target.name]: event.target.value });
        this.setState(newState);
    };

    onSubmit = event => {
        event.preventDefault();
        console.log(this.state.contact);

        let fd = new FormData();

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

        const cc_icons_content = cc_icons.map(i => {
            return <i className={i.name} key={i.name} />
        });

        const tab_content_2 = (
            <ul className="nav fd3-center-block">
                <li className="nav-item"><a href="#account_details" id="account_details" className="nav-link active" data-toggle="">New Account</a></li>
                <li className="nav-item"><a href="#contact_details" id="contact_details" className="nav-link">Contact Information</a></li>
                <li className="nav-item"><a href="#billing_details" id="billing_details" className="nav-link">Billing Details</a></li>
{/*
                {[ {text: 'New Account', id: 'account_details', hash: '#new-account'}, {text: 'Contact Information', id: 'contact_details', hash: '#contact-info'}, {text: 'Billing Details', id: 'billing_details', hash: '#billing-details'}].map((n, i) => {
                    return <li className="nav-item"><a href={n.hash} id={n.id} className={ i === 0 ? 'nav-link active' : 'nav-link' }>{n.text}</a></li>
                })}

                */}
            </ul>
        );

        const new_account = (
                    <div className="form-group input-group mb-3" id="account_info">
                        { tab_content_2 }
                        <div className="col-md-12"><h4>New Account</h4></div>
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
                        </div>

                    </div>
        );

        const contact_info2 = (
            <div className="form-group input-group mb-3" id="account_info">
                { tab_content_2 }
                <div className="col-md-12"><h4>New Account</h4></div>
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
                </div>

            </div>
        );

        const modal_body = (
            <div className="modal-body">
                <form>
                    <div className="form-group input-group mb-3">
                        <div className="col-md-12 mb-2">
                            <div className="field">
                                <input id="" className="form-control" name="phone" value="" placeholder="Name" />
                                <i className="fa fa-user orange-theme"></i>
                            </div>
                        </div>
                        <div className="col-md-12 mb-2">
                            <div className="field">
                                <input id="" className="form-control" name="email" value="" placeholder="Email" />
                                <i className="fa fa-envelope orange-theme"></i>
                            </div>
                        </div>
                        <div className="col-md-12 mb-2">
                            <div className="field">
                                <input id="" className="form-control" name="phone" value="" placeholder="Phone" />
                                <i className="fa fa-phone orange-theme"></i>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-12 mb-3">
                        <div className="cc-icons">
                            { cc_icons_content }
                        </div>
                    </div>
                    <div className="form-group input-group mb-3">
                        <div className="col-md-12 mb-2">
                                <div className="field">
                                    <input id="" className="form-control cc-top" name="email" value="" placeholder="Card number" />
                                    <i className="fa fa-credit-card orange-theme"></i>
                                </div>
                                <div className="field">
                                    <input id="" className="form-control left cc-bottom" name="phone" value="" placeholder="MM / YY" />
                                    <i className="fa fa-calendar orange-theme"></i>

                                    <input id="" className="form-control right cc-bottom" name="phone" value="" placeholder="CVC" />
                                    <i className="fa fa-lock orange-theme"></i>
                                </div>
                        </div>
                    </div>

                    <div className="input-group mt-5 mb-3">
                        <div className="col-md-12 mb-3">
                            <input id="submitButton" className="btn btn-success btn-lg btn-long" name="SUBMIT" type="submit" value="Sign Up" />
                        </div>
                    </div>

                    <p className="black-text">Rates shown are estimates, the actual premium will be determined after the underwriting process has been completed and may differ from the original quote. This quoting system is for rate comparisons only. This is not an offer or an illustration of life insurance. However, you may request an application by completing the appropriate application request form. This material briefly summarizes the product's features but is not a contract. You may review the actual contract terms, conditions and limitations by requesting a sample copy of the described policy.</p>
                </form>
            </div>
        );

        const modal_footer = (
            <div className="modal-footer">
                <button type="button" className="btn btn-primary" data-toggle="modal" data-target="#SignUpModel" data-whatever="@mdo" onClick={this.onSubmit}>Next</button>
            </div>
        );

        const tab_content = (
            <ul className="nav justify-content-center">
                {[ {text: 'New Account ', id: 'account_details'}, {text: 'Contact Information', id: 'contact_details'}, {text: 'Billing', id: 'billing_details'}].map((n, i) => {
                    return <li className="nav-item"><a href="#" id={n.id} className={ i === 0 ? 'nav-link active' : 'nav-link' }>{n.text}</a></li>
                })}
            </ul>
        );

        const new_tab_menu = (
            <ul className="nav nav-tabs" id="signup-tabs">
                {
                    [
                        {
                            id: "account-setup",
                            path: "#account",
                            className: "nav-link active",
                            text: "Account"
                        },
                        {
                            id: "settings-setup",
                            path: "#settings",
                            className: "nav-link",
                            text: "Settings"
                        },
                        {
                            id: "billing-setup",
                            path: "#billing",
                            className: "nav-link",
                            text: "Billing"
                        },
                    ].map(menu_item => {
                        return (
                            <li className="nav-item">
                                <a href={menu_item.path} id={menu_item.id} className={menu_item.className} role="tab" data-toggle="tab">{menu_item.text}</a>
                            </li>
                        )
                    })
                }
            </ul>
        );
        /*

                <div>
                    <ul className="nav nav-tabs" id="signup-tabs">
                        <li className="nav-item">
                            <a className="nav-link active" href="#account" id="account-setup" role="tab" data-toggle="tab">Account</a>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link" href="#settings" id="settings-setup" role="tab" data-toggle="tab">Settings</a>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link" href="#billing" id="billing-setup" role="tab" data-toggle="tab">Billing</a>
                        </li>
                    </ul>
                </div>

                <div className="tab-content">
                    <div role="tabpanel" className="tab-pane active fade in show" id="account">
                        <a href="#" className="btn btn-success btn-lg" onClick={this.onChangeState}>Next Settings</a>
                    </div>
                    <div role="tabpanel" className="tab-pane fade" id="settings">
                        <a href="#" className="btn btn-success btn-lg" onClick={this.onChangeState}>Next Billing</a>
                    </div>
                    <div role="tabpanel" className="tab-pane fade" id="billing">
                        <a href="#" className="btn btn-success btn-lg" onClick={this.onChangeState}>Next Account</a>
                    </div>
                </div>

        */

        const new_tab_content = (
            <div className="tab-content">
                {
                    [
                        {
                            id: "account",
                            text: "Next Settings",
                            path: "#account",
                            className: "tab-pane active fade in show",
                        },
                        {
                            id: "settings",
                            text: "Next Billing",
                            path: "#settings",
                            className: "tab-pane fade",
                        },
                        {
                            id: "billing",
                            text: "Next Account",
                            path: "#billing",
                            className: "tab-pane fade",
                        },
                    ].map(tab_item => {
                        return (
                            <div role="tabpanel" className={tab_item.className} id={tab_item.id}>
                                <a href={tab_item.path} className="btn btn-success btn-lg" onClick={this.onChangeState}>{tab_item.text}</a>
                            </div>
                        )
                    })
                }
            </div>
        );

        const modal_window_2_iframe = {
            "width": "100%",
            "minHeight": "500px"
        };

        const modal_window_2 = (
            <div>
                <div className="fd3-modal fd3-modal-bg-black fd3-modal-fs" id="new-account">
                    <div className="fd3-modal-container">
                        <a href="#modal-close" className="close-btn"><i className="fa fa-times"></i></a>
                        <div className="fd3-contents">
                            <div className="contents-container">
                                <iframe style={modal_window_2_iframe}
                                    src="https://subscriptions.zoho.com/subscribe/b71533dbc180f03dc8e60b8126a23fe8b9de07abf9a0975fad482bf477cf719e/34ert33er"
                                    frameBorder="0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );

        const modal_window = (
            <div>
                <div className="modal fade" id="SignUpModel" tabIndex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="false">
                    <div className="modal-dialog modal-full" role="document">
                        <div className="modal-content">
                            <div className="contents-container">
                                { modal_header }
                                { tab_content }

                                {/*<div className="tab-content">
                                    <div className="content-frame">
                                        <div className="tab-pane fade active" role="tabpanel" id="account_details">
                                            { contact_info }
                                        </div>
                                        <div className="tab-pane fade" role="tabpanel" id="user_details">
                                            { contact_info }
                                        </div>
                                        <div className="tab-pane fade" role="tabpanel" id="billing_details">
                                            { contact_info }
                                        </div>
                                    </div>
                                </div>*/}

                                <div className="contents-container">

                                    <div className="tab-content">
                                        <div className="tab-pane active" id="account_details" role="tabpanel"
                                             aria-labelledby="home-tab">
                                            { new_account }
                                        </div>
                                        <div className="tab-pane" id="user_details" role="tabpanel"
                                             aria-labelledby="profile-tab">
                                            { contact_info2 }
                                        </div>
                                        <div className="tab-pane" id="billing_details" role="tabpanel"
                                             aria-labelledby="messages-tab">
                                            { new_account }
                                        </div>
                                    </div>

                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>

        );

        return (
            <div>
                { modal_window_2 }
            </div>
        );
    }

}

SignUpModal.propTypes = {

};

SignUpModal.defaultProps = {
    //myProp: val
};

export default SignUpModal;

/*
Hi [Name of Person],

I’m sorry to hear that you weren't able to make it 12:00 noon. I was really looking forward to getting together. I’ve got so much going on these days that it would’ve been helpful had you reached out sooner, but I understand these things happen. I can meet with you on Friday Oct 12 between 2:00 - 3:00. Please be sure to verify with me an hour before. Thanks.
 */