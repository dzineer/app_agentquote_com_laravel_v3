import React, { Component } from 'react';
import ReactDom, { render } from 'react-dom';
import PropTypes from 'prop-types';
import QuoteResults from "./QuoteResults";
import toastr from "toastr";
import InsuranceDetails from "./InsuranceDetails";
import QuoteResult from "./QuoteResult";
import AffiliateAd from "./AffiliateAd";
/** class SiwlForm */
class SiwlForm extends Component {

    constructor(props) {
        super(props);
        this.banner = '';
        this.loader = {};
        this.resultsContainer = '#quote-results';
        this.adContainer = '#ads-box-container';
        this.counter = 0;
        this.account = acct;
        this.state = {
            config: {
                search_by_faceamount: true,
                search_by_text: 'Solve For'
            },
            selectedOption: 'Search By Face Amount',
            loading: false,
            defaultState: '',
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
                other: 0
            }
        };

        this.stateOptions = this.props.statesArr.map( item => {
            return <option key={item.value+item.text} value={item.value}>{item.text}</option>
        });

        this.stateBlock = (
            <div className="col-md-6 mt-3 mb-2">
                <select className="form-control form-control-lg" name="state" id="state" onChange={this.onBannerChange} defaultValue={user_default_state}>
                    { this.stateOptions }
                </select>
            </div>
        );

        this.searchByBlock = (
            <div className="search-by-container">
                <span className="search-by-header">Solve For: &nbsp;&nbsp;</span>
                <div className="form-check form-check-inline">
                    <input className="form-check-input" id="search_by_face_amount" name="aaaa" type="radio" defaultChecked onChange={this.onSearchByChange} value='Face Amount' />
                    <label className="form-check-label" htmlFor="search_by_face_amount">Face Amount</label>
                </div>
                <div className="form-check form-check-inline">
                    <input className="form-check-input" id="search_by_premium" name="aaaa" type="radio" onChange={this.onSearchByChange} value='Premium Amount' />
                    <label className="form-check-label" htmlFor="search_by_premium">Monthly Premium</label>
                </div>
            </div>
        );

        this.benefitBlock = (
            <div className="display-block">
                <div id="benefit_header" className="quote-header heading-info">
                    { this.searchByBlock }
                </div>
                <div className="col-md-12">
                    <div className="row">
                        <div id="amount_container" className="col-md-6 mt-2 mb-2">
                                <input type="text" name="amount" id="amount" className="form-control form-control-lg"
                                       placeholder="Amount" onKeyUp={this.onAmountChange}/>
                        </div>

                        <div id="benefit_container" className="col-md-6 mt-2 mb-2">
                            <select name="benefit" id="benefit" className="form-control form-control-lg" onChange={this.onAmountChange}>
                                <option value="-1">Choose Face Amount</option>
                                { this.generateBenefitOptions() }
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        );

        this.specialSwitchBlock = (
            <div className="col-md-6 mt-3 mb-2">

{/*                <div className="btn-group btn-group-md" data-toggle="buttons" role="group" aria-label="Search By">
                    <a className="nav-link btn btn-primary" name="search_by_face_amount" id="search_by_face_amount" href="#" onClick={this.onSearchByChange}>Search By Face Amount</a>
                    <a className="nav-link btn btn-secondary" name="search_by_premium" id="search_by_premium" href="#" onClick={this.onSearchByChange}>Search By Premium Amount</a>
                </div>*/}
                <h5>Solve for:</h5>

                <div className="form-check form-check-inline">
                    <input className="form-check-input" id="search_by_face_amount" name="aaaa" type="radio" defaultChecked onChange={this.onSearchByChange} value='Face Amount' />
                        <label className="form-check-label" htmlFor="search_by_face_amount">Solve for:</label>
                </div>
                <div className="form-check form-check-inline">
                    <input className="form-check-input" id="search_by_premium" name="aaaa" type="radio" onChange={this.onSearchByChange} value='Premium Amount' />
                        <label className="form-check-label" htmlFor="search_by_premium">Premium Amount</label>
                </div>

                {/*<div className="special-switch">
                    <div className="container-switch radio-non-lg">
                        <input type="radio" name="search-by" className="switch-input" id="search-by-faceamount" value="M"
                               checked="checked" />
                        <label htmlFor="search-by-faceamount"
                               className="switch-label form-control form-control-non-lg switch-right">Search Face Amount</label>
                        <input type="radio" name="search-by" className="switch-input" id="search-by-premium" value="F" />
                        <label htmlFor="search-by-premium" className="switch-label form-control form-control-non-lg switch-left">Search Premium</label>
                    </div>
                </div>*/}
            </div>
        );

