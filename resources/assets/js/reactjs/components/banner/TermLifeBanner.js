import React, { Component } from 'react';
import ReactDom, { render } from 'react-dom';
import SwitchInput from '../SwitchInput';
import PropTypes from 'prop-types';
import QuoteResults from "./QuoteResults";
import toastr from "toastr";
import InsuranceDetails from "./InsuranceDetails";
import QuoteResult from "./QuoteResult";

/** function: TermlifeBanner */
class TermlifeBanner extends Component {
    constructor(props) {
        super(props);
        this.banner = '';
        this.loader = {};
        this.resultsContainer = '#quote-results';
        this.counter = 0;
        this.state = {
            loading: false,
            quoteInfo: {
                accountId: 3,
                benefit: 25,
                term: 15,
                birth_month: 1,
                birth_day: 1,
                birth_year: 1973,
                state: 'CA',
                premium: 0,
                gender: 'M',
                tobacco: 'N',
                other: 0
            }
        };

        // https://banner.aq2e.com/q/g?request=3|1000|20|5|7|1980|CA|0|M|N|0&response=json

        this.styles = {
            quoterContainer: {
                minHeight: '520px',
                height: 'auto',
                paddingTop: '10px',
                paddingBottom: '20px',
                background: content.colors.banner_form_background,
                width: '744px',
                margin: '38px auto',
                padding: '29px 30px 38px',
                textAlign: 'center',
                marginBottom: '20px',
                borderRadius: '20px'
            },
            header: {
                fontSize: '31px',
                color: '#514E4E',
                fontFamily: 'Helvetica',
                fontWeight: 'lighter',
                marginBottom: '30px'
            },
            select: {
                height: '52px',
                display: 'block',
                width: '100%'
            },
            inputGroup: {
                marginBottom: '1.3rem'
            },
            birthDateGroup: {
              header: {
                display: 'block',
                width: '100%',
                fontWeight: '300',
                fontSize: '1.5em',
                lineHeight: '1.0',
                textTransform: 'none',
                textAlign: 'center',
                color: '#2a2a2a',
              }
            },
            dateGroup: {
                margin: '28px 0 42px 0'
            },
            oneThirdGroup: {
                width: '32%',
                first: {
                    marginLeft: '1px',
                    marginRight: '3px',
                },
                second: {
                    marginLeft: '1px',
                    marginRight: '3px',
                },
                third: {
                    marginLeft: '1px',
                }
            },
            getAQuote: {
                button: {
                    border: '2px solid #3490dc',
                    height: '52px',
                    width: '100%'
                }
            },
            needsAnalyzer: {
                button: {
                    background: '#5CB85C',
                    border: '2px solid #5CB85C',
                    height: '52px',
                    width: '100%'
                }
            },
            quoteFooter: {
                fontFamily: 'Helvetica',
                fontWeight: 'lighter',
                fontSize: '15px',
                marginTop: '20px'
            },
            btn: {
                width: '100%'
            }
        };

        this.stateOptions = this.props.statesArr.map( item => {
            return <option key={item.value+item.text} value={item.value}>{item.text}</option>
        });

        // console.log("stateOptions", this.stateOptions);

        this.benefitGroup = (
            <div className="input-group mb-3" style={this.styles.inputGroup}>
                <select className="custom-select form-input" name="benefit" id="benefit" onChange={this.onBannerChange} style={this.styles.select}>
                    { this.generateBenefitOptions() }
                </select>

            </div>
        );

        this.insurance_details = (
              <div className="card" style={{border: 'none', 'width': '98%'}}>
                  <div className="card-body">
                      <h4 className="card-title">Termlife Insurance</h4>
                      <h6 className="card-subtitle mb-2 text-muted">How it Works</h6>
                      <p>Termlife insurance is the most straightforward form of protection. You generally pay premiums on a monthly or annual basis and your family is protected for that "term." State Farm Life Insurance Company and State Farm Life and Accident Assurance Company (Licensed in NY and WI) offer a variety of affordable term life insurance products to fit your needs, time frame, and budget.</p>
                  </div>
              </div>
        );

        let insuranceDetails = $('insurance-details');

        if (!insuranceDetails.hasClass('show')) {
            insuranceDetails.addClass('show');
        }

        this.birthDateGroup = (

            <div className="date-group" style={this.styles.dateGroup}>

                <div>
                    <h3 style={this.styles.birthDateGroup.header}>Birthdate: </h3>
                </div>

                <div className="input-group mb-3" style={this.styles.inputGroup}>

                    <div className="div-one-third" style={Object.assign({}, this.styles.oneThirdGroup, this.styles.oneThirdGroup.first)}>
                        <select className="custom-select third-select" name="birth_month" id="birth_month" onChange={this.onBannerChange} style={this.styles.select}>
                            { this.generateCalendarOptions('month') }
                        </select>
                    </div>

                    <div className="div-one-third" style={Object.assign({}, this.styles.oneThirdGroup, this.styles.oneThirdGroup.second)}>
                        <select className="custom-select third-select" name="birth_day" id="birth_day" onChange={this.onBannerChange} style={this.styles.select}>
                            { this.generateCalendarOptions('day') }
                        </select>
                    </div>

                    <div className="div-one-third" style={Object.assign({}, this.styles.oneThirdGroup, this.styles.oneThirdGroup.third)}>
                        <select className="custom-select third-select" name="birth_year" id="birth_year" onChange={this.onBannerChange} style={this.styles.select} defaultValue={((new Date().getFullYear() - 90 + new Date().getFullYear())/2).toString()} >
                            { this.generateCalendarOptions('year') }
                        </select>
                    </div>

                </div>

            </div>
        );

        this.NeedsAnalyzer = (
            <div className="input-group mb-3" style={this.styles.inputGroup}>
                <a href="#" id="aq2e_send" target="_blank" style={Object.assign({}, this.styles.btn, this.styles.needsAnalyzer.button)}
                   className="btn btn-lg btn-primary fill-box-lg fill-parent">Needs Analyzer</a>
            </div>
        );

        this.TermsGroup = (
            <div className="input-group mb-3" style={this.styles.inputGroup}>
                <select className="custom-select" name="term" id="term" onChange={this.onBannerChange} style={this.styles.select}>
                    { this.getTermYears() }
                </select>
            </div>
        );

        this.statesGroup = (
            <div className="input-group mb-3" style={this.styles.inputGroup}>
                <select className="custom-select" name="state" id="state" onChange={this.onBannerChange} style={this.styles.select} defaultValue={content.contact_state}>
                    { this.stateOptions }
                </select>
            </div>
        );

        this.premiumGroup = (
            <div className="input-group mb-3" style={this.styles.inputGroup}>
                <select className="custom-select" name="premium" id="premium" onChange={this.onBannerChange} style={this.styles.select}>
                    { this.getPremiums() }
                </select>
            </div>
        );

        this.footer = (
            <div className="quote-footer"
                 style={this.styles.quoteFooter}>
                By clicking the "Get A Quote" button I give consent for a licensed agent to call me.
            </div>
        );

        this.token = jQuery('meta[name="csrf-token"]').attr('content');

        this.axios_instance = axios.create();
        delete this.axios_instance.defaults.headers.common['X-CSRF-TOKEN'];

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

    componentDidMount() {
        this.setState({ insurance_details: this.insurance_details });
        $('html,body').animate({
            scrollTop: $(".quote-container").offset().top - 230
        }, 'slow');
    }

    onBannerChange = event => {
        this.setState({
            quoteInfo: Object.assign({},  this.state.quoteInfo, {[event.target.name]: event.target.value})
        });
    };

    onGetQuote = event => {
        event.preventDefault();

        this.axios_instance = axios.create();
        delete this.axios_instance.defaults.headers.common['X-CSRF-TOKEN'];

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

        // https://banner.aq2e.com/q/g?request=3|1000|20|5|7|1980|CA|0|M|N|0&response=json

        let query = Object.keys(this.state.quoteInfo).map( k => this.state.quoteInfo[k]).join("|");

        this.axios_instance.get('https://banner.aq2e.com/q/g?request='+query+'&response=json').then( res => {

            let quote_results = res.data.quote;
            let carriers = res.data.carriers;

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
                            backgroundColor: content.colors.rates_background,
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

            let quoteResults = (
                <div>
                    <QuoteResults show={this.state.loading}>
                        { quote_items }
                    </QuoteResults>
                </div>
            );

            this.setState(
                { quoteContainer: quoteResults }
            );

            if (!jQuery(this.resultsContainer).hasClass("show")) {
                jQuery(this.resultsContainer).addClass('show');
            }

            this.loader.toggleClass("loader");
            $('#quote-results').addClass("show");

            render(
                quoteResults,
                document.getElementById('quote-results')
            );

            $('html,body').animate({
                scrollTop: $("#quote-results").offset().top
            }, 'slow');

        }).catch( error => {
            toastr.error("An error occurred, please try again later.");
            // console.log(error);
        });

    };

    formatCurrency = (s, n, x) => {
        let num = parseInt(s);
        let re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
        return '$'+num.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
    };

    generateBenefitOptions = () => {
        const stops = [
            { start: 25, end: 200, inc: 25 },
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

    range = (start, end) => {
        return Array(end - start + 1).fill().map((_, idx) => start + idx)
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
                return <option key={m} value={m}>{months[m]}</option>
            })
        }
        else if(type === "year") {
            return this.range(new Date().getFullYear() - 90, new Date().getFullYear() ).map(y => {
                return <option key={y} value={y}>{y}</option>
            })
        }

    };

