import React from 'react';


const AddItemIcon = (props) => {

    let { color, strokeWidth } = props;
    let useColor = color !== undefined ? color : "#383838";
    let useStroke = strokeWidth !== undefined ? strokeWidth : "3px";

    const defaultStyle = {"marginTop":"4px", "height":"25px","width":"25px","fill":"none","stroke": useColor,"strokeMiterlimit":"10","strokeWidth":useStroke};
    debugger;
    return (
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22" style={ Object.assign({}, defaultStyle, {"marginTop": "-2px", "height": "20px", "width": "20px"} ) }>
            <title>Add Item</title>
            <line className="cls-1" x1="10.76" y1="5.15" x2="10.76" y2="16.85"/>
            <line className="cls-1" x1="5.15" y1="11" x2="16.85" y2="11"/>
            <rect className="cls-1" x="1.5" y="1.5" width="19" height="19" rx="3.03"/>
        </svg>
    );
};


export default AddItemIcon;
