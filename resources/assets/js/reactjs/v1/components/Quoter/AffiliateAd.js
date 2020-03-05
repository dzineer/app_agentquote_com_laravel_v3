import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {render} from "react-dom";
import TermlifeForm from "./TermlifeForm";

/** class AffiliateAd */
class AffiliateAd extends Component {
    constructor(props) {
        super(props);

        this.state = {};

        this.styles = {
            ad: {
                "textAlign": "center",
                "margin": "40px",
                "fontSize": "1.5em",
                "lineHeight": "1.2em",
            }
        };

        this.generateAdInfo.bind(this);
    }

    getBody = () => {

        debugger;

        if (this.props.ad.message === 'null') {
            return '';
        }

        return (
            !! this.props.ad.message && <div style={this.styles.ad}>
                <p dangerouslySetInnerHTML={{__html: this.props.ad.message}} />
            </div>
        );
    };

    generateAdInfo = () => {
        return this.getBody();

        if (this.props.ad.link !== 'null') {
            return (
                <div style={this.styles.ad}>
                    <a href={this.props.ad.link} target='_blank'>{ this.props.ad.body }</a>
                </div>
            )
        }
        else {
            return this.getBody();
        }
    };

    render() {
        return (
            this.props.show &&

            <div>
                { this.generateAdInfo() }
                { this.props.children }
            </div>
        );
    }
}

AffiliateAd.propTypes = {
    ad: PropTypes.object.isRequired,
    show: PropTypes.bool.isRequired
    //myProp: PropTypes.string.isRequired
};

AffiliateAd.defaultProps = {
    ad: {},
    show: false
};

export default AffiliateAd;