    getTermYears = () => {
      return [15,20,25,30].map( n => {
          return <option key={n} value={n}>{n + " Years"}</option>
      })
    };

    getPremiums = () => {
        return [{value: 0, text: 'Annual Premium'},{value: 1, text: 'Monthly Premiums'},{value: 2, text: 'Quarterly Premiums'},{value: 3, text: 'Semiannual Premiums'}].map( p => {
            return <option key={p.value+p.text} value={p.value}>{p.text}</option>
        })
    };

    render() {

        $('#insurance-details').addClass('show');

        render(
            <InsuranceDetails>{ this.insurance_details }</InsuranceDetails>,
            document.getElementById('insurance-details')
        );

        return (
            <div className="quote-container"
                 style={this.styles.quoterContainer}>
                <h2 style={this.styles.header}>Get
                    An Instant Quote Below</h2>
                <div className="row">
                    <div className="col-md-6">

                        { this.benefitGroup }
                        { this.birthDateGroup }

                        <SwitchInput
                            radioName="gender"

                            firstHtmlId="sex-male"
                            firstLabel="Male"
                            firstRadioClassName="switch-input"
                            firstLabelClassName="switch-label form-control switch-right"
                            firstValue="M"

                            secondHtmlId="sex-female"
                            secondLabel="Female"
                            secondRadioClassName="switch-input"
                            secondLabelClassName="switch-label form-control switch-left"
                            secondValue="F"

                            onChange={this.onBannerChange}

                            defaultSwitch="first"
                        />

                    </div>
                    <div className="col-md-6">

                        { this.TermsGroup }
                        { this.statesGroup }
                        { this.premiumGroup }

                        <SwitchInput
                            radioName="tobacco"

                            firstHtmlId="tobacco-yes"
                            firstLabel="Tobacco"
                            firstRadioClassName="switch-input"
                            firstLabelClassName="switch-label form-control switch-right"
                            firstValue="N"

                            secondHtmlId="tobacco-no"
                            secondLabel="Non Tobacco"
                            secondRadioClassName="switch-input"
                            secondLabelClassName="switch-label form-control switch-left"
                            secondValue="Y"

                            onChange={this.onBannerChange}

                            defaultSwitch="first"
                        />

                    </div>

                    <div className="col-md-12">
                        <div className="row">
                            <div className="col-md-6" style={{display: 'none'}}>
                                { this.NeedsAnalyzer }
                            </div>
                            <div className="col-md-12">
                                <a href="#" id="aq2e_send" target="_blank" style={this.styles.getAQuote.button} onClick={this.onGetQuote}
                                   className="btn btn-lg btn-primary fill-box-lg fill-parent">Get A Quote</a>
                            </div>
                        </div>
                    </div>

                    <div className="col-md-12">
                        { this.footer }
                    </div>
                </div>
            </div>
        );
    }
}

TermlifeBanner.propTypes = {
    statesArr: PropTypes.array.isRequired
};

TermlifeBanner.defaultProps = {
    statesArr: []
};

export default TermlifeBanner;

/*
if (document.getElementById('banner')) {
    render(
        <TermlifeBanner />,
        document.getElementById('banner')
    );
}
*/

