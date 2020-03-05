import React from 'react';
import PropTypes from 'prop-types';

/** function: Icon */
const Icon = ({type, icon}) => {
    const sm_icon = type + " fa-" + icon;
    return (
        <i className={sm_icon}>&nbsp;</i>
    );
};

Icon.propTypes = {
    type: PropTypes.oneOf(['fas', 'fas', 'fab']).isRequired,
    icon: PropTypes.string.isRequired
};

Icon.defaultProps = {
    //myProp: val
};

export default Icon;