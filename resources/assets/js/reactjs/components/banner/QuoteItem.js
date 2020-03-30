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
                    display: 'inline-block',
                    float: 'left'
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
    }

    componentDidMount() {
        // console.log("[QuoteItem::componentDidMount]", this.props);
    }

    render() {
        return (
            <div className="quote-result">
                <div className="container" style={this.styles.for.container} key={this.props.item.Rate1Adj}>
                    <div className="row">
                        <div className="col-md-2 col-xs-12 image-container" style={this.styles.for.carrierLogo}><img
                            className="align-middle img-fluid" src={this.props.item.BannerLogoImageURL} alt=""/></div>
                        <div className="col rates-container" style={this.styles.for.ratesContainer}>
                            <div className="row">
                                <RateItem style={Object.assign({}, this.styles.for.ratesContainers, this.styles.for.ratesContainers.firstChild)} RateClassification={this.props.item.RateClassification1} RateAdj={this.props.item.Rate1Adj} />
                                <RateItem style={this.styles.for.ratesContainers} RateClassification={this.props.item.RateClassification2} RateAdj={this.props.item.Rate2Adj} />
                                <RateItem style={this.styles.for.ratesContainers} RateClassification={this.props.item.RateClassification3} RateAdj={this.props.item.Rate3Adj} />
                                <RateItem style={this.styles.for.ratesContainers} RateClassification={this.props.item.RateClassification4} RateAdj={this.props.item.Rate4Adj} />
                            </div>
                        </div>
                    </div>
                    <div className="row">
                        <ProductGuide style={this.styles.for.links.link1} link="#" />
                        <UnderwrittenGuideline style={this.styles.for.links.link2} link="#" />
                        <AppRequestButton style={this.styles.for.links.link2} link="#" />
                    </div>
                    <div className="row">
                        <ProductName style={this.styles.for.productName} name={this.props.item.ProductName}/>
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
