import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {render} from "react-dom";
import toastr from "toastr";
import QuoteResult from "../Quote/QuoteResult";
// import AffiliateAd from "../Quote/Quoter/AffiliateAd";
import QuoteResults from "../Quote/QuoteResults";
import AffiliateAd from "../../Quoter/AffiliateAd";
import TermLifeQuoteModule from "./TermLifeQuoteModule";

class FinalExpenseQuoteModule extends Component {
    constructor(props) {
        super(props);
        this.state = {
            showForm: true,
            quoteInfo: {
                accountId: 3,
                amount_to_quote: 50,
                age: 50,
                age_or_date: 'age',
                term: 121,
                birth_month: 1,
                birth_day: 1,
                birth_year: 1968,
                state: user_default_state,
                premium: 0,
                gender: 'M',
                tobacco: 'N',
                other: 0,
                email: '',
                phone: ''
            },
            loading: false
        };

        this.token = jQuery('meta[name="csrf-token"]').attr('content');

        axios.defaults.headers.common = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': this.token
        };

        toastr.options = {
            "debug": false,
            "positionClass": "toast-top-center",
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 21000
        };

        this.stateOptionsArray = this.props.statesArray.map( item => {
            return {text: item.name, value: item.abbr}
        });

        this.stateOptions = this.stateOptionsArray.map( item => {
            return <option key={item.value+item.text} value={item.value}>{item.text}</option>
        });

        // @todo: get only the supported licensed states
        this.stateOptions = this.stateOptions.filter( item => {
            return item.props.value === this.props.defaultState
        });

        this.ages = this.range(0, 90).map(y => {
             return (90/2 === y ) ? <option key={y} value={y} selected='selected'>{y}</option> : <option key={y} value={y}>{y}</option>;
        });

