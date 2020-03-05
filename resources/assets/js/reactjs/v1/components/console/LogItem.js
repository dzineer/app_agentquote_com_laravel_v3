import React, {Component} from 'react';
import PropTypes from 'prop-types';
import CarrierContainer from "../carrier2/CarrierContainer";
/** class LogItem */
const LogItem = ({message}) => {

    return (
        <div className="alert alert-success">
            <p className="mb-0">{ message } </p>
        </div>
    );
};

LogItem.propTypes = {
    /** myProp */
    message: PropTypes.object.isRequired
};

LogItem.defaultProps = {
    //myProp: val
    message: {}
};

export default LogItem;