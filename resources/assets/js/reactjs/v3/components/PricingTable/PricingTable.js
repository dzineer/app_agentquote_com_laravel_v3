import React, {Component} from 'react';
import ReactDOM, { render } from 'react-dom';
import PropTypes from 'prop-types';
import PricingColumn from './PricingColumn';
/** class PricingTable */
class PricingTable extends Component {
    constructor(props) {
        super(props);
        this.state = {};
    }

    render() {
        return (
            <div className="row pricing-table">

                        <div className="col-item offset-md-1 col-md-3 col-feature shadow no-padding">
                            <div className="col-header text-center">
                                <h2 style={{"color": "#fff !important"}}>My Mobile Life Quoter</h2>
                                <p>Everything you need in the Field</p>
                            </div>
                            <div className="col-body">
                                <ul>
                                    <li className="row0 yes">Quote on any device</li>
                                    <li className="row1 yes">Customize your companies</li>
                                    <li className="row0 yes">Quote Level Term</li>
                                    <li className="row1 yes">Quote Simplified Issue Term</li>
                                    <li className="row0 yes">Quote Final Expense</li>
                                    <li className="row1 yes">Easy To View All Risk Classes</li>
                                    <li className="row0 yes">Google &amp; Apple App Available</li>
                                    <li className="row1 yes"><span
                                        className="big-number"><sup>$</sup>5<sup>.00 </sup></span>/mo Paid
                                        Annually
                                    </li>
                                    <li className="row0"><a className="btn btn-lg btn-success"
                                                            href="https://mymobilelifequoter.com/index.php?option=com_osmembership&amp;view=register&amp;id=1&amp;Itemid=7214"
                                                            target="_blank">Sign Up</a></li>
                                </ul>
                            </div>
                        </div>
                        <div className="col-item col-md-3 no-padding">
                            <div className="col-header text-center">
                                <h2 style={{"color": "#fff"}}>AQ2E Platform</h2>
                                <p>Perfect for Consumer Quoting</p>
                            </div>
                            <div className="col-body">
                                <ul>
                                    <li className="row0 yes">Quote on any device</li>
                                    <li className="row1 yes">Customized Website/Content</li>
                                    <li className="row0 yes">Lead Capture/Generation</li>
                                    <li className="row1 yes">Dynamic Banners</li>
                                    <li className="row0 yes">Facebook App Quoter</li>
                                    <li className="row1 yes">"Email Me This Quote" Feature</li>
                                    <li className="row0 yes">Carrier Underwriting Guides</li>
                                    <li className="row1 yes">App Request form for consumer</li>
                                    <li className="row0"><span
                                        className="big-number"><sup>$</sup>30<sup>.00 </sup></span>Payable
                                        Monthly
                                    </li>
                                    <li className="row1"><a className="btn btn-lg btn-outline-primary"
                                                            href="https://aqterm.aqtermlife.com/our-platform/"
                                                            rel="noopener noreferrer" target="_blank">Learn
                                        More</a></li>
                                </ul>
                            </div>
                        </div>
                        <div className="col-item col-md-3 no-padding">
                            <div className="col-header text-center">
                                <h2 style={{"color": "#fff"}}>Total Solution</h2>
                                <p>Turnkey Marketing System</p>
                            </div>
                            <div className="col-body">
                                <ul>
                                    <li className="row0 yes">Includes Mobile Quoter &amp; Micro Site</li>
                                    <li className="row1 yes">CRM Included</li>
                                    <li className="row0 yes">We Drip Market to your Clients</li>
                                    <li className="row1 yes">We Send Newsletter Emails to your Clients</li>
                                    <li className="row0 yes">Turnkey Inbound Marketing Campaigns</li>
                                    <li className="row1 yes">5 Inbound Campaigns Pre-Built for you</li>
                                    <li className="row0 yes">28 Million Consumer emails available</li>
                                    <li className="row1 yes">6.5 Million Business emails available</li>
                                    <li className="row0"><span
                                        className="big-number"><sup>$</sup>129<sup>.00&nbsp;</sup></span> Payable
                                        Monthly
                                    </li>
                                    <li className="row1"><a className="btn btn-lg btn-outline-primary"
                                                            href="https://aqterm.aqtermlife.com/our-platform/#marketing-platform-video"
                                                            rel="noopener noreferrer" target="_blank">Learn More</a>
                                    </li>
                                </ul>

                            </div>
                        </div>

            </div>
        );
    }
}

PricingTable.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

PricingTable.defaultProps = {
    //myProp: val
};

export default PricingTable;

if (document.getElementById('pricing-table')) {
    render(
        <PricingTable />,
        document.getElementById('pricing-table')
    );
}