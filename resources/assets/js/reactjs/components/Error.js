import React from 'react';
import PropTypes from 'prop-types';

/** function: Error */
const Error = ({error}) => {

    return ( error.length ?
            <div className="alert alert-danger" role="alert">
                {error}
            </div> : null);
};

Error.propTypes = {
    error: PropTypes.string
};

export default Error;