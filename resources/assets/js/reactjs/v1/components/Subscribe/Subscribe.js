import React, {Component} from 'react';
import ReactDOM, {render} from 'react-dom';
import PropTypes from 'prop-types';

/** class Subscribe */
class Subscribe extends Component {
    constructor(props) {
        super(props);
        this.state = {};
    }

    render() {

        const styles = {
            "height": "100vh",
            "width": "650px",
            "display": "block",
            "margin": "0 auto"
        };

        return (
            <div>
                <iframe style={styles} src="https://subscriptions.zoho.com/subscribe/b71533dbc180f03dc8e60b8126a23fe8b9de07abf9a0975fad482bf477cf719e/34ert33er" frameBorder="0" />
            </div>
        );
    }
}

Subscribe.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

Subscribe.defaultProps = {
    //myProp: val
};

export default Subscribe;

if (document.getElementById('subscribe')) {
    render(
        <Subscribe />,
        document.getElementById('subscribe')
    )
}