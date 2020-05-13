import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {render} from "react-dom";
import toastr from "toastr";
import QuoteResult from "../Quote/QuoteResult";
// import AffiliateAd from "../Quote/Quoter/AffiliateAd";
import QuoteResults from "../Quote/QuoteResults";
import AffiliateAd from "../../Quoter/AffiliateAd";
import TermlifeQuoteDisplay from "../Quote/TermLifeQuoteDisplay";
import FinalExpenseQuoteDisplay from "../Quote/FinalExpenseQuoteDisplay";

class FinalExpenseReQuoteModule extends Component {
    constructor(props) {
        super(props);
        this.state = {
            showForm: true,
            quoteInfo: {
                amount_to_quote: 50,
                term: 121,
                premium: 0,
                other: 0,
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

        this.onBannerChange.bind(this);
        this.genReQuoteRequest.bind(this);
    }

    componentDidMount() {
        debugger;
        // console.log(this);
        // this.props.eventsRouter.on('hello', this.receiveMessage.bind(this) );
    }

    receiveMessage = (message) => {
        debugger;
        // console.log("TermLifeQuoteModule: I received a message.");
        // console.log("TermLifeQuoteModule: this message event is " + message.event );
        // console.log("TermLifeQuoteModule: this data i received " + message.data );
        // console.log(message);
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

    renderTerm = () => {
        return (
            <div className="form-group col-md-6">
                <label htmlFor="term">Term</label>
                <select name="term" id="term" className="form-control" onChange={ this.onBannerChange }>
                    { this.getTermYears() }
                </select>
            </div>
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

    renderBenefit = () => {
        return (
            <select name="benefit" id="benefit" className="form-control" onChange={this.onAmountChange} defaultValue={-1}>
                { this.generateBenefitOptions() }
            </select>
        );
    };

    renderForm = () => {
        return (
            <div>
                <form>


                    <div className="form-row m-t-20">

                        <div className="form-group col-md-4 d-flex flex-column align-items">
                            <a href="/" className="btn btn-success">Get a New Quote</a>
                        </div>

                        <div className="form-group col-md-4">

                        </div>

                        <div className="form-group col-md-4">

                        </div>

                    </div>

                    <div className="form-row m-y-20">

                        <div className="form-group col-md-4">
                            <h3 className="field-label">Term</h3>
                            <select name="term" id="term" className="form-control" onChange={ this.onBannerChange } defaultValue={ 121 }>
                                { this.getTermYears() }
                            </select>
                        </div>

                        <div className="form-group col-md-4">
                            <h3 className="field-label">Enter Face Amount</h3>
                            <input type="text" name="amount" id="amount" className="form-control" placeholder="Face Amount" onKeyUp={this.onAmountChange} />
                        </div>

                        <div className="form-group col-md-4">
                            <h3 className="field-label">Choose Face Amount</h3>
                            { this.renderBenefit() }
                        </div>

                    </div>

                </form>

            </div>

        );
    };

    onBannerChange = event => {

        this.setState({
            quoteInfo: Object.assign({},  this.state.quoteInfo, {[event.target.name]: event.target.value})
        }, () => { this.genReQuoteRequest() });

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
        }, () => { this.genReQuoteRequest() } );

    };

    isReady = () => {
        return this.state.quoteInfo.amount_to_quote !== 0;
    };

    genReQuoteRequest = () => {

        if (!this.isReady()) {
            toastr.error('You must provide a Face Amount');
            return;
        }

        this.setState(
            { loading: true }
        );

        this.loader = $("#loader-container");

        this.loader.toggleClass("loader");

        let fd = new FormData();

        let object = {};
        fd.forEach(function(value, key){
            object[key] = value;
        });
        let json = JSON.stringify(object);
        let url = '/api/user/quote/requote';

        debugger;

        // this.setState({ loading: true });

        this.preloader = $('.preloader');

        this.preloader.removeClass('loaded');

        fd.append("quote_id" , this.props.QuoteId);
        fd.append("user_id" , this.props.UserId);
        fd.append("term" , this.state.quoteInfo.term);
        fd.append("benefit" , this.state.quoteInfo.amount_to_quote);
        // fd.append("period" , this.state.quoteInfo.premium);
        fd.append("category" , '4');

        axios.post(url, fd).then( res => {
            // console.log(res);
            if (res.status === 200) {

                debugger;
                let quote_results = JSON.parse(res.data.quote_results);
                debugger;
                let quote_results_style = {
                    textAlign: 'center'
                };

                this.preloader.addClass('loaded');

                render(
                    <FinalExpenseQuoteDisplay quote_results={quote_results} />,
                    document.getElementById('fe-quote-display')
                );

            }
        });

    };

    render()
    {
        return <div id="main-content-area">

            { this.renderForm() }

        </div>;
    }
}

FinalExpenseReQuoteModule.propTypes = {
    UserId: PropTypes.number.isRequired,
    QuoteId: PropTypes.number.isRequired,
};

FinalExpenseReQuoteModule.defaultProps = {
    UserId: 0,
    QuoteId: 0
};

export default FinalExpenseReQuoteModule;

if (document.getElementById('requote-fe-module')) {
    render(
        <FinalExpenseReQuoteModule UserId={ UserId } QuoteId={ quote_id } />,
        document.getElementById('requote-fe-module')
    );
}
