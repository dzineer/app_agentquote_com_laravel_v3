import React from 'react';

const defaultStyle = {"marginTop":"4px", "height":"25px","width":"25px","fill":"none","stroke":"#383838","strokeMiterlimit":"10","strokeWidth":"3px"};

const CopyIcon = () => {
    return (
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 31.47" style={defaultStyle}>
            <title>copy</title>
            <rect className="cls-1" x="1.5" y="1.5" width="34.17" height="21.64" rx="3.03"/>
            <path className="cls-1" d="M44.5,20V34.79a3.45,3.45,0,0,1-3.45,3.45H13.78"
                  transform="translate(-2 -8.26)"/>
        </svg>
    );
};

export default CopyIcon;
