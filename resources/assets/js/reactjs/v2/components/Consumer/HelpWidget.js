import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {render} from "react-dom";

/** className HelpWidget */
class HelpWidget extends Component {
    constructor(props) {
        super(props);
        this.state = {};
    }

    render() {
        return (
            <div className="support">

                <div className="support-header-container">
                    <i className="fa fa-search" aria-hidden="true" />
                    <span className="support-header-text">Need Help?</span>
                    <span className="phone-btn">
                        <i className="fa fa-phone" aria-hidden="true" />
                    </span>
                </div>

                <div className="support-body-container">

                    <span className="arrow-left" />

                    <span className="support-bubble">
                        <span className="support-bubble-text">
                            Unsure who you should list as a driver?
                        </span>
                    </span>

                </div>

                <div className="support-footer-container">

                    <input type="text" className="form-control search-text" placeholder="Search" />
                    <span id="search-btn" className="search-btn">&#62;</span>

                </div>

            </div>
        );
    }
}

HelpWidget.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

HelpWidget.defaultProps = {
    //myProp: val
};

export default HelpWidget;