        this.TermBlock = (
            <div className="col-md-6 mt-3 mb-2">
                <select name="term" id="term" className="form-control form-control-lg" defaultValue={121} onChange={this.onBannerChange}>
                    { this.getTermYears() }
                </select>
            </div>
        );

        this.tobaccos = [{text: "Non-Tobacco", value: "N" }, {text: "Tobacco", value: "Y" }].map(item => {
            return <option key={item.value+item.text} value={item.value}>{item.text}</option>
        });

        this.tobaccoBlock = (
            <div className="col-md-6 mt-3 mb-2">
                <select name="tobacco" id="tobacco" className="form-control form-control-lg" onChange={this.onBannerChange}>
                    { this.tobaccos }
                </select>
            </div>
        );

        this.genders = [{text: "Male", value: "M" }, {text: "Female", value: "F" }].map(item => {
            return <option key={item.value+item.text} value={item.value}>{item.text}</option>
        });

        this.genderBlock = (
            <div className="col-md-6 mt-3 mb-2">
                <select name="gender" id="gender" className="form-control form-control-lg" onChange={this.onBannerChange}>
                    { this.genders }
                </select>
            </div>
        );

        this.ages = this.range(0, 90).map(y => {
            return <option key={y} value={y}>{y}</option>
        });

        this.ageBlock = (
            <select name="age" id="age" className="form-control form-control-lg"  defaultValue="50" onChange={this.onAgeChange}>
                { this.ages }
            </select>
        );

        this.premiums = [{value: 0, text: 'Annual Premium'},{value: 1, text: 'Monthly Premiums'},{value: 2, text: 'Quarterly Premiums'},{value: 3, text: 'Semiannual Premiums'}].map( p => {
            return <option key={p.value+p.text} value={p.value}>{p.text}</option>
        });

        this.premiumBlock = (
            <select name="premium" id="premium" className="form-control form-control-lg" onChange={this.onBannerChange}>
                { this.premiums }
            </select>
        );

        this.calenderAgeBlock = (
            <div className="display-block">

                <div className="quote-header">
                    Age or DOB
                </div>

                <div className="col-md-12 mt-3 mb-2">
                    { this.ageBlock }
                </div>

                <div className="col-md-12 mt-2 my-2">
                    <div className="row">

                        <div className="col-md-4 col-sm-4 col-xs-12 my-2">
                            <select id="birth_month" name="birth_month" className="form-control form-control-lg fill-parent aq2e-month select-box-lg zero-margins select-non-lg" onChange={this.onBannerChange}>
                                { this.generateCalendarOptions('month') }
                            </select>
                        </div>

                        <div className="col-md-4 col-sm-4 col-xs-12 my-2">
                            <select id="birth_day" name="birth_day" className="form-control form-control-lg fill-parent aq2e-day select-box-lg zero-margins select-non-lg"  onChange={this.onBannerChange}>
                                { this.generateCalendarOptions('day') }
                            </select>
                        </div>

                        <div className="col-md-4 col-sm-4 col-xs-12 mt-2">
                            <select id="birth_year" name="birth_year" className="form-control form-control-lg fill-parent aq2e-year select-box-lg zero-margins select-non-lg" defaultValue={1968} onChange={this.onBannerChange}>
                                { this.generateCalendarOptions('year') }
                            </select>

                        </div>

                    </div>
                </div>
            </div>
        );

        this.generateQuoteBlock = (
            <div className="col-md-12 mt-2 mb-2">
                <a href="#" className="btn btn-primary btn-block btn-lg py-16 mt-4" onClick={this.onGetQuote}>Generate Quote</a>
            </div>

        );

        this.saveQuoteBlock = (
            <div className="col-md-12 mt-2 mb-2">
                <div className="form-check">
                    <input className="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                    <label className="form-check-label" htmlFor="defaultCheck1">
                        Save Quote
                    </label>
                </div>
            </div>

        );

