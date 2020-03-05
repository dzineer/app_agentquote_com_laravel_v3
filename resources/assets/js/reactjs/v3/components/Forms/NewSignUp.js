import React, {Component} from 'react';
import ReactDOM, { render } from 'react-dom';
import PropTypes from 'prop-types';

/** class NewSignUp */
class NewSignUp extends Component {
    constructor(props) {
        super(props);
        this.state = {};
    }

    render() {
        return (
            <div>

            </div>
        );
    }
}

NewSignUp.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

NewSignUp.defaultProps = {
    //myProp: val
};

export default NewSignUp;

if ( document.getElementById('#new-signup-form') ) {
    render(
        <NewSignUp />,
        document.getElementById('#new-signup-form')
    )
}