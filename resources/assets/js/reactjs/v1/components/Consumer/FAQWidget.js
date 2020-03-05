import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {render} from "react-dom";
import SupportWidget from "./SupportWidget";

/** class FAQWidget */
class FAQWidget extends Component {
    constructor(props) {
        super(props);
        this.state = {};
        this.faqs = [
            'Unsure who you should list as a driver?',
            'Unsure who you should list as a driver?',
            'Unsure who you should list as a driver?'
        ]
    }

    render() {
        return (
            <div>
                <div className="faq-container">
                    <div className="faq-header">

							<span className="question-mark-container">
								<i className="fa fa-question" aria-hidden="true" />
							</span>

                        <span className="faq-text-title">FAQs</span>
                    </div>
                    <div className="faq-body">
                        <ul>
                            { this.faqs.map( faq => {
                                return <li>{ faq }</li>
                            })}
                        </ul>
                    </div>
                </div>
            </div>
        );
    }
}

FAQWidget.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

FAQWidget.defaultProps = {
    //myProp: val
};

export default FAQWidget;

if (document.getElementById('faq-widget')) {
    render(
        <FAQWidget />,
        document.getElementById('faq-widget')
    );
}