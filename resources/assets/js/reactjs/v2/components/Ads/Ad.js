import React, {Component} from 'react';
import PropTypes from 'prop-types';
import ReactDom from "react-dom";

/** class Ad */
class Ad extends Component {
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
            <div className="center-block" style={this.styles.body}>
                { this.props.children }
            </div>
        );
    }
}

Ad.propTypes = {
    /** children */
    children: PropTypes.object.isRequired
};

Ad.defaultProps = {
    children: {}
};

if (document.getElementById('ad')) {
    ReactDom.render(Ad,
        document.getElementById('ad')
    );
}

export default Ad;