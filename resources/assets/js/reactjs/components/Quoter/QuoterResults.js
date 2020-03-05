import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {render} from "react-dom";

/** class QuoterResults */
class QuoterResults extends Component {

    constructor(props) {
        super(props);
        this.state = {};
    }

    render() {
        return (
            <form>
                <h5 className="heading-info">Quote Results</h5>
            </form>
        );
    }
}

QuoterResults.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

QuoterResults.defaultProps = {
    //myProp: val
};

export default QuoterResults;

if (document.getElementById('quoter-results')) {
    render(<QuoterResults />,
        document.getElementById('quoter-results')
    );
}