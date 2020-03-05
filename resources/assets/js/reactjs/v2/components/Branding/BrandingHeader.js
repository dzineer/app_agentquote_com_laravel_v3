import React from 'react';
import PropTypes from 'prop-types';
import {render} from "react-dom";
import LogoScroller from "../Carousel/LogoScroller";
import SiteLogo from "./SiteLogo";

/** function: BrandingHeader */
const BrandingHeader = (props) => {

    let getBrandInfo = () => {
        return props.UseLogo ?  <SiteLogo Logo={ props.Logo } Alt={"Branding Logo"} /> :
                                <span className="brand-name light">{ props.Company }</span>
    };

    return (
        <a className="brand" href="./">
            { getBrandInfo() }
        </a>
    );
};

BrandingHeader.propTypes = {
    UseLogo: PropTypes.bool.isRequired,
    Logo: PropTypes.string,
    Company: PropTypes.string,
};

BrandingHeader.defaultProps = {
    UseLogo: false,
    Logo: '',
    Company: '',
};

export default BrandingHeader;


jQuery(function() {

    if (document.getElementById('branding-header')) {
        render(
            <BrandingHeader UseLogo={ use_logo }  Logo={ brand_logo }  Company={ brand_company } />,
            document.getElementById('branding-header')
        );
    }

});
