import React, { Component } from 'react';
import ReactDom, { render } from 'react-dom';
import PropTypes from 'prop-types';
import FD3Frame from "./FD3Frame";

/** function: Modal */
class ThankYou extends Component {

    constructor(props) {
        super(props);

        this.props = props;

        this.state = {
        };

        this.token = jQuery('meta[name="csrf-token"]').attr('content')
    }

    onComponentDidMount = () => {
    };

    onLoadSubdomain = event => {
        event.preventDefault();

    };

    capitalize = (s) => {
        if (typeof s !== 'string') return '';
        return s.charAt(0).toUpperCase() + s.slice(1);
    };

    render() {

        const styles = {
            for: {
                label: {
                    textAlign: 'left',
                    width: '100%',
                    color: '#333 !important'
                },
                modalTitle: {
                    width: '100%',
                    textTransform: 'capitalize'
                }
            }
        };
        return (
                <div className="fluid-container">

                    <div className="aq-header-footer">
                        <div className="aq-header-footer-container">
                            <img
                                src="https://mymobilelifequoter.com/images/AQ_Logo_trns.png"/>
                        </div>
                    </div>

                    <div className="row">
                        <div className="container">
                            <div className="row">
                                <div className="col-md-12">
                                    <span className="thank-you-text">Thank You</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
        )

    }

}

ThankYou.propTypes = {

};

ThankYou.defaultProps = {
    //myProp: val
};

export default ThankYou;

if (document.getElementById('thank-you')) {
    render(
        <ThankYou />,
        document.getElementById('thank-you')
    )
}
