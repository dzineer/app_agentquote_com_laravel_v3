import React, {Component} from 'react';
import ReactDom, {render} from 'react-dom';
import PropTypes from 'prop-types';

/** class Log */
class LogContainer extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div>
                { this.props.children }
            </div>
        );
    }
}

LogContainer.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

LogContainer.defaultProps = {
    //myProp: val
};

export default LogContainer;

if (document.getElementById("log-container")) {
    render(
        <LogContainer />,
        document.getElementById("log-container")
    )
}