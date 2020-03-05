import React from 'react';
import PropTypes from 'prop-types';
import {render} from "react-dom";
import LogoScroller from "../Carousel/LogoScroller";

/** function: SiteLogo */
const SiteLogo = (props) => {
    return (
        <img className="brand-logo" src={ props.Logo } alt={ props.Alt } />
    );
};

SiteLogo.propTypes = {
    Logo: PropTypes.string.isRequired,
    Alt: PropTypes.string
};

SiteLogo.defaultProps = {
    Logo: '',
    Alt: 'Branding Logo'
};

export default SiteLogo;
