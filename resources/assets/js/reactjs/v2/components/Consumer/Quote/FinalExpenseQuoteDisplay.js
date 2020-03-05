import React, {Component} from 'react';
import PropTypes from 'prop-types';
import QuoteResult from "./QuoteResult";
import {render} from "react-dom";
import toastr from "toastr";
import AffiliateAd from "../../Quoter/AffiliateAd";
import QuoteResults from "../../Quoter/QuoteResults";
import CustomUserModule from "../../UserModule/CustomUserModule";
import FinalExpenseReQuoteModule from "../ReQuoteModules/FinalExpenseReQuoteModule";

/** class FinalExpenseQuoteDisplay */
class FinalExpenseQuoteDisplay extends Component {
    constructor(props) {
        super(props);
        this.state = {
            userModules: []
        };
    }

    componentDidMount() {
        this.getUserModules();
    }

    getUserModules = () => {

        let fd = new FormData();

        let url = '/api/user/custom_modules/47?module_type=insurance_module';

        axios.get(url).then( res => {

            console.log(res);

            if (res.statusText === "OK") {

                let customModules = res.data.customModules;

                let modules_rendered = customModules.map((customModule) => {
                    return <CustomUserModule CustomModuleName={ customModule.module.module_name } UserId={ customModule.user_id }/>;
                });

                let all_modules = (<div className='row'>
                    { modules_rendered }
                </div>);

                this.setState({
                    userModules: all_modules
                })

                /*                $('html,body').animate({
                                    scrollTop: $("#ads-box-container").offset().top
                                }, 'slow');*/

            }
        });

    };

    render() {

        let quote_items = this.props.quote_results.map((item) => {
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

        return (
            <div>

                { this.state.userModules }
                <FinalExpenseReQuoteModule QuoteId={ quote_id } UserId={ user_id } />

                <h3 className="term-type-header">
                    Final Expense Quote Results
                </h3>

                { quote_items }
            </div>
        );
    }
}

FinalExpenseQuoteDisplay.propTypes = {
    /** myProp */
    quote_results: PropTypes.array.isRequired
};

FinalExpenseQuoteDisplay.defaultProps = {
    quote_results: []
};

export default FinalExpenseQuoteDisplay;

if (document.getElementById('fe-quote-display')) {
    render(<FinalExpenseQuoteDisplay quote_results={quote_results}/>,
        document.getElementById('fe-quote-display')
    );
}
