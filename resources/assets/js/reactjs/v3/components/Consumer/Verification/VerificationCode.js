import React, {Component} from 'react';
import PropTypes from 'prop-types';
import Timer from "../../Timer";
import ReactDOM, {render} from "react-dom";
import Logo from "../../Logo";

/** class VerificationCode */
class VerificationCode extends Component {
    constructor(props) {
        super(props);
        this.state = {
            verification_code: '',
            token: '',
            message: '',
            has_error: false,
            completed: false,
            fields: null,
            phone: null,
            haveMessage: false,
            formComplete: false,
            fieldsCompleted: [],
            selectedField: '',
            changingForm: false,
            updateFailed: false,
            rendFailed: false,
            timer: null,
            timerKey: null
        };

        this.token = jQuery('meta[name="csrf-token"]').attr('content');

        axios.defaults.headers.common = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': this.token
        };

        this.onFieldChange.bind(this);
        this.onNumberFocus.bind(this);
        this.onPhoneChange.bind(this);
        this.onPhoneFieldChange.bind(this);
        this.renderChangePhoneNumber.bind(this);
        this.onUpdatePhone.bind(this);
        this.onValidate.bind(this);
        this.onSubmit.bind(this);
        this.onCancelPhoneChange.bind(this);
        this.onTimesUp.bind(this);
        this.renderFooter.bind(this);
        this.onResendCode.bind(this);
        this.resetFields.bind(this);
    }

    componentDidMount() {

        let fields = {};
        let fieldsCompleted = {};
        let output = [...Array(5).keys()].map( key => {
            let field = "digit_" + (key + 1);
            fields[ field ] = '';
            fieldsCompleted[ field ] = false;
        });

        this.setState({
            token: this.props.token,
            fields: fields,
            fieldsCompleted: fieldsCompleted,
            phone: this.props.phone,
            timerKey: new Date(),
            status: this.props.status,
            haveMessage: ! this.props.status,
            changingForm: false,
            complete: true,
            message: this.props.message,
            has_error: this.props.status
        }, function() {
            if (this.state.fields) {
                $('#digit_1').focus();
            }
        });

    }

    onPhoneFieldChange = e => {
        this.setState({
            phone: e.currentTarget.value
        });
    };

    onTimesUp = () => {
        this.setState({
            formComplete: false
        })
    };

    onFieldChange = e => {
        debugger;
        let newState = Object.assign({}, this.state );
        newState.fields[e.currentTarget.name] = e.currentTarget.value;
        newState.fieldsCompleted[e.currentTarget.name] = e.currentTarget.value.length === 1;
        let fieldsCompleted = Object.entries(newState.fieldsCompleted).filter( ( [field,name], index, fields) => name );
        newState.formComplete = fieldsCompleted.length === 5;
        newState.currentTargetFocus = e.currentTarget;

        this.setState( newState );

        debugger;

        if (e.currentTarget.hasAttribute('data-next-field')) {
            let nextFocus = e.currentTarget.getAttribute('data-next-field');
            $('#' + nextFocus).focus();
        }

    };

    checkFocus = e => {
        debugger;
        let fields = Object.assign({}, this.state.fields );
        fields[e.currentTarget.name] = e.currentTarget.value;
        this.setState({
            fields
        });
    };

    resetFields = () => {
        let fields = {};
        let output = [...Array(5).keys()].map( key => {
            let field = "digit_" + (key + 1);
            fields[ field ] = '';
        });
        this.setState({
            fields
        });

    };

    onValidate = (code) => {
        debugger;
        let url = '/api/app_module';//  + '?module='+'phone_validation_module';
        let fd = new FormData();

        let options = {
            'verification_code' : code,
            'token' : this.state.token,
            'module': 'phone_validation_module'
        };

        fd.append("options" , JSON.stringify(options) );
        fd.append("action" , 'verify' );

        this.preloader = $('.preloader');
        this.preloader.removeClass('loaded');

        axios.post(url, fd).then( res => {
            console.log(res);
            if (res.statusText === "OK") {

                if (res.data.success === true) {
/*                    this.setState({
                        has_error: false,
                        message: res.data.message,
                        haveMessage: false,
                        updateFailed: false,
                        rendFailed: false,
                        status: true,
                        completed: true
                    });*/
                    location.href = res.data.redirect;
                } else {

                    this.preloader.addClass('loaded');

                    this.setState({
                        has_error: true,
                        message: res.data.message,
                        completed: false
                    });
                }

                this.resetFields();
                $('#digit_1').focus();

            }
        });
    };

    onSubmit = e => {
        e.preventDefault();
        debugger;

        let fields  = Object.keys(this.state.fields);
        let code = '';
        for(let i=0; i < fields.length; i++) {
            code = code + this.state.fields[ fields[i] ];
        }
        this.onValidate( code );
    };

    renderErrorMessage = () => {
        // has_error
        let styles = {
            failed: { "color" : "#BD362F", "margin" : "1.4rem"  }
        };
        let message_style = styles.failed;
        return (this.state.updateFailed || this.state.resendFailed) && this.state.message.length > 0 && <div style={ message_style }>{ this.state.message }</div>
    };

    renderMessage = () => {
        // has_error
        let styles = {
            success: { "color" : "#0194e4", "margin" : "1.4rem" },
            failed: { "color" : "#BD362F", "margin" : "1.4rem"  }
        };
        let message_style = this.state.has_error ? styles.failed : styles.success;
        return this.state.message.length > 0 && <div style={ message_style }>{ this.state.message }</div>
    };

    renderVerificationButton = () => {
        return ! this.state.changingForm &&
            <div className="col-xs-12 col-sm-12 col-md-12 col-lg-4 m-y-10 p-0 col-lg-align-t-l">
                <button type="submit" className="btn btn-primary p-x-20 m-l-12 p-x-0" onClick={ this.onSubmit } disabled={ ! this.state.formComplete }>Verify</button>
            </div>
    };

    renderUpdateButton = () => {
        return this.state.changingForm
            && <div className="col-xs-12 col-sm-12 col-md-12 col-lg-6 m-y-10 p-0 col-lg-align-t-l">
                <div>
                    <button type="submit" className="btn btn-primary p-x-10 m-l-18 p-x-0" onClick={ this.onUpdatePhone } >Update</button>
                    <button type="button" className="btn btn-danger p-x-20 m-l-12 m-t-0" onClick={ this.onCancelPhoneChange } >Cancel</button>
                </div>
            </div>
    };

    renderVerificationFields = () => {

        if ( ! this.state.changingForm && this.state.fields ) {
            let fieldsKeys = Object.keys(this.state.fields);
            let fieldsCount = fieldsKeys.length;
            let fields = fieldsKeys.map( (field, index, fields) => {
                debugger;
                let nextField = index < fieldsCount ? fields[index+1] : null;
                return <input type="text" key={ field } className="form-control verification-number" id={ field } name={ field } value={ this.state.fields[field] } data-next-field={ nextField } maxLength={1} onChange={ this.onFieldChange } onFocus={ this.onNumberFocus } />
            });

            return <div className="col-xs-12 col-sm-12 col-md-12 col-lg-8 m-y-10 p-0 col-lg-align-t-r">
                { fields }
            </div>
        }

    };

    onPhoneChange = (e) => {

        e.preventDefault();

        this.setState({
            changingForm: true
        });

    };

    onCancelPhoneChange = (e) => {

        e.preventDefault();

        this.setState({
            changingForm: false
        });

    };

    renderChangePhoneNumber = () => {
        return this.state.changingForm &&
            <div className="col-xs-12 col-sm-12 col-md-12 col-lg-6 m-y-10 p-0 col-lg-align-t-r">
                <input type="text" className="form-control phone-number-field m-r-0" value={ this.state.phone } onChange={ this.onPhoneFieldChange } />
            </div>
    };

    onUpdatePhone = (e) => {
        e.preventDefault();

        debugger;
        let url = '/api/app_module/' + '?module='+'phone_validation_module';
        let fd = new FormData();

        let options = {
            'phone' : this.state.phone,
            'token' : this.state.token
        };

        this.preloader = $('.preloader');
        this.preloader.removeClass('loaded');

        fd.append("options" , JSON.stringify(options) );
        fd.append("action" , 'update' );

        axios.post(url, fd).then( res => {
            console.log(res);
            if (res.statusText === "OK") {

                if (res.data.success === true) {

                    this.setState({
                        has_error: false,
                        message: res.data.message,
                        completed: false,
                        timerKey: new Date()
                    });

                    let that = this;
                    let timeout = setInterval(function() {
                        that.setState({
                            changingForm: false
                        });
                        clearInterval(timeout);

                        render(
                            <Timer minutes={3} callback={ that.onTimesUp } key={ that.state.timerKey } />,
                            document.getElementById('timer-component')
                        );

                    }, 1000);

                } else {
                    this.setState({
                        has_error: true,
                        updateFailed: true,
                        status: false,
                        changingForm: false,
                        message: res.data.message,
                        completed: false
                    });
                }

                this.resetFields();
                $('#digit_1').focus();
                this.preloader.addClass('loaded');
            }
        });

    };

    onResendCode = (e) => {
        e.preventDefault();

        debugger;
        let url = '/api/app_module/' + '?module='+'phone_validation_module';
        let fd = new FormData();

        let options = {
            'token' : this.state.token
        };

        this.preloader = $('.preloader');
        this.preloader.removeClass('loaded');

        fd.append("options" , JSON.stringify(options) );
        fd.append("action" , 'resend' );

        axios.post(url, fd).then( res => {
            console.log(res);
            if (res.statusText === "OK") {

                if (res.data.success === true) {

                    // ReactDOM.unmountComponentAtNode( "timer-component" );

                    this.setState({
                        has_error: false,
                        message: res.data.message,
                        completed: false,
                        changingForm: false,
                        status: true,
                        timerKey: new Date()
                    });

                    render(
                        <Timer minutes={3} callback={ this.onTimesUp } key={ this.state.timerKey } />,
                        document.getElementById('timer-component')
                    );

                } else {
                    this.setState({
                        has_error: true,
                        resendFailed: true,
                        message: res.data.message,
                        status: false,
                        completed: false
                    });
                }

                this.resetFields();
                $('#digit_1').focus();
                this.preloader.addClass('loaded');

            }
        });

    };

    onNumberFocus = (e) => {

        $('.verification-number').removeClass('number-selected');

        if (this.state.selectedField !== e.currentTarget.name) {
            e.currentTarget.className +=  " number-selected";

            // if we had a previous selection clear it.
            /*            if (this.state.selectedField !== '') {
                            let prevSelectedField = document.body.querySelector('#' + this.state.selectedField);
                            prevSelectedField.className = prevSelectedField.className.replace("number-selected", "");
                        }*/

            this.state.selectedField = e.currentTarget.id;

        }
    };

    formatPhoneNumber = (str) => {
        //Filter only numbers from the input
        let cleaned = ('' + str).replace(/\D/g, '');

        //Check if the input is of correct
        let match = cleaned.match(/^(1|)?(\d{3})(\d{3})(\d{4})$/);

        if (match) {
            //Remove the matched extension code
            //Change this to format for any country code.
            let intlCode = (match[1] ? '+1 ' : '')
            return [intlCode, '(', match[2], ') ', match[3], '-', match[4]].join('')
        }

        return null;
    };

    renderHeader = () => {
        if ( this.state.haveMessage ) {
            return <div>
                <p style={{ "color": "#080808" }} >{ this.state.message }</p>
            </div>
        }

        if ( ! this.state.completed && ! this.state.changingForm && this.state.status === true ) {
            return <div>
                <h5 style={{ "color": "#080808" }} >Verify Your Mobile Number</h5>
                <p>A 5-digit code has been sent to:<br />
                    <strong>{ this.formatPhoneNumber( this.state.phone ) }</strong>  <a href='#' style={{"textDecoration":"underline"}} className="m-l-4" onClick={ this.onPhoneChange }>Change</a>
                </p>
            </div>
        } else if ( ! this.state.completed ) {
            return <div>
                <h5 style={{ "color": "#080808" }} >Update Your Mobile Number</h5>
            </div>
        }
    };

    renderFooter = () => {

        return  this.state.timerKey && <div className="col-xs-12">

            <ul className="d-inline-block text-center m-y-10">
                <li style={{ 'textAlign':'left' }} >
                    The OTP will be expired in: <Timer minutes={3} callback={ this.onTimesUp } key={ this.state.timerKey } />
                </li>
                <li style={{ 'textAlign':'left' }} >
                    Didn't receive the code? <a href="#" onClick={ this.onResendCode }>Resend</a>
                </li>
            </ul>

        </div>
    };

    render() {

        return (
            <div>

                <div className="header-results-container phone-verification-container">
                    {/* <img src="https://app.agentquote.com/images/email/email-logo.png" />*/}

                    { this.renderHeader() }

                    <form className="form-inline">
                        <div className="form-group mx-sm-3 mb-2">
                            <label htmlFor="inputPassword2" className="sr-only">Verification code</label>
                        </div>
                        <div className="row">

                            { this.state.status === false && this.renderErrorMessage() }
                            { this.state.status && this.renderMessage() }

                            { this.renderVerificationFields() }
                            { this.state.status && this.renderChangePhoneNumber() }

                            { this.renderVerificationButton() }
                            { this.state.status && this.renderUpdateButton() }

                        </div>

                    </form>

                    <div className="row">
                        { this.state.status && this.renderFooter() }
                    </div>

                </div>

            </div>
        );
    }
}

VerificationCode.propTypes = {
    onSubmit: PropTypes.func.isRequired,
    token: PropTypes.string.isRequired,
    phone: PropTypes.string.isRequired,
    message: PropTypes.string.isRequired,
    status: PropTypes.bool.isRequired
};

VerificationCode.defaultProps = {
    onSubmit: () => {},
    token: '',
    phone: '213-555-1212',
    message:'',
    status: true
};

export default VerificationCode;
