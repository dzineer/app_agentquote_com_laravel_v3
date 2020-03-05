import React from 'react';
import PropTypes from 'prop-types';

/** function: ButtonGrid */
const ButtonGrid = (props) => {
    return (
        <div className={ props.parentClass } >
            { props.children }
        </div>
    );
};

ButtonGrid.propTypes = {
    children: PropTypes.object.isRequired,
    parentClass: PropTypes.string
};

ButtonGrid.defaultProps = {
    children: {},
    parentClass: ''
};

export default ButtonGrid;
