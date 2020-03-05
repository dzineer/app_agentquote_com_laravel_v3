import React from 'react';
import ReactDom, { render } from 'react-dom';
import PropTypes from 'prop-types';

/** Basic HTML Portrait */
const NoPortrait = ({name, src, width, height, className, style, alt, ...props}) => {

    return (
        <div className="portrait-container-container" style={style.for.portrait} >
            <div className={className}>
                <div htmlId={name} name={name} width={width} height={height} style={style.for.noimage} alt={alt} />
            </div>
        </div>
    );
};

NoPortrait.propTypes = {
    /** name */
    name: PropTypes.string.isRequired,

    /** src */
    src: PropTypes.string.isRequired,

    /** Portrait width */
    width: PropTypes.number,

    /** Portrait height */
    height: PropTypes.number,

    /** className */
    className: PropTypes.string,

    /** styles */
    style: PropTypes.object,

    /** alt */
    alt: PropTypes.string
};

NoPortrait.defaultProps = {
    width: 160,
    height: 160,
    className: 'portrait-container',
    alt: 'portrait-container'
};

export default NoPortrait;

