import React from 'react';
import PropTypes from 'prop-types';

/** function: Checkbox */
const Checkbox = ({name, label, onChange}) => {
    return (
    <div className="form-check">
        <label className="form-check-label" htmlFor={name}>
        <input className="form-check-input" type="checkbox" onChange={onChange} />
        {label}
        </label>
    </div>
    );
};

Checkbox.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
    name: PropTypes.string,
    label: PropTypes.string,
    onChange: PropTypes.func
};

Checkbox.defaultProps = {
    //myProp: val
    name: "Some Name",
    label: "Some Label",
    onChange: () => {}
};

export default Checkbox;