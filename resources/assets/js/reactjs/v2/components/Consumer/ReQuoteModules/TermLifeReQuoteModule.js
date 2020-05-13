import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {render} from "react-dom";
import toastr from "toastr";
import QuoteResult from "../Quote/QuoteResult";
// import AffiliateAd from "../Quote/Quoter/AffiliateAd";
import QuoteResults from "../Quote/QuoteResults";
import AffiliateAd from "../../Quoter/AffiliateAd";
import TermlifeQuoteDisplay from "../Quote/TermLifeQuoteDisplay";

class TermLifeReQuoteModule extends Component {
    constructor(props) {
        super(props);
        this.state = {
            showForm: true,
            quoteInfo: {
                amount_to_quote: 50,
                term: 10,
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
        console.log(this);
       // this.props.eventsRouter.on('hello', this.receiveMessage.bind(this) );
    }

    receiveMessage = (message) => {
        debugger;
        console.log("TermLifeQuoteModule: I received a message.");
        console.log("TermLifeQuoteModule: this message event is " + message.event );
        console.log("TermLifeQuoteModule: this data i received " + message.data );
        console.log(message);
    };

    generateBenefitOptions = () => {
        const stops = [
            { start: 25, end: 201, inc: 25 },
            { start: 250, end: 950, inc: 50 },
            { start: 1000, end: 4500, inc: 500 },
            { start: 5000, end: 10000, inc: 1000 },
        ];

        return stops.map( point => {
            let arr = [];
            for (let i = point.start; i < point.end; i = i + point.inc) {
                arr.push(<option key={i} value={i}>{this.formatCurrency(i*1000)}</option>);
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
                        { this.generateBenefitOptions() }
                    </select>
                </div>
            </div>
        );
    };

    renderTerm = () => {
        return (
            <div className="form-group col-md-4">
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
        return [10,15,20,25,30,35,40].map( n => {
            return <option key={n} value={n}>{n + " Years"}</option>
        })
    };

    getPremiums = () => {
        return [{value: 0, text: 'Annual'},{value: 1, text: 'Monthly'},{value: 2, text: 'Quarterly'},{value: 3, text: 'Semiannual'}].map( p => {
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
            { start: 25, end: 201, inc: 25 },
            { start: 250, end: 950, inc: 50 },
            { start: 1000, end: 4500, inc: 500 },
            { start: 5000, end: 10000, inc: 1000 },
        ];

        return stops.map( point => {
            let arr = [];
            for (let i = point.start; i < point.end; i = i + point.inc) {
                arr.push(<option key={i} value={i}>{this.formatCurrency(i*1000)}</option>);
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
                            <select name="term" id="term" className="form-control" onChange={ this.onBannerChange }>
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
        fd.append("category" , '1');

        axios.post(url, fd).then( res => {
            console.log(res);
            if (res.status === 200) {

                debugger;
                let quote_results = JSON.parse(res.data.quote_results);
                debugger;
                let quote_results_style = {
                    textAlign: 'center'
                };

                this.preloader.addClass('loaded');

                render(
                    <TermlifeQuoteDisplay quote_results={quote_results} />,
                    document.getElementById('termlife-quote-display')
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

TermLifeReQuoteModule.propTypes = {
    UserId: PropTypes.number.isRequired,
    QuoteId: PropTypes.number.isRequired,
    Quote: PropTypes.array.isRequired,
};

TermLifeReQuoteModule.defaultProps = {
    UserId: 0,
    QuoteId: 0,
    Quote: {}
};

export default TermLifeReQuoteModule;

if (document.getElementById('requote-termlife-module')) {
    render(
        <TermLifeReQuoteModule UserId={ UserId } QuoteId={ quote_id }  Quote={ quote } />,
        document.getElementById('requote-termlife-module')
    );
}
