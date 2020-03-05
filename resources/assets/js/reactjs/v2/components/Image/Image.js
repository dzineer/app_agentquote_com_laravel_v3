import React from 'react';
import PropTypes from 'prop-types';
/** Basic HTML Logo */
const Image = ({htmlId, src, width, height, style, className, alt, ...props}) => {
    return (
        <div>
            <img id={htmlId} src={src} width={width} height={height} className={className} style={style} alt={alt} />
        </div>
    );
};

Image.propTypes = {

    /** htmlId */
    htmlId: PropTypes.string.isRequired,

    /** src */
    src: PropTypes.string.isRequired,

    /** Logo width */
    width: PropTypes.number,

    /** Logo height */
    height: PropTypes.number,

    /** Style */
    style: PropTypes.object,

    /** className */
    className: PropTypes.string,

    /** alt */
    alt: PropTypes.string
};

Image.defaultProps = {
    width: 160,
    height: 160,
    className: 'logo',
    alt: 'logo'
};

export default Image;