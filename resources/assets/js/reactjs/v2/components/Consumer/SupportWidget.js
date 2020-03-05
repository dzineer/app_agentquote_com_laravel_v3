import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {render} from "react-dom";
import TermLifeQuoteWidget from "./QuoteWidgets/TermLifeQuoteWidget";

/** className SupportWidget */
class SupportWidget extends Component {
    constructor(props) {
        debugger;
        super(props);
        this.state = {};
        this.onSearch.bind(this);
    }

    componentDidMount() {

    }

    onSearch = (e) => {
        e.preventDefault();
        debugger;
        this.props.eventsRouter.emit('hello', { event: 'hello', data: 'Hello to TermLifeQuoterWidget'} );
    };

    render() {
        return (
            <div>

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
                    <span id="search-btn" className="search-btn" onClick={ this.onSearch }>&#62;</span>

                </div>

            </div>
        );
    }
}

SupportWidget.propTypes = {
    /** myProp */
    eventsRouter: PropTypes.func.isRequired
};

SupportWidget.defaultProps = {
    eventsRouter: () => {}
};

export default SupportWidget;

if (document.getElementById('support-widget')) {
    render(
        <SupportWidget eventsRouter={ FD3EventsRouter } />,
        document.getElementById('support-widget')
    );
}