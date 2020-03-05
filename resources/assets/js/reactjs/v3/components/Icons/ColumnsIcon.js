import React from 'react';

const defaultStyle = {"marginTop":"4px", "height":"25px","width":"25px","fill":"none","stroke":"#383838","strokeMiterlimit":"10","strokeWidth":"3px"};

const ColumnsIcon = () => {
    return (
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 43.31 33.25"
             style={Object.assign({}, defaultStyle, {"marginTop": "10px", "height": "25px", "width": "25px"})}>
            <title>columns_size</title>
            <rect className="cls-1" x="1.5" y="1.5" width="40.31" height="30.25" rx="3.57"/>
            <path className="cls-1" d="M12,8V39" transform="translate(-2.34 -6.69)"/>
            <path className="cls-1" d="M25,8V39" transform="translate(-2.34 -6.69)"/>
        </svg>
    );
};

export default ColumnsIcon;
