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
                      display: 'block'
                }
            },
            rate: {
                span: {
                    display: 'block',
                    color: '#333'
                }
            }
        };
    }



    render() {
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