import React from 'react';
import PropTypes from 'prop-types';

/** function: InsuranceDetails */
const InsuranceDetails = ({children}) => {
    return (
        <div>
            { children }
        </div>
    );
}

InsuranceDetails.propTypes = {

    children: PropTypes.object.isRequired
};

InsuranceDetails.defaultProps = {
    //myProp: val
    children: {}
};

export default InsuranceDetails;