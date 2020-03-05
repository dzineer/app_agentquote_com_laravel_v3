import React, {Component} from 'react';
import PropTypes from 'prop-types';
import RateItem from "./RateItem";
import ProductGuide from "./ProductGuide";
import UnderwrittenGuideline from "./UnderwrittenGuideline";
import ProductName from "./ProductName";
import AppRequestButton from "./AppRequestButton";

/** class QuoteItem */
class QuoteItem extends Component {
    constructor(props) {
        super(props);
        this.state = {};
        this.styles = {
            for: {
                links: {
                    link1: {

                    },
                    link2: {

                    }
                },
                bottomBar: {
                    display: 'inline-block',
                    float: 'left'
                },
                href: {
                    color: '#ffffff'
                },
                productName: {

                },
                container: {
                    marginBottom: '20px',
                    maxWidth: '98% !important'
                    /*                    marginLeft: '20px',
                                        marginRight: '20px'*/
                },
                ratesContainer: {
                    /*backgroundImage: "linear-gradient(-180deg, #0AD6FD 0%, #04ADF9 100%)",*/
                    backgroundColor: '#fff',
                    color: '#ffffff',
                    padding: '20px 14px'
                },
                ratesContainers: {
                    margin: '4px',
                    textAlign: 'center',
                    /*borderLeft: '1px solid #00A3CE',*/
                    lineHeight: '2',
                    firstChild: {
                        borderLeft: 'none'
                    },
                    fontSize: '1.3em'
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
                    "width": "100%\\9",
                    "alignItems": "center",
                    "flexWrap": "wrap",
                    "backgroundColor": "#f9f9f9",
                    "marginBottom": "2px"
                }
            }
        };
    }

    componentDidMount() {
        console.log("[QuoteItem::componentDidMount]", this.props);
    }

    render() {
        const image_base_url = '/images/logos/';
        const styles = {
            left: {

            },
            right: {

            },
            logoContainer: {
                display: 'flex'
            },
            logo: {
                maxWidth: '100% !important',
            },
            classifications: {
                fontSize: '0.6rem',
            },
            topContainer: {
                height: '104px'
            }
        };

        const numberWithCommas = (x) => {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        };

        const formatNum = (n) => {
            if (n === 0) {
                return ' ';
            }

            if ( n.indexOf(".") !== -1 ) {
                // found a string decimal

                let final_num = parseFloat(n).toFixed(2);
                final_num = numberWithCommas(final_num);

                return final_num;

                let pieces = n.split(".");
                let left = pieces[0];
                let right = pieces[1];
                right = right.toString();

                if (right.length > 2) {
                    right = right.replace(/0/g, '');
                }

                while(right.length < 2) {
                    right = right + "0";
                }
                return left + "." + right;
            }
        };

        return (
            <div className="quote-result">
                <div className="quote-results-container card card-body flex flex-col" style={this.styles.for.container} key={this.props.item.Rate1Adj}>

                    <div className="row -m flex-grow-1" style={styles.topContainer}>

                        <div className="rc-i col-2 col-xs-12 -p">
                            <p className="box flex" style={styles.p}>
                                <img className="img-fluid" style={styles.logo} src={image_base_url+this.props.item.BannerLogoImageURL} alt=""/>
                            </p>
                        </div>
                        <div className="rcc col-10 col-xs-12 -p" style={styles.right}>
                            <div className="row col-row -m">
                                <div className="rc col-3 -p text-center">
                                    <div className="rc-h rc-t">
                                        {this.props.item.RateClassification1}
                                    </div>
                                    <div className="rc-p rc-b">
                                        { formatNum(this.props.item.Rate1Adj) }
                                    </div>
                                </div>
                                <div className="rc col-3 -p text-center">
                                    <div className="rc-h rc-t">
                                        {this.props.item.RateClassification2}
                                    </div>
                                    <div className="rc-p rc-b">
                                        { formatNum(this.props.item.Rate2Adj) }
                                    </div>
                                </div>
                                <div className="rc col-3  -p text-center">
                                    <div className="rc-h rc-t">
                                        {this.props.item.RateClassification3}
                                    </div>
                                    <div className="rc-p rc-b">
                                        { formatNum(this.props.item.Rate3Adj) }
                                    </div>
                                </div>
                                <div className="rc col-3 -p text-center">
                                    <div className="rc-h rc-t">
                                        {this.props.item.RateClassification4}
                                    </div>
                                    <div className="rc-p rc-b">
                                        { formatNum(this.props.item.Rate4Adj) }
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="rc-f row -m bottom-info -m">
                        <ProductName style={this.styles.for.productName} name={this.props.item.ProductName}/>
                        {/*<ProductGuide style={this.styles.for.links.link1} link={this.props.item.link1} />
                        <UnderwrittenGuideline style={this.styles.for.links.link2} link={this.props.item.link2} />*/}
                    </div>
                </div>
            </div>
        );
    }
}

QuoteItem.propTypes = {
    item: PropTypes.object.isRequired
};

QuoteItem.defaultProps = {
    item: {}
};

export default QuoteItem;
