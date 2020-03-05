import React from 'react';
import PropTypes from 'prop-types';

/** function: SelectedButton */
const SelectedButton = (props) => {
    return (
        <div className={ props.containerClass } id={ props.containerId } >
            <div id="selected-insurance-btn" className="selected-btn">
                <i className="dz-fa fa-2 selected-icon"  aria-hidden="true" />
            </div>
            <h4 className="insure-name">
                No selection.
            </h4>
        </div>


    );
};

SelectedButton.propTypes = {
    children: PropTypes.object.isRequired,
    containerClass: PropTypes.string,
    containerId: PropTypes.string
};

SelectedButton.defaultProps = {
    children: {},
    parentClass: ''
};

export default SelectedButton;
