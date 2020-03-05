import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class PricingColumn */
class PricingColumn extends Component {
    constructor(props) {
        super(props);
        this.state = {};
        this.styles = {
            body: {
                "minHeight": "150px",
                "padding": "24px",
                "border": "1px solid #eee",
                "borderRadius": "5px",
                "backgroundColor": "#f1f1f1"
            }
        };
    }

    render() {
        return (
            <div className={"center-block " + this.props.className} style={this.styles.body}>
                { this.props.children }
            </div>
        );
    }
}

PricingColumn.propTypes = {
    /** children */
    children: PropTypes.array.isRequired,
    className: PropTypes.string
};

PricingColumn.defaultProps = {
    children: [],
    className: ''
};

export default PricingColumn;