        toastr.options = {
            "debug": false,
            "positionClass": "toast-top-center",
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 21000
        };
    }

    componentDidMount() {
       // debugger;
        this.setState({
            defaultState: user_default_state
        });
    }

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

    onSearchByChange = event => {
        let target_id = event.target.id;

        if(event.target.checked) {

            let newState = Object.assign({},  this.state);

            if (target_id === 'search_by_face_amount') {
                $('#amount_container').removeClass('col-md-12').addClass('col-md-6');
                $('#benefit_container').css('display', 'block');
                newState.config.search_by_faceamount = true;
            } else {
                $('#amount_container').removeClass('col-md-6').addClass('col-md-12');
                $('#benefit_container').css('display', 'none');
                newState.config.search_by_faceamount = false;
            }

            newState.selectedOption = event.target.value;

            this.setState( newState );
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

    isReady = () => {
        return this.state.quoteInfo.amount_to_quote !== 0;
    };

    onGetQuote = event => {

        /* SIWL::onGetQuote */

        event.preventDefault();

        if (!this.isReady()) {
            toastr.error('You must provide a Face Amount');
            return;
        }

        //this.axios_instance = axios.create();
        //delete this.axios_instance.defaults.headers.common['X-CSRF-TOKEN'];

        this.setState(
            { loading: true }
        );

        this.loader = $("#loader-container");

        this.loader.toggleClass("loader");

        if ($('#quote-results').hasClass("show")) {
            $('#quote-results').removeClass("show");
        }

        // debugger;
        this.setState({ loading: true });

        render(
            '',
            document.getElementById('quote-results')
        );

        this.resultsContainer = $('#quote-box-container');

        if (!this.resultsContainer.hasClass("show")) {
            $(this.resultsContainer).addClass('show');
        }

        this.adContainer = $('#ads-box-container');

        if (this.adContainer.hasClass("show")) {
            $(this.adContainer).removeClass('show');
        }

        this.resultsContainer.toggleClass("loader");
        $(this.resultsContainer).addClass('show');

        $('html,body').animate({
            scrollTop: $("#quote-results").offset().top
        }, 'slow');


        let fd = new FormData();

        let object = {};
        fd.forEach(function(value, key){
            object[key] = value;
        });
        let json = JSON.stringify(object);
        let url = '/user/quote';

        fd.append("id" , '3');
        fd.append("state" , this.state.quoteInfo.state);
        fd.append("month" , this.state.quoteInfo.birth_month);
        fd.append("day" , this.state.quoteInfo.birth_day);
        fd.append("year" , this.state.quoteInfo.birth_year);
        fd.append("gender" , this.state.quoteInfo.gender);
        fd.append("term" , this.state.quoteInfo.term);
        fd.append("tobacco" , this.state.quoteInfo.tobacco);
        fd.append("benefit" , this.state.quoteInfo.amount_to_quote);
        fd.append("age" , this.state.quoteInfo.age);
        fd.append("age_or_date" , this.state.quoteInfo.age_or_date);
        fd.append("category" , '4');

        if (this.state.config.search_by_faceamount === false) {
            fd.append("search_by" , 'true');
            fd.append("period" , '1');
        } else {
            fd.append("period" , this.state.quoteInfo.premium);
        }

        axios.post(url, fd).then( res => {
            console.log(res);
            if (res.statusText === "OK") {

                let quote_results = res.data;

                if ( quote_results.length ) {
                    if (this.state.config.search_by_faceamount === false) {
                        quote_results.reverse();
                    }
                }

                let quote_items = quote_results.map((item) => {
                    let counter = 1;
                    const styles = {
                        for: {
                            links: {
                                link1: {
                                    textAlign: 'center',
                                    color: 'white',
                                    background: '#333',
                                    padding: '8px'
                                },
                                link2: {
                                    textAlign: 'center',
                                    color: 'white',
                                    background: '#444',
                                    padding: '8px'
                                }
                            },
                            bottomBar: {
                                display:'inline-block',
                                float:'left'
                            },
                            href: {
                                color: '#ffffff'
                            },
                            productName: {
                                backgroundColor: "rgba(206, 206, 206, 1)",
                                color: 'rgba(0, 0, 0, 1)',
                                padding: '10px',
                                fontSize: '0.8em'
                            },
                            container: {
                                marginBottom: '20px'
                            },
                            ratesContainer: {
                                /*backgroundImage: "linear-gradient(-180deg, #0AD6FD 0%, #04ADF9 100%)",*/
                                backgroundColor: '#04adf9',
                                color: '#ffffff',
                                padding: '20px 14px'
                            },
                            ratesContainers: {
                                margin: '4px',
                                textAlign: 'center',
                                borderLeft: '1px solid #00A3CE',
                                lineHeight: '2',
                                firstChild: {
                                    borderLeft: 'none'
                                }
                            },
                            rateClassification: {
                                "fontFamily": "Arial",
                                "fontWeight": "bold",
                                "fontSize": "16px",
                                "color": "#333333",
                                "textAlign": "center"
                            },
                            carrierLogo: {
                                "display": "flex",
                                "width": "100% \\9",
                                "alignItems": "center",
                                "flexWrap": "wrap",
                                "backgroundColor": "#f9f9f9",
                                "marginBottom": "2px"
                            }
                        }
                    };

                    // this.setState({loading: false});

                    this.counter = this.counter+2;

                    return (
                        <QuoteResult key={this.counter} item={item} />
                    )
                });

                let preferredQuoteResult = '';

                if (ads.categories.siwl) {

                    if (!this.adContainer.hasClass("show")) {
                        $(this.adContainer).addClass('show');
                    }

                    debugger;

                    preferredQuoteResult = quote_items.filter( quote_item => {
                        return quote_item.props.item.CompanyFK === ads.siwl.company_id;
                    });

                    quote_items = quote_items.filter( quote_item => {
                        return quote_item.props.item.CompanyFK !== ads.siwl.company_id;
                    });

                }

                let styleAd = {
                    sponsored: {
                        container: {
                            textAlign: 'center',
                        },
                        text: {
                            // '-webkit-text-stroke': '1px black',
                            'color': 'white',
                            'textShadow': '3px 3px 0 #000, -1px -1px 0 #000,1px -1px 0 #000, -1px 1px 0 #000,1px 1px 0 #000',
                        }

                    }
                };

                let sponsoredImage = preferredQuoteResult.length > 0 ?
                    <div className="row">
                        <div className="col-md-2" style={ styleAd.sponsored.container } >
                            <img id="sponsored" src="/images/sponsored.svg" alt="sponsored image" />
                        </div>
                    </div>
                    : '';

                let ad = (
                    <AffiliateAd show={ads.categories.siwl} ad={ ads.categories.siwl ? ads.siwl : null }>
                        { sponsoredImage }
                        { preferredQuoteResult }
                    </AffiliateAd>
                );

                let quoteResults = (
                    <div>
                        <h5 className="heading-info" style={{ color: '#666666', marginBottom: '20px' }}>Quote Results</h5>
                        <QuoteResults show={this.state.loading}>
                            { quote_items.length !== 0 ? quote_items : 'No Results' }
                        </QuoteResults>
                    </div>
                );

                this.setState(
                    {
                        adContainer: ad,
                        quoteContainer: quoteResults
                    });

                $(this.resultsContainer).removeClass('show');

                render(
                    ad,
                    document.getElementById('ad-container')
                );

                render(
                    quoteResults,
                    document.getElementById('quote-results')
                );

                $('html,body').animate({
                    scrollTop: $("#ads-box-container").offset().top
                }, 'slow');

            }
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
        if ( event.target.name === "benefit") {
            newState.amount_to_quote = value; // before we format the value let us save the correct
                                              // value for a quote request.
            value = parseFloat(value) * 1000;   // make sure we have an integer and then make a full number to display
            value = value + ""; // since we converted to int we need to convert back to string
        }

        // if the user types the amount manually clear the benefit drop down
        if ( event.target.name === "amount") {
            if( this.state.config.search_by_faceamount ) {
                $("select#benefit").get(0).selectedIndex = 0;
                newState.amount_to_quote = value / 1000;
            } else {
                newState.amount_to_quote = value;
            }
        }

        // format the amount field, add commas if needed
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        // finish formatting by adding dollar symbol
        $('#amount').val('$' + value);

        this.setState({
            quoteInfo: newState
        });
    };

    generateCalendarOptions = (type) => {
        if (type === "day") {
            return [...Array(31).keys()].map(d => {
                return <option key={d+1} value={d+1}>{d+1}</option>
            })
        }
        else if (type === "month") {
            let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            return [...Array(12).keys()].map(m => {
                return <option key={m+1} value={m+1}>{months[m]}</option>
            })
        }
        else if(type === "year") {
            return this.range(new Date().getFullYear() - 90, new Date().getFullYear() ).map(y => {
                return <option key={y} value={y}>{y}</option>
            })
        }

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

    range = (start, end) => {
        return Array(end - start + 1).fill().map((_, idx) => start + idx)
    };

    getTermYears = () => {
        return [{name: '10 Pay', value: 10},{name: '20 Pay', value: 10},{name: 'Life Pay', value: 121}].map( n => {
            return <option key={n.value} value={n.value}>{n.name}</option>
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

    render() {
       // debugger;
        const states = this.props.statesArr.map(state => {

        });

        const blocksTemplate = [
            this.stateBlock,
            this.TermBlock,
            this.tobaccoBlock,
            this.genderBlock,
            this.calenderAgeBlock,
            this.benefitBlock,
            // this.saveQuoteBlock,
            this.generateQuoteBlock
        ];

        return (
            <form>

                <h4 className="heading-info">FE/SIWL Details</h4>

                <div className="form-group">
                    <div className="row">
                        { blocksTemplate[0] }
                        { blocksTemplate[1] }
                        { blocksTemplate[2] }
                        { blocksTemplate[3] }
                        { blocksTemplate[4] }
                        { blocksTemplate[5] }
                        { blocksTemplate[6] }
                        { blocksTemplate[7] }
                    </div>
                </div>



            </form>
        );
    }
}

SiwlForm.propTypes = {
    statesArr: PropTypes.array.isRequired
};

SiwlForm.defaultProps = {
    statesArr: []
};

export default SiwlForm;

if (document.getElementById('termlife-form')) {
    render(<SiwlForm/>,
        document.getElementById('termlife-form')
    );
}