        this.onBannerChange.bind(this);
        this.onGenQuoteRequest.bind(this);
        this.onEmailChange.bind(this);
        this.onPhoneChange.bind(this);

    }

    componentDidMount() {
       // this.props.eventsRouter.on('hello', this.receiveMessage.bind(this) );
    }

    receiveMessage = (message) => {
        debugger;
        console.log("FinalExpenseQuoteModule: I received a message.");
        console.log("FinalExpenseQuoteModule: this message event is " + message.event );
        console.log("FinalExpenseQuoteModule: this data i received " + message.data );
        console.log(message);
    };

    renderTobacco = () => {
        return (
            <div className="form-group col-md-6">
                <label htmlFor="tobacco">Tobacco</label>
                <select name="tobacco" id="tobacco" className="form-control"><option value="N">Non-Tobacco</option><option value="Y">Tobacco</option></select>
            </div>
        );
    };

    renderAge = () => {
        return (
            <select name="age" id="age" className="form-control" defaultValue="50" onChange={this.onAgeChange}>
                { this.ages }
            </select>
        );
    };

    renderGender = () => {
        return (
            <div className="form-group col-md-6">
                <label htmlFor="gender">Gender</label>
                <select name="gender" id="gender" className="form-control"><option value="M">Male</option><option value="F">Female</option></select>
            </div>
        );
    };

    renderAmount = () => {
        return (
            <div>
                <div className="form-group col-md-6">
                    <input type="text" name="amount" id="amount" className="form-control" placeholder="Amount" />
                </div>
                <div className="form-group col-md-6">
                    <select name="benefit" id="benefit" className="form-control">
                        <option value="-1" selected="">Choose Face Amount</option><option value="25">$25,000</option><option value="50">$50,000</option><option value="75">$75,000</option><option value="100">$100,000</option><option value="125">$125,000</option><option value="150">$150,000</option><option value="175">$175,000</option><option value="200">$200,000</option><option value="250">$250,000</option><option value="300">$300,000</option><option value="350">$350,000</option><option value="400">$400,000</option><option value="450">$450,000</option><option value="500">$500,000</option><option value="550">$550,000</option><option value="600">$600,000</option><option value="650">$650,000</option><option value="700">$700,000</option><option value="750">$750,000</option><option value="800">$800,000</option><option value="850">$850,000</option><option value="900">$900,000</option><option value="1000">$1,000,000</option><option value="1500">$1,500,000</option><option value="2000">$2,000,000</option><option value="2500">$2,500,000</option><option value="3000">$3,000,000</option><option value="3500">$3,500,000</option><option value="4000">$4,000,000</option><option value="5000">$5,000,000</option><option value="6000">$6,000,000</option><option value="7000">$7,000,000</option><option value="8000">$8,000,000</option><option value="9000">$9,000,000</option>
                    </select>
                </div>
            </div>
        );
    };

    renderState = () => {
        debugger;
        return (
            <div className="form-group col-md-6">
                <label htmlFor="state">State</label>
                <select className="form-control" name="state" id="state" defaultValue={ this.props.defaultState }>
                    { this.stateOptions }
                </select>
            </div>
        );
    };

    renderTerm = () => {
        return (
            <div className="form-group col-md-6">
                <label htmlFor="term">Term</label>
                <select name="term" id="term" className="form-control" onChange={ this.onBannerChange } defaultValue={ 121 }>
                    { this.getTermYears() }
                </select>
            </div>
        );
    };

    renderEmail = () => {
        return (
            <div className="form-group col-md-6">
                <label htmlFor="email">Email Address</label>
                <input type="email" name="email" id="email" className="form-control" placeholder="E-Mail" onChange={this.onEmailChange} />
            </div>
        );
    };

    renderPhone = () => {
        return (
            <div className="form-group col-md-6">
                <label htmlFor="phone">Phone Number</label>
                <input type="phone" name="phone" id="phone" className="form-control" placeholder="Phone Number" onChange={this.onPhoneChange} />
            </div>
        );
    };

    renderTermAgreement = () => {
        return (
            <div className="custom-control custom-checkbox checkbox-term-container">
                <input type="checkbox" className="custom-control-input" id="customCheck1" />
                <label className="custom-control-label" htmlFor="customCheck1">I Agree | <a href="#">Terms</a></label>
            </div>
        );
    };

    renderEmailMeThisQuote = () => {
        return (
            <input type="submit" id="email-group-btn" className="btn btn-primary w-100" value="email this quote" onClick={this.onGenQuoteRequest} />
        );
    };

    range = (start, end) => {
        return Array(end - start + 1).fill().map((_, idx) => start + idx)
    };

    getTermYears = () => {
        return [{name: '10 Pay', value: 10},{name: '20 Pay', value: 20},{name: 'Life Pay', value: 121}].map( n => {
            return <option key={n.value} value={n.value}>{n.name}</option>
        })
    };

    generateCalendarOptions = (type) => {
        if (type === "day") {
            let option = <option key={-1} value={-1}>dd</option>;
            let days = [...Array(32).keys()].map(d => {
                return <option key={d} value={d}>{d}</option>
            });
            return Object.assign([], days, [option] );
        }
        else if (type === "month") {
            let option = <option key={-1} value={-1}>mm</option>;
            let months = [...Array(13).keys()].map( n => {
                return <option key={n} value={n}>{n}</option>
            });
            return Object.assign([], months, [option] );
        }
        else if(type === "year") {
            let option = <option key={-1} value={-1}>yyyy</option>;
            let years = this.range(new Date().getFullYear() - 91, new Date().getFullYear() ).map(y => {
                return <option key={y} value={y}>{y}</option>
            });
            return Object.assign([], years, [option] );
        }

    };

    getPremiums = () => {
        return [{value: 0, text: 'Annual Premium'},{value: 1, text: 'Monthly Premiums'},{value: 2, text: 'Quarterly Premiums'},{value: 3, text: 'Semiannual Premiums'}].map( p => {
            return <option key={p.value+p.text} value={p.value}>{p.text}</option>
        })
    };

    formatCurrency = (s, n, x) => {
        let num = parseInt(s);
        let re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
        return '$'+num.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
    };

    generateBenefitOptions = () => {
        const stops = [
            { start: 1000, end: 10000, inc: 1000 },
            { start: 10000, end: 25000, inc: 2500 },
            { start: 25000, end: 50000, inc: 5000 },
            { start: 50000, end: 100001, inc: 10000 },
        ];

        return stops.map( point => {
            let arr = [];
            for (let i = point.start; i < point.end; i = i + point.inc) {
                arr.push(<option key={i} value={i/1000}>{this.formatCurrency(i)}</option>);
            }
            return arr;
        });
    };

    renderBenefit = () => {
        return (
            <select name="benefit" id="benefit" className="form-control" onChange={this.onAmountChange} defaultValue={-1}>
                { this.generateBenefitOptions() }
            </select>
        );
    };

    renderDOB = () => {
        return (
            <div className="form-group inline-input-group">
                <select name="birth_month" id="birth_month" className="form-control inline-control"  onChange={this.onBannerChange}>
                    { this.generateCalendarOptions('month') }
                </select>
                <select id="birth_day" name="birth_day" className="form-control inline-control"  onChange={this.onBannerChange}>
                    { this.generateCalendarOptions('day') }
                </select>
                <select name="birth_year" id="birth_year" className="form-control inline-control"  onChange={this.onBannerChange}>
                    { this.generateCalendarOptions('year') }
                </select>
            </div>
        );
    };

    renderForm = () => {
        return (
            <div>
                <form>

                    <div className="form-row">
                        { this.renderState() }
                        { this.renderTerm() }
                    </div>

                    <div className="form-row">
                        { this.renderTobacco() }
                        { this.renderGender() }
                    </div>

                    <div className="form-group">
                        <h3 className="age-or-dob">Age or DOB</h3>
                    </div>

                    <div className="form-row">
                        <div className="form-group col-md-6">
                            <label htmlFor="age">Age</label>
                            { this.renderAge() }
                        </div>

                        <div className="form-group col-md-6">
                            <label htmlFor="gender">DOB</label>
                            { this.renderDOB() }
                        </div>
                    </div>

                    <div className="form-group">
                        <h3 className="enter-or-choose-faceamount">Enter or Choose Face Amount</h3>
                    </div>

                    <div className="form-row">
                        <div className="form-group col-md-6">
                            <input type="text" name="amount" id="amount" className="form-control" placeholder="Amount" onKeyUp={this.onAmountChange} />
                        </div>
                        <div className="form-group col-md-6">
                            { this.renderBenefit() }
                        </div>
                    </div>

                    <div className="form-row">
                        { this.renderEmail() }
                        { this.renderPhone() }
                    </div>

                    <div className="form-group d-flex justify-content-center mb-0">
                        { this.renderTermAgreement() }
                    </div>

                    <div className="form-group mb-4">
                        { this.renderEmailMeThisQuote() }
                    </div>

                    <div className="form-group disclaimer-container">
                        <div className="disclaimer"><span>Terms & Conditions Apply</span></div>
                    </div>

                </form>
                {/*<div id="loader-container" />*/}
            </div>

        );
    };

    checkIfResetSelect = (event) => {
        if ([
            'birth_month',
            'birth_day',
            'birth_year'
        ].indexOf(event.target.name)) {
            $("select#age").get(0).selectedIndex = 0;
        }
    };

    onBannerChange = event => {

        if ([
            'birth_month',
            'birth_day',
            'birth_year'
        ].indexOf(event.target.name)) {
            const age_or_date = 'date';
            this.setState({
                quoteInfo: Object.assign({},  this.state.quoteInfo, {[event.target.name]: event.target.value, age_or_date})
            });
        }
        else {
            this.setState({
                quoteInfo: Object.assign({},  this.state.quoteInfo, {[event.target.name]: event.target.value})
            });
        }
        if (event.target.name === "birth_year") {
            this.onYearChange(event);
        }
    };

    onYearChange = event => {
        let birth_year = event.target.value;
        let cur_date = new Date();
        let cur_year = cur_date.getFullYear();
        let age = cur_year - birth_year;

        const age_or_date = 'date';

        this.setState({
            quoteInfo: Object.assign({},  this.state.quoteInfo, {[event.target.name]: event.target.value, age_or_date})
        });

        $('#age').val(age);
    };

    onAgeChange = event => {
        let age = event.target.value;
        let cur_date = new Date();
        // console.log("Current Date: ", cur_date);
        let cur_year = cur_date.getFullYear();
        let birth_month = cur_date.getMonth(); // account for returning 0 to 11
        let birth_day = cur_date.getDate();
        let birth_year = cur_year - age;
        let age_or_date = 'age';

        $('#birth_month').val(birth_month);
        $('#birth_day').val(birth_day);
        $('#birth_year').val(birth_year);

        $("select#birth_month").get(0).selectedIndex = birth_month;
        $("select#birth_day").get(0).selectedIndex = birth_day;

        $('select#birth_year option:eq(' + birth_year +')').prop('selected', true);

        // increment to 1 - 12 month
        birth_month = birth_month + 1;

        if (age_or_date === 'age') {
            console.log('use age: ', { age });
            console.log('which is date: ', { birth_month, birth_day, birth_year });
        } else {
            console.log('use birthday: ', { birth_month, birth_day, birth_year });
        }

        this.setState({
            quoteInfo: Object.assign({},  this.state.quoteInfo, { birth_month, birth_day, birth_year, age, age_or_date } )
        });
    };

    isNumeric = (n) => {
        return !isNaN(parseFloat(n)) && isFinite(n);
    };

    onAmountChange = event => {
        let value = event.target.value;

        if (value === "-1") return;

        value = value.replace(/\$/g,'').replace(/\,/g,"");
        value = value.replace(/ /g,'').replace(/\,/g,"");

        if ( ! this.isNumeric( value ) ) {
            return;
        }

        let newState = Object.assign({}, this.state.quoteInfo);
        // if the user select from benefit amount, format the value to splay in the amount field
        if (event.target.name === "benefit") {
            newState.amount_to_quote = value; // before we format the value let us save the correct
                                              // value for a quote request.
            value = parseInt(value) * 1000;   // make sure we have an integer and then make a full number to display
            value = value + ""; // since we converted to int we need to convert back to string
        }
        // if the user types the amount manually clear the benefit drop down
        if (event.target.name === "amount") {
            $("select#benefit").get(0).selectedIndex = 0;
            newState.amount_to_quote = value / 1000;
        }

        // format the amount field, add commas if needed
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        // finish formatting by adding dollar symbol
        $('#amount').val('$' + value);

        this.setState({
            quoteInfo: newState
        });
    };

    onEmailChange = event => {
        debugger;
        let value = event.target.value;

        if (value === "") return;

        let newState = Object.assign({}, this.state.quoteInfo);

        newState.email = value;

        this.setState({
            quoteInfo: newState
        });
    };

    onPhoneChange = event => {
        let value = event.target.value;

        if (value === "") return;

        let newState = Object.assign({}, this.state.quoteInfo);

        newState.phone = value;

        this.setState({
            quoteInfo: newState
        });
    };

    isReady = () => {
        return this.state.quoteInfo.amount_to_quote !== 0;
    };

    onGenQuoteRequest = event => {

        event.preventDefault();

        if (!this.isReady()) {
            toastr.error('You must provide a Face Amount');
            return;
        }

        this.setState(
            { loading: true }
        );

        this.loader = $("#loader-container");

        this.loader.toggleClass("loader");

/*        if ($('#quote-results').hasClass("show")) {
            $('#quote-results').removeClass("show");
        }*/

        // this.setState({ loading: true });

        if ($('#email').val() !== "") {
            let testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

            if (!testEmail.test($('#email').val())) {
                toastr.error('Please provide a valid email address.');
                return;
            }

        } else {
            toastr.error('Please provide an email address.');
            return;
        }

        if ($('#phone').val() !== "") {
            let testPhone = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;

            if (!testPhone.test($('#phone').val())) {
                toastr.error('Please provide a valid phone number');
                return;
            }
        } else {
            toastr.error('Please provide a phone number.');
            return;
        }

        if (! $('#customCheck1').prop("checked") === true) {
            toastr.error('To continue you must agree to our Terms & Conditions.');
            return;
        }

        let query = Object.keys(this.state.quoteInfo).map( k => this.state.quoteInfo[k]).join("|");
        console.log("Request Vars", query);

/*        render(
            '',
            document.getElementById('ad-container')
        );
*/
/*        render(
            '',
            document.getElementById('quote-results')
        );

        this.resultsContainer = $('#quote-results');*/


        let fd = new FormData();

        let object = {};
        fd.forEach(function(value, key){
            object[key] = value;
        });
        let json = JSON.stringify(object);
        let url = '/api/user/quote/generate';

        debugger;

        // this.setState({ loading: true });

        this.preloader = $('.preloader');

        this.preloader.removeClass('loaded');

        fd.append("user_id" , this.props.UserId);
        fd.append("id" , '3');
        fd.append("state" , this.state.quoteInfo.state);
        fd.append("email" , this.state.quoteInfo.email);
        fd.append("name" , this.props.customerName);
        fd.append("phone" , this.state.quoteInfo.phone);
        fd.append("month" , this.state.quoteInfo.birth_month);
        fd.append("day" , this.state.quoteInfo.birth_day);
        fd.append("year" , this.state.quoteInfo.birth_year);
        fd.append("gender" , this.state.quoteInfo.gender);
        fd.append("term" , this.state.quoteInfo.term);
        fd.append("tobacco" , this.state.quoteInfo.tobacco);
        fd.append("benefit" , this.state.quoteInfo.amount_to_quote);
        fd.append("period" , this.state.quoteInfo.premium);
        fd.append("age" , this.state.quoteInfo.age);
        fd.append("age_or_date" , this.state.quoteInfo.age_or_date);
        fd.append("category" , '4');

        axios.post(url, fd).then( res => {
            console.log(res);
            if (res.status === 200) {

                debugger;
                let quote_request_response = res.data.message;

                let quote_results_style = {
                    textAlign: 'center'
                };

                let quoteResults = (

                    <div>
                        <div className="header-results-container">
                            <img src="https://app.agentquote.com/images/email/email-logo.png" />
                            <p>{ quote_request_response }</p>
                            <h4>Thank you.</h4>
                        </div>

                    </div>
                );

    /*            this.setState(
                    {
                        showForm: false,
                        quoteContainer: quoteResults
                    });*/

                $(this.resultsContainer).removeClass('show');

                this.preloader.addClass('loaded');

                render(
                    quoteResults,
                    document.getElementById('main-content-area')
                );

            }
        });

    };

    render()
    {
        return <div id="main-content-area">

                    <h3 className="term-type-header">
                        Final Expense
                    </h3>

                    { this.renderForm() }

               </div>;
    }
}

FinalExpenseQuoteModule.propTypes = {
    statesArray: PropTypes.array.isRequired,
    UserId: PropTypes.number.isRequired,
    fields: PropTypes.array
};

FinalExpenseQuoteModule.defaultProps = {
    statesArray: [],
    UserId: 0,
    fields: []
};

export default FinalExpenseQuoteModule;

if (document.getElementById('fe-module')) {
    render(
        <FinalExpenseQuoteModule statesArray={ statesArray } UserId={ UserId } defaultState={ user_default_state } />,
        document.getElementById('fe-module')
    );
}
