import React from 'react';

const defaultStyle = {"marginTop":"4px", "height":"25px","width":"25px","fill":"none","stroke":"#383838","strokeMiterlimit":"10","strokeWidth":"3px"};

const XIcon = () => {
    return (
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.92 24.92"
             style={Object.assign({}, defaultStyle, {"height": "14px", "width": "14px"})}>
            <title>x</title>
            <path className="cls-1" d="M13,13,35,35" transform="translate(-11.54 -11.54)"/>
            <path className="cls-1" d="M35,13,13,35" transform="translate(-11.54 -11.54)"/>
        </svg>
    );
};

export default XIcon;
