import React from 'react';
import ReactDom, { render } from 'react-dom';
import PropTypes from 'prop-types';
import Image from '../Image';

/** Basic HTML Portrait */
const Portrait = ({name, src, width, height, className, style, alt, useDiv, showPortrait, ...props}) => {

    let localStyle = {
        "width": "160px",
        "height": "160px",
        "margin": "0px auto",
        "display": "inline-block",
        "borderRadius": "50%",
        "backgroundRepeat": "no-repeat",
        "backgroundPosition": "0 0",
        "backgroundSize": "cover",
        "backgroundImage": showPortrait ? "url(" + src + ")" : ""
    };

    let localPortraitStyle = {
        width: '100%',
        textAlign: 'center',
        display: 'inline-block',
        position: 'relative',
        marginTop: '60px'
    };

    // debugger;

    let results = useDiv ?
     ( <div className="portrait-container-container" style={localPortraitStyle}>
            <div className={className}>
                <div id={name} style={localStyle} />
            </div>
        </div> )
        :
     ( <div className="portrait-container-container" style={style.for.portrait}>
            <div className={className}>
                <Image htmlId={name} name={name} src={src} width={width} height={height} style={style.for.image}
                       />
            </div>
        </div> );

    return (
        results
    );
};

Portrait.propTypes = {
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
    alt: PropTypes.string,

    /** useDiv */
    useDiv: PropTypes.bool,

    /** showPhoto */
    showPortrait: PropTypes.bool
};

Portrait.defaultProps = {
    width: 160,
    height: 160,
    className: 'portrait-container',
    alt: '[User Portrait]',
    useDiv: false,
    showPortrait: true
};

export default Portrait;

