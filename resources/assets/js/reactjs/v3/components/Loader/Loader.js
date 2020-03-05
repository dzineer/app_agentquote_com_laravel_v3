import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class Loader */
class Loader extends Component {
    constructor(props) {
        super(props);
        this.state = {};
    }

    render() {
        return (
            <div>
                <img src="https://mymobilelifequoter.com/images/AQ_Logo_sym.png" />
            </div>
        );
    }
}

Loader.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

Loader.defaultProps = {
    //myProp: val
};

export default Loader;