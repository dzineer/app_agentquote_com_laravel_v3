import React from 'react';
import ReactDom, { render } from 'react-dom';
import PropTypes from 'prop-types';
import Image from '../Image';

/** Basic HTML Logo */
const Logo = ({name, src, width, height, className, alt, ...props}) => {
    
    const style = {
        logoContainer: {
            margin: "15px 0",
            height: "160px"
        },
        image: {
            width: "100%",
            margin: "0px auto",
            display: "inline-block",
            height: "160px"
        }
    };
    
    return (
        <div className={className} style={style.logoContainer}>
            <Image htmlId={name} name={name} src={src} width={width} height={height} style={style.image} alt={alt} />
        </div>
    );
};

Logo.propTypes = {
    /** name */
    name: PropTypes.string.isRequired,

    /** src */
    src: PropTypes.string.isRequired,

    /** Logo width */
    width: PropTypes.number,

    /** Logo height */
    height: PropTypes.number,

    /** className */
    className: PropTypes.string,

    /** alt */
    alt: PropTypes.string
};

Logo.defaultProps = {
    width: 160,
    height: 160,
    className: 'logo-container',
    alt: 'logo-container'
};

export default Logo;

if (document.getElementById('logo')) {
    if (content.show_logo) {
        render(
            <Logo name="test" src={content.logo} width={160} height={160} className="logo-container"/>,
            document.getElementById('logo')
        );
    }
}