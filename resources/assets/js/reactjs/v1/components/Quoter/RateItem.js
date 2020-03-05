import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class RateItem */
class RateItem extends Component {
    constructor(props) {
        super(props);
        this.state = {};
        this.styles = {
            header: {
                span: {
                    display: 'block',
                    color: '#D87C0B',
                    fontWeight: 'bold'
                }
            },
            rate: {
                span: {
                    display: 'block',
                    color: '#333',
                    fontWeight: 'bold'
                }
            }
        };
    }

    render() {
/*        let rate = "0.00";
        if( this.props.RateAdj ) {
            const rateInfo = this.props.RateAdj.split(".");
            rate = this.props.RateAdj;
            if (rateInfo[1].length > 2) {
                rate = rateInfo[0] + "." + rateInfo[1].substring(0, 2);
            }
        }*/
        return (
            <div className="col col-xs-3" style={this.props.style}>
                <div className="rate-container">
                    <span style={this.styles.header.span}>{this.props.RateClassification}</span>
                    <span style={this.styles.rate.span}>{this.props.RateAdj}</span>
                </div>
            </div>
        );
    }
}

RateItem.propTypes = {
    /** RateClassification */
    RateClassification: PropTypes.string.isRequired,
    RateAdj: PropTypes.string.isRequired,
    style: PropTypes.object.isRequired
};

RateItem.defaultProps = {
    RateClassification: '',
    RateAdj: ''
};

export default RateItem;